<?php

namespace Tests\Unit\Sale;

use Tests\TestCase;
use App\Models\ProductSale;

class GetSaleTest extends TestCase {

  /**
   * @test
   * Function to test new get record sales
   */
  public function test_get_record_sale() {
    $totalSales = ProductSale::get()->count();
    $response = $this->call('GET', 'api/sale');
    $response = json_decode($response->content());
    $this->assertEquals(count((array)$response->payload->sales), $totalSales);
  }
}
