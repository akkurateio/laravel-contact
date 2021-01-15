<?php

namespace Akkurate\LaravelContact\Http\Controllers\Api;

use Akkurate\LaravelContact\Classes\ContactEmail;
use Akkurate\LaravelContact\Http\Requests\Email\CreateEmailRequest;
use Akkurate\LaravelContact\Http\Requests\Email\UpdateEmailRequest;
use Akkurate\LaravelContact\Http\Resources\Email as EmailResource;
use Akkurate\LaravelContact\Http\Resources\EmailCollection;
use Akkurate\LaravelContact\Models\Email;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return EmailCollection
     *
     */
    public function index()
    {
        return new EmailCollection(
            QueryBuilder::for(Email::class)
            ->allowedFilters([
                'type', 'name', 'email', 'priority', 'is_default', 'is_active', 'emailable_type',
                AllowedFilter::exact('emailable_id')
            ])
            ->allowedSorts(['type', 'name', 'email'])
            ->allowedIncludes(['emailable', 'type'])
            ->jsonPaginate()
        );
    }

    /**
     * @param  $uuid
     * @param CreateEmailRequest $request
     * @return EmailResource
     * @throws ValidationException
     */
    public function store($uuid, CreateEmailRequest $request)
    {
        return new EmailResource(ContactEmail::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param Email $email
     * @return JsonResponse
     */
    public function show($uuid, Email $email)
    {
        return response()->json($email, 200);
    }

    /**
     * @param UpdateEmailRequest $request
     * @param Email $email
     * @return EmailResource
     */
    public function update($uuid, UpdateEmailRequest $request, Email $email)
    {
        $email->update($request->validated());

        return new EmailResource($email);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Email $email
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($uuid, Email $email)
    {
        $email->delete();

        return response()->json(null, 204);
    }
}
