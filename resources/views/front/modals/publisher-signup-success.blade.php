<!-- publisher Sign up success modal -->
<div class="modal fade custom-modal tester-success-modal" id="sucessSignup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="modal-header">
            <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <h2 class="text-uppercase form-title">
            register
          </h2>
          <div class="row">
            <div class="col-12 text-center modal-info-wrap">
              <h2 class="success-title text-uppercase">
                Registration Success
              </h2>
              <p class="thanku-msg">
                Thank you for registering. You will receive email on
                <a href="#" id="email_shown" class="text-green">sample@website.com</a>
                with link to activate your account.
              </p>
              <form action="{{route('resendActivationEmail')}}" method="post" id="resendActivationEmailForm">
                {{csrf_field()}}
                <input type="hidden" value="" name="user_id" id="registered_user_id" />
                <button type="submit" class="btn green-btn text-center submit-btn">Click here to re-send email</button>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-custom-footer active">

        </div>
      </div>
    </div>
  </div>