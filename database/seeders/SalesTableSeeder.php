<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sales;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 2; $i <=5; $i++) {
            Sales::create([
                'user_id' => $i,
                'total_sales' => 100*$i,
                'sale_date' => '2022-01-0'.$i
            ]);
        }
    }
}
