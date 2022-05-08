<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contactModel;
use App\CourseModel;
use App\ProjectModel;
use App\ReviewModel;
use App\ServiceModel;
use App\visitorModel;
class HomeController extends Controller
{
        function HomeIndex(){
            $TotalContact = contactModel::count();
            $TotalCourse = CourseModel::count();
            $TotalProject = ProjectModel::count();
            $TotalReview = ReviewModel::count();
            $TotalService = ServiceModel::count();
            $TotalVisitor = visitorModel::count();
        return view('Home',[

            'TotalContact'=>$TotalContact,
            'TotalCourse'=>$TotalCourse,
            'TotalProject'=>$TotalProject,
            'TotalReview'=>$TotalReview,
            'TotalService'=>$TotalService,
            'TotalVisitor'=>$TotalVisitor
        ]);
    }
}
