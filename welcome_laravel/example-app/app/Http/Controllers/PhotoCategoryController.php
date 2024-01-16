<?php

namespace App\Http\Controllers;

use App\Models\PhotoCategoryModel;
use Illuminate\Http\Request;

class PhotoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PhotoCategoryModel::with('photos')->get();
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
        $cat = PhotoCategoryModel::where('id', '=', $id)
            ->with('photos')->get();
        //dd ($cat);
        return $cat;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
