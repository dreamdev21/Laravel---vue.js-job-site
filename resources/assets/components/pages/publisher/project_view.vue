<template>
  <div>
    <div class="white-box">
      <div class="row">
        <div class="col-12">
          <div class="row">
            <div class="col-3 text-center proj-status done-step">
              <p class="proj-progress">
                <i class="fa fa-circle-thin"></i>
              </p>
              <span class="d-none d-md-block text-medium">Submitted</span>
            </div>
            <div class="col-3 text-center proj-status active">
              <p class="proj-progress">
                <i class="fa fa-circle-thin"></i>
              </p>
              <span class="d-none d-md-block text-medium">Waiting for Approval</span>
            </div>
            <div class="col-3 text-center proj-status">
              <p class="proj-progress">
                <i class="fa fa-circle-thin"></i>
              </p>
              <span class="d-none d-md-block text-medium">Pay</span>
            </div>
            <div class="col-3 text-center proj-status">
              <p class="proj-progress">
                <i class="fa fa-circle-thin"></i>
              </p>
              <span class="d-none d-md-block text-medium">Ready to Test</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="white-box">
      <div class="row">
        <div class="col-12 text-center">
          <h2 class="text-blue text-bold proj-title-name">
             {{testproject.name}}
          </h2>
          <p class="proj-name-status text-bold">
              Waiting for approval
          </p>
          <p class="proj-detail">You will be notified when your project is approved for testing.
          <!-- Project Posted on : {{ testproject.created_at | datetime }} -->
          </p>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-12 text-right mb-4">
            <router-link :to="{'name': 'publisher.projects'}" class="grey-btn mr-1 mr-sm-3 back-proj-btn d-inline-block">Back to Projects</router-link>
            <router-link :to="{'name': 'publisher.project.edit'}" class="grey-btn mr-1 mr-sm-3 back-proj-btn d-inline-block">Edit Project</router-link>
            <a href="#" class="red-btn cancel-btn d-inline-block" v-on:click="deleteProject">Cancel Project</a>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="white-box">
          <h4 class="block-subtitle">
                Basic Information
          </h4>
          <div class="row pb-3 pb-md-4">
            <div class="col-md-5">
              <div class="mb-1">
                <span class="text-bold">
                   Title :
                </span>
                <span class="">
                  {{testproject.name}}
                </span>
              </div>
              <div class="mb-1">
                <span class="text-bold">
                   Type :
                </span>
                <span class="">
                  {{type_name}}
                </span>
              </div>
              <div class="mb-1">
                <span class="text-bold">
                   Total Amount :
                </span>
                <project-cost-calculator v-if="testproject.id" :projectId="testproject.id" :testers="+testproject.tester_needed">
                  <span slot-scope="{calculation}">
                    <span class="text-bold text-red"> $ {{calculation.total_cost}}</span>
                    <span class="">({{testproject.tester_needed}} testers x ${{calculation.per_tester_cost}}/tester)</span>
                  </span>
                </project-cost-calculator>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-1">
                <span class="text-bold">
                  Start Date :
                </span>
                <span class="">
                  {{testproject.start_date | date}}
                </span>
              </div>
              <div class="mb-1">
                <span class="text-bold">
                  End Date :
                </span>
                <span class="">
                  {{testproject.end_date | date}}
                </span>
              </div>
              <div class="mb-1">
                <span class="text-bold">
                  Request for approval sent on :
                </span>
                <span class="">
                  30 Mar 2018 10:49 AM
                </span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="mb-1">
                <span class="text-bold">Time Needed to Test : </span>
                <span class="">
                  {{testproject.estimate_tester_time | times}}
                </span>
              </div>
              <div class="mb-1">
                <span class="text-bold">
                  Tester Needed :
                </span>
                <span>
                  {{testproject.tester_needed}}
                </span>
              </div>
            </div>
          </div>
          <h4 class="block-subtitle">
              Project Description
          </h4>
          <div class="">
            <div class="row">
              <div class="col-md-12 pb-3">
                  <p v-html="this.testproject.project_description"></p>
              </div>
              <div class="col-md-6 pt-3">
                  <div class="form-group">
                      <h4 class="block-subtitle">
                          Links
                      </h4>
                      <div class="row">
                          <div class="col-md-12 col-12">
                              <ul class="pl-0 mb-2">
                                  <li v-for="link in testproject.links" :key="link.id">
                                    {{link.title}}:  <a :href="link.link" target="_blank" > {{ link.link }}</a>
                                    <!-- <a :href="val.link" class="project-link" target="_blank">{{ val.link }}</a> -->
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-6 pt-3">
                <div class="form-group">
                    <h4 class="block-subtitle">
                        Files
                    </h4>
                    <file-viewer :files="testproject.media"></file-viewer>
                </div>
              </div>
              <div class="col-md-6 col-12 pt-3">
                  <div class="form-group">
                      <h4 class="block-subtitle">
                          Notes / Instruction
                      </h4>
                      <div class="">
                          {{this.testproject.notes_instruction}}
                      </div>
                  </div>
              </div>
              <div class="col-md-6 col-12 pt-3">
                <h4 class="block-subtitle">
                    Required Devices
                </h4>
                <div class="">
                  <device-selector disabled v-model="testproject.selected_devices"></device-selector>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="white-box">
            <h4 class="block-title">
                Questions
            </h4>
            <div class="">
                <div class="form-group">
                    <p>
                        Your Questions to Testers which they have to fil up while submitting test Result
                    </p>
                    <ul v-for="(ques, index) in this.testproject.questions" class="pl-0 mb-3">
                        <li>
                            <span class="text-bold mr-2">
                                Question {{ index + 1 }} :
                            </span>
                              {{ ques.question }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <project-statistics v-if="testproject.status && testproject.status.name != 'Pending Approval' " :errors="errors" v-model="testproject" ></project-statistics>
      </div>
    </div>
  </div>
</template>

<script>
import DeviceSelector from "components/components/device-selector";
import ProjectStatistics from "components/components/project-statistics";
import ProjectCostCalculator from "components/components/project-cost-calculator";
import FileViewer from "components/components/publisher/file-viewer";
import Vue from "vue";
import { TimeFilter } from "src/services/filter";
Vue.filter("times", TimeFilter);
export default {
  name: "view_project",
  components: {
    DeviceSelector,
    ProjectStatistics,
    FileViewer,
    ProjectCostCalculator
  },
  data() {
    return {
      testproject: {},
      formstate: {},
      model: {},
      originalUser: {},
      type_name: "",
      errors: null
    };
  },
  mounted: function() {
    axios
      .get(`/api/projects/${this.$route.params.id}`)
      .then(({ data: { data } }) => {
        this.testproject = data;
        this.type_name = this.testproject.project_type.name;
        this.testproject.selected_devices = data.devices.map(({ id }) => id);
        this.testproject.project_description = this.testproject.project_description.replace(/\r?\n/g, '<br \>');
      })
      .catch(function(error) {});
  },
  methods: {
    deleteProject: function() {
      this.$swal({
        title: "Are you sure you want to Cancel this project?",
        // text: "Are you sure you want to Cancel this project?",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          return axios
            .delete(`/api/projects/${this.$route.params.id}?test=0`)
            .then(response => {
              this.$router.push({ name: "publisher.projects" });
              })
            .catch(e => (this.errors = e.response.message));
        }
      });
    }
  }
};
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
.white-box {
  .block-title {
    font-size: 18px;
    font-family: $font-family-UniNeue-bold;
    border-bottom: 1px solid #dadada;
    color: #606368;
    padding-bottom: 10px;
    margin-bottom: 10px;
    width: auto;
  }
  .block-subtitle {
    font-size: 18px;
    font-family: $font-family-brandon-bold !important;
    border-bottom: 1px solid #dadada;
    color: #606368;
    padding-bottom: 10px;
    margin-bottom: 10px;
    width: auto;
  }
  .proj-name-wrap {
    // padding-bottom: 30px;
    .proj-name {
      font-family: $font-family-UniNeue-bold;
      font-size: 24px;
      line-height: 18px;
      color: #0082cc;
    }
  }
  .project-link {
    color: #0082cc;
    text-decoration: underline !important;
  }
  .proj-title-name {
    font-size: 40px;
    font-family: $font-family-brandon-bold !important;
    text-decoration: underline;
  }
  .proj-name-status {
    font-family: $font-family-brandon-bold !important;
    font-size: 20px;
    color: #00aff5;
    text-decoration: none !important;
  }
  .proj-detail {
    max-width: 45%;
    line-height: 26px;
    margin: 20px auto;
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
    color: #0082cc;
    .proj-progress {
      i {
        color: #0082cc;
        font-size: 34px;
        line-height: 24px;
        position: relative;
        &::after {
          height: 15px;
          width: 15px;
          background-color: #0082cc;
          content: "";
          border-radius: 50%;
          position: absolute;
          left: 7px;
          top: 4px;
        }
      }
      &::before {
        background-color: #0082cc;
      }
    }
  }
  .proj-status.done-step {
    color: #0082cc;
    .proj-progress {
      i {
        color: #0082cc;
        font-size: 34px;
        line-height: 24px;
        position: relative;
        &::after {
          height: 15px;
          width: 15px;
          background-color: #0082cc;
          content: "";
          border-radius: 50%;
          position: absolute;
          left: 7px;
          top: 4px;
        }
      }
      &::before {
        background-color: #0082cc;
      }
      &::after {
        background-color: #0082cc;
      }
    }
  }
}
.back-proj-btn {
  max-width: 180px;
}
.cancel-btn {
  max-width: 180px;
}
.grey-btn {
  width: auto;
  padding: 10px 12px;
  border-radius: 20px;
  display: block;
  text-align: center;
}
.red-btn {
  width: auto;
  padding: 7px 15px;
  color: #fff;
  border-radius: 20px;
  display: block;
}
@media screen and(max-width:1281px) {
  .white-box {
    .proj-title-name {
      font-size: 34px;
    }
    .proj-detail {
      max-width: 65%;
      margin: 20px auto 0;
    }
  }
}
@media screen and(max-width:991px) {
  .white-box {
    .proj-title-name {
      font-size: 32px;
    }
    .proj-name-status {
      font-size: 18px;
    }
  }
}
@media screen and(max-width:767px) {
  .white-box {
    .proj-title-name {
      font-size: 30px;
    }
    .proj-name-status {
      font-size: 16px;
    }
    .proj-detail {
      line-height: 22px;
    }
    .proj-status.active {
      span {
        display: block !important;
      }
    }
  }
}
@media screen and(max-width:575px) {
  .cancel-btn,
  .back-proj-btn {
    font-size: 12px;
    padding: 6px;
  }
  .white-box {
    .block-title {
      font-size: 18px;
    }
    .proj-title-name {
      font-size: 22px;
    }
    .proj-name-status {
      font-size: 14px;
    }
    .proj-detail {
      max-width: 100%;
      line-height: 22px;
      margin: 10px auto 0;
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
}
@media screen and(max-width:360px) {
  .cancel-btn,
  .back-proj-btn {
    font-size: 11px;
    padding: 4px;
  }
}
</style>
