<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Wisata',
            'email' => 'admin@wisata.test',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'User Wisata',
            'email' => 'user@wisata.test',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        \App\Models\TouristPlace::insert([
            [
                'name' => 'Pantai Labuhan Bajo',
                'description' => 'Pantai eksotis di Flores dengan pemandangan Pulau Komodo yang memukau. Pasir putih, laut biru jernih, dan sunset yang tak terlupakan untuk petualangan snorkeling dan diving.',
                'price' => 350000,
                'image' => '/images/labuhan-bajo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alahan Panjang',
                'description' => 'Puncak bukit di Sumatera Barat dengan pemandangan terasering sawah yang menakjubkan. Spot terbaik untuk fotografi alam dan menikmati keindahan landscape yang masih asri.',
                'price' => 275000,
                'image' => '/images/alahan-panjang.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Danau Toba',
                'description' => 'Danau terbesar di Indonesia dengan pulau Samosir di tengahnya. Menikmati keindahan alam yang memesona, budaya Batak, dan aktivitas air yang seru untuk liburan keluarga.',
                'price' => 400000,
                'image' => '/images/danau-toba.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bali',
                'description' => 'Pulau dewata dengan pantai pasir putih, pura kuno, dan budaya Hinduisme yang kaya. Destinasi lengkap untuk liburan dengan aktivitas surfing, yoga, budaya, dan kuliner terbaik.',
                'price' => 500000,
                'image' => '/images/bali.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
