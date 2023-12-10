<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('product_sales', function (Blueprint $table) {
      $table->id();
      $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
      $table->integer('quantity');
      $table->decimal('unit_cost');
      $table->decimal('selling_price');
      $table->decimal('product_profit_margin')->nullable(); // added here too because if product updates it then it will stay here as a record
      $table->decimal('product_shipping_cost')->nullable(); // added here too because if it updates then it will stay here as a record
      $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('product_sales');
  }
};
