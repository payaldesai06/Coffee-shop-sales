<?php


namespace App\Services;

use App\Models\Product;
use App\Models\ProductSale;
use App\Models\ShippingCost;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Sale\SaleResource;

class SaleService {

  /**
   * Get sale list.
   * @return mixed
   * @throws Exception
   */
  public function getList() {
    return DB::transaction(function () {
    $data = [];
    $sales = ProductSale::with([
      'user:id,name',
      'product:id,name'
    ])->orderBy('id', 'desc')
    ->get();
    $data['sales'] = SaleResource::collection($sales);
    $data['products'] = Product::orderBy('name')->select('name', 'id', 'profit_margin')->get();
    $data['shippingCost'] = ShippingCost::where('status', 'active')->latest()->first()->shipping_cost ?? 0;
    return $data;
});
  }

  /**
   * Create sale.
   * @param $request
   * @return mixed
   * @throws Exception
   */
  public function create() {
    return DB::transaction(function () {
      $getValidatedData = $this->getValidatedData();
      $sale = ProductSale::create($getValidatedData);
      return $sale->selling_price;
    });
  }

  /**
   * Validated request data to create category.
   * @return array
   */
  private function getValidatedData(): array {
    return [
      'product_id' => request('product') ?? null,
      'quantity' => request('quantity') ?? null,
      'unit_cost' => request('unitCost') ?? null,
      'selling_price' => request('sellingPrice') ? round(request('sellingPrice'), 2) : null,
      'product_profit_margin' => request('profitMargin') ?? null,
      'product_shipping_cost' => request('shippingCost') ?? null,
    ];
  }
}
