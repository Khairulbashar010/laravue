<?php

namespace Database\Seeders;

use App\Models\Bill;
use Illuminate\Database\Seeder;

class BillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bill::updateOrCreate(
            [
                "biller_id" => 1,
                "customer_id" => rand(11,20),
                "bill_month" => date('Y-m-d')
            ],
            [
                "amount" => rand(1354,86541),
                "status" =>rand(1,2),
            ]
        );
    }
}
