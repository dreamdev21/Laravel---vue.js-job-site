<template>
    <div>
        <div class="bg-color">
            <div class="container custom-container">
                <div class="row">
                    <h1 class="step-page-title">
                        Devices
                    </h1>
                    <div class="tester-profile-page">
                        <div class="white-box pb-3">
                            <h4 class="block-title">
                                Devices you have to test on
                            </h4>
                            <div class="row">
                                <div class="col-6" v-for="(device, index) in aDevices">
                                    <span class="device-name" color="#2cac3d" >
                                      {{ device.name }}
                                    </span>
                                    <toggle-button color="#2cac3d" :sync="true" :name="device.id" v-model="device_map[device.id]" @change="handleChange(device.id)"/>
                                </div>
                            </div>
                            <div v-if="!this.deviceEmpty" v-model="this.deviceEmpty" class="pl-3"><span class="text-danger">You must select at least one device.</span></div>
                        </div>
                        <div class="white-box" style="display: none">
                            <textarea class="form-control" rows="3" placeholder="Your Background Information" v-model="model.additional_information" name="additional_information" >{{ model.additional_information }}</textarea>
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
                                        <router-link :to="{ name: 'tester.system.edit', params: { id: systemInfo.id }}" class="mr-1">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import { hasClearedStep1 } from "src/services/tester";
  import ToggleButton from "vue-js-toggle-button";
  export default {
    name: "tester-profile",
    data() {
      return {
        model: {},
        aDevices: {},
        aSystems: {},
        device_map: {},
        deviceEmpty: true
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
      assignData(data) {
        this.model = { ...this.model, ...data };
        data.devices.forEach(d => (this.device_map[d.id] = true));
      },
      handleChange: function(id) {
        if(this.model.id){
          let devices = [];
          let p;
          let that = this;
          that.deviceEmpty=false;
            Object.keys(this.device_map).map(function (key) {
              var value = that.device_map[key];
              if (value){
                devices.push(key);
                that.deviceEmpty = true;
                return that.deviceEmpty;
              }
            });
          const requestData = { ...this.model, devices };
          p = axios.put(`/api/tester/${this.model.id}`, requestData);
          return that.deviceEmpty;
          requestData.status = false;
        }
      },
      deleteSystem(id) {
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
                    .then( response => this.loadSystemDetails() )
                    
            }
        });
      }
    }
  };
</script>
<style lang="scss" scoped>
    @import "../../layouts/css/_customvariables";
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
     .link{
        font-size: 17px;
        color: #606368;
        &:hover{
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
                .btn-title-wrap{
                    padding-bottom: 15px;
                    .green-btn{
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
                        font-size: 17px;
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
                    font-size: 16px;
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
                    font-size: 14px;
                    line-height: 18px;
                     .btn-title-wrap{
                        padding-bottom: 15px;
                        .green-btn{
                            font-size: 13px;
                            max-width: 95px;
                            }
                        }
                }
            }
        }
    }
</style>