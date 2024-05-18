<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'title' => 'Back-end Developer',
            'name' => 'Daniel Kassaw',
            'phone' => '0930648557',
            'email' => 'kassawdaniel7@gmail.com',
            'profile_image' => 'top_image.jpg',
            'company' => 'Kuraz Techologis',
            'gender' => 'male',
        ]);
    }
}
