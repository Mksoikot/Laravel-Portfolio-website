<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\visitorModel;
use App\ServiceModel;
use App\CourseModel;
use App\ProjectModel;

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

        return view('Home',[
            'serviceData'=>$serviceData,
            'courseData'=>$courseData,
            'projectData'=>$projectData
        ]);
    }
}
