<template>
  <div class="bg-color">
    <div class="container custom-container">
      <div class="row">
        <div class="test-proj-fillup-page">
          <div class="white-box">
            <div class="row">
              <div class="col-12">
                <h4 class="block-title border-bottom-0">
                  Project Status
                </h4>
              </div>
              <div class="col-12">
                <Steps :steps="steps" :active="get_project_current_stage" projectTypeClass="test-project"></Steps>
              </div>
            </div>
          </div>

          <TestProjectDetails :testProject="testproject" :latestStatusData="lastestStatusData"> </TestProjectDetails>

          <project-testing-process-review ></project-testing-process-review>
        </div>
      </div>
      <div class="col-12 text-center">
        <a @click="save(true)" class="btn text-uppercase green-btn">review and submit</a>
        <a @click="save()" class="btn text-uppercase green-btn">save as draft</a>
      </div>
    </div>
  </div>
</template>
<script>
import Vue from "vue";
import DeviceSelector from "components/components/device-selector";
import starRatings from "components/components/project/rating.vue";
import Steps from "components/components/publisher/steps";
import TestProjectDetails from "components/components/tester/test-project-details";
import ProjectStatusTestProject from "components/components/tester/project-status-test-project";
import ProjectTestingProcessReview from "components/components/project-testing-process-review";
import project_rating from "../../../project_rating.js";
import Attachments from "components/components/project/attachments";
import { testProjectStatusWeight } from "src/services/test-project";
import black_widow_icon from "src/assets/img/black_widow_32x32.png";
import gnat_icon from "src/assets/img/gnat_32x32.png";
import wasp_icon from "src/assets/img/wasp_32x32.png";

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
export default {
  name: "project_submission",
  components: {
    starRatings,
    DeviceSelector,
    Steps,
    TestProjectDetails,
    ProjectStatusTestProject,
    ProjectTestingProcessReview,
    Attachments
  },
  data() {
    return {
      isSubmitted: 0,
      testproject: {},
      lastestStatusData: {},
      user: {},
      projectTester: {},
      ratings: {},
      project_rating: project_rating,
      answer_map: {},
      bugEmpty: false,
      questionAnswers: {},
      formSubmitted: false,
      projectSubmissionEmpty: false,
      saveAsFinalSubmit: "",
      totalRatingInputs: 3,
      userId: window.USER.id,
      issueTypes: [
        {
          img: black_widow_icon,
          name: "High",
          title: "Black Widow -  High type bug",
          typeDesc:
            "The issue(s) is critical / deadly to the app usability and must be dealt with immediately.",
          bugs: []
        },
        {
          img: wasp_icon,
          name: "Medium",
          title: "Wasp -  Medium type bug",
          typeDesc:
            "The issue(s) affects the flow / enjoyment of the app but can wait until the next update to be solved.",
          bugs: []
        },
        {
          img: gnat_icon,
          name: "Low",
          title: "Gnat - Low type bug",
          typeDesc:
            "The issue(s) is annoying but not critical to app function or flow.",
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
          title:
            "Do you have any suggestions you would like to pass on to the Publisher?",
          typeDesc: "",
          bugs: []
        }
      ],
      steps: [
        { id: 1, name: "New" },
        { id: 2, name: "Accepted/Working" },
        { id: 3, name: "Under Review" },
        { id: 4, name: "Completed" }
      ]
    };
  },
  computed: {
    get_project_current_stage() {
      if (this.projectTester && this.projectTester.latest_status) {
        return testProjectStatusWeight(this.projectTester.latest_status);
      } else {
        return 1;
      }
    }
  },
  mounted: function() {
    axios
      .get(`/api/tester/user/${this.$route.params.id}`)
      .then(({ data: { data } }) => {
        this.projectTester = data;
        this.isSubmitted = this.projectTester.all_status.includes("Submitted");
        if (data.groupedIssues) {
          this.issueTypes.map(function(issue) {
            if (data.groupedIssues[issue.name.toLowerCase()]) {
              data.groupedIssues[issue.name.toLowerCase()].forEach(function(
                bug,
                key
              ) {
                issue.bugs.push({ id: key, desc: bug });
              });
            } else {
              issue.bugs.push({ id: 0, desc: "" });
            }
          });
        }
      })
      .catch(function(error) {});
    axios
      .get(`/api/projects/${this.$route.params.id}`)
      .then(({ data: { data } }) => {
        this.testproject = data;
        this.lastestStatusData = this.projectTester.latest_status_data ? this.projectTester.latest_status_data : {};
        this.testproject.selected_devices = data.devices.map(({ id }) => id);
        this.answer_map = data.questions.map(question => ({
          id: question.id,
          answer: ""
        }));
        return axios.get(
          `/api/projects/${this.testproject.id}/ratings/${this.userId}`
        );
      })
      .then(({ data }) => {
        const groups = _.groupBy(data, "collection_name");
        const ratings = {};
        Object.keys(groups).forEach(
          k => (ratings[k] = _.pick(groups[k][0], ["score", "suggestion"]))
        );
        this.ratings = ratings;
        return axios.get(
          `/api/projects/${this.testproject.id}/testing-inputs/${this.userId}`
        );
      })
      .then(({ data }) => {
        this.questionAnswers = data.projectQuestionAnwers;
        this.answer_map = this.questionAnswers.questions.map(question => ({
          id: question.id,
          answer: question.project_question_tester_answers.answer
        }));
      })
      .catch(function(error) {});
  },
  methods: {
    removeField: function(issueTypeIndex, bugIndex, event) {
      this.issueTypes[issueTypeIndex].bugs.splice(bugIndex, 1);
    },
    addField: function(issueTypeIndex, bugIndex, event) {
      let bug = this.issueTypes[issueTypeIndex].bugs[bugIndex];
      // if( bug.desc == "" ){
      //   this.bugEmpty = true;
      //   VueScrollTo.scrollTo('.testing-process-tabwrap');
      // }else{
      //   this.bugEmpty = false;
      this.issueTypes[issueTypeIndex].bugs.push({
        desc: "",
        id: bugIndex++
      });
      // }
    },
    save: function(submitted = false) {
      this.formSubmitted = true;
      this.projectSubmissionEmpty = false;
      this.saveAsFinalSubmit = submitted;

      // let ratingLength = Object.keys(this.ratings).length;
      let that = this;
      this.validateBugs();

      this.answer_map.map(function(answer) {
        if(!answer.answer) {
          that.projectSubmissionEmpty = true;
        }
      });

      // ####TO DO : -----
      // if (ratingLength != this.totalRatingInputs) {
      //   this.projectSubmissionEmpty = true;
      // }

      if (this.projectSubmissionEmpty) {
        VueScrollTo.scrollTo(".testing-process-tabwrap");
      }

      if(!this.projectSubmissionEmpty || !submitted) {
        let requestData = {
          email: this.$store.state.user.email,
          project_question_answers: this.answer_map,
          issues: this.issueTypes,
          project_id: this.$route.params.id
        };
        // // if(!this.bugEmpty){
        this.saveRatings()
          .then(() =>
            axios.put(`/api/tester/${this.$store.state.user.id}`, requestData)
          )
          .then(response => {
            const route = submitted
              ? "tester.project-view-submission"
              : "tester.dashboard";
            this.$router.push({ name: route });
          })
          .catch(error => (this.errors = error.response.data.message));
        // // }
      }
    },
    saveRatings() {
      return axios.post(
        `/api/tester/${this.$store.state.user.id}/rating/${
          this.testproject.id
        }`,
        this.project_rating
      );
    },
    validateBugs: function() {
      this.issueTypes.forEach(bugType => {
        bugType.bugs.forEach(bug => {
          if (bug.desc == "" && !this.projectSubmissionEmpty) {
            this.projectSubmissionEmpty = true;
          }
        });
      });
    }
  }
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";

.custom-container {
  max-width: 100%;
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
  .test-proj-fillup-page {
    width: 100%;
    .white-box {
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
      .block-title.proj-name-wrap {
        color: #2cac3d;
        .proj-name {
          font-family: $font-family-UniNeue-bold;
          font-size: 24px;
          line-height: 18px;
        }
      }
      .proj-status {
        padding: 0;
        padding-top: 8px;
        overflow: hidden;
        br {
          display: none;
        }
        &:first-child {
          .proj-progress {
            &::before {
              width: calc(50% - 30px);
              left: 15px;
            }
          }
        }
        &:last-child {
          .proj-progress {
            &::after {
              width: calc(50% - 30px);
              right: 15px;
            }
          }
        }
        .proj-progress {
          position: relative;
          margin-bottom: 5px;
          i {
            color: rgba(175, 177, 179, 0.5);
            font-size: 22px;
            line-height: 24px;
          }
          &::before {
            content: "";
            position: absolute;
            height: 3px;
            width: calc(50% - 5px);
            background-color: #ececec;
            left: -10px;
            top: 11px;
          }
          &::after {
            content: "";
            position: absolute;
            height: 3px;
            width: calc(50% - 5px);
            background-color: #ececec;
            right: -10px;
            top: 11px;
          }
        }
      }
      .proj-status.active {
        color: #2cac3d;
        .proj-progress {
          i {
            color: #2cac3d;
            font-size: 34px;
            line-height: 24px;
            position: relative;
            &::after {
              height: 15px;
              width: 15px;
              background-color: #2cac3d;
              content: "";
              border-radius: 50%;
              position: absolute;
              left: 7px;
              top: 4px;
            }
          }
          &::before {
            background-color: #2cac3d;
          }
        }
      }
      .proj-status.done-step {
        color: #2cac3d;
        .proj-progress {
          i {
            color: #2cac3d;
            font-size: 34px;
            line-height: 24px;
            position: relative;
            &::after {
              height: 15px;
              width: 15px;
              background-color: #2cac3d;
              content: "";
              border-radius: 50%;
              position: absolute;
              left: 7px;
              top: 4px;
            }
          }
          &::before {
            background-color: #2cac3d;
          }
          &::after {
            background-color: #2cac3d;
          }
        }
      }
      .proj-desc {
        letter-spacing: 0.01rem;
        margin-bottom: 5px;
      }
      .notes-list {
        padding-left: 15px;
        margin-bottom: 0px;
        li {
          position: relative;
          &::before {
            content: "-";
            position: absolute;
            left: -15px;
            top: -1px;
            color: #606368;
            font-size: 20px;
          }
        }
      }
      .project-link {
        color: #2cac3d;
        text-decoration: underline !important;
      }
      .app-title {
        min-width: 110px;
        display: inline-block;
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
      .tester-rating-tab {
        .total-score-txt {
          font-size: 20px;
          font-family: $font-family-UniNeue-bold;
          color: #363e48;
          text-align: center;
          width: 100%;
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
      }
      .fill-section-error{
        background-color: #efafaf7d;
        width: 100%;
        padding: 5px 8px;
        border-radius: 5px;
        font-weight: bold;
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
        .fill-section-error{
          padding: 3px 5px;
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