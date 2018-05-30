<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div v-if="latestStatusData.name == 'Test Passed' || latestStatusData.name == 'Test Failed'" class="text-medium text-center orange-info mb-3">
        <!-- <div v-if="isAcceptedOrRejected" class="text-medium text-center orange-info mb-3"> -->
          Project {{ latestStatusData.name == "Test Passed" ? 'approved' : 'rejected' }} on {{latestStatusData.created_at | datetime }}
        </div>
      </div>
    </div>
    <div class="white-box">
      <div class="row">
        <div class="col-12">
          <h4 class="text-bold block-title proj-name-wrap">
            <span class="proj-name">{{testProject.name}}</span>
            <div class="d-inline-block text-sm-right spot-status-wrap">
              <span class="align-middle open-spot-txt" v-if="!testProject.is_test_project && currentTestStatus == 'New'">
                Open spots : {{  testProject.allocated_tester - (testProject.testers ? testProject.testers.length : 0) }}
              </span>
              <span class="badge-wrap align-middle">
                <span class="status-badge">
                  Status:{{currentTestStatus}}
                </span>
              </span>
            </div>
          </h4>
        </div>
      </div>
      <div class="row pb-3 pb-md-4">
        <div class="col-md-5 mb-2 mb-sm-0">
          <div class="">
            <span class="text-bold">
              Type : 
            </span>
            <span class=""> {{testProject.project_type ? testProject.project_type.name : ''  }} </span>
          </div>
        </div>
        <div class="col-md-3">
          <div v-if="!testProject.is_test_project">
            <div class="">
              <span class="text-bold">Start Date : </span>
              <span class="">{{testProject.start_date | date }}</span>
            </div>
            <div class="">
              <span class="text-bold">End Date : </span>
              <span class="">{{testProject.end_date | date }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-4 text-md-right text-left">
          <span class="text-bold mr-2">Time Needed to Test: </span>
          <span class="">{{testProject.estimate_tester_time | times}}</span>
        </div>
      </div>
      <div class="row pb-3 pb-md-4">
        <div class="col-12">
          <h4 class="text-bold block-title">Project Description
          </h4>
        </div>
        <div class="col-12">
          <p class="proj-desc" v-html="testProject.project_description"></p>
        </div>
      </div>
      <div class="row pb-3 pb-md-4">
        <div class="col-md-6 col-12 pb-md-0 pb-3">
          <h4 class="text-bold block-title">Links</h4>
          <div class=""  v-for="link in testProject.links" :key="link.id" >
            <span class="text-bold mr-2">{{link.title}} : </span>
            <a :href="link.link" target="_blank" > {{ link.link }}</a>
          </div>
        </div>
        <div class="col-md-6 col-12">
          <h4 class="text-bold block-title">Files</h4>
          <file-viewer colorTheme="tester" :files="testProject.media"></file-viewer>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-6 pb-md-0 pb-3">
          <h4 class="block-title text-bold">Notes/Instruction</h4>
          <p class="mb-1">{{testProject.notes_instruction ? testProject.notes_instruction : 'No notes given' }}</p>
        </div>
        <div class="col-12 col-md-6">
          <h4 class="block-title text-bold">Required Devices</h4>
          <device-selector disabled v-model="testProject.selected_devices"></device-selector>
        </div>
      </div>
      <div class="row" v-if="!testProject.is_test_project">
        <div class="col-12 col-md-6 pb-md-0 pb-3">
          <h4 class="text-bold block-title">Amount to Tester</h4>
          <p class="mb-1">${{testProject.cost_per_tester}}/tester</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
import DeviceSelector from "components/components/device-selector";
import FileViewer from "components/components/publisher/file-viewer";
import Vue from "vue";
import {TimeFilter} from "src/services/filter";
Vue.filter('times', TimeFilter);
  export default {
    name: "TestProjectDetails",
    data() {
      return {
        isAcceptedOrRejected: false,
      };
    },
    components: {
      DeviceSelector,
      FileViewer  
    },
    props: {
      testProject: {
        type: Object,
        default() {
          return {};
        }
      },
      latestStatusData:{
        type: Object,
        default() {
          return {};
        }
      }
    },
    computed: {
      currentTestStatus() {
        if (Object.keys(this.latestStatusData).length) {
          if (this.latestStatusData.name.toLowerCase() === "submitted") {
            return `In Review, Submitted: ${moment(
              this.latestStatusData.updated_at
            ).format("DD MMM, YYYY HH:mm A")}`;
          }
          return this.latestStatusData.name;
        }
        // @TODO when user is not associated with test project this should be status of project itself.
        return "New";
      },
    },
  }
</script>

<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";

.custom-container{
  max-width: 100%;
  .text-green{
    color: #2cac3d;
  }
  .text-red{
    color: #e63423;
  }
  .text-bold{
    font-family: $font-family-brandon-bold !important;
  }
  .text-medium{
    font-family: $font-family-brandon-medium;
  }
  .orange-info {
    color: #fff;
    background-color: #ff7802;
    border-radius: 4px;
    padding: 10px;
    font-size: 16px;
  }
  .test-proj-fillup-page{
    width: 100%;
    .white-box{
      background-color: #fff;
      box-shadow: 0px 0px 3px 2px rgba(3, 3, 3, 0.05);
      border-radius: 4px;
      padding: 20px;
      margin-bottom: 20px;
      font-size: 14px;
      line-height: 22px;
      letter-spacing: 0;
      color: #606368;
      .block-title{
        font-size: 18px;
        font-family: $font-family-UniNeue-bold;
        border-bottom: 1px solid #dadada;
        color: #606368;
        padding-bottom: 10px;
        margin-bottom: 10px;
        width: auto;
        .badge-wrap{
          border: 1px solid #2cac3d;
          background-color: #2cac3d;
          color: #fff;
          font-size: 16px;
          border-top-left-radius: 16px;
          border-bottom-left-radius: 16px;
          padding: 2px 12px;
          font-family: $font-family-brandon-regular;
          position: relative;
          margin-right: -20px;
          float: right;
          margin-left: 15px;
        }
      }
      .proj-name-wrap{
        // padding-bottom: 30px;
        .proj-name{
          font-family: $font-family-UniNeue-bold;
          font-size: 24px;
          line-height: 18px;
        color: #2cac3d;
        }
        .spot-status-wrap{
          float: right;
        }
      }
      .proj-desc{
        letter-spacing: 0.01rem;
        margin-bottom: 5px;
      }
      .notes-list{
        padding-left: 15px;
        margin-bottom: 0px;
        li{
          position: relative;
          &::before{
            content: "-";
            position: absolute;
            left: -15px;
            top: -1px;
            color: #606368;
            font-size: 20px;
          }
        }
      }
      .project-link{
        color: #2cac3d;
        text-decoration: underline !important;
      }
      .test-device-list{
        span{
          margin-right: 15px;
          margin-top: 10px;
        }
      }
    }
  }
}
@media screen and(max-width:1200px) {
  .custom-container{
    .test-proj-fillup-page{
      .white-box{
        .block-title{
          .badge-wrap{
            font-size: 15px;
          }
        }
      }
    }
  }
}
@media screen and(max-width:991px) {
  .custom-container{
    .test-proj-fillup-page{
      .white-box{
        padding: 15px;
        .block-title{
          .badge-wrap{
            margin-right: -15px;
          }
        }
        .proj-name-wrap{
        .proj-name{
          font-size: 22px;
        }
      }
      }
    }
  }
}
@media screen and(max-width:767px) {
 .custom-container{
    .orange-info, {
      padding: 5px;
      font-size: 14px;
      line-height: 18px;
    }
    .test-proj-fillup-page{
      .status-bar{
        font-size: 14px;
      }
      
      .white-box{
        
        .block-title{
          font-size: 16px;
          .badge-wrap{
            right: 0;
            top: -3px;
          }
        }
        .notes-list{
          margin-bottom: 15px;
        }
      }
    }
 }
}
@media screen and(max-width:575px) {
   .custom-container{
    .test-proj-fillup-page{
      .white-box{
        line-height: 18px;
        .block-title.proj-name-wrap{
          padding-bottom: 45px;
          .proj-name{
            display: block;
            width: 100%;
            font-size: 20px;
          }
          .spot-status-wrap{
            float: left;
          }
          .open-spot-txt{
            margin-top: 12px;
            float: right;
          }
          .badge-wrap{
            position: relative;
            float: left;
            margin-left: -15px;
            margin-top: 15px;
            font-size: 13px;
            border-bottom-left-radius: 0;
            border-top-left-radius: 0;
            border-top-right-radius: 16px;
            border-bottom-right-radius: 16px;
            margin-right: 15px;
          }
        }
        .project-link{
          display: block;
        }
      }
    }
  }
}
@media screen and(max-width:360px) {
   .custom-container{
    .test-proj-fillup-page{
      .white-box{
        .block-title.proj-name-wrap{
          .badge-wrap{
            font-size: 11px;
          }
        }
      }
    }
   }
}

</style>