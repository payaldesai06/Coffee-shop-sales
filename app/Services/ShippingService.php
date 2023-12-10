<?php


namespace App\Services;

use App\Models\ShippingCost;
use Exception;
use Illuminate\Support\Facades\DB;

class ShippingService {

  /**
   * Get shipping cost list.
   * @return mixed
   * @throws Exception
   */
  public function getList() {
    return ShippingCost::with('user:id,name')->orderBy('id', 'desc')->get();
  }

  /**
   * Create shipping cost.
   * @param $request
   * @return mixed
   * @throws Exception
   */
  public function create($request) {
    return DB::transaction(function () {
      ShippingCost::where('status', 'active')->update(['status' => 'inactive']); // make other shipping cost inactive
      $getValidatedData = $this->getValidatedData();
      return ShippingCost::create($getValidatedData);
    });
  }

  /**
   * Validated request data to create shipping cost.
   * @return array
   */
  private function getValidatedData(): array {
    return [
      'shipping_cost' => request('shippingCost') ?? null
    ];
  }
}
