<?php

namespace Infogue;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Uploader
{
    public function __construct(){

    }

    public function upload(Request $request, $input, $path, $name)
    {
        // passing all attributed to upload helper
        $upload = $this->uploadFile($request, $input, $path, $name);

        if ($upload['status']) {
            $request->merge([$input => $upload['filename']]);
        }

        return $upload['status'];
    }

    private function uploadFile($request, $source, $target, $filename = null)
    {
        if ($request->hasFile($source)) {

            $upload = $request->file($source);
            if ($upload->isValid())
            {
                $fileName = $upload->getClientOriginalName().'.'.$upload->getClientOriginalExtension();
                if($filename != null){
                    $fileName = $filename.'.'.$upload->getClientOriginalExtension();
                    $upload->move($target, $fileName);
                }
                else{
                    $upload->move($target);
                }

                return ['status' => true, 'filename' => $fileName];
            }
        }
        return ['status' => false, 'filename' => ''];
    }
}
