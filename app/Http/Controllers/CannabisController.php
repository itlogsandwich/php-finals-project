<?php

namespace App\Http\Controllers;

use App\Models\Cannabis;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCannabisRequest;
use App\Http\Requests\UpdateCannabisRequest;

class CannabisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $cannabis = Cannabis::all();

        return view('cannabis.home', compact('cannabis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createListing()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCannabisRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cannabis $cannabis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cannabis $cannabis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCannabisRequest $request, Cannabis $cannabis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cannabis $cannabis)
    {
        //
    }
}
