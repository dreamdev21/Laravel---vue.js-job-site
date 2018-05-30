<template>
  <div class="container-fluid login_bg">
    <div class="row">
      <div class="col-xl-4 offset-xl-4 col-lg-5 offset-lg-4 col-md-6 offset-md-3 col-sm-8 offset-sm-4 col-10 offset-1 p-0 login-content">
        <div class="login-top-part">
          <div class="row">
            <div class="col-sm-12 mt-3">
              <h2 class="text-center">
                <img src="~img/home_logo.png" alt="The Beta Plan" class="img-fluid login-logo"/>
              </h2>
            </div>
          </div>
        </div>
        <vue-form :state="formstate" @submit.prevent="onSubmit">
          <div class="col-md-12">
            <div style="color: red" v-if="errors">
              {{ errors }}
            </div>
            <p class="user-message"> Please enter new password.</p>
            <div class="form-group custom-form-group">
              <validate tag="div">
                <input v-model="model.password" name="password" type="password" required placeholder="New Password"
                       class="form-control custom-form-control" minlength="4"
                       maxlength="10"/>
                <field-messages name="password" show="$invalid && $submitted" class="text-danger">
                  <div slot="required">Password is required</div>
                  <div slot="minlength">Password should be atleast 4 characters long</div>
                  <div slot="maxlength">Password should be atmost 10 characters long</div>
                </field-messages>
                <div class="input-group-text">
                  <img src="~img/lock-icon.png" class="img-fluid"/>
                </div>
              </validate>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group custom-form-group">
              <validate tag="div">
                <input v-model="model.repeatPassword" name="repeatpassword" type="password" required
                       placeholder="Confirm Password" class="form-control custom-form-control"
                       :sameas="model.password">
                <field-messages name="repeatpassword" show="$invalid && $submitted" class="text-danger">
                  <div slot="required">Password confirmatoin is required</div>
                  <div slot="sameas">Password and Confirm password should match</div>
                </field-messages>
                <div class="input-group-text">
                  <img src="~img/lock-icon.png" class="img-fluid"/>
                </div>
              </validate>
            </div>
          </div>
          <div class="col-12 mt-4">
            <div class="form-group">
              <input type="submit" value="submit" class="btn green-btn text-uppercase"/>
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
    name: "resetpassword",
    data() {
      return {
        formstate: {},
        model: {
          password: "",
          repeatPassword: "",
          token: "",
          email: ""
        },
        errors: null
      }
    },
    methods: {
      onSubmit: function () {
        if (this.formstate.$invalid) {
          return;
        } else {
          this.model.token = localStorage.getItem('token');
          this.model.email = localStorage.getItem('email');
          axios.post(`/password/reset`, {
            email: this.model.email,
            token: this.model.token,
            password: this.model.password,
            password_confirmation: this.model.repeatPassword,
          })
            .then(response => {
              this.$router.push("login");
            })
            .catch(
              error => (this.errors = error.response.data.message)
            );

        }
      }
    },
    mounted: function () {
      axios.post(`/`)
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
        margin-bottom: 10px;
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
      font-size: 16px;
      color: #777;
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
      font-size: 17px;
      font-family: $font-family-brandon-medium;
      letter-spacing: 0px;
      color: #fff;
      border-radius: 20px;
      display: block;
      text-align: center;
      margin: 20px auto;
      max-width: 150px;
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
      .green-btn {
        margin: 5px auto 10px;
        max-width: 110px;
        padding: 5px 10px;
        font-size: 14px;
      }
    }
  }
</style>
