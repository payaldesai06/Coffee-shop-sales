<?php

namespace App\Http\Resources\Sale;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource {
  public function toArray($request): array {
    return [
      'id' => $this->id,
      'product' => $this->product ? $this->product->name : '',
      'quantity' => $this->quantity ?? '',
      'unitCost' => $this->unit_cost ?? '',
      'sellingPrice' => $this->selling_price ?? '',
      'productProfitMargin' => $this->product_profit_margin ?? '',
      'productShippingCost' => $this->product_shipping_cost ?? '',
      'createdBy' => !empty($this->user) ? $this->user->name : '',
      'createdAt' => optional($this->created_at)->format(config('constant.date_time_format')) ?? "",
    ];
  }
}
