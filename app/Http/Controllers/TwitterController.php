<?php

namespace App\Http\Controllers;

use AYLIEN\TextAPI;
use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Log;

class TwitterController extends Controller
{
    public function index(Request $request){

        /*I have not check auth because as I have discussed about the facebook login system,
        So this functionality should work independent of login system*/

        //show the tweet searchbox form
        if(!$request->isMethod('POST')){
            return view('twitter.index');
        }

        try{

            $this->validate($request, [
                'hashtag'       => 'required',
            ]);

            //get hashtag
            $hashtag = $request->get('hashtag');

            //create connection using oath package
            $connection = new TwitterOAuth(env('CONSUMER_KEY'), env('CONSUMER_SECRET'), env('ACCESS_TOKEN'), env('ACCESS_TOKEN_SECRET'));

            //since twitteroauth api was getting timeout we set the timeout for longer period
            $connection->setTimeouts(10, 15);

            //twitter search api to search the hashtag
            $tweets = $connection->get("search/tweets", ["q" => $hashtag]);

            //sentiment analysis of tweets
            $tweets = $this->sentimentAnalysisOfTweets($tweets);

            return view('twitter.show_tweets')
                ->with('tweets', $tweets);
        }catch (\Exception $e){
            Log::error($e->getMessage().PHP_EOL.$e->getTraceAsString());
            //give session flash message
            return false;
        }
    }

    public function sentimentAnalysisOfTweets($tweets){

        if(empty($tweets)){
            return false;
        }

        //Since it will call api on every tweet text, hence the website will becomes slow to avoid this we should do this calling
        //process in background and need to store the sentiments of tweets in database.
        foreach($tweets->statuses as $tweet){
            $textapi = new TextAPI(env("API_AYLIEN_APP_ID"), env("API_AYLIEN_APP_KEY"));

            $sentiment = $textapi->Sentiment(array('text' => $tweet->text));

            if(empty($sentiment)){
                return false;
            }

            //store the polarity of tweets in object
            $tweet->polarity = $sentiment->polarity;
        }
        return $tweets;
    }
}
