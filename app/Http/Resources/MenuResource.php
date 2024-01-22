<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'label' => $this->name,
            'pemissions'  => PermissionResource::collection($this->permissions),
        ];
    }
}
