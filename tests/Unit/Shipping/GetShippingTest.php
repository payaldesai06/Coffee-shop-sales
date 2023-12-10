<?php

namespace Tests\Unit\Shipping;

use Tests\TestCase;
use App\Models\ShippingCost;

class GetShippingTest extends TestCase {

  /**
   * @test
   * Function to test new get shipping costs
   */
  public function test_get_record_sale() {
    $totalShippingCosts = ShippingCost::get()->count();
    $response = $this->call('GET', 'api/shipping');
    $response = json_decode($response->content());
    $this->assertEquals(count((array)$response->payload), $totalShippingCosts);
  }
}
