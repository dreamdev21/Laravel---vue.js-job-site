<template>
  <div>
    
    <div class="white-box">
      <div class="row">
        <div class="col-12">
          <h4 class="text-bold block-title proj-name-wrap">
            <span class="proj-name">{{this.testProject.name}} 
              <!--<span class="text-blue pl-3"> <{{this.testProject.publisher_id}}> </span>-->
            </span>
            <!-- <span class="badge-wrap text-right">
              <span class="status-badge">
                Status:
              </span>
            </span> -->
          </h4>
        </div>
      </div>
      <div class="row pb-3 pb-md-4">
        <div class="col-md-4 col-12">
          <div class="" v-if="!testProject.is_test_project">
            <span class="text-bold">Publisher : </span>
            <span> {{this.testProject.publisher ? this.testProject.publisher.first_name+' '+ this.testProject.publisher.last_name : ''}}</span>
          </div>
          <div class="">
            <span class="text-bold">Type : </span>
            <span> {{this.testProject.project_type ? this.testProject.project_type.name : ''}}</span>
          </div>
        </div>
        <div class="col-md-4 col-12">
          <div v-if="!testProject.is_test_project">
            <div class="">
              <span class="text-bold">Start Date : </span>
              <span class="">{{this.testProject.start_date | date}}</span>
            </div>
            <div class="">
              <span class="text-bold">End Date : </span>
              <span class="">{{this.testProject.end_date | date}}</span>
            </div>
          </div>
        </div>
        <div class="col-md-4 text-md-right text-left">
          <div class="">
            <span class="text-bold">Created at : </span>
            <span>{{this.testProject.created_at | datetime }}</span>
          </div>
          <div class="">
            <span class="text-bold">Time Needed to Test : </span>
            <span>{{this.testProject.estimate_tester_time | times}}</span>
          </div>
        </div>
      </div>
      <div class="row pb-3 pb-md-4">
        <div class="col-12">
          <h4 class="text-bold block-title">Project Description
          </h4>
        </div>
        <div class="col-12">
          <!--<p v-html="this.testProject.project_description | text"></p>-->
          <p v-html="this.testProject.project_description"></p>
        </div>
      </div>
      <div class="row pb-3 pb-md-4">
        <div class="col-md-6">
          <h4 class="text-bold block-title">Links</h4>
          <div class="" v-for="link in testProject.links" :key="link.id" >
            <span class="font-bold">{{link.title}} : </span>
            <span class=""> <a :href="link.link" target="_blank" > {{ link.link }}</a> </span>
          </div>
        </div>
        <div class="col-md-6">
          <h4 class="text-bold block-title">Files</h4>
          <file-viewer :files="testProject.media"></file-viewer>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <h4 class="text-bold block-title">Notes/Instruction</h4>
          <p class=""> {{this.testProject.notes_instruction}} </p>
        </div>
        <div class="col-md-6">
          <h4 class="text-bold block-title">Devices to test on</h4>
          <device-selector disabled v-model="selected_devices"></device-selector>
        </div>
      </div>
    </div>
    <div class="white-box" v-if="$route.name!= 'admin.test_project.view-submission'">
      <div class="row">
        <div class="col-12">
          <h4 class="block-title">
              Questions
          </h4>
          <p>
            Your Questions to Testers which they have to fill up while submitting test Result
          </p>
          <div class="mb-1" :key="index" v-for="(ques, index) in testProject.questions">
            <span class="text-bold">Question {{ index + 1 }} : </span>
            <span class="text-medium"> {{ ques.question }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DeviceSelector from "components/components/device-selector";
import FileViewer from "components/components/publisher/file-viewer";
import Vue from "vue";
import {TimeFilter} from "src/services/filter";
Vue.filter('times', TimeFilter);
  export default {
    name: "AdminTestProjectDetails",
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
      currentTestStatus:{
        type: String,
        default() {
          return '';
        }
      }
    },
    computed: {
      selected_devices() {
        return (this.testProject.devices || []).map(({ id }) => id);
      }
    },
    data() {
      return {
        originalUser: window.USER
      };
    },
  }
</script>

<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";
.text-bold {
  font-family: $font-family-brandon-bold !important;
}
.text-medium {
  font-family: $font-family-brandon-medium;
}
.text-blue {
  color: #0082cc;
}
.orange-info {
  color: #fff;
  background-color: #ff7802;
  border-radius: 4px;
  padding: 10px;
  font-size: 16px;
}
.orange-outline-info {
  background-color: #fff;
  color: #ff7802;
  border: 2px solid #ff7802;
  border-radius: 4px;
  padding: 10px;
  font-size: 16px;
}
.green-info {
  color: #fff;
  background-color: #2cac3d;
  border-radius: 4px;
  padding: 10px;
  font-size: 16px;
}
.white-box {
  .block-title {
    font-size: 18px;
    font-family: $font-family-UniNeue-bold;
    border-bottom: 1px solid #dadada;
    color: #3e3a94;
    padding-bottom: 10px;
    margin-bottom: 10px;
    width: auto;
  }
  .project-link {
    color: #0082cc;
    text-decoration: underline !important;
  }
}
.back-proj-btn {
  max-width: 160px;
  min-width: 160px;
  min-height: 34px;
  margin-right: 15px;
  border-radius: 6px;
}
.approve-btn {
  max-width: 160px;
  min-height: 34px;
  min-width: 160px;
  border-radius: 6px;
}
.purple-btn {
  min-height: 34px;
  margin-right: 5px;
  padding: 7px 10px;
  border-radius: 6px;
}
.grey-btn {
  margin-right: 5px;
  width: auto;
  padding: 7px 10px;
  border-radius: 6px;
}
@media screen and(max-width:1281px) {
}
@media screen and(max-width:1200px) {
}
@media screen and(max-width:991px) {
}
@media screen and(max-width:767px) {
  .orange-info,
  .orange-outline-info,
  .green-info {
    padding: 5px;
    font-size: 14px;
    line-height: 18px;
  }
}
@media screen and(max-width:575px) {
  .white-box {
    .block-title {
      font-size: 16px;
    }
  }
  .grey-btn,
  .purple-btn {
    padding: 4px 5px;
    display: block;
    max-width: 120px;
    margin: 10px auto;
    min-height: 30px;
    max-height: 30px;
  }
  .back-proj-btn {
    max-width: 125px;
    min-width: 125px;
  }
  .approve-btn {
    max-width: 125px;
    min-width: 125px;
  }
}
</style>