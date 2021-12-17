<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryCodeRequest;
use App\Http\Resources\CountryCodeResource;
use App\Models\CountryCode;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CountryCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $countriesCode = CountryCode::where('is_active', true)->get();
        return CountryCodeResource::collection($countriesCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCountryCodeRequest $request
     * @return CountryCodeResource
     */
    public function store(StoreCountryCodeRequest $request): CountryCodeResource
    {
        $countryCode = CountryCode::create($request->all());

        return new CountryCodeResource($countryCode);
    }

    /**
     * Display the specified resource.
     *
     * @param CountryCode $countryCode
     * @return CountryCodeResource
     */
    public function show(CountryCode $countryCode): CountryCodeResource
    {
        return new CountryCodeResource($countryCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CountryCode $countryCode
     * @param StoreCountryCodeRequest $request
     * @return CountryCodeResource
     */
    public function update(CountryCode $countryCode, StoreCountryCodeRequest $request): CountryCodeResource
    {
        $countryCode->update($request->all());
        return new CountryCodeResource($countryCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CountryCode $countryCode
     * @return Response
     */
    public function destroy(CountryCode $countryCode): Response
    {
        $countryCode->delete();
        return response(null, ResponseAlias::HTTP_NO_CONTENT);
    }
}
