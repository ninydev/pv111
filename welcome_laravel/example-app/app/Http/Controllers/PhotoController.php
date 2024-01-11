<?php

namespace App\Http\Controllers;

use App\Http\Requests\Photo\CreatePhotoRequest;
use App\Models\Photo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Photo::with('category')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePhotoRequest $request)
    {
        try {
            // $photo = new Photo($request->all());

            $photo = $request->getModelFromRequest();
            $photo->save();
            return $photo;

            // Если мне не нужно знать ничего о новой модели - а только состояние операции
//            return  $request
//                        ->getModelFromRequest()
//                        ->save();
        } catch (\Exception $e) {
            return  $e->getMessage();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $photo = Photo::where('id', '=', $id)
            ->with('category', 'tags')->get();
        return $photo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();
        return response()->json([], 204);
    }


}
