<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {  
        $this->call(UsersTableSeeder::class); // need to run first,because has foreign key user_id
        $this->call(SalesTableSeeder::class);
    }
}
