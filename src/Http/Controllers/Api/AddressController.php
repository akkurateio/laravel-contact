<?php

namespace Akkurate\LaravelContact\Http\Controllers\Api;

use Akkurate\LaravelContact\Classes\ContactAddress;
use Akkurate\LaravelContact\Http\Requests\Address\CreateAddressRequest;
use Akkurate\LaravelContact\Http\Requests\Address\UpdateAddressRequest;
use Akkurate\LaravelContact\Http\Resources\Address as AddressResource;
use Akkurate\LaravelContact\Http\Resources\AddressCollection;
use Akkurate\LaravelContact\Models\Address;
use Akkurate\LaravelCore\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

class AddressController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return JsonResource
     *
     */
    public function index()
    {
        return new AddressCollection(QueryBuilder::for(Address::class)
            ->allowedFilters([
                'type', 'name', 'street1', 'street2', 'street3', 'zip', 'city', 'priority', 'is_default', 'is_active', 'addressable_type',
                AllowedFilter::exact('addressable_id')
            ])
            ->allowedSorts(['type', 'name', 'street1', 'street2', 'street3', 'zip', 'city', 'priority', 'is_default', 'is_active'])
            ->allowedIncludes(['addressable'])
            ->jsonPaginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateAddressRequest $request
     * @param  $uuid
     * @return AddressResource
     * @throws ValidationException
     */
    public function store($uuid, CreateAddressRequest $request)
    {
        $address = ContactAddress::create($request->validated());
        return new AddressResource($address);
    }

    /**
     * Display the specified resource.
     *
     * @param Address $address
     * @return AddressResource
     */
    public function show($uuid, Address $address)
    {
        return new AddressResource($address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAddressRequest $request
     * @param Address $address
     * @return AddressResource
     */
    public function update($uuid, UpdateAddressRequest $request, Address $address)
    {
        $address->update($request->validated());
        return new AddressResource($address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Address $address
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($uuid, Address $address)
    {
        $address->delete();
        return response()->json(null, 204);
    }

}
