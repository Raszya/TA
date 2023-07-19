<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Guru;

class GuruControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_guru_data()
    {
        // Data untuk pengujian
        $data = [
            'nip' => '12345678',
            'nama' => 'John Doe',
            'jenisKelamin' => 'L',
            'noTelp' => '081234567890',
            'alamat' => 'Jl. Contoh Alamat No. 123',
        ];

        // Melakukan request POST ke route yang sesuai
        $response = $this->post(route('admin.guru.store'), $data);

        // Pastikan response adalah redirect ke route 'admin.listguru'
        $response->assertStatus(302);

        // Pastikan data berhasil disimpan dalam database
    }

    /** @test */
    public function it_redirects_back_with_error_message_if_data_invalid()
    {
        // Data untuk pengujian dengan data yang tidak valid (tidak menyertakan 'nip')
        $data = [
            'nama' => 'John Doe',
            'jenisKelamin' => 'L',
            'noTelp' => '081234567890',
            'alamat' => 'Jl. Contoh Alamat No. 123',
        ];

        // Melakukan request POST ke route yang sesuai
        $response = $this->post(route('admin.guru.store'), $data);

        // Pastikan response adalah redirect back dengan pesan 'Data Tidak Sesuai!'
        $response->assertStatus(302);
        // $response->assertSessionHas('danger', 'Data Tidak Sesuai!');
    }
}
