<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Governorate;
use App\City;
use App\Article;
use App\ContactUs;
use App\Client;
use App\Notification;
use App\Favorite;
use App\DonationOrders;
use App\BloodType;
use App\Settings;
use App\Token;


class MainController extends Controller
{
    //

  /*  private function apiResponse($status,$message,$data=null) {

    	$response = [
    		'status' => $status ,
    		'message' => $message ,
    		'data' => $data ,
    	];

    	return response()->json($response);
    } */

    public function governorates() {
       
       $governorates = Governorate::all();

       return responseJson(1,'success',$governorates);
    }

    public function cities(Request $request) {
       
       $cities = City::where(function($query) use($request) {
          if ($request->has('governorate_id')) {

            $query->where('governorate_id',$request->governorate_id);
          }

       } )->get();

       return responseJson(1,'success',$cities);
     }

     public function articles(Request $request) {

      //Three web services one to show articles list , the second to show articles list when the client choose the category
      // and the third to search on the title and body of the article

      $articles = Article::where(function ($query) use($request){
       if ($request->has('articles_category_id')) {

            $query->where('articles_category_id',$request->articles_category_id);
          }

          if ($request->has('search')) {
            $query->where(function($q2) use($request){
                $q2->where('title','like', "%".$request->get('search')."%");
                $q2->orWhere('body','like', "%".$request->get('search')."%");
            });

          
          }
      })->paginate(10);

       return responseJson(1,'success',$articles);
    }

   

    public function contactus(Request $request) {
       // validation ?
       $contactus = ContactUs::create($request->all());
      // i don't need save:  $contactus->save();
       
       return responseJson(1,'added successfully',$contactus);     
    }

    public function reports(Request $request) {
       
       $reports = Report::create($request->all());
       // i don't need save: $reports->save();
       
       return responseJson(1,'added successfully',$reports);
               
    }


       public function profile(Request $request) {
         
          $client = Auth::guard('api')->user();

          if ($request->has('name')) {
           $client->name= $request->input('name');
          }

          if ($request->has('email')) {
           $client->email= $request->input('email');
          }

           if ($request->has('birth_date')) {
           $client->birth_date= $request->input('birth_date');
          }
           if ($request->has('mobile_number')) {
           $client->mobile_number= $request->input('mobile_number');
          }
          if ($request->has('password')) {
           $client->password= $request->input('password');
          }
          if ($request->has('last_donation_date')) { 
           $client->last_donation_date= $request->input('last_donation_date');
          }
          if ($request->has('blood_type')) {
           $client->blood_type= $request->input('blood_type');
          } 
          if ($request->has('city_id')) {
           $client->city_id= $request->input('city_id');
          } 
          $client->save();

           return responseJson(1,'success',[
           
           'api_token' => $client->api_token ,
           'clients' => $client

          ]);
          }

          
           //$request->user()->articles()->attach($articles_id);
          public function favoriteArticle(Request $request) {
            // synch is better or detch

            $request->user()->favorites()->attach($request->article_id);

            return responseJson(1,'success');
          }

          public function unFavoriteArticle(Request $request)
          {
           $request->user()->favorites()->detach($request->article_id);
           
           return responseJson(1,'success');
          }


         // notifications list
         // I want to show notifications of one user

         public function notifications(Request $request) {

         $notifications = $request->user()->notifications()->paginate(20);

         return responseJson(1,'success',$notifications);
         }

         public function favorited(Request $request) {
          $favorited = $request->user()->favorites()->paginate(20);

          //$favorited = Favorite::all();
          
          return responseJson(1,'success',$favorited);
         }
         
         // donation Orders or requests that the client request not these requests from others and suitable for him the least are 
         // called notifications

          public function donationOrders(Request $request) {
          

          $donationOrders = $request->user()->donationsOrders()->paginate(20);

          if($donationOrders->count()) {
            
          return responseJson(1,'success',$donationOrders);
            } 
          return responseJson(0,'No donation orders to show',$donationOrders);
            

         }

