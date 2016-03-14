<?php

namespace Infogue;

use Illuminate\Http\Request;

class Uploader
{
    /**
     * Populate and preparing upload file.
     *
     * @param Request $request
     * @param $input
     * @param $path
     * @param $name
     * @return mixed
     */
    public function upload(Request $request, $input, $path, $name)
    {
        $upload = $this->uploadFile($request, $input, $path, $name);

        if ($upload['status']) {
            $request->merge([$input => $upload['filename']]);
        }

        return $upload['status'];
    }

    /**
     * Upload and moving uploaded file.
     *
     * @param $request
     * @param $source
     * @param $target
     * @param null $filename
     * @return array
     */
    private function uploadFile($request, $source, $target, $filename = null)
    {
        if ($request->hasFile($source)) {

            $upload = $request->file($source);
            if ($upload->isValid()) {
                $fileName = $upload->getClientOriginalName() . '.' . $upload->getClientOriginalExtension();
                if ($filename != null) {
                    $fileName = $filename . '.' . $upload->getClientOriginalExtension();
                    $upload->move($target, $fileName);
                } else {
                    $upload->move($target);
                }

                return ['status' => true, 'filename' => $fileName];
            }
        }
        return ['status' => false, 'filename' => ''];
    }
}