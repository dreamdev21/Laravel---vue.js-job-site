<template>
    <div class="container-fluid login_bg">
                <vue-form :state="formstate" @submit.prevent="onSubmit">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 col-sm-6 offset-sm-3 col-10 offset-1 p-0 login-content">
               <div class="login-top-part">
                    <div class="row">
                        <div class="col-sm-12 mt-3">
                            <h2 class="text-center">
                                <img src="~img/home_logo.png" alt="The Beta Plan" class="img-fluid login-logo"/>
                            </h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 mt-3 ">
                            <div style="color: red" v-if="error" v-text="error"></div>
                            <div class="form-group custom-form-group">
                                <validate tag="div">
                                    <input v-model="model.username" name="email" id="email" type="email" required autofocus placeholder="E-mail" class="form-control custom-form-control" />
                                    <field-messages name="email" show="$invalid && $submitted" class="text-danger">
                                        <div slot="required">Email is a required field</div>
                                        <div slot="email">Email is not valid</div>
                                    </field-messages>
                                    <div class="input-group-text">
                                        <img src="~img/msg-icon.png" class="img-fluid" />
                                    </div>
                                </validate>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group custom-form-group">
                                <validate tag="div">
                                    <input v-model="model.password" name="password" id="password" type="password" required placeholder="Password" class="form-control custom-form-control" minlength="4" maxlength="10" />
                                    <field-messages name="password" show="$invalid && $submitted" class="text-danger">
                                        <div slot="required">Password is required</div>
                                        <div slot="minlength">Password should be atleast 4 characters long</div>
                                        <div slot="maxlength">Password should be atmost 10 characters long</div>
                                    </field-messages>
                                    <div class="input-group-text">
                                        <img src="~img/lock-icon.png" class="img-fluid" />
                                    </div>
                                </validate>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group custom-form-group">
                                <button type="submit" :disabled="processing" class="btn green-btn text-uppercase text-center">Sign in</button>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <validate tag="label">
                                <div class="form-group custom-form-group mb-0">
                                    <div class="checkbox">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="custom-control-input checkbox_label" name="remember" id="remember" v-model="model.remember" check-box>
                                              <span class="cr">
                                            <i class="cr-icon fa fa-square" aria-hidden="true"></i>
                                        </span>
                                            Remember me
                                        </label>
                                        <field-messages name="remember" show="$invalid && $submitted" class="text-danger">
                                            <div slot="check-box">Terms must be accepted</div>
                                        </field-messages>
                                    </div>
                                </div>
                            </validate>
                        </div>
                    </div>
               </div>
                <div class="backend-login-footer">
                    <div class="col-sm-12 text-center">
                        <div class="form-group mb-0">
                            <p class="mb-0">
                                <router-link tag="a" :to="{ name: 'forgetpassword' }" class="">Forgot your Password ?</router-link>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                </vue-form>
    </div>
</template>
<!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
<script>
import Vue from "vue";
import VueForm from "vue-form";
import options from "src/validations/validations.js";
import {
  hasTesterRole,
  hasPublisherRole,
  isLoggedIn,
  logout,
  isUserActive,
  isApprovedTester,
  latestProjectStatus
} from "src/services/auth";
Vue.use(VueForm, options);
export default {
  name: "login2",
  data() {
    return {
      formstate: {},
      processing: false,
      model: {
        username: "",
        password: ""
      },
      error: null
    };
  },
  methods: {
    onSubmit() {
      this.error=null;
      if (this.formstate.$invalid) {
        return;
      } else {
        this.processing = true;
        axios
          .post("/oauth/token", {
            ...this.model,
            client_id: window.Laravel.client_id,
            client_secret: window.Laravel.client_secret,
            grant_type: "password"
          })
          .then(
            response => {
              localStorage.setItem("access_token", response.data.access_token);
              return isLoggedIn();
            },
            response => {
              this.error = "Invalid email or password";
              this.processing = false;
            }
          )
          .then(() => {
            if (hasTesterRole() && window.USER.status.name.toLowerCase()!== "deactive") {
              axios.defaults.headers.common[
                "Authorization"
              ] = `Bearer ${localStorage.getItem("access_token")}`;
              let latestUserStatus = window.USER.status.name.toLowerCase();
            //   console.log(isUserActive() , isApprovedTester(), latestUserStatus, latestUserStatus == "step_2_clear" , latestUserStatus == 'submitted' , latestUserStatus == 'review');
              if (isUserActive() || isApprovedTester() || latestUserStatus == "step_2" || latestUserStatus == 'submitted' || latestUserStatus == 'review') {
                this.$router.push({ name: "tester.dashboard" });
              } else {
                  if( latestUserStatus == "step_1"){
                    this.$router.push({ name: "tester.step2" });
                  }else{
                    this.$router.push({ name: "tester.welcome" });
                  }
              }
            } else if (hasPublisherRole() && window.USER.status.name.toLowerCase()!== "deactive") {
              axios.defaults.headers.common[
                "Authorization"
              ] = `Bearer ${localStorage.getItem("access_token")}`;
              this.$router.push({ name: "publisher.dashboard" });
            } else if (window.USER.status.name.toLowerCase()!== "deactive") {
               this.error = null;
            }else{
              logout();
              this.processing = false;
              this.error = "Your account is deactivated. Please contact help@thebetaplan.com";

            }
          });
      }
    }
  },
  mounted: function() {},
  destroyed: function() {}
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";

.checkbox label:after,
.radio label:after {
    content: '';
    display: table;
    clear: both;
}

.checkbox .cr,
.radio .cr {
    position: relative;
    display: inline-block;
    border: 1px solid #a9a9a9;
    border-radius: .25em;
    width: 1.3em;
    height: 1.3em;
    float: left;
    margin-right: .5em;
}

.radio .cr {
    border-radius: 50%;
}

.checkbox .cr .cr-icon,
.radio .cr .cr-icon {
    position: absolute;
    font-size: 12px;
    line-height: 0;
    top: 52%;
    left: 2px;
}

.radio .cr .cr-icon {
    margin-left: 0.04em;
}

.checkbox label input[type="checkbox"],
.radio label input[type="radio"] {
    position: absolute;
    top: -99999999;
    visibility: hidden;
}

.custom-form-group .checkbox label input[type="checkbox"]:checked+.cr,
.custom-form-group .radio label input[type="radio"]:checked+.cr {
    border: 2px solid #29aa35;
}

.custom-form-group .checkbox label input[type="checkbox"]:checked+.cr>.cr-icon,
.custom-form-group .radio label input[type="radio"]:checked+.cr>.cr-icon {
    color: #29aa35;
}

.custom-form-group .radio .cr {
    height: 20px;
    width: 20px;
    margin-top: 3px;
}

.custom-form-group .radio .cr .cr-icon {
    font-size: 12px;
    margin-left: 0px;
}
.checkbox label input[type="checkbox"]+.cr>.cr-icon,
.radio label input[type="radio"]+.cr>.cr-icon {
    transform: scale(3) rotateZ(-20deg);
    opacity: 0;
    transition: all .3s ease-in;
}

.checkbox label input[type="checkbox"]:checked+.cr>.cr-icon,
.radio label input[type="radio"]:checked+.cr>.cr-icon {
    transform: scale(1) rotateZ(0deg);
    opacity: 1;
}

.checkbox label input[type="checkbox"]:disabled+.cr,
.radio label input[type="radio"]:disabled+.cr {
    opacity: .5;
}
.custom-form-control::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  font-size: 18px;
    color: #b7b7b7;
}
.custom-form-control::-moz-placeholder { /* Firefox 19+ */
  font-size: 18px;
    color: #b7b7b7;
}
.custom-form-control:-ms-input-placeholder { /* IE 10+ */
  font-size: 18px;
    color: #b7b7b7;
}
.custom-form-control:-moz-placeholder { /* Firefox 18- */
  font-size: 18px;
    color: #b7b7b7;
}

