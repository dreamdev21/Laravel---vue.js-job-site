<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div v-if="isProjectApproved" class="text-medium text-center orange-info mb-3">
          Project approved on {{testproject.status.created_at | datetime }}
        </div>
        <div class="text-medium text-center orange-outline-info mb-3 d-none">
          status = waiting for approval
        </div>
        <div class="text-medium text-center green-info mb-3 d-none">
          Project is completed on {{testproject.end_date | date}}
        </div>
        <div class="white-box">
          <div class="row">
            <div class="col-12">
              <h4 class="block-title">
                Basic Information
              </h4>
            </div>
          </div>

          <div class="row pb-3 pb-md-4">
            <div class="col-md-5">
              <div class="mb-1">
                <span class="d-block d-sm-inline-block align-middle text-bold">
                  Publisher Name :
                </span>
                <span class="d-block d-sm-inline-block align-middle">
                  {{ publisher_name }}
                </span>
              </div>
              <div class="mb-1">
                <span class="d-block d-sm-inline-block align-middle text-bold">
                   Title :
                </span>
                <span class="d-block d-sm-inline-block align-middle">
                  {{ this.testproject.name }}
                </span>
              </div>
              <div class="mb-1">
                <span class="d-block d-sm-inline-block align-middle text-bold">
                   Type :
                </span>
                <span class="d-block d-sm-inline-block align-middle">
                  {{type_name}}
                </span>
              </div>
              <div class="mb-1">
                <span class="d-block d-sm-inline-block align-middle text-bold">
                   Total Amount :
                </span>
                <project-cost-calculator v-if="testproject.id" :projectId="testproject.id" :testers="+testproject.tester_needed">
                  <span slot-scope="{calculation}" class="d-block d-sm-inline-block align-middle">
                    <span class="text-bold text-red"> $ {{calculation.total_cost}}</span>
                    <span class="">({{testproject.tester_needed}} testers x ${{calculation.per_tester_cost}}/tester)</span>
                  </span>
                </project-cost-calculator>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-1">
                <span class="d-block d-sm-inline-block align-middle text-bold">
                  Start Date :
                </span>
                <span class="d-block d-sm-inline-block align-middle">
                  {{testproject.start_date | date}}
                </span>
              </div>
              <div class="mb-1">
                <span class="d-block d-sm-inline-block align-middle text-bold">
                  End Date :
                </span>
                <span class="d-block d-sm-inline-block align-middle">
                  {{testproject.end_date | date}}
                </span>
              </div>
               <div class="mb-1">
                <span class="d-block d-sm-inline-block align-middle text-bold">
                  Request for approval sent on :
                </span>
                <span class="d-block d-sm-inline-block align-middle">
                 30 Mar 2018 10:49 AM
                </span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="mb-1">
                <span class="d-block d-sm-inline-block align-middle text-bold">
                  Time Needed to Test :
                </span>
                <span class="d-block d-sm-inline-block align-middle">
                  {{testproject.estimate_tester_time | times}}
                </span>
              </div>
              <div class="mb-1">
                <span class="d-block d-sm-inline-block align-middle text-bold">
                  Tester Needed :
                </span>
                <span class="d-block d-sm-inline-block align-middle">
                  {{testproject.allocated_tester || testproject.tester_needed}}
                </span>
              </div>
            </div>
          </div>

          <div class="row pb-3 pb-md-4">
            <div class="col-12">
              <h4 class="block-title">
                Project Description
              </h4>
              <p v-html="this.testproject.project_description"></p>
            </div>
          </div>

          <div class="row pb-3 pb-md-4">
            <div class="col-md-6 pb-md-0 pb-3">
              <h4 class="block-title">
                  Links
              </h4>
              <div class="mb-1" :key="val.link" v-for="val in testproject.links">
                <span class="d-block d-sm-inline-block align-middle text-bold">
                  {{ val.title }} :
                </span>
                <span class="d-block d-sm-inline-block align-middle">
                  <a :href="val.link" target="_blank">{{ val.link }}</a>
                </span>
              </div>
            </div>
            <div class="col-md-6">
               <h4 class="block-title">
                  Files
              </h4>
              <file-viewer :files="testproject.media"></file-viewer>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 pb-md-0 pb-3">
              <h4 class="block-title">
                  Notes / Instruction
              </h4>
              <div class="mb-1">
                {{this.testproject.notes_instruction}}
              </div>
            </div>
            <div class="col-md-6">
               <h4 class="block-title">
                  Required Devices
              </h4>
              <device-selector disabled v-model="testproject.selected_devices"></device-selector>
            </div>
          </div>
        </div>

        <div class="white-box">
          <div class="row">
            <div class="col-12">
               <h4 class="block-title">
                  Questions
              </h4>
              <p>
                Your Questions to Testers which they have to fill up while submitting test Result
              </p>
              <div class="mb-1" :key="index" v-for="(ques, index) in testproject.questions">
                <span class="text-bold">Question {{ index + 1 }} : </span>
                <span class="text-medium"> {{ ques.question }}</span>
              </div>
            </div>
          </div>
        </div>
        <project-cost v-if="testproject.id" :errors="errors" :disabled="isProjectApproved" v-model="testproject"></project-cost>
        <!------- Statistics Section -->
        <project-statistics v-if="isProjectRunning || isProjectCompleted" :errors="errors" v-model="testproject" @onCompleted="projectCompleted"></project-statistics>
        <project-tester-ratings :exclude="ratedUsers" v-if="isProjectCompleted" :project="testproject"></project-tester-ratings>
        <!------- -->
        <div class="col-12 text-center p-0">
            <router-link v-if="isProjectApproved" class="btn grey-btn" :to="{name: 'admin.projects'}">Back to Projects</router-link>
          <span v-if="isProjectApproved">
            <router-link class="btn grey-btn" :to="{name: 'admin.projects'}">Download PDF</router-link>
            <a target="_blank" class="btn purple-btn" @click="btnViewInvoice" >View Invoice</a>
            <a v-if="isProjectRunning || isProjectCompleted" class="btn grey-btn" href="#" >View Testers</a>
          </span>
          <span v-else>
            <p>Publisher will notify for the pending payment. We will inform you once publisher will pay to start project.</p>
            <router-link class="btn grey-btn back-proj-btn" :to="{name: 'admin.projects'}">Back To Project</router-link>
            <router-link class="btn grey-btn back-proj-btn" :to="{name: 'admin.project.edit'}">Edit</router-link>
            <button class="btn purple-btn approve-btn" :class="{disable: isProjectApproved}" type="button" @click="approveProject">Approve</button>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DeviceSelector from "components/components/device-selector";
