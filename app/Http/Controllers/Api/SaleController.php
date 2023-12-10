<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Sale\CreateSaleRequest;
use App\Services\SaleService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller {
  protected $saleService;

  public function __construct(SaleService $saleService) {
    $this->saleService = $saleService;
  }

  /**
   * Get List sale.
   * @return JsonResponse|mixed
   */
  public function index() {
    try {
      return $this->respondWithData($this->saleService->getList());
    } catch (Exception $exception) {
      Log::error($exception);
      return $this->respondInternalError($exception->getMessage(), [], $exception);
    }
  }

  /**
   * Create sale.
   * @param CreateSaleRequest $request
   * @return JsonResponse|mixed
   */
  public function create(CreateSaleRequest $request) {
    try {
      return $this->respondWithData($this->saleService->create());
    } catch (Exception $exception) {
      Log::error($exception);
      return $this->respondInternalError($exception->getMessage(), [], $exception);
    }
  }
}
