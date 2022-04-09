<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\visitorModel;

class visitorController extends Controller
{
    function VisitorIndex(){
      $visitorData= json_decode( visitorModel::orderBy('id','desc')->take(1000)->get());
        return view('visitor',['visitorData'=>$visitorData]);
    }
}