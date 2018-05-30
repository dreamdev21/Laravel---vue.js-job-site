<template>
  <div id="scroll-top" class="add-tester-page">
    <div class="container custom-container">
      <div class="row">
        <div class="col-12">
          <h1 class="step-page-title">
            <span class="">Add</span>
             Member
          </h1>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <vue-form class="form-horizontal form-validation" :state="formstate" >
          <div class="white-box">
            <h4 class="block-title">
              Member Details
            </h4>
            <div class="row">
              <div class="col-md-6 border-right">
                <div class="row pb-3">
                    <div class="col-md-4 pr-md-0 mb-2 mb-sm-1"><span class="text-medium">First Name <span class="input-required">*</span> : </span></div>
                    <div class="col-md-8">
                      <input name="first_name" type="text" placeholder="First name" class="form-control" />
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-4 pr-md-0 mb-2 mb-sm-1"><span class="text-medium">Last name <span class="input-required">*</span> : </span></div>
                    <div class="col-md-8">
                      <input name="last_name" type="text" placeholder="Last name" class="form-control" />
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-4 pr-md-0 mb-2 mb-sm-1"><span class="text-medium">E-mail <span class="input-required">*</span> : </span></div>
                    <div class="col-md-8">
                      <input name="email" type="email" placeholder="E-mail" class="form-control" />
                    </div>
                </div>
                <div class="row pb-3">
                  <div class="col-md-4 pr-md-0 mb-2 mb-sm-1"><span class="text-medium">Phone number : </span></div>
                  <div class="col-md-8">
                    <input name="mobile" type="mobile" placeholder="Phone number" class="form-control" pattern="[0-9]{10}" />
                  </div>
                </div>
                
              </div>
              <div class="col-md-6">
                <div class="row pb-3">
                    <div class="col-md-4 pr-md-0 mb-2 mb-sm-1"><span class="text-medium">Password <span class="input-required">*</span> : </span></div>
                    <div class="col-md-8">
                      <input name="password" type="password" placeholder="Password" class="form-control" />
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-4 pr-md-0 mb-2 mb-sm-1"><span class="text-medium">Confirm password <span class="input-required">*</span> : </span></div>
                    <div class="col-md-8">
                      <input autocomplete="off" name="confirm_password"  type="password" placeholder="Confirm password" class="form-control" />
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-4 pr-md-0 mb-2 mb-sm-1"><span class="text-medium">Roles <span class="input-required">*</span> : </span></div>
                    <div class="col-md-8">
                        <select id="country_id" name="country_id" required size="1" class="form-control">
                          <option value="0" selected disabled>
                              Please select
                          </option>
                          <option>Manager</option>
                          <option>Accountant</option>
                        </select>
                    </div>
                </div>
                <div class="row pb-3" >
                  <div class="col-md-4 pr-md-0 mb-2 mb-sm-1"><span class="text-medium">Status : </span></div>
                  <div class="col-md-8">
                      <div class="radio form-check-inline mr-5">
                          <label>
                            <input type="radio" name="is_active" value="Active" checked>
                            <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                            Active
                          </label>
                      </div>
                      <div class="radio form-check-inline">
                        <label>
                          <input type="radio" name="is_active" value="Deactive">
                          <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                          Deactive
                        </label>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-4 roles-note">
            <h4 class="text-bold">
              *Roles
            </h4>
            <ul class="pl-4">
              <li class="mb-2">
                <span class="text-medium">Manager : </span>
                <span class=""> Create /edit project, Review tester's filled the project, check various stages of projects, mark as completed, give rating to testers </span>
              </li>
              <li class="">
                <span class="text-medium">Accountant : </span>
                <span> Payment to admin, download invoices and reports </span>
              </li>
            </ul>
          </div>
          <div class="row">
            <div class="col-12 text-center">
              <router-link :to="{ name: 'publisher.members' }" class="grey-btn">Back to members</router-link>
              <!-- <button type="reset" class="btn btn-effect-ripple btn-secondary reset_btn1" @click="form_reset">
                  Reset
              </button> -->
              <a href="#" class="blue-btn mr-0">Submit</a>
            </div>
          </div>
          </vue-form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import Vue from "vue";
  import VueForm from "vue-form";
 
  const cleanData = {
    username: "",
    email: "",
    mobile_no: "",
    password: "",
    confirm_password: "",
    country_id: "",
    is_active: 'Active',
  };
  export default {
    name: "add-member",
    components: {
    },
    data() {
      return {
        formstate: {},
        header: this.$route.params.id ? "Edit Publisher" : "Add Publisher",
        model: { ...cleanData },
        errors: null,
        old_file: "",
        originalUser: {},
        aCountries: {}
      };
    },
    methods: {
      onSubmit: function() {
        if (this.formstate.$invalid) {
          VueScrollTo.scrollTo('#scroll-top');
          return;
        } else {
        }
      }
    }
  };
