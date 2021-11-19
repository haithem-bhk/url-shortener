<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Str;
use Validator;

class urlController extends Controller
{
    //
    public function getForm(){
    	$links = Url::latest()->get();
    	return view('form',['links'=>$links]);	
    }

    public function shortenUrl(Request $request){

    	$validator = Validator::make($request->all(),
    		[
           'destination' => 'required|url'
        ]);
        if ($validator->fails()) {
        	return redirect()->back()->withErrors($validator);
        }
    	
    	
    	$url = new Url();
    	$url->destination = $request['destination'];
    	$url->slug = Str::random(6);
    	$url->save();
    	return redirect()->back()->with('status','URL Successfully Shortened !');
    }

    public function shortenUrlApi(Request $request){
        $validator = Validator::make($request->all(),
            [
           'destination' => 'required|url'
        ]);
        if ($validator->fails()) {
            return $validator->messages();
        }
        $url = new Url();
        $url->destination = $request['destination'];
        $url->slug = Str::random(6);
        $url->save();

        return $url;


    }
}
