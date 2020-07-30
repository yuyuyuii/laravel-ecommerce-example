<?php

use Illuminate\Database\Seeder;
use App\Coupon;
class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Coupon::create([
        'code' => 'ABCDE',
        'type' => 'fixed',
        'value' => 30,
      ]);

      Coupon::create([
        'code' => 'FGHIJ',
        'type' => 'percent',
        'percent_off' => 50,
      ]);

    }
}
