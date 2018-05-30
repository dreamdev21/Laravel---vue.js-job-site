<template>
<div class="">
  <div class="white-box" >
    <div class="row">
      <div class="col-12">
      <div :class="['testing-process-tabwrap', mainContentDivClass]">
        <b-tabs>
          <!-- Questions Section -->
          <b-tab title="Questions" class="active-tab" active>
            <div class="tester-questions-tab">
              <div class="row mb-sm-3 mb-2" v-for="(question, i) in questionAnswers" :key="i">
                <div class="col-12">
                  <p class="mb-0 mb-sm-1">
                    <span class="text-medium mr-1">Q{{i+1}}.</span>
                    <span class="">
                      {{ question.question | firstUppercase }}
                    </span>
                  </p>
                </div>
                <div class="col-12">
                  <p class="mb-0 mb-sm-1 text-medium ml-3 pl-3">
                    {{ question.project_question_tester_answers ? question.project_question_tester_answers.answer : '-' | firstUppercase  }}
                  </p>
                </div>
              </div>
            </div>
          </b-tab>
          <!-- Ratings Section -->
          <b-tab title="Ratings/Scores">
            <div class="tester-rating-tab">
              <div class="row">
                <div class="col-md-10 text-center">
                  <h4 class="total-score-txt">
                    Total Score: 88
                    <span class="effective-badge">Exemplary</span>
                  </h4>
                </div>
                <div class="col-md-2">
                  <button v-if="!allExpanded" class="btn green-btn text-uppercase expand-btn" @click="showAllCollapse">Expand All</button>
                  <button v-else class="btn green-btn expand-btn text-uppercase " @click="hideAllCollapse">Collapse All</button>

                </div>
              </div>
              <div role="tablist">
                <!-- Tablist -->
                <b-card no-body class="mb-3 mb-sm-4 custom-accordion" v-for="(mainSection, sectionKey) in project_rating" :key="sectionKey" >
                  <b-card-header header-tag="header" class="p-1" role="tab">
                    <b-btn block href="#" v-b-toggle="'accordion'+sectionKey">
                      {{ mainSection.title }}
                      <span class="text-right">
                        Total Score : 00
                      </span>
                    </b-btn>
                  </b-card-header>
                  <b-collapse :id="'accordion'+sectionKey" visible role="tabpanel" v-model="accordian_expanded[sectionKey]" @click="single_expand(sectionKey)">
                    <b-card-body v-for="(subSection,subSectionKey) in mainSection.sub_points" :key="subSectionKey">
                      <starRatings v-model="subSection.rating" :title="subSection.title" :aDescription="subSection.description" :disabled="ratingDisable"></starRatings>
                    </b-card-body>
                  </b-collapse>
                </b-card>
              </div>
            </div>
          </b-tab>
          <!--- Issues Section -->
          <b-tab title="Issues">
            <div class="tester-issues-tab">
              <div class="issue-block mb-md-5 mb-sm-3 mb-3" v-for="issue in issueTypes" :key="issue.id">
                <div class="row">
                  <div class="col-12">
                    <div class="icon-wrap d-inline-block align-middle">
                        <img :src="issue.img" class="img-fluid" />
                      
                            </div>
                            <div class="content-wrap d-inline-block align-middle">
                              <p class="text-bold issue-type">{{ issue.title }}</p>
                            </div>
                            <div class="mt-2" >
                              <span v-for="(bug,i) in issue.bugs" :key="i">
                                <p v-if="bug.desc" class="mb-sm-3 mb-2">{{i+1}}. {{ bug.desc }} </p>
                              </span>

                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </b-tab>
                <!-- Attachment Section -->
                <!-- <b-tab title="Attachment">
                  <attachments v-if="testProject.id && testerId" :disabled="true" :testerId="testerId" :projectId="testProject.id"></attachments>
                </b-tab> -->
              </b-tabs>
            </div>
          </div>
        </div>
      </div>
    <div class="white-box">
      <div class="row">
        <div class="col-12">
             <h4 :class="['block-title', adminBlockTitle]">Attachments
          </h4>
        </div>
        <div class="col-12">
          <attachments v-if="testProject.id && testerId" :disabled="true" :testerId="testerId" :projectId="testProject.id"></attachments>
        </div>
      </div>
    </div>
</div>
</template>

