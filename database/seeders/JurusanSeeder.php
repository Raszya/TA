<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusan = Jurusan::create([
            'nama' => 'IPA',
        ]);
        $jurusan = Jurusan::create([
            'nama' => 'IPS',
        ]);
        $jurusan = Jurusan::create([
            'nama' => 'Bahasa',
        ]);
    }
}