<?php

namespace Tests\Unit;

use Tests\TestCase;

class RecordSalesTest extends TestCase {

  public function test_record_sale() {
    $sellingPrice = 23.33;
    $data = [
        'quantity' => 1,
        'unitCost' => 10
    ];
    $response = $this->call('POST', 'api/sale/create', $data)->decodeResponseJson();
    $this->assertEquals($response['payload'], $sellingPrice);
  }
}
