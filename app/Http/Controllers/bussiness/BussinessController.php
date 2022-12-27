<?php

namespace App\Http\Controllers\Bussiness;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Bussiness;
use App\Models\Categories;
use App\Models\Coordinates;
use App\Models\Locations;
use App\Models\Reviews;
use App\Models\Transactions;
use App\Models\UserReviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BussinessController extends Controller
{
    public function index()
    {   
        $count = Bussiness::count();
        return view('bussiness.index',[
            'count' => $count,
            'posts' => Bussiness::all()
        ]); 
        

        
    }

    public function store()
    {
            $url = config('constants.url');
            $api_key = config('constants.api_key');
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $api_key
            ])->get($url);
            $data = json_decode($response->body());
            $businesses = 0;
            foreach($data->businesses as $r){
                $businesses = Bussiness::count();
                if($businesses < 200){
                    $business_id =  Bussiness::create(
                        [
                            'uniq_id' => array_key_exists('id', $r) ? $r->id : '',
                            'alias' => array_key_exists('alias', $r) ? $r->alias : '',
                            'name' => array_key_exists('name', $r) ? $r->name : '',
                            'image_url' => array_key_exists('image_url', $r) ? $r->image_url : '',
                            'is_closed' => array_key_exists('is_closed', $r) ? $r->is_closed : '',
                            'url' => array_key_exists('url', $r) ? $r->url : '',
                            'review_count' => array_key_exists('review_count', $r) ? $r->review_count : '',
                            'rating' => array_key_exists('rating', $r) ? $r->rating : '',
                            'price' => array_key_exists('price', $r) ? $r->price : '',
                            'phone' => array_key_exists('phone', $r) ? $r->phone : '',
                            'display_phone' => array_key_exists('display_phone', $r) ? $r->display_phone : '',
                            'distance' => array_key_exists('distance', $r) ? $r->distance : ''
                        ]
                    );
                    
                    
    
                    foreach($r->categories as $cat) {
                        Categories::create(
                            [
                                'alias' => array_key_exists('alias', $cat) ? $cat->alias : '',
                                'title' => array_key_exists('title', $cat) ? $cat->title : '',
                                'bussiness_id' => $business_id->id 
                            ]
                        );
                    }
    
                    if(array_key_exists('coordinates', $r)){
                        Coordinates::create(
                            [
                                'latitude' => array_key_exists('latitude', $r->coordinates) ? $r->coordinates->latitude : '',
                                'longitude' => array_key_exists('longitude', $r->coordinates) ? $r->coordinates->longitude : '',
                                'bussiness_id' => $business_id->id 
                            ]
                        );
                    }
                    
    
                    foreach($r->transactions as $tr) {
                        Transactions::create(
                            [
                                'transaction_name' => $tr,
                                'bussiness_id' => $business_id->id 
                            ]
                        );
                    }
    
                    if(array_key_exists('location', $r)){
                        $location_id = Locations::create(
                            [
                                'address1' => array_key_exists('address1', $r->location) ? $r->location->address1 : '',
                                'address2' => array_key_exists('address2', $r->location) ? $r->location->address2 : '',
                                'address3' => array_key_exists('address3', $r->location) ? $r->location->address3 : '',
                                'city' => array_key_exists('city', $r->location) ? $r->location->city : '',
                                'zip_code' => array_key_exists('zip_code', $r->location) ? $r->location->zip_code : '',
                                'country' => array_key_exists('country', $r->location) ? $r->location->country : '',
                                'state' => array_key_exists('state', $r->location) ? $r->location->state : '',
                                'bussiness_id' => $business_id->id 
                            ]
                        );
                        foreach($r->location->display_address as $dis) {
                            Address::create(
                                [
                                    'address' => $dis,
                                    'location_id' => $location_id->id
                                ]
                            );
                        }
                    }
                }
                
                

            


            }
        return redirect()->back();
    }

    public function edit($id)
    {
        $data = Bussiness::with('categories')
        ->with('coordinates')
        ->with('transactions')
        ->with('locations')
        ->where('id', $id)
        ->first();
        return view('bussiness.edit', [
            'post' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'is_closed' => 'required',
            'review_count' => 'required',
            'rating' => 'required',
            'phone' => 'required',
        ]);

        $name = $request->input('name');
        $nameToLower = strtolower($name);
        $splitName = explode(' ', $nameToLower);
        $alias = implode('-', $splitName);
        
        $categories = $request->input('categories');
        $listCategories = [];
        foreach($categories as $row){
            $nameToLower = strtolower($row);
            $splitName = explode(' ', $nameToLower);
            $listCategories[] = implode('-', $splitName);
        }

        $phone = $request->input('phone');
        $subPhone = substr($phone, 5, strlen($phone));
        $displayPhone = '(212) ' . $subPhone;

        $validatedData['alias'] = $alias;
        $validatedData['display_phone'] = $displayPhone;

        Bussiness::where('id', $id)
        ->update($validatedData);
        for($i = 0; $i < count($categories); $i++){
            Categories::where('bussiness_id', $id)
            ->update(['title' => $categories[$i], 'alias' => $listCategories[$i]]);
        }

        Coordinates::where('bussiness_id', $id)
        ->update([
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude')
        ]);
        $transactions = $request->input('transactions');
        for($i = 0; $i < count($transactions); $i++){
            Transactions::where('bussiness_id', $id)
            ->update(['transaction_name' => $transactions[$i]]);
        }

        Locations::where('id', $id)
        ->update([
            'address1' => $request->input('address1'),
            'address2' => $request->input('address2'),
            'address3' => $request->input('address3'),
            'city' => $request->input('city'),
            'zip_code' => $request->input('zip_code'),
            'country' => $request->input('country'),
            'state' => $request->input('state'),
        ]);

        return redirect('/bussiness')->with('success', 'Update data successfully');

       

    }

    public function destroy($id)
    {
        Bussiness::destroy($id);
        return redirect()->back();
    }


    


}
