<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectModel;

class projectController extends Controller
{
    function PorjectIndex(){
        return view('project');
    }
    function getProjectData(){
        $result= json_encode(ProjectModel::orderBy('id','desc')->get());
        return $result;
     }
    //  function getProjectDetails(Request $request){
    //     $id= $request->input('id');
    //     $result= json_encode(ProjectModel::where('id',$id)->get());
    //     return $result;
    //  }
     function ProjectDelete(Request $request){
       $id = $request->input('id');
       $result = ProjectModel::where('id',$id)->delete();
        if($result==true){
            return 1;
        }else{
            return 0;
        }
      }

}
