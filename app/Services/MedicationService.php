<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Models\Medication;
use App\Enums\UserRole;
use Exception;

class MedicationService extends Service
{
    public function getAll($perPage = null)
    {
        $authenicateUser = Auth::User();
        if($authenicateUser->role == UserRole::OWNER)
            return Medication::withTrashed()->paginate($perPage ?? self::PERPAGE);

        return Medication::paginate($perPage ?? self::PERPAGE);
    }

    public function createNew($data): bool
    {
        DB::beginTransaction();
        try {
            $medication = Medication::create(Arr::only($data, ['name', 'description', 'quantity']));
            DB::commit();
            Log::info('A new medication was created', ['medication' => $medication]);
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error while creating a new medication', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }

    public function updateExists($medication, $data): bool
    {
        DB::beginTransaction();
        try {
            $medication->update(Arr::only($data, ['name', 'description', 'quantity']));
            DB::commit();
            Log::info('An existing medication was updated', ['medication' => $medication]);
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error while updating an existing medication', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }

    public function forceDeleteExists($id): bool
    {
        DB::beginTransaction();
        try {
            $medication = Medication::withTrashed()->find($id);

            if($medication) {
                $medication->forceDelete();
                DB::commit();
                Log::info('An existing medication was deleted', ['medication' => $medication]);
                return true;
            }

            return false;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error while force deleting an existing medication', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }

    public function deleteExists($medication): bool
    {
        DB::beginTransaction();
        try {
            $medication->delete();
            DB::commit();
            Log::info('An existing medication was deleted', ['medication' => $medication]);
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error while deleting an existing medication', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }
}