import ProjectCost from "components/components/project-cost";
import ProjectStatistics from "components/components/project-statistics";
import ProjectTesterRatings from "components/components/project-tester-ratings";
import FileViewer from "components/components/publisher/file-viewer";
import ProjectCostCalculator from "components/components/project-cost-calculator";
import {
  isProjectApproved,
  isProjectCompleted,
  isProjectRunning
} from "src/services/project";
import Vue from "vue";
import { TimeFilter } from "src/services/filter";
Vue.filter("times", TimeFilter);

export default {
  name: "view_project",
  components: {
    DeviceSelector,
    ProjectCost,
    ProjectStatistics,
    ProjectTesterRatings,
    FileViewer,
    ProjectCostCalculator
  },
  data() {
    return {
      testproject: {},
      formstate: {},
      model: {},
      originalUser: {},
      publisher_name: "",
      type_name: "",
      isProjectApproved: false,
      isProjectCompleted: false,
      isProjectRunning: false,
      errors: null,
      ratedUsers: []
    };
  },
  methods: {
    projectCompleted() {
      this.getProject();
    },
    approveProject() {
      const requestData = _.pick(this.testproject, [
        "cost_per_tester",
        "allocated_tester",
        "total_cost",
        "applied_discount",
        "per_tester_admin_decided_cost",
        "name"
      ]);
      requestData.status = "PENDING_PAYMENT";
      this.errors = null;
      return axios
        .put(`/api/projects/${this.testproject.id}`, requestData)
        .then(({ data: { data } }) => {
          this.testproject = data;
          this.isProjectApproved = true;
          this.$router.push({
            name: "admin.project.invoice",
            params: { id: this.testproject.id }
          });
        })
        .catch(error => {
          if (Array.isArray(error.response.data.message)) {
            this.errors = error.response.data.message;
          } else {
            this.errors = [error.response.data.message];
          }
        });
    },
    getProject() {
      axios
        .get(`/api/projects/${this.$route.params.id}`)
        .then(({ data: { data } }) => {
          this.testproject = data;
          this.isProjectApproved = isProjectApproved(data.status.name);
          this.isProjectCompleted = isProjectCompleted(data.status.name);
          this.isProjectRunning = isProjectRunning(data.status.name);
          this.type_name = this.testproject.project_type.name;
          this.publisher_name = this.testproject.publisher.name
            ? this.testproject.publisher.name
            : this.testproject.publisher.first_name +
              " " +
              this.testproject.publisher.last_name;
          this.testproject.selected_devices = data.devices.map(({ id }) => id);
          this.testproject.project_description = this.testproject.project_description.replace(
            /\r?\n/g,
            "<br >"
          );
        })
        .catch(function(error) {});
    },
    btnViewInvoice() {
      let route = this.$router.resolve({
        name: "admin.project.invoice",
        params: { id: this.testproject.id }
      });
      // let route = this.$router.resolve('/link/to/page'); // This also works.
      window.open(route.href, "_blank");

      // this.$router.push();
    }
  },
  mounted: function() {
    this.getProject();
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
  min-width: 85px;
  min-height: 34px;
  margin-right: 15px;
  border-radius: 6px;
}
.approve-btn {
  max-width: 160px;
  min-height: 34px;
  min-width: 110px;
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