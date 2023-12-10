<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Shipping\CreateShippingRequest;
use App\Http\Resources\Shipping\ShippingResource;
use App\Services\ShippingService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ShippingController extends Controller {
  protected $shippingService;

  public function __construct(ShippingService $shippingService) {
    $this->shippingService = $shippingService;
  }

  /**
   * Get List shipping.
   * @return JsonResponse|mixed
   */
  public function index() {
    try {
      $shippings = $this->shippingService->getList();
      return $this->respondWithData(ShippingResource::collection($shippings));
    } catch (Exception $exception) {
      Log::error($exception);
      return $this->respondInternalError($exception->getMessage(), [], $exception);
    }
  }

  /**
   * Create shipping.
   * @param CreateShippingRequest $request
   * @return JsonResponse|mixed
   */
  public function create(CreateShippingRequest $request) {
    try {
      $isCreated = $this->shippingService->create($request);
      if (!$isCreated) {
        return $this->respondInternalError(config('response.error'), [], []);
      }
      return $this->respondOk();
    } catch (Exception $exception) {
      Log::error($exception);
      return $this->respondInternalError($exception->getMessage(), [], $exception);
    }
  }
}
