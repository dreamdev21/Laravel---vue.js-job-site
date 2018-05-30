<template>
  <div class="bg-color">
    <div class="container custom-container">
      <div class="row">
        <div class="test-proj-fillup-page">
          <div class="white-box">
            <div class="row">
              <!-- <div class="col-12">
                <h4 class="block-title border-bottom-0">
                  Project Status
                </h4>
              </div> -->
              <div class="col-12">
                <Steps :steps="steps" :active="get_project_current_stage" projectTypeClass="test-project"></Steps>
              </div>
            </div>
          </div>
          
          <TestProjectDetails :testProject="testproject" :latestStatusData="lastestStatusData"> </TestProjectDetails>

          <div class="" v-if="isAccpeted || isSubmitted">
            <project-testing-process-review :ratingDisable="true"></project-testing-process-review>
          </div>

          <div class="col-12 text-center">
            <router-link tag="a" :to="{name: 'tester.dashboard'}" class="btn text-uppercase grey-btn"> Back To Dashboard</router-link>
            
            <!-- <a v-if="isSubmitted" :disabled="true" class="btn text-uppercase green-btn">Submitted</a> -->
            <router-link v-if="isAccpeted && !isSubmitted " tag="a" :to="{name: 'tester.project-submission', params:{id: $route.params.id}}" class="btn text-uppercase green-btn">Continue working </router-link>
            <a v-else-if="!isAccpeted && !isSubmitted && !isUnderReview" @click="acceptProject" class="btn text-uppercase green-btn">start working / accept</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import ProjectStatusTestProject from "components/components/tester/project-status-test-project";
import Steps from "components/components/publisher/steps";
import TestProjectDetails from "components/components/tester/test-project-details";
import ProjectTestingProcessReview from "components/components/project-testing-process-review";
import { testProjectStatusWeight } from "src/services/test-project";
export default {
  name: "view_project",
  components: {
    ProjectStatusTestProject,
    TestProjectDetails,
    Steps,
    ProjectTestingProcessReview
  },
  data() {
    return {
      testproject: {},
      user: {},
      projectTester: {},
      isAccpeted: 0,
      isSubmitted: 0,
      isUnderReview: 0,
      lastestStatusData: {},
      steps: [
        { id: 1, name: "New" },
        { id: 2, name: "Accepted/Working" },
        { id: 3, name: "Under Review" },
        { id: 4, name: "Completed" }
      ]
    };
  },
  computed: {
    get_project_current_stage(){
      if(this.projectTester && this.projectTester.latest_status ){
        return testProjectStatusWeight(this.projectTester.latest_status);
      }
      else{
        return 1;
      }
    }
  },
  mounted: function() {
    axios
      .get(`/api/tester/user/${this.$route.params.id}`)
      .then(({ data: { data } }) => {
        this.projectTester = data;
        this.lastestStatusData = this.projectTester.latest_status_data ? this.projectTester.latest_status_data : {};
        this.isUnderReview = this.projectTester.all_status.includes("Review");
        this.isSubmitted = this.projectTester.all_status.includes("Submitted");
        if (!this.isSubmitted) {
          this.isAccpeted = this.projectTester.all_status.includes("Accepted");
        }
      })
      .catch(function(error) {});
    axios
      .get(`/api/projects/${this.$route.params.id}`)
      .then(({ data: { data } }) => {
        this.testproject = data;
        this.testproject.selected_devices = data.devices.map(({ id }) => id);
        this.testproject.project_description = this.testproject.project_description.replace(/\r?\n/g, '<br>');
      })
      .catch(function(error) {});
  },
  methods: {
    acceptProject: function() {
      axios
        .get("/api/tester/test-project-accepted")
        .then( response => {
            if( this.testproject.is_test_project == 0 || ( this.testproject.is_test_project == 1 && response.data.length == 0 ) ){
              axios
                .post(`/api/tester/update-test-status/${this.$route.params.id}`, {
                  test_status: "ACCEPTED"
                })
                .then(response => {
                  if (response.data.success) {
                    this.$router.push({ name: "tester.project-submission" });
                  }
                })
                .catch(function(error) {});
            }else{
              this.$swal({
                title: "Error",
                text: "Test Project already accepted",
                icon: "error"
              });
            }
        })  
        .catch(function(error){})
    },
    submitProject: function() {
      axios
        .post(`/api/tester/update-test-status/${this.$route.params.id}`, {
          test_status: "ACCEPTED"
        })
        .then(response => {
          if (response.data.success) {
            this.$router.push({ name: "tester.project-submission" });
          }
        })
        .catch(function(error) {});
    }
  }
};
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
  .test-proj-fillup-page{
    width: 100%;
    .white-box{
      .block-title{
        font-size: 18px;
        font-family: $font-family-UniNeue-bold;
        border-bottom: 1px solid #dadada;
        color: #606368;
        padding-bottom: 10px;
        margin-bottom: 10px;
        width: auto;
      }
    }
    .green-btn ,.grey-btn{
      width: 100%;
      max-width: 240px;
      padding: 7px 10px;
      color: #fff;
      border-radius: 20px;
      display: inline-block;
      text-align: center;
      margin: 10px 15px 30px 0px;
    }
  }
}
@media screen and(max-width:1281px) {
  .custom-container{
    .test-proj-fillup-page{
      .green-btn{
        font-size: 13px;
      }
    }
  }
}
@media screen and(max-width:1200px) {
  .custom-container{
    .test-proj-fillup-page{
      .green-btn,.grey-btn{
        font-size: 12px;
        letter-spacing: 0;
      }
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
        .block-title{
          .badge-wrap{
            right: 0;
          }
        }
      }
      .green-btn,.grey-btn{
        max-width: 180px;
      }
    }
  }
}
@media screen and(max-width:767px) {
 .custom-container{
    .test-proj-fillup-page{
      .status-bar{
        font-size: 14px;
      }
      .green-btn,.grey-btn{
        margin: 10px 15px 10px 0;
        max-width: 175px;
      }
      .white-box{
        .block-title{
          font-size: 16px;
          margin: 0;
          padding: 0;
        }
      }
    }
 }
}
@media screen and(max-width:575px) {
  .custom-container{
    .step-page-title{
      font-size: 26px;
    }
    .test-proj-fillup-page{
      .white-box{
        line-height: 18px;
        }
      }
  }
}

</style>