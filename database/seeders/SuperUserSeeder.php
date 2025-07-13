<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Adminjude',
            'email' => 'adminjude@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        return redirect()->route('login');
        // Additional logic if needed
    }
}
