<!-- Login Modal -->
<div class="modal fade custom-modal login-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <ul class="nav nav-tabs modal-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="modal-tester-tab" data-toggle="tab" href="#modal-tab-tester" role="tab" aria-controls="modal-tab-tester"
                aria-selected="true">Tester</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="modal-publisher-tab" data-toggle="tab" href="#modal-tab-publisher" role="tab" aria-controls="modal-tab-publisher"
                aria-selected="false">Publisher</a>
            </li>
          </ul>
          <div class="tab-content modal-tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="modal-tab-tester" role="tabpanel" aria-labelledby="tester-tab">
              <form action="{{route('authenticate')}}" class="login-form" method="post">
                {{csrf_field()}}
                <input type="hidden" value="tester" name="type" />
                <h2 class="text-center text-uppercase form-title">
                  log in
                </h2>
                <div class="form-group custom-form-group email-input-group">
                  <div class="input-group custom-input-group">
                    <input type="email" class="form-control custom-form-control email-input" name="email" required placeholder="Enter email">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <img src="images/msg-icon.png" class="img-fluid icon-deactive" />
                        <img src="images/msg-icon-active.png" class="img-fluid icon-active" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group custom-form-group email-input-group">
                  <div class="input-group custom-input-group">
                    <input type="password" name="password" required class="form-control custom-form-control password-input" placeholder="password">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <img src="images/lock-icon.png" class="img-fluid icon-deactive" />
                        <img src="images/lock-icon-active.png" class="img-fluid icon-active" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group custom-form-group text-center">
                  <div class="checkbox">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" value="">
                      <span class="cr">
                        <i class="cr-icon fa fa-square" aria-hidden="true"></i>
                      </span>
                      Remember Me
                    </label>
                  </div>
                </div>
                <button type="submit" class="btn green-btn text-center">login</button>
                <div class="w-100 text-center">
                  <a class="modal-link" href="javascript:void(0);" data-toggle="modal" data-target="#forgotpassword" data-dismiss="modal">Forgot Password?</a>
                </div>
              </form>
              <div class="modal-custom-footer">
                <p>New User? Testers <a href="#" data-toggle="modal" data-target="#testerSignup" data-dismiss="modal">sign up</a> Here.</p>
              </div>
            </div>
            <div class="tab-pane fade" id="modal-tab-publisher" role="tabpanel" aria-labelledby="publisher-tab">
              <form action="{{route('authenticate')}}" class="login-form" method="post">
                {{csrf_field()}}
                <input type="hidden" value="publisher" name="type" />
                <h2 class="text-center text-uppercase form-title">
                  log in
                </h2>
                <div class="form-group custom-form-group email-input-group">
                  <div class="input-group custom-input-group">
                    <input type="email" name="email" required class="form-control custom-form-control email-input" placeholder="Enter email">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <img src="images/msg-icon.png" class="img-fluid icon-deactive" />
                        <img src="images/msg-icon-active.png" class="img-fluid icon-active" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group custom-form-group email-input-group">
                  <div class="input-group custom-input-group">
                    <input type="password" name="password" required class="form-control custom-form-control password-input" placeholder="password">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <img src="images/lock-icon.png" class="img-fluid icon-deactive" />
                        <img src="images/lock-icon-active.png" class="img-fluid icon-active" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group custom-form-group text-center">
                  <div class="checkbox">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" value="">
                      <span class="cr">
                        <i class="cr-icon fa fa-square" aria-hidden="true"></i>
                      </span>
                      Remember Me
                    </label>
                  </div>
                </div>
                <button type="submit" class="btn green-btn text-center">login</button>
                <div class="w-100 text-center">
                  <a class="modal-link" href="javascript:void(0);" data-toggle="modal" data-target="#forgotpassword" data-dismiss="modal">Forgot Password?</a>
                </div>
              </form>
              <div class="modal-custom-footer">
                <p>New User? Publishers <a href="#" href="javascript:void(0);" data-toggle="modal" data-target="#publisherSignup" data-dismiss="modal">sign up</a> Here.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>