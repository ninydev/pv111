<?php

namespace App\Http\Controllers;

use App\Models\PhotoTag;
use Illuminate\Http\Request;

class PhotoTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PhotoTag::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $photoTag = PhotoTag::where('id', '=', $id)
            ->with('photos')
            ->get();
        return $photoTag;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PhotoTag $photoTag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhotoTag $photoTag)
    {
        //
    }
}
