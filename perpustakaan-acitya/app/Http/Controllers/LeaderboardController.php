<?php

namespace App\Http\Controllers;

use App\Models\AchievementPengguna;
use App\Models\Anggota;
use App\Models\DetailPeminjaman;
use App\Models\Kunjungan;
use App\Models\Leaderboard;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class LeaderboardController extends Controller
{
    private const PERIODS = ['Bulanan', 'Semester', 'Tahunan'];

    public function index(Request $request): View
    {
        $periode = $request->string('periode')->value();
        $periode = in_array($periode, self::PERIODS, true) ? $periode : 'Bulanan';
        $tahun = $request->integer('tahun') ?: now()->year;
        $semester = $request->integer('semester');
        $semester = in_array($semester, [1, 2], true) ? $semester : (now()->month <= 6 ? 1 : 2);
        $bulanDipilih = $request->integer('bulan');
        $bulanDipilih = in_array($bulanDipilih, range(1, 12), true) ? $bulanDipilih : now()->month;

        [$mulai, $selesai, $bulan] = $this->rentangPeriode($periode, $tahun, $semester, $bulanDipilih);
        $leaderboard = $this->perbaruiPeringkat($periode, $tahun, $bulan, $mulai, $selesai);

        return view('leaderboard.index', compact(
            'leaderboard',
            'periode',
            'tahun',
            'semester',
            'bulan',
            'mulai',
            'selesai',
        ));
    }

    /**
     * @return array{Carbon, Carbon, int}
     */
    private function rentangPeriode(string $periode, int $tahun, int $semester, int $bulanDipilih): array
    {
        if ($periode === 'Tahunan') {
            return [Carbon::create($tahun, 1, 1)->startOfDay(), Carbon::create($tahun, 12, 31)->endOfDay(), 0];
        }

        if ($periode === 'Semester') {
            $bulanMulai = $semester === 1 ? 1 : 7;
            $bulanAkhir = $semester === 1 ? 6 : 12;

            return [
                Carbon::create($tahun, $bulanMulai, 1)->startOfDay(),
                Carbon::create($tahun, $bulanAkhir, 1)->endOfMonth(),
                $bulanAkhir,
            ];
        }

        return [
            Carbon::create($tahun, $bulanDipilih, 1)->startOfDay(),
            Carbon::create($tahun, $bulanDipilih, 1)->endOfMonth(),
            $bulanDipilih,
        ];
    }

    private function perbaruiPeringkat(string $periode, int $tahun, int $bulan, Carbon $mulai, Carbon $selesai): Collection
    {
        $tanggalMulai = $mulai->toDateString();
        $tanggalSelesai = $selesai->toDateString();
        $anggota = Anggota::query()
            ->select(['id', 'nama', 'role', 'kelas', 'jurusan', 'jabatan'])
            ->get();

        $bukuDipinjam = DetailPeminjaman::query()
            ->join('peminjaman', 'detail_peminjaman.peminjaman_id', '=', 'peminjaman.id')
            ->whereBetween('peminjaman.tanggal_pinjam', [$tanggalMulai, $tanggalSelesai])
            ->whereIn('peminjaman.status', ['Dipinjam', 'Dikembalikan', 'Terlambat', 'Penggantian Buku'])
            ->groupBy('peminjaman.anggota_id')
            ->select('peminjaman.anggota_id')
            ->selectRaw('SUM(detail_peminjaman.jumlah) as total_buku_dipinjam')
            ->pluck('total_buku_dipinjam', 'peminjaman.anggota_id')
            ->map(static fn ($total): int => (int) $total);

        $kunjungan = Kunjungan::query()
            ->whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai])
            ->groupBy('anggota_id')
            ->select('anggota_id')
            ->selectRaw('COUNT(*) as total_kunjungan')
            ->pluck('total_kunjungan', 'anggota_id')
            ->map(static fn ($total): int => (int) $total);

        $pengembalianTepatWaktu = Pengembalian::query()
            ->join('peminjaman', 'pengembalian.peminjaman_id', '=', 'peminjaman.id')
            ->whereBetween('pengembalian.tanggal_kembali', [$tanggalMulai, $tanggalSelesai])
            ->whereColumn('peminjaman.tanggal_jatuh_tempo', '>=', 'pengembalian.tanggal_kembali')
            ->groupBy('peminjaman.anggota_id')
            ->select('peminjaman.anggota_id')
            ->selectRaw('COUNT(*) as total_pengembalian_tepat_waktu')
            ->pluck('total_pengembalian_tepat_waktu', 'peminjaman.anggota_id')
            ->map(static fn ($total): int => (int) $total);

        $achievement = AchievementPengguna::query()
            ->whereBetween('tanggal_didapat', [$tanggalMulai, $tanggalSelesai])
            ->groupBy('anggota_id')
            ->select('anggota_id')
            ->selectRaw('COUNT(*) as total_achievement')
            ->pluck('total_achievement', 'anggota_id')
            ->map(static fn ($total): int => (int) $total);

        $baris = $anggota
            ->map(function (Anggota $anggota) use ($bukuDipinjam, $kunjungan, $pengembalianTepatWaktu, $achievement): array {
                $totalBukuDipinjam = (int) $bukuDipinjam->get($anggota->id, 0);
                $totalKunjungan = (int) $kunjungan->get($anggota->id, 0);
                $totalPengembalianTepatWaktu = (int) $pengembalianTepatWaktu->get($anggota->id, 0);
                $totalAchievement = (int) $achievement->get($anggota->id, 0);

                return [
                    'anggota' => $anggota,
                    'buku_dipinjam' => $totalBukuDipinjam,
                    'kunjungan' => $totalKunjungan,
                    'achievement' => $totalAchievement,
                    'total_poin' => ($totalBukuDipinjam * 10) + ($totalPengembalianTepatWaktu * 5) + ($totalKunjungan * 2) + ($totalAchievement * 20),
                ];
            })
            ->filter(fn (array $baris): bool => $baris['total_poin'] > 0)
            ->sortBy([
                ['total_poin', 'desc'],
                ['buku_dipinjam', 'desc'],
                [fn (array $baris) => $baris['anggota']->nama, 'asc'],
            ])
            ->values();

        $sekarang = now();
        $peringkat = $baris->map(function (array $barisAnggota, int $index): array {
            $barisAnggota['peringkat'] = $index + 1;

            return $barisAnggota;
        })->values();

        if ($peringkat->isNotEmpty()) {
            Leaderboard::query()->upsert(
                $peringkat->map(fn (array $barisAnggota) => [
                    'anggota_id' => $barisAnggota['anggota']->id,
                    'periode' => $periode,
                    'tahun' => $tahun,
                    'bulan' => $bulan,
                    'total_poin' => $barisAnggota['total_poin'],
                    'peringkat' => $barisAnggota['peringkat'],
                    'created_at' => $sekarang,
                    'updated_at' => $sekarang,
                ])->all(),
                ['anggota_id', 'periode', 'tahun', 'bulan'],
                ['total_poin', 'peringkat', 'updated_at'],
            );
        }

        return $peringkat;
    }
}
