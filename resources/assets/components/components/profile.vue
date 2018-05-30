<template>
    <div>
      <policy v-if="showNda" @done="hideNDA"></policy>
        <div class="bg-color" v-else>
            <div class="container custom-container">
                <div class="row">
                    <h1 class="step-page-title">
                        Profile
                    </h1>
                    <div class="tester-profile-page">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-xl-5 col-12">
                                    <div class="img-wrap d-block d-sm-inline-block">
                                        <profile-picture @change="onFileChange" :disabled="!(portal == 'publisher' || portal == 'tester')" :image="model.profile" />
                                    </div>
                                    <div class="content-wrap d-block d-sm-inline-block">
                                        <h4 class="username">{{model.first_name }} {{ model.last_name }}</h4>
                                        <p class="usermail">{{ model.email }}</p>
                                    </div>
                                </div>
                                <div class="col-xl-7 col-12">
                                    <div class="user-profile-form">
                                        <div class="form-group d-inline-block custom-county-block">
                                            <label>Country</label>
                                            <span class="d-block text-bold">
                                                {{ model.country ? model.country.name : '' }}
                                            </span>
                                        </div>
                                        <div class="form-group d-inline-block" v-if="this.portal == 'tester'">
                                            <label>Gender</label>
                                            <span class="d-block text-bold">
                                              {{ model.gender }}
                                            </span>
                                        </div>
                                        <div class="form-group d-inline-block" v-if="this.portal == 'tester'">
                                            <label>Birthdate</label>
                                            <span class="d-block text-bold">
                                                {{ model.date_of_birth | date }}
                                            </span>
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
                                    <div class="col-12">
                                        <span class="d-inline-block ">
                                          Cell Number :
                                        </span>
                                        <span class="text-bold d-inline-block" v-if="model.mobile_no">
                                            {{ '1' + model.mobile_no | phone }}<br/>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="white-box pb-3" v-if="this.portal == 'tester'">
                            <h4 class="block-title">
                                Devices you have to test on
                            </h4>
                            <div class="row">
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-2" v-for="(device, index) in aDevices"  >
                                    <span class="device-name" color="#2cac3d" >
                                      {{ index + 1 }}. {{ device.name }}
                                    </span>
                                    <img src="~img/check-mark-3-16.png" v-show="device_map[index+1]">
                                    <!--<span class="text-bold selected-txt"> {{ device_map[index+1] ? 'yes' : 'no'  }} </span>-->
                                </div>
                            </div>
                        </div>
                        <div class="white-box">
                            <h4 class="block-title">
                                About Me
                            </h4>
                            <div class="mb-0 w-100">
                              <div class="row">
                                <div class="col-12">
                                  {{ model.additional_information }}
                                </div>
                              </div>
                            </div>
                        </div>
                         <div class="white-box">
                            <h4 class="block-title">
                                Systems
                            </h4>
                            <div class="mb-2" v-for="(systemInfo,index) in aSystems">
                                <div class="row">
                                    <div class="col-md-12">
                                        {{ systemInfo.os }} - {{ systemInfo.processor }} - {{ systemInfo.ram }} - {{ systemInfo.gpu_memory }} - {{ systemInfo.gpu_model }}
                                    </div>
                                </div>
                            </div>
                            <div v-if="aSystems.length == 0">
                                You have not added system yet.
                            </div>
                        </div>
                        <!-- <div class="white-box pb-2" v-if="this.portal == 'tester' && !this.$route.params.id">
                          <h4 class="block-title">
                            Our NDA Policy
                          </h4>
                          <p class="policy-text">Read and agree to our NDA policy.
                            <a href="javascript:;" @click="showNDA">View Policy</a>
                          </p>
                          <p class="agreed-txt text-green">
                            You have agreed our Policy
                          </p>
                        </div> -->
                        <router-link tag="a" :to="{name: 'tester.edit-profile'}" v-if="this.portal == 'tester' && !this.$route.params.id" class="btn text-uppercase text-center green-step-btn">edit</router-link >
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-if="this.$route.params.id">
            <div class="col-lg-12">
                <div class="col-md-offset-4 col-md-8 m-t-25">
                    <router-link :to="{ name: 'admin.' + this.portal }" class="btn btn-primary">Back</router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Vue from "vue";
