<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run() {
    $this->call(UserSeed::class);
    $this->call(ProductSeed::class);
    $this->call(ShippingCostSeed::class);
  }
}