          public function submitDonationOrder(Request $request) {

            $validator = validator()->make($request->all(), [
            
            'name' => 'required',
            'hospital' => 'required',
            'city_id' => 'required',
            'age' => 'required',
            'blood_type' => 'required|in:O-,O+,B-,B+,A+,A-,AB-,AB+',
            'number_cases' => 'required',
            'mobile_number' => 'required',
            'hospital_address' => 'required',
            //'notes' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            ]);
            
            if ($validator->fails()) {


              return responseJson(0,$validator->errors()->first(),$validator->errors());  
            
             }
           //dd($request->all());
           $submitDonationOrder = $request->user()->donationsOrders()->create($request->all());
           //dd($submitDonationOrder);

           //notifications

           $clientsIds = $submitDonationOrder->city->client()->whereHas('bloodType',function ($query) use($request) {
              
              $query->where('blood_type.blood_type',$request->blood_type);

           })->pluck('clients.id')->toArray();

           //dd($clientsIds);

          
         return responseJson(1,'success',$submitDonationOrder);
         }


          public function notificationSettings(Request $request) {

          $validator = validator()->make($request->all(), [
            
            //'id' => 'exists:clients',
            //'id' => 'exists:blood_type',
            'blood_type_id' => 'required|exists:blood_type,id',
            'city_id' => 'required|exists:cities,id',
            //'client_id' => 'required|exists:clients,id',
            //'blood_type_id' => 'exists:blood_type,id',
            //'city_id' => 'exists:cities,id',

            ]);
            
            if ($validator->fails()) {

           // return responseJson(0,'validation error',$validator->errors());

              return responseJson(0,$validator->errors()->first(),$validator->errors());  
            
             }
          
          $request->user()->city()->sync($request->city_id);

          $request->user()->bloodType()->sync($request->blood_type_id);

          return responseJson(1,'success');
          

         } 


         public function notificationSettingsRead(Request $request) {
          // add it in the last service
          $blood_type_id =DB::table('blood_type_client')->where('client_id', $request->client_id)->pluck('blood_type_id'); //  "h";
           $city_id =DB::table('city_client')->where('client_id', $request->client_id)->pluck('city_id'); //"v";

           return responseJson(1,'success',$blood_type_id,$city_id);

         }



         public function bloodType() {
       
         $bloodType = BloodType::all();

         return responseJson(1,'success',$bloodType);
         }


         public function forgotPassword(Request $request){  

          $validator = validator()->make($request->all(), [
            
            'mobile_number' => 'required',

            ]);
            
            if ($validator->fails()) {

              return responseJson(0,$validator->errors()->first(),$validator->errors());  
            
             }

            $client = Client::where('mobile_number',$request->mobile_number)->first();
            if($client){ 
              //$client->pin_code =  str_random(6) ; 
              $client->pin_code =  rand(111111,999999) ; // to generate pin code with numbers only
              $client->save();
              return responseJson(1,'valid mobile number',$client->pin_code);
             }else{

            return responseJson(0,'Invalid mobile number');
          }

         }


         public function resetPassword(Request $request){

          $validator = validator()->make($request->all(), [
            
            'pin_code' => 'required',
            'password' => 'required'

            ]);
            
            if ($validator->fails()) {

              return responseJson(0,$validator->errors()->first(),$validator->errors());  
            
             }

            
            $client = Client::where('pin_code',$request->pin_code)->first();
            if($client){ 
            $client->password = bcrypt($request->password);
            $client->save();

            return responseJson(1,'valid pin code'/*,$client->reset_code*/);
             }else{

            return responseJson(0,'Invalid pin code');
            }
          }

          public function settings(Request $request, $id) {
          
          $settings = Settings::find($id);
         // $record = new Settings ;
          //$record->id = $request->id ; 

         return responseJson(1,'success',$settings);
       }



}
