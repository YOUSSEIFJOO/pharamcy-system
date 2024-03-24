<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'name'      => (string) $this->name,
            'email'     => (string) $this->email,
            'phone'     => (string) $this->phone,
            'address'   => (string) $this->address,
            'note'      => (string) $this->note
        ];
    }
}
