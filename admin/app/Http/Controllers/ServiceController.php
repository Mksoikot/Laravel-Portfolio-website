<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceModel;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    function ServiceIndex(){
          return view('service');
      }
    function getServiceData(){
       $result= json_encode(ServiceModel::orderBy('id','desc')->get());

    //    dd($result);

       return $result;
    }
    function getServiceDetails(Request $request){
        $id= $request->input('id');
        $result= json_encode(ServiceModel::where('id',$id)->get());
        return $result;
     }
    function ServiceDelete(Request $request){
       $id= $request->input('id');
       $result= ServiceModel::where('id',$id)->delete();
       if($result==true){
           return 1;
       }
       else{
        return 0;
       }
     }
     function ServiceUpdate(Request $request){
        $id= $request->input('id');
        $name= $request->input('name');
        $des= $request->input('des');
        $img = $request->input('img');
        $result= ServiceModel::where('id',$id)->update(['service_name'=>$name,'service_des'=>$des,'service_img'=>$img]);
        if($result==true){
            return 1;
        }
        else{
         return 0;
        }
      }
      function ServiceAdd(Request $request){
        $name= $request->input('name');
        $des= $request->input('des');
        $img = $request->input('img');
        // $result= ServiceModel::insert(['service_name'=>$name,'service_des'=>$des,'service_img'=>$img]);
        $result= DB::insert('INSERT INTO `service`(`service_name`, `service_des`, `service_img`) VALUES (?,?,?)',
        [$name,$des,$img]);
        if($result==true){
            return 1;
        }
        else{
         return 0;
        }
      }
}
