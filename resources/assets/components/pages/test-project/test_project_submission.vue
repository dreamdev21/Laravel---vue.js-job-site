<template>
  <div>
    <div class="container custom-container">
      <div class="row">
        <div class="col-md-12">
          <div v-if="isAcceptedOrRejected" class="text-medium text-center orange-info mb-3">
            Project {{ this.testStatus.name == "Test Passed" ? 'approved' : 'rejected' }} on {{this.testStatus.created_at | datetime }}
          </div>
          <div v-else-if="projectTester.tester" class="text-medium text-center orange-info mb-3">
            {{ projectTester.tester.first_name+' '+projectTester.tester.last_name | firstUppercase}} has {{ projectTester.latest_status_data.name }} the project on {{ projectTester.latest_status_data.created_at | datetime }}
          </div>
        </div>
      </div>
      
      <div class="">
        <AdminTestProjectDetails :testProject="testproject" :currentTestStatus="currentTestStatus"> </AdminTestProjectDetails>
        
        <div class=""  v-if="Object.keys(projectTester).length">
          <project-testing-process-review :testerId=testerId :projectId=projectId></project-testing-process-review>
        </div>
        

        <div class="col-md-12 text-center" v-if="!isAcceptedOrRejected">
          <!-- <a href="javascript:;" @click.prevent="rejectProjectSubmission(testproject)" class="btn red-btn text-white">
            Reject 
          </a> -->
          <a href="javascript:;" v-b-modal.rejectModal class="btn red-btn text-white">
            Reject 
          </a>
          <a href="javascript:;" @click="acceptProjectSubmission(testproject)" class="btn purple-btn text-white">
            Accept
          </a>
          <router-link :to="{ name: 'admin.test_project.moderate'}" tag="a" class="btn grey-btn text-white">
            Back to Moderate Test projects
          </router-link>
        </div>
      </div>
    </div>
    <b-modal ref="rejectModal" id="rejectModal" class="reject-modal">

      <!-- <b-modal id="modalPrevent" ref="modal" title="Submit your name" @ok="handleOk" @shown="clearName">
        <form @submit.stop.prevent="handleSubmit">
          <b-form-input type="text" placeholder="Enter your name" v-model="name"></b-form-input>
        </form>
      </b-modal> -->

      <h1 class="text-left text-medium">Are you sure?</h1>
      <h5>Are you sure want to Reject ?</h5>
      <!-- <div id="scroll-top" > -->
        <vue-form class="form-validation" :state="formstate" @submit.prevent="onSubmit">
          <validate tag="div">
            <textarea v-model="rejectReason" type="text" name="rejectReason" class="form-control" required autofocus placeholder="Please enter reason fo reject" rows="3"></textarea>
            <field-messages name="rejectReason" show="$invalid && $submitted" class="text-danger">
              <div slot="required">Please enter reason for rejection</div>
            </field-messages>
          </validate>
          <div class="text-right mt-3">
            <button class="btn grey-btn mr-2" @click="hideModal">Cancel</button>
            <button class="btn blue-btn" type="submit">Ok</button>
          </div>
        </vue-form>
      <!-- </div> -->

    </b-modal>
  </div>
</template>

