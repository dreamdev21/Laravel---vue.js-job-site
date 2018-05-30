<template>
  <div>
  <policy v-if="showNda" @done="hideNDA"></policy>
  <div class="bg-color" v-else>
    <div class="container custom-container">
      <div class="row">
        <h1 class="step-page-title">
          Step 1 - Profile
        </h1>
        <vue-form :state="formstate" @submit.prevent="onSubmit" enctype="multipart/form-data">
          <div class="tester-profile-page">
              <div class="white-box">
                <div class="row">
                  <div class="col-xl-5 col-12">
                    <div class="img-wrap d-block d-sm-inline-block">
                      <profile-picture @change="onFileChange" :image="model.profile" />
                    </div>
                    <div class="content-wrap d-block d-sm-inline-block">
                      <h4 class="username">{{ model.first_name }} {{ model.last_name }}</h4>
                      <p class="usermail">{{ model.email }}</p>
                    </div>
                  </div>
                  <div class="col-xl-7 col-12">
                    <div class="user-profile-form">
                        <div class="form-group d-inline-block custom-county-block">
                          <label>Country</label>
                          <select v-model="model.country_id" class="form-control">
                            <option v-for="country in aCountries" :value="country.id">{{ country.name }} </option>
                          </select>
                        </div>
                        <div class="form-group d-inline-block">
                          <label>Gender</label>
                          <div class="radio form-check-inline mr-3">
                              <label>
                                <input class="form-check-input" type="radio" v-model="model.gender" name="exampleRadios" id="male" value="Male" :checked="model.gender == 'Male'">
                                <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                Male
                              </label>
                          </div>
                          <div class="radio form-check-inline mr-3">
                              <label>
                                <input class="form-check-input" type="radio" v-model="model.gender" name="exampleRadios" id="female" value="Female" :checked="model.gender == 'Female'" >
                                <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                Female
                              </label>
                          </div>
                        </div>
                        <div class="form-group d-inline-block">
                          <label>Birthdate</label>
                          <datepicker initial-view="year" input-class="form-control" :format="'dd MMM yyyy'" v-model="model.date_of_birth" name="dob" required></datepicker>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="white-box">
                <h4 class="block-title">
                  Basic Information
                </h4>
                  <div class="detail-form">
                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <span class="d-inline-block d-lg-block d-xl-inline-block">
                          Cell Number :
                        </span>
                        <input type="text" v-model="model.mobile_no" class="form-control d-inline-block d-lg-block d-xl-inline-block" placeholder="">
                      </div>
                      <!-- <div class="col-lg-5 col-sm-6 col-12">
                        <span class="d-block d-xl-inline-block"> Text me if projects matching my device open:
                        </span>
                        <div class="toggle-btn-group">
                          <a href="#" class="btn green-btn">Yes</a>
                          <a href="#" class="btn white-btn">No</a>
                        </div>
                      </div>
                      <div class="col-lg-4 col-sm-6 col-12">
                        <span class="d-block d-xl-inline-block"> Text me if projects matching my device open:</span>
                        <div class="toggle-btn-group">
                          <a href="#" class="btn green-btn">Yes</a>
                          <a href="#" class="btn white-btn">No</a>
                        </div>
                      </div> -->
                    </div>
                  </div>
              </div>
              <div class="white-box pb-3">
                <h4 class="block-title">
                  Devices you have to test on
                </h4>
                <div class="row">
                  <div class="col-sm-4 col-6" v-for="(device, index) in aDevices">
                    <span class="device-name" color="#2cac3d" >
                      {{ index + 1 }}. {{ device.name }}
                    </span>
                    <toggle-button color="#2cac3d" :sync="true" :name="device.id" v-model="device_map[device.id]" />
                  </div>

                  <div class="col-sm-4 col-6">
                    <span class="device-name">
                      Others
                    </span>
                    <div class="toggle-btn-group other-group">
                        <tags-input class="form-control" :tags="additional_devices" @tags-change="handleChange"></tags-input>
                    </div>
                  </div>
                </div>
              </div>
              <div class="white-box">
                <h4 class="block-title">
                  About Me
                </h4>
                
                <validate tag="div">
                  <textarea class="form-control" rows="3" placeholder="Any other background Information you would like to share?" v-model="model.additional_information" required autofocus name="additional_information"  v-on:keyup="keymonitor"></textarea>
                  <!-- <field-messages name="additional_information" show="$invalid && $submitted" class="text-danger">
                    <div slot="required">In between 300 to 1500 Characters required.</div>
                  </field-messages> -->
                    <div v-if="otherInfoLengthInvalid" class="text-danger">In between 300 to 1500 Characters required.</div>
                </validate>
              </div>
              <div class="white-box">
                  <h4 class="block-title btn-title-wrap">
                      Systems
                      <router-link tag="a" :to="{name: 'tester.add-system'}" class="btn green-btn">
                        Add System
                      </router-link>
                  </h4>
                  <div class="mb-sm-2 mb-3" v-for="(systemInfo,index) in aSystems">
                      <div class="row">
                          <div class="col-md-9 col-sm-6 col-12 mb-2 mb-sm-0">
                              {{ systemInfo.os }} - {{ systemInfo.processor }} - {{ systemInfo.ram }} - {{ systemInfo.gpu_memory }} - {{ systemInfo.gpu_model }}
                          </div>
                          <div class="col-md-3 col-sm-6 col-12 text-sm-right text-left text-green">
                              <router-link :to="{ name:'tester.system.edit',params:{id:systemInfo.id}}">
                                <a href="#" class="mr-3 link">Edit </a>
                              </router-link>
                              |
                              <a href="#" class="ml-3 link" @click.prevent="deleteSystem(systemInfo.id)"> Delete</a>
                          </div>
                      </div>
                  </div>
                  <div v-if="aSystems.length == 0">
                      You have not added system yet, click on Add System.
                  </div>
                  <div v-if="aSystems.length == 0 && !is_system_exist" class="text-danger">
                    Please add system
                  </div>
              </div>
              <div class="white-box pb-2">
                <validate tag="div">
                  <h4 class="block-title">
                    Our NDA Policy
                  </h4>
                  <p class="policy-text">Read and agree to our NDA policy.</p>
                  <a href="javascript:;" @click="showNDA">View Policy</a>
                  <input type="hidden" name="policy_agree" v-model="model.policy_agree" required />
                  <field-messages name="policy_agree" show="$invalid && $submitted" class="text-danger">
                    <div slot="required">You must read and agree to the NDA policy to continue</div>
                  </field-messages>
                </validate>
              </div>
              <button type="submit" class="btn text-uppercase text-center green-btn">submit and go to next step</button>
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
import options from "src/validations/validations.js";
import { hasClearedStep1 } from "src/services/tester";
import ToggleButton from "vue-js-toggle-button";
import Policy from "pages/tester/nda-policy";
import ProfilePicture from "components/components/profile-picture";
Vue.use(VueForm, options);
export default {
  name: "tester-profile",
  data() {
    return {
      showNda: false,
      formstate: {},
      model: {},
      aDevices: {},
      aSystems: {},
      aCountries: {},
      additional_devices: [],
      device_map: {},
      policy_agree: true,
      is_system_exist:true,
      previewUrl: "/images/device_no_icon.png",
      otherInfoLengthInvalid: false
    };
  },
  mounted: function() {
    this.loadSystemDetails();
    axios
      .get("/api/devices")
      .then(response => {
        this.aDevices = response.data;
        this.aDevices.forEach(d => (this.device_map[d.id] = false));
        return axios.get(`/api/tester/${this.$store.state.user.id}`);
      })
      .then(({ data: { data } }) => this.assignData(data))
      .catch(function(error) {});

    axios
      .get("/api/getCountries")
      .then(response => {
        this.aCountries = response.data;
      })
      .catch(function(error) {});
  },
  methods: {
    loadSystemDetails(){
      axios
          .get("/api/get-systems")
          .then(response => {
              this.aSystems = response.data;
          })
          .then(({ data: { data } }) => this.assignData(data))
          .catch(function(error) {});
    },
    showNDA() {
      this.showNda = true;
    },
    hideNDA() {
      if (localStorage.getItem("nda-agree")) {
        this.model.policy_agree =
          localStorage.getItem("nda-agree") == "1" ? true : false;
        localStorage.removeItem("nda-agree");
      }
      this.showNda = false;
    },
    assignData(data) {
      this.model = { ...this.model, ...data };
      // this.model.gender =  this.model.gender ? this.model.gender.toLowerCase() : '';
      this.previewUrl = data.profile;
      if (this.model.country_id == null) {
        this.model.country_id = 231; // 'United states' will be selected as default
      }
      data.devices.forEach(d => (this.device_map[d.id] = true));
      if (hasClearedStep1(data.status.name)) {
        this.model.policy_agree = true;
      }
    },
    /** Start - user image  */
    onFileChange(file) {
      const formData = new FormData();
      formData.append("profile", file, "profile.png");
      formData.append("_method", "PUT");
      formData.append("email", this.model.email);
      axios
        .post("/api/tester/" + this.model.id, formData)
        .then(({ data: { data } }) => {
          this.assignData(data);
          this.$store.commit("set_user", data);
        })
        .catch(error => (this.error = error));
    },
    onSubmit: function() {
      this.validateAboutMe();
      if (this.formstate.$invalid || this.otherInfoLengthInvalid) {
        return;
      } else {
        let p;
        this.errors = null;
        if (!this.model.policy_agree) {
          return this.$swal(
            "Error",
            "Please read and agree to the policy",
            "error"
          );
        }
        if (this.model.id) {
          this.model.additional_devices = this.additional_devices;
          const devices = [];
          Object.keys(this.device_map).forEach(id => {
            if (this.device_map[id]) {
              devices.push(parseInt(id));
            }
          });
          this.model.image = this.image;
          const requestData = { ...this.model, devices };
          if (
            requestData.date_of_birth &&
            typeof requestData.date_of_birth !== "string"
          ) {
            requestData.date_of_birth = requestData.date_of_birth.toMysql();
          }
          requestData.status = "Step_1";
          p = axios.put(`/api/tester/${this.model.id}`, requestData);
          p
            .then(response => {
              this.$store.commit("set_user", response.data.data);
              this.$router.push({ name: "tester.step2" });
            })
            .catch(error => (this.errors = error.response.data.message));
        }
      }
    },
    handleChange: function(index, text) {
      if (text) {
        this.additional_devices.splice(index, 0, text);
      } else {
        this.additional_devices.splice(index, 1);
      }
    },
    keymonitor: function(event) {
      this.validateAboutMe();
    },
    validateAboutMe: function(){
      let otherInfoLength = this.model.additional_information != null ? this.model.additional_information.length : 0;
      if(otherInfoLength == 0){
        this.otherInfoLengthInvalid = true;
      }
      else if(otherInfoLength < 300 || otherInfoLength > 1500 ){
        this.otherInfoLengthInvalid = true;
      }else{
        this.otherInfoLengthInvalid = false;
      }

      if( this.aSystems.length == 0 ){
        this.is_system_exist = false;
        return;
      }
    },
    deleteSystem(id){
      this.$swal({
          title: "Are you sure?",
          text: "You want to delete System?",
          icon: "warning",
          buttons: true,
          dangerMode: true
      }).then(willDelete => {
          if (willDelete) {
              return axios
                  .delete(`/api/systems/${id}`)
                  .then(response => this.loadSystemDetails() )
                  
          }
      });
    }
  },
  components: {
    "tags-input": require("vue-tagsinput/src/input.vue"),
    Policy,
    ProfilePicture
  }
};
</script>
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
  border: 1px solid #2cac3d;
  border-radius: 0.25em;
  width: 1.3em;
  height: 1.3em;
  float: left;
  margin-right: 0.5em;
  color: #2cac3d;
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

