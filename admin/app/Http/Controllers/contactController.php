<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contactModel;
use Illuminate\Support\Facades\DB;

class contactController extends Controller
{
    function ContactIndex(){
        return view('contact');
    }
    function getContactData(){
       $result= json_encode( DB::table('contacts')->orderBy('id','desc')->get());
       return $result;
    // dd($result);
    }
    function ContactDelete(Request $request){
        $id= $request->input('id');
        $result= contactModel::where('id',$id)->delete();
        if($result==true){
            return 1;
        }
        else{
         return 0;
        }
      }
}
