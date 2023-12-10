<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSale extends Model {
  use SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'product_id', 'quantity', 'unit_cost', 'selling_price', 'product_profit_margin', 'product_shipping_cost', 'created_by'
  ];

  public function product() {
    return $this->belongsTo(Product::class, 'product_id');
  }

  public function user() {
    return $this->belongsTo(User::class, 'created_by');
  }
}
