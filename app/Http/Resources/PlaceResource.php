<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'type' => 'places',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'slug' => $this->slug,
                'city' => $this->city,
                'state' => $this->state,
                'image' => 'url-photo',
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
           'links' => [
               'self' => env('APP_URL').'/api/places/'. $this->slug
           ],
        ];
    }
}
