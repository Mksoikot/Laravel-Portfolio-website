<div class="container-fluid jumbotron mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
            <img class=" page-top-img fadeIn" src="{{asset('images/code.svg')}}">
            <h1 class="page-top-title mt-3">- প্রজেক্টস সমূহ -</h1>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        @foreach ($projectData as $projectData)
        <div class="col-md-3 p-1 text-center">
            <div class=" m-1 card">
                <div class="text-center">
                    <img class="w-100" src="{{$projectData->project_img}}" alt="Card image cap">
                    <h5 class="service-card-title mt-4">{{$projectData->project_name}}</h5>
                    <h6 class="service-card-subTitle p-0 m-0">{{$projectData->project_des}}</h6>
                    <button class="normal-btn-outline mt-2 mb-4 btn">{{$projectData->project_link}}</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
