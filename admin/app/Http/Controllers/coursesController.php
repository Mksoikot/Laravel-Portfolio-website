<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseModel;
use Illuminate\Support\Facades\DB;

class coursesController extends Controller
{
    function CoursesIndex(){
        return view('courses');
    }
    function getCourseData(){
       $result= json_encode( DB::table('courses')->get());
       return $result;
    // dd($result);
    }
    function getCouresDetails(Request $request){
        $id= $request->input('id');
        $result= json_encode(CourseModel::where('id',$id)->get());
        return $result;
     }
     function CourseDelete(Request $request){
        $id= $request->input('id');
        $result= CourseModel::where('id',$id)->delete();
        if($result==true){
            return 1;
        }
        else{
         return 0;
        }
      }
      function CourseUpdate(Request $request){
        $id= $request->input('id');
        $course_name = $request->input('course_name');
        $course_des = $request->input('course_des');
        $course_fee  = $request->input('course_fee');
        $course_totalenroll  = $request->input('course_totalenroll');
        $course_totalclass = $request->input('course_totalclass');
        $course_link  = $request->input('course_link');
        $course_img  = $request->input('course_img');
        $result= CourseModel::where('id',$id)->update([
            'course_name'=>$course_name,
            'course_des'=>$course_des,
            'course_fee'=>$course_fee,
            'course_totalenroll'=>$course_totalenroll,
            'course_totalclass'=>$course_totalclass,
            'course_link'=>$course_link,
            'course_img'=>$course_img,
        ]);
        if($result==true){
            return 1;
        }
        else{
         return 0;
        }
      }
      function CourseAdd(Request $request){
        $course_name = $request->input('course_name');
        $course_des = $request->input('course_des');
        $course_fee  = $request->input('course_fee');
        $course_totalenroll  = $request->input('course_totalenroll');
        $course_totalclass = $request->input('course_totalclass');
        $course_link  = $request->input('course_link');
        $course_img  = $request->input('course_img');
       $result= DB::insert('INSERT INTO `courses`(`course_name`, `course_des`, `course_fee`, `course_totalenroll`, `course_totalclass`, `course_link`, `course_img`) VALUES (?,?,?,?,?,?,?)',
        [$course_name,$course_des,$course_fee,$course_totalenroll,$course_totalclass,$course_link,$course_img]);
        // $result= CourseModel::insert([
        //     'course_name'=>$course_name,
        //     'course_des'=>$course_des,
        //     'course_fee'=>$course_fee,
        //     'course_totalenroll'=>$course_totalenroll,
        //     'course_totalclass'=>$course_totalclass,
        //     'course_link'=>$course_link,
        //     'course_img'=>$course_img,
        // ]);
        // dd($result);
        if($result==true){
            return 1;
        }
        else{
         return 0;
        }
      }
}
