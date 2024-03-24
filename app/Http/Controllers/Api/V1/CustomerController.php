<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $service)
    {
        $this->customerService = $service;
    }

    public function index(Request $request): JsonResponse
    {
        $perPage    = $request->perPage ?? null;
        $customers  = $this->customerService->getAll($perPage);
        return $this->success(CustomerResource::collection($customers));
    }

    public function store(CreateCustomerRequest $request): JsonResponse
    {
        if($this->customerService->createNew($request->validated()))
            return $this->success();

        return $this->failed();
    }

    public function show(Customer $customer): JsonResponse
    {
        return $this->success(new CustomerResource($customer));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer): JsonResponse
    {
        if($this->customerService->updateExists($customer, $request->validated()))
            return $this->success();

        return $this->failed();
    }

    public function destroy(Customer $customer): JsonResponse
    {
        if($this->customerService->deleteExists($customer))
            return $this->success();

        return $this->failed();
    }

    public function forceDelete($id): JsonResponse
    {
        if($this->customerService->forceDeleteExists($id))
            return $this->success();

        return $this->failed();
    }
}
