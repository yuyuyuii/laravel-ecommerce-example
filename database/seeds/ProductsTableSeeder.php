<?php

use Illuminate\Database\Seeder;
use App\Product; //productモデルを追加

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() //テストデータを登録
    {
      Product::create([
        'name' => 'MacBook Pro',
        'slug' => 'macbook-pro',
        'details' => '15 inch, 1TB SSD, 32GB RAM',
        'price' => 24999,
        'description' => 'mac book description, mac book description, mac book description'
      ]);

      Product::create([
        'name' => 'Laptop 1',
        'slug' => 'laptop-1',
        'details' => '15 inch, 1TB SSD, 32GB RAM',
        'price' => 14999,
        'description' => 'laptop description, mac book description, mac book description'
      ]);

      Product::create([
        'name' => 'Laptop 2',
        'slug' => 'laptop-2',
        'details' => '15 inch, 1TB SSD, 32GB RAM',
        'price' => 14999,
        'description' => 'laptop description, mac book description, mac book description'
      ]);


      Product::create([
        'name' => 'Laptop 3',
        'slug' => 'laptop-3',
        'details' => '15 inch, 1TB SSD, 32GB RAM',
        'price' => 14999,
        'description' => 'laptop description, mac book description, mac book description'
      ]);

      Product::create([
        'name' => 'Laptop 4',
        'slug' => 'laptop-4',
        'details' => '15 inch, 1TB SSD, 32GB RAM',
        'price' => 14999,
        'description' => 'laptop description, mac book description, mac book description'
      ]);

      Product::create([
        'name' => 'Laptop 5',
        'slug' => 'laptop-5',
        'details' => '15 inch, 1TB SSD, 32GB RAM',
        'price' => 14999,
        'description' => 'laptop description, mac book description, mac book description'
      ]);

      Product::create([
        'name' => 'Laptop 6',
        'slug' => 'laptop-6',
        'details' => '15 inch, 1TB SSD, 32GB RAM',
        'price' => 14999,
        'description' => 'laptop description, mac book description, mac book description'
      ]);

      Product::create([
        'name' => 'Laptop 7',
        'slug' => 'laptop-7',
        'details' => '15 inch, 1TB SSD, 32GB RAM',
        'price' => 14999,
        'description' => 'laptop description, mac book description, mac book description'
      ]);

      Product::create([
        'name' => 'Laptop 8',
        'slug' => 'laptop-8',
        'details' => '15 inch, 1TB SSD, 32GB RAM',
        'price' => 14999,
        'description' => 'laptop description, mac book description, mac book description'
      ]);

      Product::create([
        'name' => 'Laptop 9',
        'slug' => 'laptop-9',
        'details' => '15 inch, 1TB SSD, 32GB RAM',
        'price' => 14999,
        'description' => 'laptop description, mac book description, mac book description'
      ]);

      
    }
}