.vue-js-switch {
  float: right;
}
.user_image {
  font-size: 10px;
}
.input {
  width: 100% !important;
}
.custom-county-block {
  width: 30%;
}
.link {
  font-size: 17px;
  color: #606368;
  &:hover {
    text-decoration: underline !important;
  }
}
.custom-container {
  max-width: 100%;
  .step-page-title {
    font-family: $font-family-UniNeue-bold;
    font-size: 30px;
    width: 100%;
    text-align: center;
    color: #363e48;
    margin: 5px 0 25px;
  }
  .tester-profile-page {
    width: 100%;
    .other-input {
      min-width: 150px;
    }
    .toggle-btn-group {
      width: calc(100% - 115px);
    }
    .white-box {
      font-size: 17px;
      textarea {
        font-size: 15px;
        resize: none;
      }
      .block-title {
        font-size: 20px;
        font-family: $font-family-UniNeue-bold;
        border-bottom: 1px solid #dadada;
        color: #2cac3d;
        padding-bottom: 10px;
        margin-bottom: 10px;
      }
      .btn-title-wrap {
        padding-bottom: 15px;
        .green-btn {
          display: inline-block;
          padding: 3px;
          float: right;
          max-width: 120px;
          margin: 0;
          &:hover {
            color: #ffffff;
          }
          &:focus {
            color: #fff;
          }
        }
      }
      .img-wrap {
        vertical-align: middle;
      }
      .content-wrap {
        vertical-align: middle;
        .username {
          font-family: $font-family-UniNeue-regular;
          font-size: 25px;
          color: #363e48;
          margin-bottom: 0px;
        }
        .usermail {
          font-size: 15px;
          color: #73767b;
          font-family: $font-family-brandon-regular;
          margin-bottom: 0;
        }
      }
      .user-profile-form {
        padding-top: 25px;
        float: right;
        .form-group {
          min-width: 120px;
          margin-right: 20px;
          vertical-align: top;
          &:last-child {
            margin-right: 0;
          }
          .form-control {
            &:hover,
            &:focus {
              outline: none !important;
            }
          }
          label {
            display: block;
          }
          .form-check {
            display: inline-block;
            margin-right: 15px;
            .form-check-input {
              margin-left: 0;
            }
            .form-check-label {
              padding-left: 20px;
            }
          }
        }
      }
      .detail-form {
        width: 100%;
        span {
          max-width: 210px;
          vertical-align: middle;
          font-size: 16px;
          color: #606368;
          line-height: 20px;
          margin-right: 5px;
        }
        .form-control {
          width: 35%;
          margin-top: 5px;
          &:hover {
            outline: none !important;
          }
          &:focus {
            outline: none !important;
          }
        }
        .toggle-btn-group {
          display: inline-block;
          vertical-align: inherit;
          margin-top: 5px;
          margin-bottom: 0;
        }
      }
      .device-name {
        font-size: 17px;
        color: #606368;
        min-width: 110px;
        vertical-align: middle;
        display: inline-block;
      }
      .toggle-btn-group {
        display: inline-block;
        vertical-align: middle;
        margin-bottom: 10px;
        margin-top: 10px;
        .green-btn {
          background-color: #2cac3d;
          font-size: 17px;
          font-family: $font-family-brandon-medium;
          letter-spacing: 0.05rem;
          color: #fff;
          border-radius: 4px;
          padding: 0px 10px;
          &:hover {
            background-color: #158f25;
            outline: none !important;
          }
          &:focus {
            outline: none !important;
          }
        }
        .white-btn {
          background-color: #fff;
          border: 1px solid #e4e4e4;
          font-size: 17px;
          font-family: $font-family-brandon-regular;
          letter-spacing: 0.05rem;
          color: #606368;
          border-radius: 4px;
          padding: 0px 10px;
          margin-left: 5px;
          &:hover {
            background-color: #e4e4e4;
            outline: none !important;
          }
          &:focus {
            outline: none !important;
          }
        }
        .form-control {
          vertical-align: middle;
          &:hover,
          &:focus {
            outline: none !important;
          }
        }
      }
      .policy-text {
        margin-bottom: 5px;
        a {
          color: #2cac3d;
          font-family: $font-family-brandon-bold;
          font-size: 17px;
          text-decoration: underline !important;
        }
      }
      .agree-text {
        font-size: 15px;
        color: #ff0000;
      }
    }
    .green-btn {
      width: 100%;
      max-width: 260px;
      padding: 7px 10px;
      margin: 15px auto;
      border-radius: 20px;
      display: block;
      &:hover {
        background-color: #158f25;
      }
    }
  }
}
@media screen and(max-width:1281px) {
  .custom-container {
    .tester-profile-page {
      .white-box {
        textarea {
          font-size: 14px;
        }
        .img-wrap {
          height: 100px;
          width: 100px;
          padding: 15px 20px;
          margin-right: 10px;
        }
        .content-wrap {
          .username {
            font-size: 22px;
          }
        }
        .detail-form {
          span {
            max-width: 160px;
            font-size: 14px;
            line-height: 18px;
          }
        }
        .device-name {
          font-size: 16px;
        }
      }
    }
  }
}
@media screen and(max-width:1200px) {
  .custom-container {
    .step-page-title {
      font-size: 28px;
      margin: 0 0 20px;
    }
    .tester-profile-page {
      .white-box {
        .block-title {
          font-size: 18px;
        }
        .user-profile-form {
          padding-top: 20px;
          float: left;
          .form-group {
            .form-check {
              margin-right: 0;
            }
          }
        }
        .img-wrap {
          height: 80px;
          width: 80px;
          padding: 10px 15px;
        }
        .detail-form {
          .form-control {
            float: left;
          }
          span {
            min-height: 55px;
          }
        }
        .device-name {
          min-width: 85px;
          font-size: 15px;
        }
        .toggle-btn-group {
          display: block;
          .green-btn {
            font-size: 15px;
          }
          .white-btn {
            font-size: 15px;
          }
          .form-control {
            max-width: 100px;
          }
        }
        .policy-text {
          a {
            font-size: 16px;
          }
        }
      }
    }
  }
}

