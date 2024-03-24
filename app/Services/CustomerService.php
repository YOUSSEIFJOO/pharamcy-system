<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Models\Customer;
use App\Enums\UserRole;
use Exception;

class CustomerService extends Service
{
    public function getAll($perPage = null)
    {
        $authenicateUser = Auth::User();
        if($authenicateUser->role == UserRole::OWNER)
            return Customer::withTrashed()->paginate($perPage ?? self::PERPAGE);

        return Customer::paginate($perPage ?? self::PERPAGE);
    }

    public function createNew($data): bool
    {
        DB::beginTransaction();
        try {
            $customer = Customer::create(Arr::only($data, ['name', 'email', 'phone', 'address', 'note']));
            DB::commit();
            Log::info('A new customer was created', ['customer' => $customer]);
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error while creating a new customer', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }

    public function updateExists($customer, $data): bool
    {
        DB::beginTransaction();
        try {
            $customer->update(Arr::only($data, ['name', 'email', 'phone', 'address', 'note']));
            DB::commit();
            Log::info('An existing customer was updated', ['customer' => $customer]);
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error while updating an existing customer', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }

    public function forceDeleteExists($id): bool
    {
        DB::beginTransaction();
        try {
            $customer = Customer::withTrashed()->find($id);

            if($customer) {
                $customer->forceDelete();
                DB::commit();
                Log::info('An existing customer was deleted', ['customer' => $customer]);
                return true;
            }

            return false;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error while force deleting an existing customer', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }

    public function deleteExists($customer): bool
    {
        DB::beginTransaction();
        try {
            $customer->delete();
            DB::commit();
            Log::info('An existing customer was deleted', ['customer' => $customer]);
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error while deleting an existing customer', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }
}
