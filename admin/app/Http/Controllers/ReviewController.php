<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReviewModel;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    function ReviewIndex(){
        return view('review');
    }
  function getReviewData(){
     $result= json_encode(ReviewModel::orderBy('id','desc')->get());

  //    dd($result);

     return $result;
  }
  function getReviewDetails(Request $request){
      $id= $request->input('id');
      $result= json_encode(ReviewModel::where('id',$id)->get());
      return $result;
   }
  function ReviewDelete(Request $request){
     $id= $request->input('id');
     $result= ReviewModel::where('id',$id)->delete();
     if($result==true){
         return 1;
     }
     else{
      return 0;
     }
   }
   function ReviewUpdate(Request $request){
      $id= $request->input('id');
      $name= $request->input('name');
      $des= $request->input('des');
      $img = $request->input('img');
      $result= ReviewModel::where('id',$id)->update(['name'=>$name,'des'=>$des,'img'=>$img]);
      if($result==true){
          return 1;
      }
      else{
       return 0;
      }
    }
    function ReviewAdd(Request $request){
      $name= $request->input('name');
      $des= $request->input('des');
      $img = $request->input('img');
      // $result= ServiceModel::insert(['service_name'=>$name,'service_des'=>$des,'service_img'=>$img]);
      $result= DB::insert('INSERT INTO `review`(`name`, `des`, `img`) VALUES (?,?,?)',
      [$name,$des,$img]);
      if($result==true){
          return 1;
      }
      else{
       return 0;
      }
    }
}
