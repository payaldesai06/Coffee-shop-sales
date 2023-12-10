<?php

namespace Tests\Unit\Sale;

use Tests\TestCase;

class RecordSaleTest extends TestCase {

  /**
   * @test
   * Function to test new record sale
   */
  public function test_post_record_sale() {
    $sellingPrice = 23.33;
    $data = [
      'quantity' => 1,
      'unitCost' => 10,
      'sellingPrice' => $sellingPrice
    ];
    $response = $this->call('POST', 'api/sale/create', $data);
    $response = json_decode($response->content());
    $this->assertEquals($response->payload, $sellingPrice);
  }
}