.login_bg{
    background-color: #eff9fe;
    background-size: 100%;
    min-height: 100vh !important;
    .row.align-items-center{
        height: 100vh;
    }
    .login-top-part{
        padding: 25px 50px 20px;
    }
    .login-content {
        margin: 100px auto;
        box-shadow: 0px 0px 5px 5px rgba(0, 0, 0, 0.03);
        background-size: 100% 100%;
        border-radius: 7px;
        background-color: #fff;
        .login-logo{
            max-width: 170px;
            margin-bottom: 30px;
        }
    }
    .form-control{
        border-radius: 0px !important;
    }
    .custom-form-group{
        position: relative;
        margin-bottom: 25px;
        .custom-form-control{
            background-color: transparent !important;
            border: none;
            border-radius: none !important;
            border-bottom: 1px solid #c9c9c9;
            font-size: 18px;
            color: #b7b7b7;
            width: 100%;
            padding-right: 35px;
            position: relative;
            &:hover{
                outline: none !important;
            }
            &:focus{
                outline: none !important;
            }
        }
        .input-group-text{
            padding: 5px;
            position: absolute;
            right: 0px;
            top: 3px;
        }
    }
    .backend-login-footer{
        background-image: url('~img/backend-login-grey.png');
        background-size: 100%;
        background-repeat: no-repeat;
        border-bottom-left-radius: 7px;
        border-bottom-right-radius: 7px;
        padding: 25px 0;
        a{
            color: #fff;
            text-decoration: underline !important;
            font-size: 16px;
            margin: 30px 0;
        }
    }
    .green-btn{
      width: 100%;
      padding: 7px 10px;
      border:2px solid #2cac3d;
      background-color: #2cac3d;
      font-size: 15px;
      font-family: $font-family-brandon-medium;
      letter-spacing: 0px;
      color: #fff;
      border-radius: 20px;
      display: block;
      text-align: center;
      margin: 20px auto;
        max-width: 260px;
      &:hover{
        background-color: #158f25;
      }
    }
}
@media screen and(max-width:1200px) {
    .login_bg{
        .login-top-part{
            padding: 15px 35px 20px;
        }
        .backend-login-footer{
            padding: 20px 0;
            background-size: cover;
            background-position: center;
        }
        .green-btn{
            max-width: 210px;
            margin: 5px auto;
        }
        .custom-form-group{
            .custom-form-control{
                font-size: 16px;
            }
        }
        .custom-form-control::-webkit-input-placeholder { /* Chrome/Opera/Safari */
            font-size: 16px;
        }
        .custom-form-control::-moz-placeholder { /* Firefox 19+ */
            font-size: 16px;
        }
        .custom-form-control:-ms-input-placeholder { /* IE 10+ */
            font-size: 16px;
        }
        .custom-form-control:-moz-placeholder { /* Firefox 18- */
            font-size: 16px;
            
        }
    }
}
@media screen and(max-width:767px) {
     .login_bg{
         .login-content{
             margin: 50px auto;
             .login-logo{
                 margin-bottom: 10px;
             }
         }
        .login-top-part{
            padding: 0 15px 15px;
        }
        .green-btn{
            max-width: 160px;
        }
     }
}
</style>
