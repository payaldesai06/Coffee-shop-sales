<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeed extends Seeder {
  /**
   * Run the database product seeds.
   *
   * @return void
   */
  public function run() {
    $products = [
      [
        'name' => 'Gold Coffee',
        'description' => 'It is a best product of our cafe.',
        'profit_margin' => 25,
      ],
      [
        'name' => 'Arabic Coffee',
        'description' => 'It is a second best product of our cafe after Gold Coffee.',
        'profit_margin' => 15,
      ]
    ];
    collect($products)->map(function ($product) {
      Product::factory()->create($product);
    });
  }
}
