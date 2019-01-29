<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Client;

class AuthController extends Controller
{
    //

    public function register(Request $request) {

    	$validator = validator()->make($request->all(), [
            
            'name' => 'required',
            'email' => 'required',
            'birth_date' => 'required',
            'city_id' => 'required',
            'mobile_number' => 'required',
            'blood_type' => 'required|in:O-,O+,B-,B+,A+,A-,AB-,AB+',
            'password' => 'required|confirmed',
            'last_donation_date' => 'required',

            ]);
            
            if ($validator->fails()) {

           // return responseJson(0,'validation error',$validator->errors());

              return responseJson(0,$validator->errors()->first(),$validator->errors());	
            
             }

        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = str_random(60);
        $client->save();
        //return responseJson(1,'added successfully',$client);
        return responseJson(1,'added successfully',[
           
           'api_token' => $client->api_token ,
           'client' => $client

        	]);     
    }


    public function login(Request $request) {

    	$validator = validator()->make($request->all(), [
            
            'mobile_number' => 'required',
            'password' => 'required',

            ]);
            
            if ($validator->fails()) {

           // return responseJson(0,'validation error',$validator->errors());

              return responseJson(0,$validator->errors()->first(),$validator->errors());	
            
             }

            // return auth()->guard('api')->validate($request->all());
             $client = Client::where('mobile_number',$request->mobile_number)->first();

             if($client) {

             	if(Hash::check($request->password,$client->password)) {
                    $client->api_token = str_random(60);
                    $client->save();

             		return responseJson(1,'Login successfully', [
                       
                      'api_token' => $client->api_token ,
                      'client' => $client

             			]);
             	}else{

             		return responseJson(0,'Login failed');
             	}
             }else{

             	return responseJson(0,'Login failed');
             }
    
    }

    public function registerToken() {

       $validator = validator()->make($request->all(), [
            
            'platform' => 'required|in:android,ios',
            'token' => 'required',

            ]);
            
            if ($validator->fails()) {

              return responseJson(0,$validator->errors()->first(),$validator->errors());  
            
             }

        Token::where('token',$request->token)->delete();
        
        $request->user()->tokens()->create($request->all());

        return responseJson(1,'Registered successfully');     

    }

    public function removeToken() {

        $validator = validator()->make($request->all(), [
            
            'token' => 'required',

            ]);
            
            if ($validator->fails()) {

              return responseJson(0,$validator->errors()->first(),$validator->errors());  
            
             }

            Token::where('token',$request->token)->delete(); 

          return responseJson(1,'Deleted successfully'); 
    }
 }
