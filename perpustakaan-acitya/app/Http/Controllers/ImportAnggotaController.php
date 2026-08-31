<?php

namespace App\Http\Controllers;

use App\Exports\TemplateAnggotaExport;
use App\Imports\ReadAnggotaImport;
use App\Models\Anggota;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class ImportAnggotaController extends Controller
{
    private const FIELDS = ['nama', 'role', 'nis_nisn', 'nip', 'kelas', 'jurusan', 'jabatan', 'email', 'no_hp'];
    private const LABELS = ['nama' => 'Nama', 'role' => 'Role', 'nis_nisn' => 'NIS/NISN', 'nip' => 'NIP', 'kelas' => 'Kelas', 'jurusan' => 'Jurusan', 'jabatan' => 'Jabatan', 'email' => 'Email', 'no_hp' => 'Nomor HP'];
    private const ALIASES = [
        'nama' => ['nama', 'nama lengkap', 'nama siswa', 'nama anggota', 'full name'],
        'role' => ['role', 'peran', 'jenis anggota', 'status anggota'],
        'nis_nisn' => ['nis', 'nisn', 'nis/nisn', 'nis nisn', 'nomor induk siswa'],
        'nip' => ['nip', 'nomor induk pegawai'],
        'kelas' => ['kelas', 'rombel', 'kelas siswa'],
        'jurusan' => ['jurusan', 'kompetensi keahlian', 'konsentrasi keahlian', 'program keahlian'],
        'jabatan' => ['jabatan', 'posisi'],
        'email' => ['email', 'e-mail', 'alamat email'],
        'no_hp' => ['no hp', 'no. hp', 'nomor hp', 'no handphone', 'nomor handphone', 'telepon', 'whatsapp', 'wa'],
    ];

    public function create(Request $request): View
    {
        $this->forgetPendingFile($request);
        return view('anggota.import');
    }

    /** Unggah hanya membuat pratinjau; belum menyimpan anggota. */
    public function preview(Request $request): View|RedirectResponse
    {
        $request->validate(['file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:5120']]);
        $this->forgetPendingFile($request);
        $file = $request->file('file');
        $path = $file->store('import-anggota');

        try { $rows = $this->readRows(Storage::path($path)); }
        catch (Throwable $e) {
            Storage::delete($path);
            Log::error('Gagal membaca file import anggota.', ['exception' => $e::class, 'message' => $e->getMessage(), 'file_name' => $file->getClientOriginalName()]);
            return back()->withInput()->with('error', 'File tidak dapat dibaca. Detail kesalahan dicatat pada log aplikasi.');
        }
        if ($rows === null || $rows->isEmpty()) { Storage::delete($path); return back()->withInput()->with('error', 'File tidak berisi data.'); }

        $headers = $rows->shift()->values()->map(fn ($value) => trim((string) $value))->all();
        if (collect($headers)->filter()->isEmpty()) { Storage::delete($path); return back()->withInput()->with('error', 'Baris header tidak ditemukan pada file.'); }

        $token = bin2hex(random_bytes(20));
        $mapping = $this->detectMapping($headers);
        $request->session()->put('anggota_import_pending', compact('token', 'path', 'headers') + ['name' => $file->getClientOriginalName()]);

        return view('anggota.import-preview', ['token' => $token, 'headers' => $headers, 'mapping' => $mapping, 'previewRows' => $this->previewRows($rows, $mapping), 'fileName' => $file->getClientOriginalName(), 'labels' => self::LABELS]);
    }

    public function confirm(Request $request): RedirectResponse
    {
        $pending = $request->session()->get('anggota_import_pending');
        if (! is_array($pending) || ! hash_equals($pending['token'] ?? '', (string) $request->input('token'))) return redirect()->route('anggota.import.create')->with('error', 'Sesi pratinjau sudah berakhir. Unggah file kembali.');
        $mapping = $this->validatedMapping($request->input('mapping', []), $pending['headers']);
        if ($mapping['nama'] === null) return back()->with('error', 'Petakan salah satu kolom file ke field Nama sebelum mengonfirmasi import.');

        try { $rows = $this->readRows(Storage::path($pending['path'])); }
        catch (Throwable $e) {
            Log::error('Gagal membaca ulang file import anggota.', ['exception' => $e::class, 'message' => $e->getMessage(), 'file_name' => $pending['name']]);
            $this->forgetPendingFile($request);
            return redirect()->route('anggota.import.create')->with('error', 'File sementara tidak dapat dibaca. Unggah file kembali.');
        }
        $rows?->shift();
        $result = $this->importRows($rows ?? collect(), $mapping);
        $this->forgetPendingFile($request);
        return redirect()->route('anggota.index')->with('success', "Import selesai: {$result['success']} data berhasil diimport.")->with('import_summary', $result)->with('import_failures', $result['failures']);
    }

    public function template()
    {
        try { return Excel::download(new TemplateAnggotaExport, 'contoh-format-import-anggota.xlsx'); }
        catch (Throwable $e) {
            Log::error('Gagal membuat template import anggota.', ['exception' => $e::class, 'message' => $e->getMessage()]);
            return redirect()->route('anggota.import.create')->with('error', 'Template Excel tidak dapat dibuat. Silakan periksa log aplikasi.');
        }
    }

    private function readRows(string $path): ?Collection { return Excel::toCollection(new ReadAnggotaImport, $path)->first(); }

    private function detectMapping(array $headers): array
    {
        $normalized = array_map(fn ($header) => $this->normalizeHeader($header), $headers);
        $mapping = array_fill_keys(self::FIELDS, null);
        foreach (self::ALIASES as $field => $aliases) foreach ($aliases as $alias) {
            $index = array_search($this->normalizeHeader($alias), $normalized, true);
            if ($index !== false) { $mapping[$field] = $index; break; }
        }
        return $mapping;
    }

    private function validatedMapping(array $mapping, array $headers): array
    {
        $result = array_fill_keys(self::FIELDS, null);
        foreach (self::FIELDS as $field) {
            $index = $mapping[$field] ?? null;
            if ($index !== null && $index !== '' && filter_var($index, FILTER_VALIDATE_INT) !== false && array_key_exists((int) $index, $headers)) $result[$field] = (int) $index;
        }
        return $result;
    }

    private function previewRows(Collection $rows, array $mapping): array
    {
        return $rows->values()->filter(fn ($row) => $row->filter(fn ($value) => $value !== null && $value !== '')->isNotEmpty())->take(5)
            ->map(fn ($row, $index) => ['line' => $index + 2, 'data' => $this->mapRow($row->values()->all(), $mapping)])->all();
    }

    private function importRows(Collection $rows, array $mapping): array
    {
        $result = ['total' => 0, 'success' => 0, 'failed' => 0, 'duplicates' => 0, 'skipped' => 0, 'failures' => []];
        $seen = ['nis_nisn' => [], 'nip' => [], 'email' => []];
        foreach ($rows->values() as $index => $row) {
            $line = $index + 2; $data = $this->mapRow($row->values()->all(), $mapping);
            if (collect($data)->filter()->isEmpty()) { $result['skipped']++; continue; }
            $result['total']++; $data['role'] = $this->resolveRole($data);
            $validator = Validator::make($data, $this->rules(), [], self::LABELS);
            $validator->after(function ($validator) use ($data, $mapping, $seen) {
                if ($data['role'] === 'Siswa' && $data['nis_nisn'] === null) $validator->errors()->add('nis_nisn', 'NIS/NISN wajib untuk Siswa.');
                if (in_array($data['role'], ['Guru', 'Karyawan'], true) && $mapping['nip'] !== null && $data['nip'] === null) $validator->errors()->add('nip', 'NIP wajib diisi karena kolom NIP tersedia pada file.');
                foreach (array_keys($seen) as $field) if ($data[$field] !== null && isset($seen[$field][strtolower($data[$field])])) $validator->errors()->add($field, self::LABELS[$field]." duplikat dalam file (baris {$seen[$field][strtolower($data[$field])]})");
            });
            if ($validator->fails()) { $this->addFailure($result, $line, $data['nama'], $validator->errors()->all()); continue; }
            try {
                DB::transaction(fn () => Anggota::create([...$data, 'password' => Hash::make('Acitya123!'), 'status' => 'Aktif']));
                foreach (array_keys($seen) as $field) if ($data[$field] !== null) $seen[$field][strtolower($data[$field])] = $line;
                $result['success']++;
            } catch (Throwable $e) {
                Log::error('Gagal menyimpan baris import anggota.', ['baris' => $line, 'exception' => $e::class, 'message' => $e->getMessage()]);
                $this->addFailure($result, $line, $data['nama'], ['Data tidak dapat disimpan. Periksa nilai unik NIS/NISN, NIP, atau email.'], true);
            }
        }
        return $result;
    }

    private function addFailure(array &$result, int $line, ?string $name, array $errors, bool $duplicate = false): void
    {
        $result['failed']++; $result['duplicates'] += $duplicate || collect($errors)->contains(fn ($error) => str_contains(strtolower($error), 'sudah digunakan') || str_contains(strtolower($error), 'duplikat')) ? 1 : 0;
        $result['failures'][] = "Baris {$line}".($name ? " ({$name})" : '').': '.implode(', ', $errors);
    }

    private function mapRow(array $row, array $mapping): array
    {
        $data = [];
        foreach (self::FIELDS as $field) { $value = $mapping[$field] === null ? null : ($row[$mapping[$field]] ?? null); $data[$field] = is_scalar($value) ? trim((string) $value) : null; if ($data[$field] === '') $data[$field] = null; }
        return $data;
    }

    private function resolveRole(array $data): ?string
    {
        $roles = ['siswa' => 'Siswa', 'guru' => 'Guru', 'karyawan' => 'Karyawan'];
        if ($data['role'] !== null && isset($roles[strtolower($data['role'])])) return $roles[strtolower($data['role'])];
        if ($data['nis_nisn'] !== null) return 'Siswa';
        if ($data['nip'] !== null) return preg_match('/guru|pengajar|pendidik|wali\\s*kelas/ui', $data['jabatan'] ?? '') ? 'Guru' : 'Karyawan';
        return null;
    }

    private function rules(): array { return ['nama' => ['required', 'string', 'max:150'], 'role' => ['required', Rule::in(['Siswa', 'Guru', 'Karyawan'])], 'nis_nisn' => ['nullable', 'string', 'max:30', Rule::unique('anggota', 'nis_nisn')], 'nip' => ['nullable', 'string', 'max:30', Rule::unique('anggota', 'nip')], 'kelas' => ['nullable', 'string', 'max:20'], 'jurusan' => ['nullable', 'string', 'max:100'], 'jabatan' => ['nullable', 'string', 'max:100'], 'email' => ['nullable', 'email', 'max:150', Rule::unique('anggota', 'email')], 'no_hp' => ['nullable', 'string', 'max:20', 'regex:/^(?:\\+62|62|0)[0-9]{8,18}$/']]; }
    private function normalizeHeader(string $header): string { return preg_replace('/[^a-z0-9]+/i', '', strtolower(trim(ltrim($header, "\xEF\xBB\xBF")))); }
    private function forgetPendingFile(Request $request): void { $pending = $request->session()->pull('anggota_import_pending'); if (is_array($pending) && isset($pending['path'])) Storage::delete($pending['path']); }
}