<script>
import Vue from "vue";
import VueForm from "vue-form";
import options from "src/validations/validations.js";
import moment from "moment";
import DeviceSelector from "components/components/device-selector";
import AdminTestProjectDetails from "components/components/admin/test-project";
import FileViewer from "components/components/publisher/file-viewer";
import ProjectTestingProcessReview from "components/components/project-testing-process-review";
import {TimeFilter} from "src/services/filter";
Vue.filter('times', TimeFilter);
Vue.use(VueForm, options);
// validation jump
var VueScrollTo = require('vue-scrollto');
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
  name: "project_view",
  components: {
    AdminTestProjectDetails,
    DeviceSelector,
    FileViewer,
    ProjectTestingProcessReview
  },
  data() {
    return {
      formstate: {},
      testproject: {},
      projectTester: {},
      testStatus: {},
      isAcceptedOrRejected: false,
      testerId: 0,
      projectId: 0,
      rejectReason: ''
    };
  },
  methods: {
    hideModal () {
      this.$refs.rejectModal.hide()
    },
    onSubmit: function() {
      if (!this.formstate.$invalid) {
         this.$refs.rejectModal.hide()
      } 
    },
    getProjectTester(){
      axios
        .get(`/api/project-tester/${this.$route.params.id}`)
        .then(({ data:  data }) => {
          this.projectTester = data.data;
          this.testproject = this.projectTester.project;
          this.testerId = this.projectTester.tester_id;
          this.projectId = this.projectTester.project_id;
          this.testproject.selected_devices = data.devices.map(({ id }) => id);
          this.testproject.project_description = this.testproject.project_description.replace(/\r?\n/g, '<br>');
        })
        .catch(function(error) {});
    },
    getProject() {
      // axios
      //   .get(`/api/projects/${this.$route.params.id}`)
      //   .then(({ data: { data } }) => {
      //     this.testproject = data;
      //     this.testproject.selected_devices = data.devices.map(({ id }) => id);
      //     this.testproject.project_description = this.testproject.project_description.replace(/\r?\n/g, '<br>');
      //   })
      //   .catch(function(error) {});
    },
    getTestStatus(){
      axios
        .get(`/api/test-status/${this.$route.params.id}`)
        .then(({ data: data }) => {
          if( Object.keys(data.status).length && (data.status.name == "Test Passed" || data.status.name == "Test Failed" ))
            this.isAcceptedOrRejected = true;
            this.testStatus = data.status;
        })
        .catch(function(error) {});
    },
    changeStatus(project, status) {
      return axios
        .post(`/api/test/${project.id}/status`, {
          status
        })
        .then(() => this.$router.push({ name: "admin.test_project.moderate"}) );
    },
    acceptProjectSubmission(project) {
        this.$swal({
        title: "Are you sure?",
        text: "Are you sure you want to Approve?",
        icon: "warning",
        buttons: true
      }).then(willDelete => {
        if (willDelete) {
        return this.changeStatus(project, "TEST_PASSED");
        }
      });
     
    },
    rejectProjectSubmission(project) {
      this.$swal({
        title: "Are you sure?",
        text: "Are you sure you want to Reject?",
        buttons: true,
        content: 'input',
        inputPlaceholder: 'Please enter reason for reject',
        customClass: 'rejectSwal'
      }).then(willDelete => {
        if (willDelete) {
          return this.changeStatus(project, "TEST_FAILED");
        }
      });
    }
  },
  mounted: function() {
    this.getProjectTester();
    this.getTestStatus();
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
      return "New";
    },
  }
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";
.text-medium {
  font-family: $font-family-brandon-medium;
}
.orange-info {
  color: #fff;
  background-color: #ff7802;
  border-radius: 4px;
  padding: 10px;
  font-size: 16px;
}


