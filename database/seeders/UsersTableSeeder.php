<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Manager',
            'email' => 'manager@example.com',
            'role' => 'Manager',
            'password' => bcrypt('password')
        ]);

        for($i = 1; $i <= 4; $i++) {
            User::create([
                'name' => 'Seller '.$i,
                'email' => 'seller'.$i.'@example.com',
                'role' => 'Seller',
                'password' => bcrypt('password')
            ]);
        }
    }
}
