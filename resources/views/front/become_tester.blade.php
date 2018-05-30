@extends('master')
@section('main_section_class', 'tester-page-section')
@section('sub_section_class','container-fluid')
@section('top_content')
  <div class="container-fluid tester-banner-wrap">
    <div class="row">
      <div class="col-12">
        <div class="tester-banner-detail text-center">
          <h3 class="text-uppercase banner-title">TESTERS WANTED!</h3>
          <p class="banner-txt">
            <span>Play...Give feedback...Get paid! </span>
            <br> You could be testing in as little as 48 hours.
            <br> Create your profile today.
          </p>
        </div>
      </div>
    </div>
    <a href="#" class="paypal-btn">
      Get paid with
      <img src="{{url('images/paypal-icon.png')}}" class="img-fluid" />
    </a>
  </div>
  <div id="becomeTester" class="become-tester-wrap">
    <div class="container custom-container p-0">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-7">
          <h3 class="section-title">
            Become a tester
          </h3>
          <ul class="tester-list">
            <li>
              Are you interested in becoming a VR/AR/MR game tester and getting paid for it ?
            </li>
            <li>
              Do you enjoy or are you passionate about VR/AR/MR products?
            </li>
            <li>
              Are you hip and up-to-date with gaming trends?
            </li>
            <li>
              Do you want to help impact the VR/AR/MR community by giving feedback to publishers on their content?
            </li>
          </ul>
        </div>
        <div class="col-12 col-sm-12 col-md-5">
          <div class="become-tester-quote">
            <p>
              If you answered
              <span class="text-green">YES</span>,
              <br> to
              <span class="text-green">any</span> of these questions,
              <br> We would love to
              <span class="text-green">work</span> with
              <span class="text-green">you !</span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="become-tester-group-wrap">
    <div class="container custom-container p-0">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-6">
          <h3 class="section-title">
            Being a part of The Beta Plan tester group:
          </h3>
          <div class="img-wrap">
            <img src="{{url('images/tester-group-icon.png')}}" class="img-fluid" />
          </div>
          <div class="content-wrap">
            <p>
              You WILL be compensated!
            </p>
            <p>
              Not all tests are the same. We will scale compensation rates depending on the type of project. So do more, get more.
            </p>
            <p>
              You WILL be rated!
            </p>
            <p>
              Our publishers get to rate you, not on positive/negative feedback, but on the quality of your feedback.
            </p>
            <p>
              You CAN get first dibs on projects!
            </p>
            <p>
              By having a good-standing feedback rating, you are able to get priority access to open projects.
            </p>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6">
          <h3 class="section-title">
            What you need to
            <br>know:
          </h3>
          <p class="top-txt">
            This application process will take approximately 20-30 minutes and has 3 parts: You need to complete all parts to apply as
            a tester.
          </p>
          <ul class="tester-group-list">
            <li>
              <h5 class="text-uppercase text-green">1. Your profile information</h5>
              <p>This consists of a form with the standard profile information and NDA legal jargon.</p>
            </li>
            <li>
              <h5 class="text-uppercase text-green">2. Asset Submission Overview</h5>
              <p>Here we will show you a video on how our process for testing and submitting your assets goes. This will also
                show you what to do in your video, as far as what to talk about, how to "talk out loud" about what you
                are seeing/doing, and recording best practices.</p>
            </li>
            <li>
              <h5 class="text-uppercase text-green">3. Time to Shine!</h5>
              <p>
                Here you will conduct a run-through of everything shown thus far and submit for review.
              </p>
            </li>
            <li>
              <p>
                You will receive a confirmation receipt of your upload and within 48 - 72 hours we will get back you regarding your status.
              </p>
            </li>
          </ul>
          <p class="bottom-txt">
            That's it!
          </p>
        </div>
        <div class="col-12">
          <a href="#" class="btn green-btn apply-tester-btn" data-toggle="modal" data-target="#testerSignup" data-dismiss="modal">
            APPLY TO BE A TESTER
            <img src="{{url('images/next-arrow-white.png')}}" class="img-fluid" />
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection