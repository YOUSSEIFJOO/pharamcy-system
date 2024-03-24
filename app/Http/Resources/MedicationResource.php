<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class MedicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'          => (string) $this->name,
            'description'   => (string) $this->description,
            'quantity'      => (int) $this->quantity
        ];
    }
}
