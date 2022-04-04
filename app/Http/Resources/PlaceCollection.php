<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PlaceCollection extends ResourceCollection
{

    public function toArray($request)
    {
        return [
            'meta' => [
                'copyright' => 'Copyright 2022 asyx.',
                'authors' => ['Michael E. Assey (Omakei)']
            ],
            'data' => $this->collection,
        ];
    }
}
