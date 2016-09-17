<?php

namespace Infogue\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;
use Infogue\Image;

class ImageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Image Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling gallery of uploaded image
    | to be inserted into article, delete and upload as well.
    |
    */

    /**
     * Attach auth api middleware on this controller.
     *
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Retrieve gallery image by 15 data.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function gallery(Request $request)
    {
        $contributor = Contributor::findOrFail($request->input('contributor_id'));
        $gallery = $contributor->images()->select('id', 'source')->orderBy('created_at', 'desc')->paginate(12);
        $gallery->map(function ($row) {
            $row->source = asset("images/featured/" . $row->source);
        });
        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'gallery' => $gallery,
            'timestamp' => Carbon::now(),
        ]);
    }

    /**
     * Upload image into contributor gallery.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        /*
         * make sure the uploaded file has size not more than 2MB
         * and it must be an image and valid.
         */
        $validator = Validator::make($request->all(), [
            'source' => 'required|mimes:jpg,jpeg,gif,png|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'denied',
                'message' => "The image must be an image and less than 2MB",
                'timestamp' => Carbon::now(),
            ], 400);
        }

        $uploadedImage = $request->file('source');
        if ($uploadedImage->isValid()) {
            /*
             * Check default name is it already exist on asset folder,
             * rename if necessary and save into images table correspond the uploader (contributor)
             * $uploadedImage->getFilename() // hash name of file
             */
            $extension = $uploadedImage->getClientOriginalExtension();
            $fullName = preg_replace('/\s+/', '_', $uploadedImage->getClientOriginalName());
            $name = basename($fullName, '.' . $extension);

            if (File::exists(public_path('images/featured/' . $fullName))) {
                $fullName = $name . '_' . uniqid() . '.' . $extension;
            }
            $uploadedImage->move(public_path("images/featured/"), $fullName);

            $image = new Image(['source' => $fullName]);
            $contributor = Contributor::findOrFail($request->input('contributor_id'));
            if ($contributor->images()->save($image)) {
		$image->source = asset("images/featured/" . $image->source);
                return response()->json([
                    'request_id' => uniqid(),
                    'status' => 'success',
                    'message' => Lang::get('alert.image.upload', ['title' => $fullName]),
		    'image' => $image,
                    'timestamp' => Carbon::now(),
                ]);
            }
        }

        // just throw and regular error message if something bad happen.
        return response()->json([
            'request_id' => uniqid(),
            'status' => 'failure',
            'message' => Lang::get('alert.error.generic'),
            'timestamp' => Carbon::now(),
        ], 500);
    }

    /**
     * Delete image by passing contributor id and image id.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        /*
         * the file must be owned by the correspond contributor,
         * and if it exists, just delete.
         */
        $contributor = Contributor::findOrFail($request->input('contributor_id'));
        $image = $contributor->images()->findOrFail($request->input('id'));
        $pathImage = public_path('images/featured/' . $image->source);
        if (File::exists($pathImage)) {
            unlink($pathImage);
        }

        if ($image->delete()) {
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'success',
                'message' => Lang::get('alert.image.delete', ['title' => $image->source]),
                'timestamp' => Carbon::now(),
            ]);
        }

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'failure',
            'message' => Lang::get('alert.error.generic'),
            'timestamp' => Carbon::now(),
        ], 500);
    }
}
