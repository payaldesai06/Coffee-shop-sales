<?php

namespace App\Http\Resources\Shipping;

use Illuminate\Http\Resources\Json\JsonResource;

class ShippingResource extends JsonResource {
  public function toArray($request): array {
    return [
      'id' => $this->id,
      'shippingCost' => $this->shipping_cost,
      'createdBy' => !empty($this->user) ? $this->user->name : '',
      'status' => $this->status ?? '',
      'createdAt' => optional($this->created_at)->format(config('constant.date_time_format')) ?? "",
    ];
  }
}
