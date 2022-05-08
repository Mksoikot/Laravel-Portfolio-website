@extends('Layout.app')
@section('title','Contact')
@section('content')

<div class="container-fluid jumbotron mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
                <h1 class="page-top-title mt-3">- যোগাযোগ করুন -</h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <iframe style="width: 100%;height: 100%;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3659.901207730412!2d91.16434051423569!3d23.464027784731286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x37547f3621681ba7%3A0x1efbb3921182085!2z4KaV4KeB4Kau4Ka_4Kay4KeN4Kay4Ka-IOCmsOCnh-CmsuCmk-Cnn-CnhyDgprjgp43gpp_gp4fgprbgpqg!5e0!3m2!1sen!2sbd!4v1652004243681!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="col-md-6">
            <h3 class="service-card-title">ঠিকানা</h3>
            <hr>
            <p class="footer-text"><i class="fas fa-map-marker-alt"></i> নিলয় সোসাইটি, স্টেশন রোড, কুমিল্লা <i class="ml-2 fas fa-phone"></i> ০১৬২২২৪৩১১৭ <i class="ml-2 fas fa-envelope"></i> Mksoikot117@gmail.com</p>
            <div class="form-group ">
                <input id="contactNameId" type="text" class="form-control w-100" placeholder="আপনার নাম">
            </div>
            <div class="form-group">
                <input id="contactMobileId" type="text" class="form-control  w-100" placeholder="মোবাইল নং ">
            </div>
            <div class="form-group">
                <input id="contactEmailId" type="text" class="form-control  w-100" placeholder="ইমেইল ">
            </div>
            <div class="form-group">
                <input id="contactMsgId" type="text" class="form-control  w-100" placeholder="মেসেজ ">
            </div>
            <button id="contactSendBtnId" class="btn btn-block normal-btn w-100">পাঠিয়ে দিন </button>
        </div>
    </div>
</div>
@include('Layout.footer');
@endsection
