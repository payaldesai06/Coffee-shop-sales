<?php

namespace Database\Seeders;

use App\Models\ShippingCost;
use Illuminate\Database\Seeder;

class ShippingCostSeed extends Seeder {
  /**
   * Run the database product seeds.
   *
   * @return void
   */
  public function run() {
    ShippingCost::factory()->create([]);
  }
}
