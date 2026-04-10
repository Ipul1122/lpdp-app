<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat akun admin default
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'msyaifulloh2024@gmail.com',
            'password' => Hash::make('tes12345'),
        ]);
    }
}