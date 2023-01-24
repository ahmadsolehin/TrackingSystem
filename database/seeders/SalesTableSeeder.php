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
        for($i = 1; $i <=4; $i++) {
            Sales::create([
                'user_id' => '2',
                'total_sales' => 3*$i*2-0.3,
                'sale_date' => '2023-01-'.$i
            ]);
        }
    }
}
