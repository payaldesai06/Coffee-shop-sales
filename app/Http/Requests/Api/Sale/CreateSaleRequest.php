<?php

namespace App\Http\Requests\Api\Sale;

use Illuminate\Foundation\Http\FormRequest;

class CreateSaleRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize(): bool {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules(): array {
    return [
      'product' => 'nullable|numeric|exists:products,id',
      'quantity' => 'required|numeric|min:1',
      'unitCost' => 'required|numeric|min:1',
    ];
  }
}
