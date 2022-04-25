<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectModel;
use Illuminate\Support\Facades\DB;

class projectController extends Controller
{
    function PorjectIndex(){
        return view('project');
    }
    function getProjectData(){
        $result= json_encode(ProjectModel::orderBy('id','desc')->get());
        return $result;
     }
     function getProjectDetails(Request $request){
        $id= $request->input('id');
        $result= json_encode(ProjectModel::where('id',$id)->get());
        return $result;
     }
     function ProjectDelete(Request $request){
       $id = $request->input('id');
       $result = ProjectModel::where('id',$id)->delete();
        if($result==true){
            return 1;
        }else{
            return 0;
        }
      }
      function ProjectUpdate(Request $request){
        $id= $request->input('id');
        $name= $request->input('name');
        $des= $request->input('des');
        $img = $request->input('img');
        $link = $request->input('link');
        $result= ProjectModel::where('id',$id)->update(['project_name'=>$name,'project_des'=>$des,'project_img'=>$img,'project_link'=>$link]);
        if($result==true){
            return 1;
        }
        else{
         return 0;
        }
      }
      function ProjectAdd(Request $request){
        $name= $request->input('name');
        $des= $request->input('des');
        $img = $request->input('img');
        $link = $request->input('link');
        // $result= ProjectModel::insert(['project_name'=>$name,'project_des'=>$des,'project_img'=>$img,'project_link'=>$link]);
        $result= DB::insert('INSERT INTO `projects`(`project_name`, `project_des`, `project_img`, `project_link`) VALUES (?,?,?,?)',
        [$name,$des,$img,$link]);
        if($result==true){
            return 1;
        }
        else{
         return 0;
        }
      }
}
