@extends('Layout.app')
@section('title','Home')

@section('content')

@include('component.HomeBanner');

@include('component.HomeService');

@include('component.HomeCourse');

@include('component.HomeProject');

@include('component.HomeContact');

@include('component.HomeReview');

@include('Layout.footer');

@endsection
