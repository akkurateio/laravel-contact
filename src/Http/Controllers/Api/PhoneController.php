<?php

namespace Akkurate\LaravelContact\Http\Controllers\Api;

use Akkurate\LaravelContact\Classes\ContactPhone;
use Akkurate\LaravelContact\Http\Requests\Phone\CreatePhoneRequest;
use Akkurate\LaravelContact\Http\Requests\Phone\UpdatePhoneRequest;
use Akkurate\LaravelContact\Http\Resources\Phone as PhoneResource;
use Akkurate\LaravelContact\Http\Resources\PhoneCollection;
use Akkurate\LaravelContact\Models\Phone;
use Akkurate\LaravelCore\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class  PhoneController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return JsonResource
     *
     */
    public function index()
    {
        return new PhoneCollection(QueryBuilder::for(Phone::class)
            ->allowedFilters([
                'number', 'prefix', 'priority', 'is_default', 'is_active', 'phoneable_type',
                AllowedFilter::exact('phoneable_id')
            ])
            ->allowedSorts([])
            ->allowedIncludes(['phoneable', 'type'])
            ->jsonPaginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePhoneRequest $request
     * @return PhoneResource
     * @throws ValidationException
     */
    public function store($uuid, CreatePhoneRequest $request)
    {
        $phone = ContactPhone::create($request->validated());
        return new PhoneResource($phone);
    }

    /**
     * Display the specified resource.
     *
     * @param Phone $phone
     * @return PhoneResource
     */
    public function show($uuid, Phone $phone)
    {
        return new PhoneResource($phone);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePhoneRequest $request
     * @param Phone $phone
     * @return PhoneResource
     */
    public function update($uuid, UpdatePhoneRequest $request, Phone $phone)
    {
        $phone->update($request->validated());
        return new PhoneResource($phone);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Phone $phone
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($uuid, Phone $phone)
    {
        $phone->delete();
        return response()->json(null, 204);
    }


}
