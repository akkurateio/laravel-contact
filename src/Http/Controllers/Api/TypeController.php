<?php

namespace Akkurate\LaravelContact\Http\Controllers\Api;

use Akkurate\LaravelContact\Classes\ContactType;
use Akkurate\LaravelContact\Http\Resources\Type as TypeResource;
use Akkurate\LaravelContact\Http\Resources\TypeCollection;
use Akkurate\LaravelContact\Models\Type;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\QueryBuilder;

class TypeController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return TypeCollection
     *
     */
    public function index()
    {
        return new TypeCollection(
            QueryBuilder::for(Type::class)
            ->where('is_active', true)
            ->allowedFilters(['code', 'name', 'description', 'priority', 'is_active'])
            ->allowedSorts(['code', 'name', 'description', 'priority', 'is_active'])
            ->allowedIncludes([])
            ->jsonPaginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $uuid
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store($uuid, Request $request)
    {
        $type = ContactType::create($request->validated());

        return response()->json($type, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  $uuid
     * @param Type $type
     * @return TypeResource
     */
    public function show($uuid, Type $type)
    {
        return new TypeResource($type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $uuid
     * @param Request $request
     * @param Type $type
     * @return TypeResource
     */
    public function update($uuid, Request $request, Type $type)
    {
        $type->update($request->validated());

        return new TypeResource($type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $uuid
     * @param Type $type
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($uuid, Type $type)
    {
        $type->delete();

        return response()->json(null, 204);
    }

    /**
     * Activate or deactivate the specified resource.
     *
     * @param $uuid
     * @param Request $request
     * @param Type $type
     * @return TypeResource
     */
    public function toggle($uuid, Request $request, Type $type)
    {
        $type->is_active = $request->is_active;
        $type->save();

        return new TypeResource($type);
    }
}