@media screen and(max-width:991px) {
  .custom-container {
    .tester-profile-page {
      .white-box {
        .detail-form {
          .form-control {
            float: none;
            width: 50%;
          }
          span {
            min-height: auto;
            max-width: 100%;
            br {
              display: none;
            }
          }
        }
      }
    }
  }
}
@media screen and(max-width:767px) {
  .custom-container {
    .tester-profile-page {
      .white-box {
        .user-profile-form {
          width: 100%;
          .form-group {
            min-width: 60px;
            width: 30%;
            margin-right: 15px;
          }
        }
      }
    }
  }
}
@media screen and(max-width:575px) {
  .custom-container {
    .step-page-title {
      font-size: 26px;
    }
    .tester-profile-page {
      .white-box {
        line-height: 18px;
        .btn-title-wrap {
          padding-bottom: 15px;
          .green-btn {
            font-size: 13px;
            max-width: 95px;
            &:hover {
              color: #ffffff;
            }
            &:focus {
              color: #fff;
            }
          }
        }
        .img-wrap {
          margin-bottom: 10px;
        }
        .detail-form {
          .toggle-btn-group {
            margin-bottom: 15px;
          }
        }
        .user-profile-form {
          width: 100%;
          .form-group {
            min-width: 100%;
            margin-right: 0;
          }
        }
        .policy-text {
          font-size: 14px;
        }
        .agree-text {
          font-size: 13px;
        }
      }
    }
  }
}
</style>