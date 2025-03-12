<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'mohammed',
            'username' => 'moe',
            'email' => 'mohammed@gmail.com',
            'password' => bcrypt('Mododo126')
        ]);
    }
}
