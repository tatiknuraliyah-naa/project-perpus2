<?php

/*
======================================================
Nama File : ExampleTest.php
Fungsi : Memastikan halaman depan mengarahkan pengunjung ke login.
Bagian yang boleh diubah : Nama test dan ekspektasi halaman publik.
Bagian yang harus berhati-hati : URL serta nama route tujuan.
Bagian yang tidak boleh diubah : Pemanggilan HTTP test Laravel.
Risiko : Ekspektasi salah dapat menyembunyikan perubahan route yang tidak diinginkan.
======================================================
*/

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    /* JANGAN DIUBAH: halaman depan wajib mengarahkan pengguna anonim ke login. */
    public function test_the_homepage_redirects_guests_to_login(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('login'));
    }
}
