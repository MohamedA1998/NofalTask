<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Country::active()->get()->toResourceCollection();
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        return $country->toResource();
    }
}
