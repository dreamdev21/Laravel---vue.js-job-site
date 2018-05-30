<!-- tester Sign up modal -->
<div class="modal fade custom-modal tester-signup-modal" id="testerSignup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="modal-header">
            <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{route('register')}}" method="post" id="tester-register-form" class="tester-register-form">
						{{ csrf_field() }}
						<input type="hidden" name="type" value="tester" />
            <h2 class="text-uppercase form-title">
              register
            </h2>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-6">
                <div class="form-group custom-form-group">
                  <input type="text" class="form-control custom-form-control" name="first_name" placeholder="Enter First Name">
                </div>
                <div class="form-group custom-form-group">
                  <input type="text" class="form-control custom-form-control" name="last_name" placeholder="Enter Last Name">
                </div>
                <div class="form-group custom-form-group">
                  <input type="email" class="form-control custom-form-control" name="email" placeholder="Enter Email">
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-6">
                <div class="form-group custom-form-group country-select">
                  <div class="bfh-selectbox custom-form-control selectbox-wrap" data-name="country_id" data-value="231" data-filter="true">
              				@foreach($countries as $country)
												<div data-value="{{$country->id}}">{{$country->name}}</div>
											@endforeach
				          </div>
                </div>
                <div class="form-group custom-form-group">
                  <input class="form-control custom-form-control" type="password" name="password" id="pass" placeholder="Password" data-toggle="popover" data-placement="left"
                  />
                </div>
                <div class="form-group custom-form-group">
                  <input type="password" class="form-control custom-form-control" name="password_confirmation" id="confirmpass" placeholder="Confirm Password">
                </div>
              </div>
            </div>
            <button type="submit" name="signup-submit" id="signup-submit" class="btn green-btn text-center submit-btn">submit</button>
            <div class="w-100 text-center">
              <a class="modal-link" href="javascript:void(0);" data-toggle="modal" data-target="#forgotpassword" data-dismiss="modal">Forgot Password?</a>
            </div>
          </form>
        </div>
        <div class="modal-custom-footer">
          <p>Already have an account ? <a href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal" data-dismiss="modal">Log in</a> here.</p>
        </div>
        <div class="modal-custom-footer active">
          {{--<p>Register successful, admin will provide Login detail by email on--}}
            {{--<br>--}}
            {{--<a href="#" class="text-uppercase">sample@website.com</a>--}}
          {{--</p>--}}
        </div>
      </div>
    </div>
  </div>