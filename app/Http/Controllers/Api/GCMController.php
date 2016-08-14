<?php

namespace Infogue\Http\Controllers\api;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Infogue\Article;
use Infogue\Http\Requests;
use Infogue\Http\Controllers\Controller;

class GCMController extends Controller
{
    /**
     * Registering gcm into related contributor.
     *
     * @param Request $request
     * @return mixed
     */
    public function registerGcm(Request $request)
    {
        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'message' => $request->input('gcm_token'),
            'timestamp' => Carbon::now(),
        ]);
    }

    public function broadcastArticle($slug)
    {
        $article = Article::whereSlug($slug)->firstOrFail();
        $article->featured_ref = asset('images/featured/' . $article->featured);

        $headers = array(
            'Authorization: key=' . env('GCM_KEY'),
            'Content-Type: application/json'
        );

        $data = [
            "to" => "/topics/article",
            "notification" => [
                "title" => "Infogue.id updates",
                "body" => "New article " + $article->title,
                "id" => $article->id,
                "title" => $article->title,
                "slug" => $article->slug,
                "featured_ref" => $article->featured_ref,
            ]
        ];

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, env('GCM_URL'));

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarily
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            // die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        return $result;
    }
}
