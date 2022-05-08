<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\visitorModel;
use App\ServiceModel;
use App\CourseModel;
use App\ProjectModel;
use App\contactModel;
use App\ReviewModel;

class HomeController extends Controller
{
    function HomeIndex(){
        $userIp= $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Dhaka');
        $timeData= date("Y-m-d h:i:sa");
        visitorModel::insert(['ip_address'=>$userIp,'visit_name'=>$timeData]);

       $serviceData= json_decode(ServiceModel::orderBy('id','desc')->limit(4)->get());
       $courseData= json_decode(CourseModel::orderBy('id','desc')->limit(6)->get());
       $projectData= json_decode(ProjectModel::orderBy('id','desc')->limit(10)->get());
       $reviewData= json_decode(ReviewModel::orderBy('id','desc')->limit(10)->get());

        return view('Home',[
            'serviceData'=>$serviceData,
            'courseData'=>$courseData,
            'projectData'=>$projectData,
            'reviewData'=>$reviewData
        ]);
    }

    function ContactSend(Request $request){
        $contact_name = $request->input('contact_name');
        $contact_mobile = $request->input('contact_mobile');
        $contact_email = $request->input('contact_email');
        $contact_msg = $request->input('contact_msg');
        $result= DB::insert('INSERT INTO `contacts`(`contact_name`, `contact_mobile`, `contact_email`, `contact_msg`) VALUES (?,?,?,?)',
        [$contact_name,$contact_mobile,$contact_email,$contact_msg]);
    //    $result =  contactModel::insert([
    //             'contact_name'=>$contact_name,
    //             'contact_mobile'=>$contact_mobile,
    //             'contact_email'=>$contact_email,
    //             'contact_msg'=>$contact_msg
    //     ]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }
}
