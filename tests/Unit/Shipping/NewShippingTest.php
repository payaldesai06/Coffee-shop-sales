<?php

namespace Tests\Unit\Shipping;

use Tests\TestCase;

class NewShippingTest extends TestCase {

  /**
   * @test
   * Function to test new shipping cost
   */
  public function test_post_shipping_cost() {
    $data = [
      'shippingCost' => 20
    ];
    $response = $this->call('POST', 'api/shipping/create', $data);
    $response = json_decode($response->content());
    $this->assertEquals($response->message, "Ok");
  }
}
