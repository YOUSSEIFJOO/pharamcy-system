<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\CreateMedicationRequest;
use App\Http\Requests\UpdateMedicationRequest;
use App\Http\Resources\MedicationResource;
use App\Http\Controllers\Controller;
use App\Services\MedicationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Medication;

class MedicationController extends Controller
{
    private $meidcationService;

    public function __construct(MedicationService $service)
    {
        $this->meidcationService = $service;
    }

    public function index(Request $request): JsonResponse
    {
        $perPage        = $request->perPage ?? null;
        $medications    = $this->meidcationService->getAll($perPage);
        return $this->success(MedicationResource::collection($medications));
    }

    public function store(CreateMedicationRequest $request): JsonResponse
    {
        if($this->meidcationService->createNew($request->validated()))
            return $this->success();

        return $this->failed();
    }

    public function show(Medication $medication): JsonResponse
    {
        return $this->success(new MedicationResource($medication));
    }

    public function update(UpdateMedicationRequest $request, Medication $medication): JsonResponse
    {
        if($this->meidcationService->updateExists($medication, $request->validated()))
            return $this->success();

        return $this->failed();
    }

    public function destroy(Medication $medication): JsonResponse
    {
        if($this->meidcationService->deleteExists($medication))
            return $this->success();

        return $this->failed();
    }

    public function forceDelete($id): JsonResponse
    {
        if($this->meidcationService->forceDeleteExists($id))
            return $this->success();

        return $this->failed();
    }
}
