<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Enums\UserRole;

class UserResource extends JsonResource
{
    protected $token;

    public function __construct($resource, $token = null)
    {
        parent::__construct($resource);
        $this->token = $token;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'role'  => strtolower(UserRole::getName($this->role)),
            'token' => $this->when(isset($this->token), $this->token)
        ];
    }
}