</script>
<style scoped>
    .dropzone_wrapper {
        width: 100%;
        height: 300px;
    }
    .red-asterisk {
        color: red;
    }
</style>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";
.checkbox label:after,
.radio label:after {
  content: "";
  display: table;
  clear: both;
}

.checkbox .cr,
.radio .cr {
  position: relative;
  display: inline-block;
  border: 1px solid #0082cc;
  border-radius: 0.25em;
  width: 1.3em;
  height: 1.3em;
  float: left;
  margin-right: 0.5em;
  color: #0082cc;
}

.radio .cr {
  border-radius: 50%;
}

.checkbox .cr .cr-icon,
.radio .cr .cr-icon {
  position: absolute;
  font-size: 0.8em;
  line-height: 0;
  top: 50%;
  left: 20%;
}

.radio .cr .cr-icon {
  margin-left: 0.04em;
}

.checkbox label input[type="checkbox"],
.radio label input[type="radio"] {
  display: none;
}

.checkbox label input[type="checkbox"] + .cr > .cr-icon,
.radio label input[type="radio"] + .cr > .cr-icon {
  transform: scale(3) rotateZ(-20deg);
  opacity: 0;
  transition: all 0.3s ease-in;
}

.checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
.radio label input[type="radio"]:checked + .cr > .cr-icon {
  transform: scale(1) rotateZ(0deg);
  opacity: 1;
}

.checkbox label input[type="checkbox"]:disabled + .cr,
.radio label input[type="radio"]:disabled + .cr {
  opacity: 0.5;
}
  .custom-container{
    max-width: 100%;
    padding: 0;
  }
  .border-right{
    border-right: 1px solid #dadada;
  }
  .step-page-title{
    font-family: $font-family-UniNeue-bold;
    font-size : 30px;
    width: 100%;
    text-align: center;
    color: #363e48;
    margin: 5px 0 25px;
  }
  .add-tester-page{
    width: 100%;
    .white-box{
      .block-title{
        font-size: 20px;
        font-family: $font-family-UniNeue-bold;
        border-bottom: 1px solid #dadada;
        color: #0082cc;
        padding-bottom: 10px;
        margin-bottom: 10px;
        width: auto;
        min-height:35px;
      }
      .custom-form-control{
        font-size: 14px;
        border-radius: 4px;
        padding: 2px 8px;
        min-height: 32px;
        max-height: 32px;
        &:hover{
          outline: none !important;
        }
        &:focus{
          outline: none !important;
        }
      }
    }
    .blue-btn,.grey-btn{
      cursor: pointer;
      width: auto;
      border-radius: 20px !important;
      padding: 8px 8px;
      min-width: 150px;
      max-height: 36px;
      display: inline-block;
      margin-right: 10px;
    }
    .roles-note{
      h4{
        font-size: 15px;
      }
      font-size: 14px;
    }
  }

@media screen and(max-width:1281px) {
    .add-tester-page{
      .white-box{
      }
      .blue-btn,.grey-btn{
        padding: 6px;
      }
    }
}
@media screen and(max-width:1200px) {
    .page-title{
      font-size: 28px;
      margin: 0 0 20px;
    }
    .add-tester-page{
      .white-box{
        .block-title{
          font-size: 18px;
        }
      }
    }
  }
@media screen and(max-width:991px) {
    .custom-container{
    max-width: 100%;
  }
}
@media screen and(max-width:767px) {
  .border-right{
    border: none;
  }
}
@media screen and(max-width:575px) {
  .custom-container{
    padding: 0;
    .step-page-title{
      font-size: 26px;
      margin: 0 0 20px;
    }
  }
    .add-tester-page{
      .grey-btn{
        font-size: 14px;
      }
      .blue-btn,.grey-btn{
        margin-top: 10px;
        font-size: 14px;
        padding: 4px 6px;
        min-width: 130px;
      }
      .white-box{
        line-height: 18px;
      }
    }
  }

</style>

