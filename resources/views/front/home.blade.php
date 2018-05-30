@extends('master')

@section('main_section_class', 'home-banner-section')
@section('sub_section_class','container custom-container')
@section('home_page_footer_class', 'home-footer')
@section('top_content')
<div class="row">
  <div class="col-12">
    <div id="carouselExampleIndicators" class="carousel slide custom-home-carousel" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block ml-auto" src="{{url('images/home-slider-2.png')}}" alt="First slide">
          <div class="carousel-caption d-md-block mr-auto">
            <h2 class="text-uppercase banner-title">outside Collaboration</h2>
            <p class="banner-content">Instead of developing in a vacuum
              <br> we provide you with real users' experiences.</p>
            <a href="#contact" class="btn green-btn banner-btn">
              contact us
              <img src="{{url('images/next-arrow-white.png')}}" class="img-fluid" />
            </a>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block ml-auto" src="{{url('images/home-slider-3.png')}}" alt="Second slide">
          <div class="carousel-caption d-md-block mr-auto">
            <h2 class="text-uppercase banner-title">The Beta Plan<!--Bug catchers when you need them--></h2>
            <p class="banner-content">We help you find the bugs
              <br> you've missed.</p>
            <a href="{{route('pricing')}}" class="btn green-btn banner-btn">
              order today
              <img src="{{url('images/next-arrow-white.png')}}" class="img-fluid" />
            </a>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block ml-auto" src="{{url('images/home-slider-4.png')}}" alt="Third slide">
          <div class="carousel-caption d-md-block mr-auto">
            <h2 class="text-uppercase banner-title">Be in the know</h2>
            <p class="banner-content">New hardware advances happen daily, we want to help make sure your offering works with them all.</p>
            <a href="#contact" class="btn green-btn banner-btn">
              contact us
              <img src="{{url('images/next-arrow-white.png')}}" class="img-fluid" />
            </a>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block ml-auto" src="{{url('images/home-slider-1.png')}}" alt="Fourth slide">
          <div class="carousel-caption d-md-block mr-auto">
            <h2 class="text-uppercase banner-title">TESTERS WANTED</h2>
            <ul class="banner-list">
              <li>
                Play the newest VR/AR/MR games before the general public
              </li>
              <li>
                Get PAID
              </li>
              <li>
                We are looking for testers of all backgrounds and experience levels
              </li>
            </ul>
            <a href="{{route('becomeTester')}}" class="btn green-btn banner-btn">
              Become A Tester
              <img src="{{url('images/next-arrow-white.png')}}" class="img-fluid" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<section id="services" class="home-service-section">
  <div class="home-service-bg"></div>
  <div class="container custom-container">
    <div class="row">
      <div class="col-12">
        <h2 class="text-uppercase section-title">
          Services Offered
        </h2>
      </div>
    </div>
    <div class="service-carousel-wrap">
      <div class="row">

        <div class="col-md-4 col-sm-6 text-center service-block">
          <div class="service-img-wrap">
            <img src="{{url('images/service-gameplay-testing.png')}}" class="img-fluid" />
          </div>
          <h5 class="text-uppercase service-title">
            Gameplay Testing
          </h5>
          <p>
            Testers will check and report that the game works, is easy to use, has actions that make sense, and contains fun gameplay.
          </p>
        </div>
        <div class="col-md-4 col-sm-6 text-center service-block">
          <div class="service-img-wrap">
            <img src="{{url('images/service-usability.png')}}" class="img-fluid" />
          </div>
          <h5 class="text-uppercase service-title">
            Usability Testing
          </h5>
          <p>
            The primary function will be the discovery and documentation of software defects (bugs).
          </p>
        </div>
        <div class="col-md-4 col-sm-6 text-center service-block">
          <div class="service-img-wrap">
            <img src="{{url('images/service-comfort.png')}}" class="img-fluid" />
          </div>
          <h5 class="text-uppercase service-title">
            Comfort Level
          </h5>
          <p>
            Testers will go through the app gauging the visually-induced disturbances that cause disorientation and other symptoms of
            discomfort.
          </p>
        </div>
        <div class="col-md-4 col-sm-6 text-center service-block">
          <div class="service-img-wrap">
            <img src="{{url('images/service-tester.png')}}" class="img-fluid" />
          </div>
          <h5 class="text-uppercase service-title">
            Our Testers
          </h5>
          <p>
            We have vetted testers and a client driven rating system.
          </p>
        </div>
        <div class="col-md-4 col-sm-6 text-center service-block">
          <div class="service-img-wrap">
            <img src="{{url('images/service-vr.png')}}" class="img-fluid" />
          </div>
          <h5 class="text-uppercase service-title">
            Devices
          </h5>
          <p>
            Google Daydream, Samsung Gear, HTC Vive, Oculus Rift, Microsoft Mixed Reality, Google Cardboard, Microsoft Hololens
          </p>
        </div>
        <div class="col-md-4 col-sm-6 text-center service-block">
          <a href="#" class="service-img-wrap" data-toggle="modal" data-target="#serviceModal">
            <div class="arrow-wrap">
              <img src="{{url('images/green-arrow.png')}}" class="img-fluid" />
            </div>
          </a>
          <a href="#" data-toggle="modal" data-target="#serviceModal">
            <h5 class="text-uppercase service-title">
              all of our services
            </h5>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="whyus" class="why-us-section">
  <div class="why-us-bg"></div>
  <div class="container custom-container">
    <div class="row">
      <div class="col-12">
        <h3 class="text-white text-uppercase section-title">
          why us ?
        </h3>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-lg-4 col-md-6">
        <ul class="why-us-list">
          <li>
            - Created by a team of developers and product specialists
          </li>
          <li>
            - Our team consists of product, analytics, and process professionals
          </li>
          <li>
            - We provide detailed analysis that will help you improve
          </li>
          <li>
            - Testers use the same rubric guaranteeing consistent results
          </li>
          <li>
            - We vet our videos for quality issues
          </li>
          <li>
            - We are here to talk to you and answer any questions you may have
          </li>
        </ul>
      </div>
      <div class="col-12 col-lg-8 col-md-6">
        <div class="float-right">
          <div class="d-inline-block text-center why-us-block">
            <div class="why-us-img-wrap">
              <img src="{{url('images/on-demand-icon.png')}}" class="img-fluid" />
            </div>
            <h5 class="why-us-block-title">
              On demand
              <br>testing
            </h5>
          </div>
          <div class="d-inline-block text-center why-us-block">
            <div class="why-us-img-wrap">
              <img src="{{url('images/process-driven-icon.png')}}" class="img-fluid" />
            </div>
            <h5 class="why-us-block-title">
              Process
              <br>Driven
            </h5>
          </div>
          <div class="d-inline-block text-center why-us-block">
            <div class="why-us-img-wrap">
              <img src="{{url('images/analytics-icon.png')}}" class="img-fluid" />
            </div>
            <h5 class="why-us-block-title">
              Concise Reporting &amp; Analytics
            </h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="whatexpect" class="what-to-expect-section">
  <div class="container custom-container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-3">
        <h3 class="text-uppercase section-title">
          What to Expect
      </div>
      <div class="col-12 col-sm-12 col-md-9">
        <div class="what-expect-cotent-wrap">
          <div class="men-img-wrap">
            <img src="{{url('images/standing-men-img.png')}}" class="img-fluid" />
          </div>
          <div class="what-expect-content">
            <ul>
              <li>
                <a href="javscript:void(0);">Videos of Testing</a>
                <p class="expect-text">We provide you access to videos
                  <br> from your testers.</p>
              </li>
              <li>
                <a href="javscript:void(0);">Analytics</a>
                <p class="expect-text">We provide you with comprehensive analytics
                  <br>based off your testers' feedback.</p>
              </li>
              <li>
                <a href="javscript:void(0);">Results</a>
                <p class="expect-text">We will provide an outline of all responses to the questions provided.</p>
              </li>
              <li>
                <a href="javscript:void(0);">Project Dashboard</a>
                <p class="expect-text">You get access to a project dashboard with all current and past projects. All data, analytics and feedback
                  results can be accessed anytime.</p>
              </li>
              <li>
                <a href="javscript:void(0);">Tester Ratings</a>
                <p class="expect-text">You get to rate the testers, in doing so guaranteeing only the best testers work on your projects.</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="customer-logo-section">
  <div class="customer-logo-curve"></div>
  <div class="container custom-container">
    <div class="row">
      <div class="col-12">
        <div class="dotted-line"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-4 col-md-3">
        <div class="customer-logo-wrap">
          <img src="{{url('images/logo-lg.png')}}" class="img-fluid" />
        </div>
      </div>
      <div class="col-4 col-md-3">
        <div class="customer-logo-wrap">
          <img src="{{url('images/logo-citrix.png')}}" class="img-fluid" />
        </div>
      </div>
      <div class="col-4 col-md-3">
        <div class="customer-logo-wrap">
          <img src="{{url('images/logo-fox.png')}}" class="img-fluid" />
        </div>
      </div>
      <div class="col-4 col-md-3">
        <div class="customer-logo-wrap">
          <img src="{{url('images/logo-rubbermaid.png')}}" class="img-fluid" />
        </div>
      </div>
      <div class="col-4 col-md-3">
        <div class="customer-logo-wrap">
          <img src="{{url('images/logo-gogo.png')}}" class="img-fluid" />
        </div>
      </div>
      <div class="col-4 col-md-3">
        <div class="customer-logo-wrap">
          <img src="{{url('images/logo-singtel.png')}}" class="img-fluid" />
        </div>
      </div>
      <div class="col-4 col-md-3">
        <div class="customer-logo-wrap">
          <img src="{{url('images/logo-lowes.png')}}" class="img-fluid" />
        </div>
      </div>
      <div class="col-4 col-md-3">
        <div class="customer-logo-wrap">
          <img src="{{url('images/logo-fedex.png')}}" class="img-fluid" />
        </div>
      </div>
      <div class="col-4 col-md-3">
        <div class="customer-logo-wrap">
          <img src="{{url('images/logo-nbc.png')}}" class="img-fluid" />
        </div>
      </div>
      <div class="col-6 col-md-5">
        <div class="customer-logo-wrap">
          <img src="{{url('images/logo-gohnson.png')}}" class="img-fluid" />
        </div>
      </div>
      <div class="col-6 col-md-4">
        <div class="customer-logo-wrap">
          <img src="{{url('images/logo-covidien.png')}}" class="img-fluid" />
        </div>
      </div>
    </div>
  </div>
</section>
<section class="fixed-bottom text-center text-uppercase tester-wanted-btn-wrap">
  <a href="{{route('becomeTester')}}" class="tester-wanted-btn">
    Testers Wanted: Click Here!
  </a>
</section>
@endsection