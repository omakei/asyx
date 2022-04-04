<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'type' => 'user',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email,
                'email_verified_at' => $this->email_verified_at,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'tokens' => [
                'name' => $this->tokens()->first()?->name,
                'abilities' => $this->tokens()->first()?->abilities,
                'token' => $this?->token,
                'type' => 'Bearer',
                'expired_at' => 3600,
            ],
        ];

    }
}
