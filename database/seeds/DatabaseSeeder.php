<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class); //categoriesテーブルを登録
        $this->call(ProductsTableSeeder::class); //productseederを登録
        $this->call(CouponsTableSeeder::class); //couponseederを登録
    }
}
