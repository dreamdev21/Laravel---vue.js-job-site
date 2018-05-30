<!doctype html>
<html lang="en">

<head>
  <title>The Beta Plan</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- <link rel="shortcut icon" href="{{url('images/favicon-32x32.png')}}" type="image/x-icon"> -->
  <link rel="icon" href="{{url('images/favicon.ico')}}" type="image/x-icon">
  <link rel="shortcut icon" href="{{url('images/favicon-32x32.png')}}" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{url('styles/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{url('styles/bootstrap-slider.css')}}">
  <link rel="stylesheet" href="{{url('styles/font-awesome.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('styles/bootstrap-datetimepicker.min.css')}}">
  <!-- <link rel="stylesheet" href="{{url('styles/jquery-countryselector.min.css')}} /> -->
  <link rel="stylesheet" href="{{url('styles/bootstrap-formhelpers.css')}}">
  <link rel="stylesheet" href="{{url('styles/style.css')}}">
</head>

<body>
  <section class="@yield('main_section_class')">
    <div class="@yield('sub_section_class')">
      @if(Route::currentRouteName() == "becomeTester")
        <div class="container custom-container">
          @include('nav') 
        </div>
      @else
        @include('nav') 
      @endif

      @yield('top_content')
    </div>
  </section>
  @yield('content')
  @include('front.modals.all-service')
  @include('front.modals.forget-password')
  @include('front.modals.login')
  @include('front.modals.publisher-signup')
  @include('front.modals.tester-signup')
  @include('front.modals.publisher-signup-success')
  @php
    $routeName = request()->route()->getName();
    $route = route('home');
  @endphp
  <a href="#" id="toTop" class="move-top-btn">
    <!-- <i class="fa fa-arrow-up"></i> -->
    <img src="{{url('images/up-arrow-white.png')}}" class="img-fluid" />
  </a>
  <footer class="@yield('home_page_footer_class')">
    <div class="container custom-container">
      <div class="row footer-wrap">

        <a href="{{route('home')}}" class="d-block d-sm-inline-block footer-logo-wrap footer-item">
          <img src="{{url('images/footer-logo.png')}}" class="img-fluid footer-logo">
        </a>

        <div class="d-block d-sm-inline-block footer-item border-l footer-menu ">
          <a href="{{$routeName === 'home' ? '#services' : $route.'#services'}}" id="services">Services</a>
          <a href="{{$routeName === 'home' ? '#whyus' : $route.'#whyus'}}">why us</a>
          <a href="{{$routeName === 'home' ? '#whatexpect' : $route.'#whatexpect'}}">What to Expect</a>
          <a href="{{route('pricing')}}">Pricing</a>
        </div>
        <div class="d-block d-sm-inline-block footer-item border-r footer-follow-links">
          <p class="footer-title text-uppercase">Follow us</p>
          <a href="https://www.facebook.com/The-Beta-Plan-1295785547234329/" target="_blank">
            <img src="{{url('images/icon-fb.png')}}" class="follow-icon"> Facebook</a>
          <a href="https://twitter.com/@_theBetaPlan" target="_blank">
            <img src="{{url('images/icon-twitter.png')}}" class="follow-icon"> Twitter</a>
          <a href="https://www.instagram.com/thebetaplan" target="_blank">
            <img src="{{url('images/icon-instagram.png')}}" class="follow-icon"> Instagram</a>
        </div>

        <div id="contact" class="d-block d-sm-inline-block footer-item footer-menu-light contact-form-wrap">
          <p class="footer-title text-uppercase">Contact us</p>
          <form class="footer-contact-form" id="foo-cont-form">
            <div class="row">
              <div class="col-6">
                <div class="form-group custom-form-group">
                  <input type="text" class="form-control custom-form-control" placeholder="Name*" name="foo_con_name" id="foo_con_name">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group custom-form-group">
                  <input type="text" class="form-control custom-form-control" placeholder="Company(Not Required)">
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group custom-form-group">
                  <input type="text" class="form-control custom-form-control" placeholder="Email*" name="foo_con_email" id="foo_con_email">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group custom-form-group">
                  <input type="text" class="form-control custom-form-control" placeholder="Phone*" name="foo_con_number" id="foo_con_number">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group custom-form-group">
                  <input type="text" class="form-control custom-form-control" placeholder="Comments*" name="foo_con_comments" id="foo_con_comments">
                </div>
              </div>
              <div class="col-6">
                <button type="submit" class="btn green-btn">send</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="justify-content-center footer-copyright text-center">
      <div class="col-12">
        &copy; {{date('Y')}} The Beta Plan LLC
        <br>All rights reserved.
      </div>
    </div>
  </footer>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->
  <script src="{{url('scripts/jquery-3.2.0.min.js')}}"></script>
  <script src="{{url('scripts/popper.min.js')}}"></script>
  <script src="{{url('scripts/moment.min.js')}}"></script>
  <script src="{{url('scripts/bootstrap-datetimepicker.min.js')}}"></script>
  <script src="{{url('scripts/bootstrap.min.js')}}"></script>
  <script src="{{url('scripts/bootstrap-slider.js')}}"></script>
  <script src="{{url('scripts/jquery.cookie.js')}}"></script>
  <script src="{{url('scripts/bootstrap-formhelpers.js')}}"></script>
  <script src="{{url('scripts/jquery.validate.min.js')}}"></script>
  <script src="{{url('scripts/script.js')}}"></script>
  <script>
    $(function() {
      $('form.login-form').submit(function(e) {
        e.preventDefault();
        var $form = $(this);
        $form.find('.has-error-div').remove();
        $.ajax({
          url: $form.attr('action'),
          data: $form.serialize(),
          type: 'post',
          headers: {
            'Accept': 'application/json'
          }
        }).then(function(response) {
          var user = response.data;
          if (user.roles[0].name === 'tester') {
            return window.location = '/portal/tester';
          }
          window.location = '/portal/publisher'
        }).catch(function(e) {
          var message = Array.isArray(e.responseJSON.message) ? e.responseJSON.message : [e.responseJSON.message];
          $form.prepend('<div class="has-error-div" style="color: red">'+message.join('<br />')+'</div>')
        })
      })
      $('form.tester-register-form').submit(function(e) {
        e.preventDefault();
        var $form = $(this);
        $form.find('.has-error-div').remove();
        var $button = $form.find('#signup-submit');
        $button.prop('disabled', true).addClass('disabled disable');
        $.ajax({
          url: $form.attr('action'),
          data: $form.serialize(),
          type: 'post',
          headers: {
            'Accept': 'application/json'
          }
        }).then(function(response) {
          var user = response.data;
          $('#email_shown').html(user.email);
          $form.closest('.modal').modal('hide');
          $('#registered_user_id').val(user.id);
          $button.prop('disabled', false).removeClass('disabled disable');
          $('.tester-success-modal').modal('show');
        }).catch(function(e) {
          $button.prop('disabled', false).removeClass('disabled disable');
          var message = Array.isArray(e.responseJSON.message) ? e.responseJSON.message : [e.responseJSON.message];
          $form.prepend('<div class="has-error-div" style="color: red">'+message.join('<br />')+'</div>')
        })
      });
      $('form#resendActivationEmailForm').submit(function(e) {
        e.preventDefault();
        var $form = $(this);
        $form.find('.has-error-div').remove();
        var $button = $form.find('.submit-btn');
        $button.prop('disabled', true).addClass('disabled disable');
        $.ajax({
          url: $form.attr('action'),
          data: $form.serialize(),
          type: 'post',
          headers: {
            'Accept': 'application/json'
          }
        }).then(function(response) {
          var user = response.data;
          $form.prepend('<div class="has-error-div" style="color: green">Activation email has been sent again to '+user.email+'</div>')
        }).catch(function(e) {
          $button.prop('disabled', false).removeClass('disabled disable');
          var message = Array.isArray(e.responseJSON.message) ? e.responseJSON.message : [e.responseJSON.message];
          $form.prepend('<div class="has-error-div" style="color: red">'+message.join('<br />')+'</div>')
        })
      })
    });
    window.Laravel = {
    "baseRoute":"{{url('/')}}"
    }

  </script>
</body>
</html>