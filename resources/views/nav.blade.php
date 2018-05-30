@php
  $routeName = request()->route()->getName();
  $route = route('home');
@endphp

<div class="row">
  <div class="col-12">
    <nav class="navbar navbar-expand-lg custom-navbar">
      <a class="navbar-brand" href="{{route('home')}}">
        <img src="{{url('images/home_logo.png')}}" class="img-fluid" />
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars" aria-hidden="true"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item custom-link {{$routeName === 'home' ? 'active' : ''}}">
            <a class="nav-link" href="{{$routeName === 'home' ? '#services' : $route.'#services'}}" id="services">Services</a>
          </li>
          <li class="nav-item custom-link">
            <a class="nav-link" href="{{$routeName === 'home' ? '#whyus' : $route.'#whyus'}}">why us</a>
          </li>
          <li class="nav-item custom-link">
            <a class="nav-link" href="{{$routeName === 'home' ? '#whatexpect' : $route.'#whatexpect'}}">What to Expect</a>
          </li>
          <li class="nav-item custom-link {{$routeName === 'pricing' ? 'active' : ''}}">
            <a class="nav-link" href="{{route('pricing')}}">pricing</a>
          </li>
          <li class="nav-item custom-link">
            <a class="nav-link" href="{{$routeName === 'home' ? '#contact' : $route.'#contact'}}">contact</a>
          </li>
          <li class="nav-item custom-link">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal">login</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</div>