<?php

namespace Database\Seeders;

use App\Models\Barista;
use Illuminate\Database\Seeder;

class BaristaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Password ditulis plaintext di sini — otomatis di-hash oleh
        // casts() 'password' => 'hashed' di model Barista saat create().
        // Ganti 'password' / 'admin123' dengan password asli jika berbeda.

        Barista::create([
            'nama' => 'Admin Cravely',
            'posisi' => 'Admin',
            'shift' => null,
            'password' => 'admin123',
        ]);

        Barista::create([
            'nama' => 'Reza Utama',
            'posisi' => 'Head Barista',
            'shift' => 'Pagi',
            'password' => 'password',
        ]);

        Barista::create([
            'nama' => 'Siti Aisyah',
            'posisi' => 'Senior Barista',
            'shift' => 'Sore',
            'password' => 'password',
        ]);

        Barista::create([
            'nama' => 'Kevin Sanjaya',
            'posisi' => 'Junior Barista',
            'shift' => 'Pagi',
            'password' => 'password',
        ]);

        Barista::create([
            'nama' => 'Amanda Putri',
            'posisi' => 'Junior Barista',
            'shift' => 'Sore',
            'password' => 'password',
        ]);

        Barista::create([
            'nama' => 'Dimas Setiawan',
            'posisi' => 'Part Time Barista',
            'shift' => 'Malam',
            'password' => 'password',
        ]);
    }
}