<script>
import Vue from "vue";
import moment from "moment";
import DeviceSelector from "components/components/device-selector";
import VueCollapse from 'vue2-collapse'
import starRatings from "components/components/project/rating.vue";
import Attachments from "components/components/project/attachments";
import project_rating from "../../project_rating.js";
import {hasTesterRole, hasPublisherRole,isAdmin} from "../../services/auth.js";
import black_widow_icon from "src/assets/img/black_widow_32x32.png";
import gnat_icon from "src/assets/img/gnat_32x32.png";
import wasp_icon from "src/assets/img/wasp_32x32.png";
// Loading the plugin into the Vue.
Vue.use(VueCollapse)
export default {
  name: "project_testing_process_review",
  components: {
    starRatings,
    DeviceSelector,
    Attachments,
  },
  props: {
    projectId:{
      type: Number,
      default() {
        return parseInt(this.$route.params.id);
      }
    },
    testerId: {
      type: Number,
      default() {
        return window.USER.id;
      }
    },
    ratingDisable:{
      default() {
        return false;
      }
    }
  },
  data() {
    return {
      testProject: {},
      user: {},
      ratings: {},
      projectTester: {},
      answer_map: {},
      questionAnswers: {},
      seen: false,
      expandedAll: false,
      accordian_expanded:{
        1 : false,
        2 : false,
        3 : false,
      },
      allExpanded: false,
      project_rating: project_rating,
      mainContentDivClass: '',
      adminBlockTitle:'',
      issueTypes: [
        {
          img: black_widow_icon,
          name: "High",
          title: "Black Widow -  High type bug",
          typeDesc: "",
          bugs: []
        },
        {
          img: wasp_icon,
          name: "Medium",
          title: "Wasp -  Medium type bug",
          typeDesc: "",
          bugs: []
        },
        {
          img: gnat_icon,
          name: "Low",
          title: "Gnat - Low type bug",
          typeDesc: "",
          bugs: []
        },
        {
          img: "",
          name: "Cosmetic",
          title: "Are there any cosmetic issues you would like to mention?",
          typeDesc: "",
          bugs: []
        },
        {
          img: "",
          name: "Other",
          title: "Do you have any suggestions you would like to pass on to the Publisher?",
          typeDesc: "",
          bugs: []
        }
      ],
    };
  },
  computed: {
    currentTestStatus() {
      if (this.projectTester && this.projectTester.latest_status_data) {
        if (this.projectTester.latest_status.toLowerCase() === "submitted") {
          return `In Review, Submitted: ${moment(
            this.projectTester.latest_status_data.updated_at
          ).format("DD MMM, YYYY HH:mm A")}`;
        }
        return this.projectTester.latest_status;
      }
      // @TODO when user is not associated with test project this should be status of project itself.
      return "Running / Open";
    }
  },
  mounted: function() {
    this.reloadTestingProcessData();
    if(hasPublisherRole()){
      this.mainContentDivClass = 'publisher-testing-process-section';

    }else if(isAdmin()){
      this.mainContentDivClass = 'admin-testing-process-section';
      this.adminBlockTitle = 'admin-text-color';
    }
  },
  methods: {
    reloadTestingProcessData(){
      axios
      .get(`/api/tester/user/${this.projectId}`)
      .then(({ data: { data } }) => {
        this.projectTester = data;
      })
      .catch(function(error) {});
      axios
        .get(`/api/projects/${this.projectId}`)
        .then(({ data: { data } }) => {
          this.testProject = data;
          this.testProject.selected_devices = data.devices.map(({ id }) => id);
          if(this.testerId)
            return axios.get(`/api/projects/${this.projectId}/ratings/${this.testerId}`);
        })
        .then(({ data }) => {
          const groups = _.groupBy(data, "collection_name");
          const ratings = {};
          Object.keys(groups).forEach(
            k => (ratings[k] = _.pick(groups[k][0], ["score", "suggestion"]))
          );
          this.ratings = project_rating;
          return axios.get(`/api/projects/${this.projectId}/testing-inputs/${this.testerId}`);
        })
        .then(({ data }) => {
          this.questionAnswers = data.projectQuestionAnwers.questions;
          if (data.groupedIssues) {
            this.issueTypes.map(function(issue){
              if(data.groupedIssues[(issue.name).toLowerCase()]){
                issue.bugs = [];
                (data.groupedIssues[(issue.name).toLowerCase()]).forEach(function(bug,key){
                  issue.bugs.push({ id: key, desc: bug });
                });
              }else{
                issue.bugs.push({ id: 0, desc: '' });
              }
            });
          }
        })
        .catch(function(error) {});
    },
    addexplanation: function(event) {
      console.log(event.target);
    },
    reviewProject: function(event) {
      axios
        .post(`/api/tester/update-test-status/${this.$route.params.id}`, {
          test_status: "REVIEW",
          issues: this.issues,
          project_id: this.$route.params.id
        })
        .then(response => {
          if (response.data.success) {
            this.$router.push({ name: "tester.project-view-submission" });
          }
        })
        .catch(function(error) {});
    },
    showAllCollapse: function(event){
      let that = this;
      this.allExpanded = true;
      Object.keys(this.accordian_expanded).map(function(key){
        that.accordian_expanded[ key ] = true;
      });
    },
    hideAllCollapse: function(event){
     let that = this;
      this.allExpanded = false;
      Object.keys(this.accordian_expanded).map(function(key){
        that.accordian_expanded[ key ] = false;
      });
    },
    single_expand: function(key){
      let that = this;
      this.allExpanded = false;
      Object.keys(this.accordian_expanded).map(function(key){
        that.accordian_expanded[ key ] = false;
      });
      this.accordian_expanded[ key ] = true;
    },
    single_collapse: function(key){
      let that = this;
      this.allExpanded = false;
      Object.keys(this.accordian_expanded).map(function(key){
        that.accordian_expanded[ key ] = false;
      });
      // this.accordian_expanded[ key ] = false;
    }
  }
};
</script>
<style lang="scss" scoped>
@import "../layouts/css/_customvariables";
.admin-text-color{
  color: #3e3a94 !important;
}
.publisher-text-color{
  color: #0082cc;
}
.text-green {
  color: #2cac3d;
}
.text-red {
  color: #e63423;
}
.text-bold {
  font-family: $font-family-brandon-bold !important;
}
.text-medium {
  font-family: $font-family-brandon-medium;
}
.white-box {
  background-color: #fff;
  box-shadow: 0px 0px 3px 2px rgba(3, 3, 3, 0.05);
  border-radius: 4px;
  padding: 20px;
  margin-bottom: 20px;
  font-size: 14px;
  line-height: 22px;
  color: #606368;
  .block-title {
    font-size: 18px;
    font-family: $font-family-UniNeue-bold;
    border-bottom: 1px solid #dadada;
    color: #606368;
    padding-bottom: 10px;
    margin-bottom: 10px;
    width: auto;
    .badge-wrap {
      border: 1px solid #2cac3d;
      background-color: #2cac3d;
      color: #fff;
      font-size: 16px;
      right: -5px;
      position: absolute;
      border-top-left-radius: 16px;
      border-bottom-left-radius: 16px;
      padding: 2px 12px;
      top: -5px;
      font-family: $font-family-brandon-regular;
    }
  }
  .test-device-list {
    span {
      margin-right: 15px;
      margin-top: 10px;
    }
  }
  .tester-issues-tab {
    .line-seprator {
      margin: 0 0 20px;
    }
    .issue-block {
      .issue-type {
        margin-bottom: 0px;
        font-size: 18px;
      }
      .form-group {
        .form-control {
          margin-bottom: 20px;
        }
        .remove-icon {
          color: #606368;
          i {
            font-size: 34px;
          }
        }
      }
    }
  }
  .tester-attachment-tab {
    .add-files-btn {
      width: 160px;
      float: right;
      margin-top: 0;
      margin-bottom: 20px;
      input {
        opacity: 0;
        position: absolute;
        top: 0;
        right: 0;
      }
    }
    .attachment-table-wrap {
      .attachment-table {
        border-radius: 6px;
        margin-bottom: 0;
        tr {
          td {
            &:first-child {
              min-width: 60px;
              max-width: 60px;
              width: 60px;
              text-align: center;
            }
            &:last-child {
              min-width: 130px;
              max-width: 130px;
              width: 130px;
              display: table-cell;
            }
            &:nth-child(3) {
              min-width: 160px;
              max-width: 160px;
              width: 160px;
              display: table-cell;
              text-align: center;
            }
            a {
              margin-right: 10px;
              color: #1f1f1f;
              font-size: 20px;
            }
          }
        }
      }
    }
  }
  .tester-rating-tab {
    .total-score-txt {
      font-size: 20px;
      font-family: $font-family-UniNeue-bold;
      color: #363e48;
      text-align: center;
      width: auto;
      margin-bottom: 15px;
      .effective-badge {
        font-family: $font-family-brandon-regular;
        color: #fff;
        font-size: 12px;
        background-color: #4be05e;
        border: 1px solid #2cac3d;
        border-radius: 16px;
        padding: 1px 8px;
        vertical-align: middle;
        margin-bottom: 5px;
        display: inline-block;
      }
    }
    .custom-accordion {
      border: none;
      &:hover {
        box-shadow: none;
      }
      .card-header {
        padding: 0 !important;
        border-bottom: none;
        &:hover {
          outline: none !important;
        }
        a.collapsed {
          border: 2px solid #118921;
          background-color: #2cac3d;
          color: #fff;
          border-radius: 6px;
          &:before {
            background-image: url("~img/right-arrow.png");
          }
          span {
            color: #fff;
          }
          img {
            display: inline-block;
            vertical-align: initial;
          }
        }
        a {
          padding: 10px 20px !important;
          padding-left: 35px !important;
          border-radius: 0px;
          border-top-right-radius: 6px;
          border-top-left-radius: 6px;
          text-align: left;
          color: #2cac3d;
          font-family: $font-family-UniNeue-heavy;
          font-size: 16px;
          text-align: left;
          text-transform: uppercase;
          background-color: #f2f2f2;
          // border: 1px solid #dadada;
          // border-bottom: none;
          border: none !important;
          &:before {
            background-image: url("~img/down-arrow.png");
            content: "";
            position: absolute;
            left: 15px;
            top: 15px;
            height: 14px;
            width: 14px;
            background-size: 100%;
            background-position: center;
          }
          span {
            float: right;
            font-family: $font-family-brandon-bold;
            font-size: 16px;
            text-transform: none;
            color: #2f2f2f;
          }
        }
      }
      .card-body {
        padding: 0 10px 10px;
        background-color: #f2f2f2;
        border-bottom-left-radius: 6px;
        border-bottom-right-radius: 6px;
        .detail-block-wrap {
          background-color: #fff;
          border: 1px solid #dadada;
          padding: 15px;
          border-radius: 6px;
          h4 {
            font-size: 18px;
            color: #2cac3d;
            font-family: $font-family-brandon-bold;
          }
          .detail-block {
            font-family: $font-family-brandon-medium;
            font-size: 14px;
            line-height: 16px;
            span {
              width: calc(100% / 3 - 5px);
              display: inline-block;
              vertical-align: top;
            }
          }
          .explanation-wrap {
            textarea {
              resize: none;
              padding: 0px 10px;
              font-size: 17px;
              color: #9c9c9c;
              &:hover,
              &:focus {
                outline: none !important;
              }
            }
          }
          .ratings-block {
            margin-top: 10px;
            img {
              width: 100%;
            }
          }
          .green-btn-wrap {
            .green-btn {
              margin: 0;
              margin-top: 30px;
              font-size: 12px;
              line-height: 14px;
              text-transform: uppercase;
              padding: 4px 8px;
              cursor: pointer;
            }
          }
        }
      }
    }
      .expand-btn{
        max-width: 100%;
        padding: 5px 10px;
        margin-top: 0;
        margin-bottom: 20px;
        margin-right: 0;
      }
  }
}
.green-btn {
  width: 100%;
  max-width: 180px;
  padding: 7px 10px;
  border: 2px solid #118921;
  background-color: #2cac3d;
  font-size: 14px;
  font-family: $font-family-brandon-medium;
  letter-spacing: 0.05rem;
  color: #fff;
  border-radius: 20px;
  display: inline-block;
  text-align: center;
  margin: 10px 15px 30px 0px;
  &:hover {
    background-color: #158f25;
    color: #fff;
    outline: none !important;
  }
}
@media screen and(max-width:1281px) {
  .custom-container {
    .test-proj-fillup-page {
      .white-box {
        font-size: 16px;
      }
      .green-btn {
        font-size: 13px;
      }
    }
  }
}
@media screen and(max-width:1200px) {
  .custom-container {
    .test-proj-fillup-page {
      .green-btn {
        font-size: 12px;
        letter-spacing: 0;
      }
      .white-box {
        font-size: 14px;
        .block-title {
          font-size: 18px;
          .badge-wrap {
            font-size: 15px;
          }
        }
      }
    }
  }
}
@media screen and(max-width:991px) {
  .custom-container {
    .test-proj-fillup-page {
      .white-box {
        padding: 15px;
        .block-title {
          .badge-wrap {
            right: 0;
          }
        }
      }
    }
  }
}
@media screen and(max-width:767px) {
  .custom-container {
    .test-proj-fillup-page {
      .status-bar {
        font-size: 14px;
      }
      .green-btn {
        margin: 10px 15px 10px 0;
        max-width: 175px;
      }
      .white-box {
        .block-title {
          .badge-wrap {
            right: 0;
            top: -3px;
          }
        }
        .proj-status {
          br {
            display: block;
          }
        }
        .notes-list {
          margin-bottom: 15px;
        }
        .proj-status.active {
          span {
            display: block !important;
          }
        }
        .tester-rating-tab {
          .custom-accordion {
            .card-header {
              a {
                font-size: 16px;
                padding: 10px !important;
                padding-left: 30px !important;
                &::before {
                  top: 15px;
                  left: 10px;
                }
                span {
                  font-size: 16px;
                }
              }
            }
          }
          .expand-btn{
           max-width: 120px;
            padding: 5px 10px;
            margin: 0 auto;
            margin-bottom: 20px;
            margin-right: auto;
            display: block;
            font-size: 14px;
          }
        }
        .tester-issues-tab {
          .issue-block {
            .issue-type {
              font-size: 16px;
            }
            .form-group {
              .remove-icon {
                margin-top: 3px;
                display: block;
                i {
                  font-size: 24px;
                }
              }
            }
          }
        }
        .tester-attachment-tab {
          .add-files-btn {
            float: left;
            max-width: 100px;
            padding: 2px;
          }
          .attachment-table-wrap {
            .attachment-table {
              border-radius: 6px;
              tr {
                td {
                  &:nth-child(2) {
                    min-width: 320px;
                  }
                }
              }
            }
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
    .test-proj-fillup-page {
      .white-box {
        font-size: 14px;
        line-height: 18px;
        .block-title.proj-name-wrap {
          padding-bottom: 40px;
          .proj-name {
            display: block;
            width: 100%;
            font-size: 20px;
          }
          .badge-wrap {
            position: relative;
            float: left;
            margin-left: -15px;
            margin-top: 15px;
            font-size: 13px;
            border-bottom-left-radius: 0;
            border-top-left-radius: 0;
            border-top-right-radius: 16px;
            border-bottom-right-radius: 16px;
          }
        }
        .proj-status {
          &:first-child {
            .proj-progress {
              &::before {
                width: calc(50% - 25px);
              }
            }
          }
          &:last-child {
            .proj-progress {
              &::after {
                width: calc(50% - 25px);
              }
            }
          }
        }
        .proj-status.active {
          .proj-progress {
            i {
              font-size: 28px;
              &::after {
                height: 13px;
                width: 13px;
                left: 5px;
                top: 5px;
              }
            }
          }
        }
        .proj-status.done-step {
          .proj-progress {
            i {
              font-size: 28px;
              &::after {
                height: 13px;
                width: 13px;
                left: 5px;
                top: 5px;
              }
            }
          }
        }
        .tester-rating-tab {
          .total-score-txt {
            font-size: 18px;
            margin-bottom: 20px;
          }
          .custom-accordion {
            .card-header {
              a {
                font-size: 14px;
                padding: 5px 10px !important;
                padding-left: 30px !important;
                &::before {
                  top: 9px;
                  left: 10px;
                }
                span {
                  font-size: 14px;
                }
              }
            }
          }
        }
      }
    }
    .green-btn {
      margin: 10px 15px 10px 0;
    }
  }
}
@media screen and(max-width:360px) {
  .custom-container {
    .test-proj-fillup-page {
      .white-box {
        .tester-rating-tab {
          .total-score-txt {
            font-size: 14px;
            margin-bottom: 15px;
          }
          .custom-accordion {
            .card-header {
              a {
                font-size: 13px;
                padding-left: 20px !important;
                &::before {
                  top: 10px;
                  left: 6px;
                  height: 10px;
                  width: 10px;
                }
                span {
                  font-size: 13px;
                }
              }
            }
          }
        }
      }
    }
  }
}
</style>