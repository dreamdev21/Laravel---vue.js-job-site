<template>
  <div class="container-fluid login_bg">
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
        </div>
        <div class="col-lg-12" v-show="this.email_send">
          <p class="user-message "> Email for reset password instruction has been sent on {{model.email}}. Please check
            your inbox.</p>
        </div>
        <vue-form :state="formstate" @submit.prevent="onSubmit" v-if="!this.email_send">
          <div class="col-lg-12">
            <p class="user-message "> Please enter the email you are registered with. An email message will be sent to
              the email address with further instructions.</p>
            <div style="color: red" v-if="errors">
              {{ errors }}
            </div>
            <div class="form-group custom-form-group">
              <validate tag="div">
                <input v-model="model.email" name="email" type="email" required placeholder="E-mail"
                       class="form-control custom-form-control"/>
                <field-messages name="email" show="$invalid && $submitted" class="text-danger">
                  <div slot="required">Email is a required field</div>
                  <div slot="email">Email is not valid</div>
                </field-messages>
                <div class="input-group-text">
                  <img src="~img/msg-icon.png" class="img-fluid"/>
                </div>
              </validate>
            </div>
          </div>
          <div class="col-12 mt-4">
            <div class="form-group">
              <input type="submit" value="RESET PASSWORD" class="btn green-btn text-uppercase"/>
            </div>
            <div class="form-group text-center mb-4">
              <router-link tag="a" :to="{ name: 'login' }" class="">Back to login</router-link>
            </div>
          </div>
        </vue-form>
      </div>
    </div>
  </div>
</template>
<script>
  import Vue from 'vue'
  import VueForm from "vue-form";
  import options from "src/validations/validations.js";

  Vue.use(VueForm, options);
  export default {
    name: "forgetpassword",
    data() {
      return {
        formstate: {},
        model: {
          email: ""
        },
        email_send: false,
        errors: null
      }
    },
    methods: {
      onSubmit() {
        if (this.formstate.$invalid) {
          return;
        } else {
          axios.post(`/password/email`, {email: this.model.email})
            .then(response => {
              var resToken = response.data.data.token;
              if (resToken !== null) {
                localStorage.setItem("token", resToken);
                localStorage.setItem("email", this.model.email);
                this.email_send = true;
                return true;
              }
            })
            .catch(
              error => (this.errors = error.response.data.message)
            );
        }
      }
    },
    mounted: function () {

    },
    destroyed: function () {

    }
  }
</script>
<style lang="scss" scoped>
  @import "../layouts/css/_customvariables";

  .login_bg {
    background-color: #eff9fe;
    background-size: 100%;
    min-height: 100vh !important;
    .row.align-items-center {
      height: 100vh;
    }
    .login-top-part {
      padding: 5px 50px 0px;
    }
    .login-content {
      margin: 100px auto;
      box-shadow: 0px 0px 5px 5px rgba(0, 0, 0, 0.03);
      background-size: 100% 100%;
      border-radius: 7px;
      background-color: #fff;
      .login-logo {
        max-width: 170px;
        margin-bottom: 20px;
      }
      a {
        color: #2cac3d;
        text-decoration: underline !important;
        margin-bottom: 40px;
        font-size: 15px;
      }
    }
    .user-message {
      padding: 15px 0;
      font-size: 14px;
      color: #777;
      text-align: center;
    }
    .form-control {
      border-radius: 0px !important;
    }
    .custom-form-group {
      position: relative;
      margin-bottom: 25px;
      .custom-form-control {
        background-color: transparent !important;
        border: none;
        border-radius: none !important;
        border-bottom: 1px solid #c9c9c9;
        font-size: 18px;
        color: #b7b7b7;
        width: 100%;
        padding-right: 35px;
        position: relative;
        &:hover {
          outline: none !important;
        }
        &:focus {
          outline: none !important;
        }
      }
      .input-group-text {
        padding: 5px;
        position: absolute;
        right: 0px;
        top: 3px;
      }
    }
    .green-btn {
      width: 100%;
      padding: 7px 10px;
      border: 2px solid #2cac3d;
      background-color: #2cac3d;
      font-size: 15px;
      font-family: $font-family-brandon-medium;
      letter-spacing: 0px;
      color: #fff;
      border-radius: 20px;
      display: block;
      text-align: center;
      margin: 20px auto;
      max-width: 230px;
      &:hover {
        background-color: #158f25;
      }
    }
  }

  @media screen and(max-width: 1200px) {
    .login_bg {
      .login-top-part {
        padding: 15px 35px 20px;
      }
      .green-btn {
        margin: 5px auto;
      }
      .custom-form-group {
        .custom-form-control {
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

  @media screen and(max-width: 767px) {
    .login_bg {
      .login-content {
        margin: 50px auto;
        .login-logo {
          margin-bottom: 0px;
        }
      }
      .user-message {
        padding: 0 0 15px;
      }
      .login-top-part {
        padding: 0 15px 15px;
      }
    }
  }
</style>
