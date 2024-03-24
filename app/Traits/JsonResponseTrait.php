<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait JsonResponseTrait
{
    public function success($data = null): JsonResponse
    {
        return response()->json([
            'success'   => true,
            'message'   => 'Operation has been done',
            'data'      => $data
        ]);
    }

    public function failed($data = null): JsonResponse
    {
        return response()->json([
            'success'   => false,
            'message'   => 'Error happened',
            'data'      => $data
        ]);
    }
}
