<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Infogue\Article;
use Infogue\Http\Requests;

class FeedController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get("type", "rss");

        // create new feed
        $feed = App::make("feed");

        // multiple feeds are supported
        // if you are using caching you should set different cache keys for your feeds

        // cache the feed for 60 minutes (second parameter is optional)
        //$feed->setCache(60, 'infogueFeedKey');

        $feed->title = 'Infogue news feed ' . $type;

        // check if there is cached feed and build new only if is not
        if (true /*!$feed->isCached()*/) {
            // creating rss feed with our most recent 20 posts
            $posts = Article::take(20)->published()->get();

            // set your feed's title, description, link, pubdate and language
            $feed->description = 'The most update web portal news. We always provide latest article and information with high integrity and truth.';
            $feed->logo = asset('apple-touch-icon.png');
            $feed->link = url('feed');
            $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
            $feed->pubdate = $posts->first()->created_at;
            $feed->lang = 'en';
            $feed->setShortening(true); // true or false
            $feed->setTextLimit(100); // maximum length of description text

            foreach ($posts as $post) {
                // use enclosure tag (array)
                $enclosure = ['url' => asset("images/" . $post->featured), 'type' => 'image/jpeg'];
                // set item's title, author, url, pubdate, description, content, enclosure (optional)*
                $feed->add(
                    $post->title,
                    $post->contributor->name,
                    URL::to($post->slug),
                    $post->created_at,
                    preg_replace('/\s\s+/', ' ', trim(preg_replace("/&#?[a-z0-9]+;/i", " ", strip_tags($post->content)))),
                    $post->content,
                    $enclosure
                );
            }
        }

        // first param is the feed format
        // optional: second param is cache duration (value of 0 turns off caching)
        // optional: you can set custom cache key with 3rd param as string

        if ($type == "rss") {
            return $feed->render('rss');
        }

        return $feed->render('atom');
        // to return your feed as a string set second param to -1
        // $xml = $feed->render('atom', -1);
    }
}
