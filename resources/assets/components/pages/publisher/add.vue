<template>
  <div id="scroll-top" class="add-tester-page">
    <div class="container custom-container">
      <div class="row">
        <div class="col-12">
          <h1 class="step-page-title" :header="header">
            <span class="" v-if="$route.params.id">Edit</span>
            <span class="" v-else>Add</span>
             Publisher
          </h1>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
          <div class="white-box">
            <h4 class="block-title">
              Publisher Details
            </h4>
            <div class="row">
              <div class="col-12">
                <!-- <div style="color: red" v-if="errors" v-text="errors"></div> -->
                <div style="color: red" v-if="errors" >
                  <ul id="example-1" v-for="error in errors">
                    <li>
                        {{ error }}
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 border-right">
                <div class="row pb-3">
                    <div class="col-md-4 pr-md-0 mb-2 mb-sm-1"><span class="text-medium">First Name <span class="input-required">*</span> : </span></div>
                    <div class="col-md-8">
                     <validate tag="div">
                        <input v-model="model.first_name" name="first_name" type="text" required autofocus placeholder="First name" class="form-control" />
                        <field-messages name="first_name" show="$invalid && $submitted" class="text-danger">
                            <div slot="required">First name is a required field</div>
                        </field-messages>
                      </validate>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-4 pr-md-0 mb-2 mb-sm-1"><span class="text-medium">Last name <span class="input-required">*</span> : </span></div>
                    <div class="col-md-8">
                     <validate tag="div">
                        <input v-model="model.last_name" name="last_name" type="text" required autofocus placeholder="Last name" class="form-control" />
                        <field-messages name="last_name" show="$invalid && $submitted" class="text-danger">
                            <div slot="required">Last name is a required field</div>
                        </field-messages>
                      </validate>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-4 pr-md-0 mb-2 mb-sm-1"><span class="text-medium">E-mail <span class="input-required">*</span> : </span></div>
                    <div class="col-md-8">
                     <validate tag="div">
                        <input v-model="model.email" name="email" type="email" autocomplete="off" required placeholder="E-mail" class="form-control" />
                        <field-messages name="email" show="$invalid && $submitted" class="text-danger">
                            <div slot="required">Email is a required field</div>
                            <div slot="email">Email is not valid</div>
                        </field-messages>
                      </validate>
                    </div>
                </div>
                <div class="row pb-3">
                  <div class="col-md-4 pr-md-0 mb-2 mb-sm-1"><span class="text-medium">Phone number : </span></div>
                  <div class="col-md-8">
                    <validate tag="div">
                       <input v-model="model.mobile_no" name="mobile" type="mobile" placeholder="Phone number" class="form-control" pattern="[0-9]{10}" />
                        <field-messages name="mobile" show="$invalid && $submitted" class="text-danger">
                            <div slot="pattern">Please enter 10 digits phone number</div>
                        </field-messages>
                    </validate>
                  </div>
                </div>

              </div>
              <div class="col-md-6">
                <div class="row pb-3">
                    <div class="col-md-4 pr-md-0 mb-2 mb-sm-1"><span class="text-medium">Password <span class="input-required">*</span> : </span></div>
                    <div class="col-md-8">
                     <validate tag="div">
                       <input v-model="model.password" name="password" autocomplete="off" type="password" :required="!model.id" placeholder="Password" class="form-control" />
                        <field-messages name="password" show="$invalid && $submitted" class="text-danger">
                            <div slot="required">Password is a required field</div>
                            <div slot="password">Password is not valid</div>
                        </field-messages>
                      </validate>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-4 pr-md-0 mb-2 mb-sm-1"><span class="text-medium">Confirm password <span class="input-required">*</span> : </span></div>
                    <div class="col-md-8">
                     <validate tag="div">
                        <input v-model="model.confirm_password" autocomplete="off" name="confirm_password"  type="password" :required="!model.id" placeholder="Confirm password" class="form-control" :sameas="model.password" />
                        <field-messages name="confirm_password" show="$invalid && $submitted" class="text-danger">
                            <div slot="required">Confirm Password is a required field</div>
                            <div slot="sameas">Password and Confrim Password must match</div>
                        </field-messages>
                      </validate>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-4 pr-md-0 mb-2 mb-sm-1"><span class="text-medium">Country <span class="input-required">*</span> : </span></div>
                    <div class="col-md-8">
                     <validate tag="div">
                        <select id="country_id" name="country_id" required size="1" class="form-control" v-model="model.country_id" :required="!model.id">
                          <option value="0" selected disabled>
                              Please select
                          </option>
                          <option v-for="country in aCountries " :value="country.id"> {{ country.name }} </option>
                        </select>
                        <field-messages name="country_id" show="$invalid && $submitted" class="text-danger">
                            <div slot="required">Country is required</div>
                        </field-messages>
                      </validate>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-4 pr-md-0 mb-2 mb-sm-1">
                      <span class="text-medium">Packages <span class="input-required">*</span> : </span>
                    </div>
                    <div class="col-md-8">
                      <validate tag="div">
                        <select v-if="$route.params.id" id="package_id" name="package_id" required size="1" class="form-control" v-model="model.package_id" :required="!model.id">
                          <option v-for="p in aPackages" :value="p.id"> {{ p.name }} </option>
                        </select>
                        <select v-else id="package_id" name="package_id" required size="1" class="form-control" :required="!model.id">
                          <option v-for="p in aPackages" :selected="p.is_default == 1" :value="p.id"> {{ p.name }} </option>
                        </select>

                        <field-messages name="package_id" show="$invalid && $submitted" class="text-danger">
                            <div slot="required">Package is required</div>
                        </field-messages>
                      </validate>
                    </div>
                </div>
                <div class="row pb-3" v-if="$route.params.id">
                  <div class="col-md-4 pr-md-0 mb-2 mb-sm-1"><span class="text-medium">Status : </span></div>
                  <div class="col-md-8">
                    <validate tag="div">
                      <div class="radio form-check-inline mr-5">
                          <label>
                            <input type="radio" name="is_active"  v-model="model.is_active" value="Active" checked>
                            <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                            Active
                          </label>
                      </div>
                      <div class="radio form-check-inline">
                        <label>
                          <input type="radio" name="is_active" v-model="model.is_active" value="Deactive">
                          <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                          Deactive
                        </label>
                      </div>
                    </validate>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 text-center">
              <!-- <button type="reset" class="btn btn-effect-ripple btn-secondary reset_btn1" @click="form_reset">
                  Reset
              </button> -->
              <router-link :to="{ name: 'admin.publisher' }" class="grey-btn">Back to publishers</router-link>
              <button type="submit" class="purple-btn mr-0">
                <span class="" v-if="$route.params.id">Save Publisher</span>
                <span class="" v-else>Submit</span>
              </button>
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
import Datepicker from "vuejs-datepicker";
import options from "src/validations/validations.js";
Vue.use(VueForm, options);
var VueScrollTo = require("vue-scrollto");
Vue.use(VueScrollTo, {
  container: "body",
  duration: 500,
  easing: "ease",
  offset: -100,
  cancelable: true,
  onDone: false,
  onCancel: false,
  x: false,
  y: true
});
const cleanData = {
  username: "",
  email: "",
  mobile_no: "",
  password: "",
  confirm_password: "",
  country_id: "",
  is_active: "Active"
};
export default {
  name: "add_user",
  components: {
    Datepicker
  },
  data() {
    return {
      formstate: {},
      header: this.$route.params.id ? "Edit Publisher" : "Add Publisher",
      model: { ...cleanData },
      errors: null,
      old_file: "",
      originalUser: {},
      aCountries: {},
      aPackages: {}
    };
  },
  methods: {
    onSubmit: function() {
      if (this.formstate.$invalid) {
        VueScrollTo.scrollTo("#scroll-top");
        return;
      } else {
        let p;
        const requestData = { ...this.model };
        // requestData.date_of_birth = requestData.date_of_birth.toMysql();
        requestData.status = requestData.is_active;
        if (this.model.id) {
          p = axios.put(`/api/publisher/${this.model.id}`, requestData);
        } else {
          p = axios.post("/api/publisher", requestData);
        }
        p
          .then(response => this.$router.push({ name: "admin.publisher" }))
          .catch(error => (this.errors = error.response.data.message));
      }
    },
    clearqueue(file) {
      if (this.$refs.user_image.dropzone.files.length > 1) {
        this.$refs.user_image.dropzone.removeFile(this.old_file);
      }
      this.old_file = file;
    },
    form_reset() {
      if (this.model.id) {
        return (this.model = this.originalUser);
      } else {
        this.model = { ...cleanData };
        this.$refs.user_image.removeAllFiles();
      }
    }
  },
  created: function() {
    if (this.model.country_id == null) {
      this.model.country_id = 231; // 'United states' will be selected as default
    }
  },
  mounted: function() {
    if (this.$route.params.id) {
      axios
        .get(`/api/publisher/${this.$route.params.id}`)
        .then(({ data: { data } }) => {
          this.model = data;
          this.model.is_active = this.model.is_active ? "Active" : undefined;
          if (this.model.status.name == "Deactive") {
            this.model.is_active = "Deactive";
          }
          this.originalUser = data;
        })
        .catch(() => this.$router.push({ name: "admin.publisher" }));
    }
    axios
      .get("/api/getCountries")
      .then(response => {
        this.aCountries = response.data;
      })
      .catch(function(error) {});
    axios
      .get("/api/getPackages")
      .then(response => {
        console.log(response.data);
        this.aPackages = response.data;
      })
      .catch(function(error) {});
  },
  destroyed: function() {}
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
  border: 1px solid #3e3a94;
  border-radius: 0.25em;
  width: 1.3em;
  height: 1.3em;
  float: left;
  margin-right: 0.5em;
  color: #3e3a94;
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
.custom-container {
  max-width: 100%;
  padding: 0;
}
.border-right {
  border-right: 1px solid #dadada;
}
.step-page-title {
  font-family: $font-family-UniNeue-bold;
  font-size: 30px;
  width: 100%;
  text-align: center;
  color: #363e48;
  margin: 5px 0 25px;
}
.add-tester-page {
  width: 100%;
  .white-box {
    .block-title {
      font-size: 20px;
      font-family: $font-family-UniNeue-bold;
      border-bottom: 1px solid #dadada;
      color: #3e3a94;
      padding-bottom: 10px;
      margin-bottom: 10px;
      width: auto;
      min-height: 35px;
    }
    .custom-form-control {
      font-size: 14px;
      border-radius: 4px;
      padding: 2px 8px;
      min-height: 32px;
      max-height: 32px;
      &:hover {
        outline: none !important;
      }
      &:focus {
        outline: none !important;
      }
    }
  }
  .purple-btn,
  .grey-btn {
    cursor: pointer;
    width: auto;
    border-radius: 20px !important;
    padding: 8px 8px;
    min-width: 150px;
    max-height: 36px;
    display: inline-block;
    margin-right: 10px;
  }
}

@media screen and(max-width:1281px) {
  .add-tester-page {
    .white-box {
    }
    .purple-btn,
    .grey-btn {
      padding: 6px;
    }
  }
}
@media screen and(max-width:1200px) {
  .page-title {
    font-size: 28px;
    margin: 0 0 20px;
  }
  .add-tester-page {
    .white-box {
      .block-title {
        font-size: 18px;
      }
    }
  }
}
@media screen and(max-width:991px) {
  .custom-container {
    max-width: 100%;
  }
}
@media screen and(max-width:767px) {
  .border-right {
    border: none;
  }
}
@media screen and(max-width:575px) {
  .custom-container {
    padding: 0;
    .step-page-title {
      font-size: 26px;
      margin: 0 0 20px;
    }
  }
  .add-tester-page {
    .grey-btn {
      font-size: 14px;
    }
    .purple-btn,
    .grey-btn {
      margin-top: 10px;
      font-size: 14px;
      padding: 4px 6px;
      min-width: 130px;
    }
    .white-box {
      line-height: 18px;
    }
  }
}
</style>

