<?php

namespace Tests\Unit;

use App\Models\QrKunjunganToken;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class QrKunjunganTokenTest extends TestCase
{
    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    public function test_qr_is_not_active_before_start_at(): void
    {
        Carbon::setTestNow('2026-09-16 10:00:00');
        $token = new QrKunjunganToken(['aktif' => true, 'jam_mulai' => '10:01', 'jam_selesai' => '11:00', 'created_at' => '2026-09-16 08:00:00']);

        $this->assertTrue($token->belumAktif());
        $this->assertFalse($token->masihBerlaku());
    }

    public function test_qr_is_active_between_start_and_end_time(): void
    {
        Carbon::setTestNow('2026-09-16 10:00:00');
        $token = new QrKunjunganToken(['aktif' => true, 'jam_mulai' => '09:59', 'jam_selesai' => '10:01', 'created_at' => '2026-09-16 08:00:00']);

        $this->assertFalse($token->belumAktif());
        $this->assertFalse($token->sudahKedaluwarsa());
        $this->assertTrue($token->masihBerlaku());
    }

    public function test_qr_is_expired_after_end_time(): void
    {
        Carbon::setTestNow('2026-09-16 10:00:00');
        $token = new QrKunjunganToken(['aktif' => true, 'jam_mulai' => '09:00', 'jam_selesai' => '09:59', 'created_at' => '2026-09-16 08:00:00']);

        $this->assertTrue($token->sudahKedaluwarsa());
        $this->assertFalse($token->masihBerlaku());
    }
}