.custom-container{
  max-width: 100%;
  padding: 0;
  .text-green{
    color: #2cac3d;
  }
  .text-red{
    color: #e63423;
  }
  .text-yellow{
    color: #ffcc00;
  }
  .text-purple{
    color: #3e3a94;
  }
  .text-bold{
    font-family: $font-family-brandon-bold !important;
  }
  .text-medium{
    font-family: $font-family-brandon-medium;
  }
  .purple-btn{
    background-color: #5651b9;
    border: 2px solid #3e3a94;
    color: #fff;
    font-size: 15px;
    line-height: 16px;
    font-family: $font-family-brandon-medium;
    border-radius: 6px;
    padding: 7px 10px;
    -webkit-transition: all 0.4s ease;
    -moz-transition: all 0.4s ease;
    -o-transition: all 0.4s ease;
    -ms-transition: all 0.4s ease;
    transition: all 0.4s ease;
    min-width: 160px;
    display: inline-block;
    min-height: 35px;
    margin-right: 10px;
    &:hover{
      outline: none !important;
      background-color: #3e3a94;
    }
    &:focus{
      outline: none !important;
    }
  }
  .red-btn{
    color: #fff;
    font-size: 15px;
    line-height: 16px;
    font-family: $font-family-brandon-medium;
    border-radius: 6px;
    padding: 7px 10px;
    min-width: 160px;
    display: inline-block;
    min-height: 35px;
    margin-right: 10px;
    &:hover{
      outline: none !important;
      background-color:  #940000;
    }
    &:focus{
      outline: none !important;
    }
  }
  .grey-btn{
    background-color: #898a8c;
    border: 2px solid #7a7b7d;
    color: #fff;
    font-size: 15px;
    line-height: 16px;
    font-family: $font-family-brandon-medium;
    border-radius: 6px;
    padding:7px 10px;
      min-width: 160px;
    -webkit-transition: all 0.4s ease;
    -moz-transition: all 0.4s ease;
    -o-transition: all 0.4s ease;
    -ms-transition: all 0.4s ease;
    transition: all 0.4s ease;
    display: inline-block;
    min-height: 35px;
    margin-right: 10px;
    &:hover{
      outline: none !important;
      background-color: #7a7b7d;
    }
    &:focus{
      outline: none !important;
    }
  }
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
        border: 1px solid #3e3a94;
        background-color: #5651b9;
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
    .proj-name-wrap{
      // padding-bottom: 30px;
      .proj-name{
        font-family: $font-family-UniNeue-bold;
        font-size: 24px;
        line-height: 18px;
        color: #3e3a94;
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
    .graph-wrap{
      margin-top: 25px;
      .graph-title{
        font-size: 17px;
        color: #606368;
        font-family: $font-family-UniNeue-bold;
        padding-left: 40px;
      }
      .graph-img{
        margin: 0 auto;
        display: block;
      }
    }
    .graph-wrap.border-right{
      border-right: 1px solid #dadada;
    }
    .green-outline-badge{
      color: #2cac3d;
      border: 1px solid #2cac3d;
    }
    .outline-badge{
      padding: 3px 20px 3px 20px;
      border-top-left-radius: 16px;
      border-bottom-left-radius: 16px;
      font-family: "BrandonTextBold";
      border-right: none;
      font-size: 15px;
      float: right;
      margin-right: -20px;
      margin-top: 10px;
    }
    .testers-wrap{
      border-bottom: 1px solid #dadada;
      margin-bottom: 15px;
      .tester-name{
        font-size: 18px;
        color: #363e48;
        font-family: $font-family-brandon-bold !important;
        margin-bottom: 10px;
      }
      span{
        i{
          font-size: 20px;
        }
      }
      &:last-child{
        border-bottom: none;
        margin-bottom: 0;
      }
    }
    .activities-wrap{
      padding: 10px 0;
      border-bottom: 1px solid #dadada;
      &:last-child{
        border-bottom: none;
        padding-bottom: 0;
      }
    }
    .project-block-wrap{
      margin-top: 5px;
      font-family: $font-family-brandon-regular;
      font-size: 16px;
      color: #606368;
      position: relative;
      p{
        margin-bottom: 25px;
      }
      a{
        color: #14c1bf;
        text-decoration: underline !important;
      }
      .proj-amt{
        font-size: 25px; 
        font-family: $font-family-brandon-black;
      }
      .tester-amt{
        font-family: $font-family-brandon-black;
        font-size: 50px;
      }
      .form-group{
        max-width: 80%;
        margin: 0 auto;
        display: block;
      }
      .amt-block-wrap{
        position: relative;
        border-right: 1px solid #dadada;
      }
    }
  }
}
@media screen and(max-width:1199px) {
   .custom-container{
     .white-box{
        .project-block-wrap{
          p{
            margin-bottom: 15px;
          }
          .proj-amt{
            font-size: 22px;
          }
          .form-group{
            margin: 0;
            max-width: 50%;
          }
          .tester-amt{
            font-size: 44px;
          }
        }
     }
     .red-btn{
       min-width: 120px;
     }
     .grey-btn{
       min-width: 120px;
     }
     .purple-btn{
       min-width: 120px;
     }
   }
}

@media screen and(max-width:1112px) {
  .custom-container{
    .white-box{
      .proj-name-wrap{
        .proj-name{
          font-size: 20px;
        }
      }
      .outline-badge{
        padding: 3px 10px 3px 10px;
      }
      .graph-wrap{
        .graph-title{
          font-size: 15px;
          padding-left: 20px;
        }
      }
       .project-block-wrap{
          .proj-amt{
            font-size: 20px;
          }
          .tester-amt{
            font-size: 40px;
          }
        }
    }
  }
}
@media screen and(max-width:991px) {
  .custom-container{
    .white-box{
      padding: 15px;
      .block-title{
        font-size: 16px;
        .badge-wrap{
          right: 0;
        }
      }
      .outline-badge{
        margin-right: -15px;
        font-size: 14px;
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
    .white-box{
      .outline-badge{
        margin-right: 0;
        font-size: 14px;
        float: left;
        border-bottom-right-radius: 16px;
        border-right: 1px solid;
        border-top-right-radius: 16px;
        border-bottom-left-radius: 0;
        border-top-left-radius: 0;
        border-left: 0;
        margin-left: -15px;
        margin-bottom: 15px;
        margin-top: 0;
      }
      .activities-wrap{
        padding: 10px 0 30px;
      }
      .project-block-wrap{
        .amt-block-wrap{
          border-right: none;
        }
      }
    }
    .purple-btn,.grey-btn,.red-btn{
      font-size: 14px;
      min-width: 100px;
      margin-right: 10px;
      padding: 5px;
      min-height: 30px;
    }
  }
}
@media screen and(max-width:575px) {
  .custom-container{
    .grey-btn,.purple-btn,.red-btn{
      display: inline-block;
      margin: 10px auto 0 10px;
      max-width: 150px;
    }
    .grey-btn{
      max-width: 100%;
    }
    .white-box{
      .outline-badge{
        padding: 0 10px 0 10px;
      }
      
      .proj-name-wrap{
        font-size: 16px;
        padding-bottom: 55px;
        .proj-name{
          font-size: 18px;
          width: 100%;
          float: left;
          position: relative;
          margin-bottom: 10px;
        }
      }
      .block-title{
        .badge-wrap{
          right: 0;
          position: relative;
          width: 100%;
          float: left;
          left: 0;
          border-bottom-right-radius: 16px;
          border-bottom-left-radius: 0;
          border-top-right-radius: 16px;
          border-top-left-radius: 0;
          margin-left: -15px;
          font-size: 14px;
        }
      }
    }
  }
}
</style>