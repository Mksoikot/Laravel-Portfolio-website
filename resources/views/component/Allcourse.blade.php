<div class="container-fluid jumbotron mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
                <img class=" page-top-img fadeIn" src="{{asset('images/knowledge.svg')}}">
                <h1 class="page-top-title mt-3">- অনলাইন কোর্স সমূহ -</h1>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        @foreach ($courseData as $courseData)
        <div class="col-md-4 p-1 text-center">
            <div class="card">
                <div class="text-center">
                    <img class="w-100" src="{{$courseData->course_img}}" alt="Card image cap">
                    <h5 class="service-card-title mt-4"> {{$courseData->course_name}}</h5>
                    <h6 class="service-card-subTitle p-0 ">{{$courseData->course_fee}} | {{$courseData->course_totalenroll}}</h6>
                    <h6 class="service-card-subTitle p-0 ">{{$courseData->course_totalclass}}</h6>
                    <button target="_blank" href="{{$courseData->course_link}} " class="normal-btn btn">শুরু করুন</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
