<!-- publisher Sign up modal -->
<div class="modal fade custom-modal tester-signup-modal" id="publisherSignup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="modal-header">
            <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{route('register')}}" method="post" id="publisher-reg-form" class="tester-register-form">
            {{ csrf_field() }}
						<input type="hidden" name="type" value="publisher" />
            <h2 class="text-uppercase form-title">
              register
            </h2>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-6 pr-2 pr-md-4">
                <div class="form-group custom-form-group">
                  <input type="text" class="form-control custom-form-control" name="first_name" placeholder="First Name">
                </div>
                <div class="form-group custom-form-group">
                  <input type="text" class="form-control custom-form-control" name="last_name" placeholder="Last Name">
                </div>
                <div class="form-group custom-form-group">
                  <input type="email" class="form-control custom-form-control" name="email" placeholder="Email">
                </div>
                 <div class="form-group custom-form-group">
                  <input type="text" class="form-control custom-form-control" name="mobile_no" placeholder="Contact Number">
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-6 pr-2 pl-md-4">
                <div class="form-group custom-form-group">
                  <input class="form-control custom-form-control" type="password" name="password" id="publisher_pass" placeholder="Password" data-toggle="popover" data-placement="left"
                  />
                </div>
                <div class="form-group custom-form-group">
                  <input type="password" class="form-control custom-form-control" name="password_confirmation" id="publisher_confirmpass" placeholder="Confirm Password">
                </div>
                <div class="form-group custom-form-group">
                  <input type="text" class="form-control custom-form-control" name="company_name" placeholder="Company Name">
                </div>
              </div>
            </div>
            <!-- data-toggle="modal" data-target="#sucessSignup"
              data-dismiss="modal" -->
            <button type="submit" class="btn green-btn text-center submit-btn" id="psignup" data-toggle="" data-target=""
              data-dismiss="">sign up</button>
            <div class="w-100 text-center">
              <a class="modal-link" href="javascript:void(0);" data-toggle="modal" data-target="#forgotpassword" data-dismiss="modal">Forgot Password?</a>
            </div>
          </form>
        </div>
        <div class="modal-custom-footer">
          <p>Already have an account ? <a href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal"  data-dismiss="modal">Log in</a> here.</p>
        </div>
      </div>
    </div>
  </div>