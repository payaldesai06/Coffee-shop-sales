<?php

namespace App\Http\Requests\Api\Shipping;

use Illuminate\Foundation\Http\FormRequest;

class CreateShippingRequest extends FormRequest {
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
      'shippingCost' => 'required|numeric|min:1',
    ];
  }
}