import VueForm from "vue-form";
import Croppa from "vue-croppa";
import options from "src/validations/validations.js";
import { hasClearedStep1 } from "src/services/tester";
import ToggleButton from "vue-js-toggle-button";
import Policy from "pages/tester/nda-policy";
import TesterProfile from "../pages/tester/edit-profile";
import { PhoneFilter } from "src/services/filter";
import ProfilePicture from "./profile-picture";
Vue.use(VueForm, options);
Vue.use(Croppa);
Vue.filter("phone", PhoneFilter);
export default {
  name: "ProfileComponent",
  props: ["skin", "portal"],
  components: {
    "tags-input": require("vue-tagsinput/src/input.vue"),
    Policy,
    ProfilePicture
  },
  computed: {
    style() {
      return "@import '../layouts/css/skins/" + this.skin + "'";
    }
  },
  data() {
    return {
      header: "Profile",
      user: {},
      showNda: false,
      formstate: {},
      model: {},
      aDevices: {},
      aCountries: {},
      aSystems: {},
      additional_devices: [],
      device_map: {},
      policy_agree: false,
      userdevice_flag: false,
      previewUrl: "/images/device_no_icon.png"
    };
  },
  mounted() {
    if (this.$route.params.id) {
      axios
        .get(`/api/tester/${this.$route.params.id}`)
        .then(({ data: { data } }) => {
          this.model = data;
          this.header = `${this.model.first_name}'s Profile`;
        })
        .catch(() => this.$router.push({ name: `admin.${this.portal}` }));
      axios
        .get("/api/devices")
        .then(response => {
          this.aDevices = response.data;
          this.aDevices.forEach(d => (this.device_map[d.id] = false));
          this.model.devices.forEach(f => (this.device_map[f.id] = true));
        })
        .then(({ data: { data } }) => this.assignData(data))
        .catch(function(error) {});
    } else {
      axios
        .get("/api/devices")
        .then(response => {
          this.aDevices = response.data;
          this.aDevices.forEach(d => (this.device_map[d.id] = false));
          return axios.get(`/api/tester/${this.$store.state.user.id}`);
        })
        .then(({ data: { data } }) => this.assignData(data))
        .catch(function(error) {});
    }
    axios
        .get("/api/get-systems")
        .then(response => {
            this.aSystems = response.data;
        })
        .then(({ data: { data } }) => this.assignData(data))
        .catch(function(error) {});
  },
  methods: {
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
      if (this.formstate.$invalid) {
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
    }
  }
};
</script>
<style lang="scss" scoped>
@import "../layouts/css/customvariables";
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
  width: 25%;
}
.text-bold {
  font-family: $font-family-brandon-bold;
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
    .load-proj-wrap {
      background-color: #2cac3d;
      color: #fff;
      font-family: $font-family-brandon-bold;
      border-radius: 4px;
      width: 100%;
      text-align: center;
      padding: 4px 8px;
      margin-bottom: 20px;
      font-size: 16px;
      border: 2px solid #118921;
    }
    .white-box {
      background-color: #fff;
      box-shadow: 0px 0px 3px 2px rgba(3, 3, 3, 0.05);
      border-radius: 4px;
      padding: 20px;
      margin-bottom: 20px;
      font-size: 17px;
      color: #606368;
      letter-spacing: 0;
      textarea {
        font-size: 15px;
        resize: none;
      }
      .block-title {
        font-size: 20px;
        font-family: $font-family-UniNeue-bold;
        border-bottom: 1px solid #dadada;
        color: #123e59;
        padding-bottom: 10px;
        margin-bottom: 10px;
      }
      .img-wrap {
        // padding: 18px 25px;
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
        padding-top: 35px;
        float: right;
        width: 100%;
        text-align: right;
        .form-group {
          min-width: 80px;
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
          margin-right: 15px;
        }
        .form-control {
          width: calc(100% - 90px);
          float: right;
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
        min-width: 75%;
      }
      .selected-txt {
        display: inline-block;
        vertical-align: middle;
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
          font-size: 15px;
          text-decoration: underline !important;
        }
      }
      .agreed-txt {
        font-size: 15px;
        color: #2cac3d;
      }
    }
    .green-step-btn {
      width: 100%;
      max-width: 130px;
      padding: 5px;
      border: 2px solid #118921;
      background-color: #2cac3d;
      font-size: 14px;
      font-family: $font-family-brandon-medium;
      letter-spacing: 0.05rem;
      color: #fff;
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
        font-size: 16px;
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
        font-size: 15px;
        .block-title {
          font-size: 18px;
        }
        .user-profile-form {
          padding-top: 10px;
          float: left;
          text-align: left;
          .form-group {
            margin-bottom: 0;
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
        }
        .device-name {
          min-width: 90%;
          // display: block;
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
        padding: 15px;
        .detail-form {
          .form-control {
            max-width: 120px;
            float: none;
            margin-bottom: 15px;
            margin-left: 15px;
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
}
@media screen and(max-width:575px) {
  .custom-container {
    .step-page-title {
      font-size: 26px;
    }
    .tester-profile-page {
      .white-box {
        font-size: 14px;
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
          float: left;
          text-align: left;
          padding-top: 10px;
          .form-group {
            min-width: 100%;
            margin-right: 0;
            margin-bottom: 0;
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
