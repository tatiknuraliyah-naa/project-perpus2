<?php

namespace Tests\Feature;

use App\Http\Controllers\BukuController;
use App\Models\Buku;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mockery;
use Tests\TestCase;

class BukuControllerTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }

    public function test_book_with_loan_history_cannot_be_deleted(): void
    {
        $relation = Mockery::mock(HasMany::class);
        $relation->shouldReceive('exists')->once()->andReturnTrue();

        $buku = Mockery::mock(Buku::class);
        $buku->shouldReceive('detailPeminjaman')->once()->andReturn($relation);
        $buku->shouldNotReceive('delete');

        $response = app(BukuController::class)->destroy($buku);

        $this->assertSame(302, $response->getStatusCode());
        $this->assertSame(
            'Buku tidak dapat dihapus karena sudah tercatat dalam transaksi peminjaman. Ubah statusnya menjadi Tidak Aktif agar riwayat tetap terjaga.',
            session('error')
        );
    }

    public function test_book_without_loan_history_can_be_deleted(): void
    {
        $relation = Mockery::mock(HasMany::class);
        $relation->shouldReceive('exists')->once()->andReturnFalse();

        $buku = Mockery::mock(Buku::class);
        $buku->shouldReceive('detailPeminjaman')->once()->andReturn($relation);
        $buku->shouldReceive('delete')->once();

        $response = app(BukuController::class)->destroy($buku);

        $this->assertSame(route('buku.index'), $response->getTargetUrl());
        $this->assertSame('Data buku berhasil dihapus.', session('success'));
    }
}
