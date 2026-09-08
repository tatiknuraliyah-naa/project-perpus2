<?php

/*
======================================================
Nama File : ExampleTest.php
Fungsi : Memastikan halaman depan publik tersedia pada URL landing yang ditetapkan.
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
    public function test_the_landing_page_is_available_at_its_public_url(): void
    {
        $response = $this->get('/perpustakaan-acityawiguna');

        $response->assertOk();
        $response->assertSee('Perpustakaan Acitya Wiguna');
    }

    public function test_the_root_url_redirects_to_the_landing_page(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('landing'));
    }

    public function test_guests_are_redirected_to_login_before_opening_the_catalog(): void
    {
        $response = $this->get('/katalog');

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('login_notice', 'Silakan login terlebih dahulu untuk mengakses katalog.');
        $response->assertSessionHas('url.intended', route('katalog.index'));

        $this->followingRedirects()
            ->get('/katalog')
            ->assertOk()
            ->assertSee('Silakan login terlebih dahulu untuk mengakses katalog.');
    }

    public function test_direct_login_does_not_show_the_catalog_notice(): void
    {
        $response = $this->get('/login');

        $response->assertOk();
        $response->assertDontSee('Silakan login terlebih dahulu untuk mengakses katalog.');
    }
}
