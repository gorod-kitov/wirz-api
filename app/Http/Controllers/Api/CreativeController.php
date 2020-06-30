<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ImageRequest;
use App\models\Images;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class CreativeController extends Controller
{

    /**
     * @param ImageRequest $request
     * @return \Illuminate\Http\JsonResponse|string|void
     */
    public function addCreatives(ImageRequest $request)
    {
        foreach ($request->file('files') as $image) {
            $imageName =  time().uniqid().'.'.$image->getClientOriginalExtension();
            Log::info($imageName);
            Images::create(['path' => $imageName]);
            $image->move(public_path('images'), $imageName);
        }

        return response()->json('true');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $images = Images::all()->toArray();

        return response()->json($images);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $response = Images::query()
            ->where('id',$id)
            ->delete();

        return response()->json($response);
    }

}
