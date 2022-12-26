<?php

namespace App\Http\Controllers\Bussiness;

use App\Http\Controllers\Controller;
use App\Models\Bussiness;
use App\Models\Reviews;
use App\Models\Reviewuser;
use Illuminate\Support\Facades\Http;

class ReviewsController extends Controller
{
    public function index($id)
    {   
        $review = Reviews::where('uniq_id_bussiness', $id)->count();
        $bussiness = Bussiness::where('uniq_id', $id)->first();
        if($review === 0){
            $api_key = config('constants.api_key');
            $urlReviews = "https://api.yelp.com/v3/businesses/$id/reviews";
            $responseReviews = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $api_key
            ])->get($urlReviews);
            $dataReviews = json_decode($responseReviews->body());
            
            foreach($dataReviews->reviews as $r){
                $reviews_id =  Reviews::create(
                    [
                        'uniq_id' => array_key_exists('id', $r) ? $r->id : '',
                        'url' => array_key_exists('url', $r) ? $r->url : '',
                        'text' => array_key_exists('text', $r) ? $r->text : '',
                        'rating' => array_key_exists('rating', $r) ? $r->rating : '',
                        'time_created' => array_key_exists('time_created', $r) ? $r->time_created : '',
                        'uniq_id_bussiness' => $id, 
                        'bussiness_id' => $bussiness->id 
                    ]
                );
                if(array_key_exists('user', $r)){
                    Reviewuser::create(
                        [
                            'uniq_id' => array_key_exists('id', $r->user) ? $r->user->id : '',
                            'profile_url' => array_key_exists('profile_url', $r->user) ? $r->user->profile_url : '',
                            'image_url' => array_key_exists('image_url', $r->user) ? $r->user->image_url : '',
                            'name' => array_key_exists('name', $r->user) ? $r->user->name : '',
                            'review_id' => $reviews_id->id 
                        ]
                    );
                }
            }
        }
        $review = Reviews::where('uniq_id_bussiness', $id)->get();
        $reviewuser = [];
        foreach($review as $r){
            $reviewuser[] = Reviewuser::where('review_id', $r->id)->get();
        }
        
        
        return view('reviews.index',
            [
                'review' => $review,
                'reviewuser' => $reviewuser
            ]
        );
    }
}
