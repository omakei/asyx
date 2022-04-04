<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceFormRequest;
use App\Http\Resources\PlaceCollection;
use App\Http\Resources\PlaceResource;
use App\Models\Place;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;

class PlaceController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Place::class, 'place');
    }

    public function index()
    {
        $places = QueryBuilder::for(Place::class)
                    ->allowedFilters([AllowedFilter::exact('name')])
                    ->paginate();

        return new PlaceCollection($places);
    }

    public function store(PlaceFormRequest $request)
    {
        $place = Place::create($request->only(['name','slug','city','state']));

        $place->addMediaFromBase64($request->only('image')['image'])->toMediaCollection('image');
        return response()
            ->json(
                PlaceResource::make($place),
                Response::HTTP_CREATED
            );
    }

    public function show(Place $place)
    {
        return response()
            ->json(
                PlaceResource::make($place),
                Response::HTTP_OK
            );
    }

    public function update(PlaceFormRequest $request, Place $place)
    {

        $place->update($request->only(['name','slug','city','state']));

        $place->clearMediaCollection('image');

        $place->addMediaFromBase64($request->only('image')['image'])->toMediaCollection('image');

        return response()
            ->json(
                PlaceResource::make($place),
                Response::HTTP_OK
            );
    }

    public function destroy(Place $place)
    {
        $place->delete();

        return response()
            ->json(
                null,
                Response::HTTP_NO_CONTENT
            );
    }
}
