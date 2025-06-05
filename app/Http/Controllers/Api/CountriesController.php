<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Models\Country;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $countries = Country::withTranslation()->get();

        return CountryResource::collection($countries);
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        $country = $country->withTranslation($country->id)->first();

        return new CountryResource($country);
    }
}
