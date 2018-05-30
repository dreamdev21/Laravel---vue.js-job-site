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

          <TestProjectDetails :testProject="testProject" :latestStatusData="lastestStatusData"> </TestProjectDetails>

          <project-testing-process-review></project-testing-process-review>
          
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center">
        <router-link tag="a" :to="{ name: 'tester.project-submission', params: {id: $route.params.id } }" class="btn text-uppercase text-center green-btn d-block d-sm-inline-block mr-sm-2" >not satisfied, want to change</router-link>
        <a @click="reviewProject" class="btn text-uppercase text-center green-btn d-block d-sm-inline-block">Submit</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DeviceSelector from "components/components/device-selector";
import Steps from "components/components/publisher/steps";
import TestProjectDetails from "components/components/tester/test-project-details";
import ProjectStatusTestProject from "components/components/tester/project-status-test-project";
import { testProjectStatusWeight } from "src/services/test-project";
import ProjectTestingProcessReview from "components/components/project-testing-process-review";
import { isLoggedIn } from "src/services/auth";
export default {
  name: "project_submission",
  components: {
    DeviceSelector,
    Steps,
    TestProjectDetails,
    ProjectStatusTestProject,
    ProjectTestingProcessReview
  },
  data() {
    return {
      testProject: {},
      lastestStatusData: {},
      user: {},
      projectTester: {},
      steps: [
        { id: 1, name: "New" },
        { id: 2, name: "Accepted/Working" },
        { id: 3, name: "Under Review" },
        { id: 4, name: "Completed" }
      ]
    };
  },
  mounted: function() {
    axios
      .get(`/api/tester/user/${this.$route.params.id}`)
      .then(({ data: { data } }) => {
        this.projectTester = data;
      })
      .catch(function(error) {});
    axios
      .get(`/api/projects/${this.$route.params.id}`)
      .then(({ data: { data } }) => {
        this.testProject = data;
        this.lastestStatusData = this.projectTester.latest_status_data
          ? this.projectTester.latest_status_data
          : {};
        this.testProject.selected_devices = data.devices.map(({ id }) => id);
        this.testProject.project_description = this.testProject.selected_devices.replace(
          /\r?\n/g,
          "<br>"
        );
      })
      .catch(function(error) {});
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
  methods: {
    reviewProject: function() {
      this.$swal({
        title: "Are you sure?",
        text: "You want to submit this project for review",
        icon: "warning",
        buttons: true
      }).then(willDelete => {
        if (willDelete) {
          axios
            .post(`/api/tester/update-test-status/${this.$route.params.id}`, {
              test_status: "SUBMITTED"
            })
            .then(response => {
              if (response.data.success) {
                // reload user data to track actual progress
                isLoggedIn();
                this.$router.push({ name: "tester.dashboard" });
              }
            })
            .catch(function(error) {});
        }
      });
    }
  }
};
</script>
<style scoped>
.border-row-bottom {
  border-bottom: 1px solid #797979 !important;
}
.border-bottom {
  border-bottom: 1px solid #ccc;
}
@media only screen and (min-width: 768px) {
  .border-right {
    border-right: 1px solid #ccc;
  }
}
.progress-o {
  background-color: rgba(204, 204, 204, 1);
  border: none;
  height: 5px;
  width: 20px;
}
.progress-rectangle {
  background-color: #f5a022;
  border: none;
  height: 5px;
  width: 20px;
}
.btn {
  border-radius: 0;
}
.font-12 {
  font-weight: 400;
  font-style: normal;
  font-size: 12px;
}
.font-14 {
  font-weight: 400;
  font-style: normal;
  font-size: 14px;
}
.font-bold-16 {
  font-weight: 700;
  font-style: normal;
  font-size: 16px;
}
.font-bold-18 {
  font-weight: 700;
  font-style: normal;
  font-size: 18px;
}
.font-bold-20 {
  font-weight: 700;
  font-style: normal;
  font-size: 20px;
}
.font-bold-24 {
  font-weight: 700;
  font-style: normal;
  font-size: 20px;
}
.font-bold-48 {
  font-weight: 700;
  font-style: normal;
  font-size: 48px;
}
.font-title-color {
  color: #666699;
}
.font-amount-color {
  color: #990000;
}
.font-amount-color-1 {
  color: #003399;
}
.font-amount-color-2 {
  color: #009933;
}
</style>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";
.custom-container {
  max-width: 100%;
}
.text-bold {
  font-family: $font-family-brandon-bold !important;
}
.text-medium {
  font-family: $font-family-brandon-medium;
}
.text-blue {
  color: #0082cc;
}
.page-title {
  font-family: $font-family-UniNeue-bold;
  font-size: 30px;
  width: 100%;
  text-align: center;
  color: #363e48;
  margin: 5px 0 25px;
}
.test-proj-fillup-page {
  width: 100%;
}
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
  .proj-name-wrap {
    // padding-bottom: 30px;
    .proj-name {
      font-family: $font-family-UniNeue-bold;
      font-size: 24px;
      line-height: 18px;
      color: #2cac3d;
    }
  }
  .proj-status {
    padding: 0;
    padding-top: 8px;
    overflow: hidden;
    width: calc(100% / 5);
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
      &::after {
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
  .project-link {
    color: #2cac3d;
    text-decoration: underline !important;
  }
}
.green-btn {
  width: auto;
  min-width: 130px;
  padding: 7px 10px;
  border: 2px solid #118921;
  background-color: #2cac3d;
  font-size: 14px;
  font-family: $font-family-brandon-medium;
  letter-spacing: 0.05rem;
  color: #fff !important;
  margin: 15px auto;
  border-radius: 20px;
  &:hover {
    background-color: #158f25;
    color: #fff !important;
  }
}
@media screen and(max-width:1281px) {
  .white-box {
    .proj-detail {
      max-width: 65%;
      margin: 20px auto 0;
    }
  }
}
@media screen and(max-width:991px) {
  .white-box {
    padding: 15px;
    .block-title {
      .badge-wrap {
        right: 0;
        top: 0;
      }
    }
    .proj-name-status {
      font-size: 18px;
    }
  }
}
@media screen and(max-width:767px) {
  .white-box {
    .block-title {
      font-size: 18px;
    }
    .proj-name-status {
      font-size: 16px;
    }
    .proj-status.active {
      span {
        display: block !important;
      }
    }
  }
}
@media screen and(max-width:575px) {
  .white-box {
    .proj-name-wrap {
      padding-bottom: 40px;
    }
    .block-title {
      font-size: 18px;
      .badge-wrap {
        position: relative;
        width: 100%;
        float: left;
        margin-top: 5px;
      }
    }
    .proj-name-status {
      font-size: 14px;
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
    .proj-status.active,
    .proj-status.done-step {
      .proj-progress {
        i {
          font-size: 28px;
          &::after {
            height: 13px;
            width: 13px;
            left: 6px;
            top: 5px;
          }
        }
      }
    }
  }
  .green-btn {
    max-width: 290px;
    padding: 7px;
    font-size: 12px;
  }
}
</style>