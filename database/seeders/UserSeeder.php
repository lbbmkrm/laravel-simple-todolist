<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User([
            'email' => 'admin@example.com',
            'username' => 'admin',
            'password' => bcrypt('root')
        ]);
        $user->save();
    }
}
