<template>
    <div class="container custom-container">
      <div class="row">
        <h1 class="step-page-title">
          Dashboard
        </h1>
        <div class="dashboard-page">
          <div class="row">
            <div class="col-12 col-sm-6 col-lg-3 text-center">
              <div class="white-box proj-summary">
                <h3 class="proj-count">{{aRunningProjects.length}}</h3>
                <p class="proj-status">Running Projects</p>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 text-center">
              <div class="white-box proj-summary">
                <h3 class="proj-count">{{aPendingApprovalProjects.length}}</h3>
                <p class="proj-status">Pending Approvals</p>
              </div>  
            </div>
            <div class="col-12 col-sm-6 col-lg-3 text-center">
              <div class="white-box proj-summary">
                <h3 class="proj-count">0</h3>
                <p class="proj-status">Inbox</p>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 text-center">
              <div class="white-box proj-summary">
                <h3 class="proj-count">$0</h3>
                <p class="proj-status">My spending</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-9 col-sm-8 col-12">
              <div class="status-bar blue-status-bar">
                Welcome! Press post new project to start posting a project
              </div>
            </div>
            <div class="col-md-3 col-sm-4 col-12">
              <router-link :to="{name: 'publisher.project.add'}" class="text-uppercase blue-btn post-btn">post new project</router-link>
            </div>
          </div>
          <div class="white-box">
            <div class="row">
              <div class="col-md-6 col-12">
                <h4 class="block-title">
                  Activities
                </h4>
                <div class="activity-list">
                  <ul v-for="activity_log in this.activity_col1">
                    <li v-if="activity_log.description == 'Sign in'">
                      Sign in - {{activity_log.created_at}}
                    </li>
                    <li v-if="activity_log.description == 'Accepted'">
                      {{activity_log.active_user.first_name}} has accepted '{{activity_log.publisher_project.name}}' - {{activity_log.created_at}}
                    </li>
                    <li v-if="activity_log.description == 'Invoice received'">
                      Invoice received - {{activity_log.created_at}}
                    </li>
                    <li v-if="activity_log.description == 'Payment sent'">
                      Payment sent - {{activity_log.created_at}}
                    </li>
                    <li v-if="activity_log.description == 'Project completed'">
                      Project complete - {{activity_log.created_at}}
                    </li>
                    <!--<li>-->
                      <!--Welcome you can now post the project. - <span class="text-bold">2 Mins ago</span>-->
                    <!--</li>-->
                    <!--<li>-->
                       <!--Sign in - <span class="text-bold">5 Mins ago</span>-->
                    <!--</li>-->
                    <!--<li>-->
                      <!--Sample Activity #1 - <span class="text-bold">10 Mins ago</span>-->
                    <!--</li>-->
                  </ul>
                </div>
              </div>
              <div class="col-md-6 col-12">
                <h4 class="block-title">
                </h4>
                <div class="activity-list">
                  <ul v-for="activity_log in this.activity_col2">
                    <li v-if="activity_log.description == 'Sign in'">
                      Sign in - {{activity_log.created_at}}
                    </li>
                    <li v-if="activity_log.description == 'Accepted'">
                      {{activity_log.active_user.first_name}} has accepted '{{activity_log.publisher_project.name}}' - {{activity_log.created_at}}
                    </li>
                    <li v-if="activity_log.description == 'Invoice received'">
                      Invoice received - {{activity_log.created_at}}
                    </li>
                    <li v-if="activity_log.description == 'Payment sent'">
                      Payment sent - {{activity_log.created_at}}
                    </li>
                    <li v-if="activity_log.description == 'Project completed'">
                      Project complete - {{activity_log.created_at}}
                    </li>
                    <!--<li>-->
                      <!--Sample Activity #2 - <span class="text-bold">18 Mins ago</span>-->
                    <!--</li>-->
                    <!--<li>-->
                      <!--Sample Activity #3 - <span class="text-bold">23 Mins ago</span>-->
                    <!--</li>-->
                    <!--<li>-->
                      <!--Sample Activity #4 - <span class="text-bold">44 Mins ago</span>-->
                    <!--</li>-->
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="white-box">
            <div class="row">
              <div class="col-12">
                <h4 class="block-title">
                  Running Projects
                </h4>
                  <p class="no-proj-desc" v-show="aRunningProjects.length == 0"> You do not have any running projects. Please click on Post New Project button.
                  </p>
              </div>
            </div>
            <project-item :key="testproject.id" :project="testproject" @delete="deleteProject" v-for="testproject in aRunningProjects">
            </project-item>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
  import ProjectItem from "components/components/publisher/project_item";
  export default {
    name: "publisher_projects",
      components: {
      ProjectItem
    },
  data() {
    return {
      aPendingApprovalProjects: [],
      aRunningProjects: [],
      aPendingPaymentProjects: [],
      aCompletedProjects: [],
      formstate: {},
      model: {},
      originalUser: {},
      aDevices: {},
      additional_devices: [],
      project_types: {},
      running_project: "",
      publisher_id: "",
      publisher_name: "",
      activity_logs: [],
      activity_col1: [],
      activity_col2: []
    };
  },
  mounted: function() {
    this.loadProjects();
    this.activitiesLog();
    axios
      .get("/api/devices")
      .then(response => {
        this.aDevices = response.data;
      })
      .then(({ data: { data } }) => this.assignData(data))
      .catch(function(error) {});
    axios
      .get(`/api/tester/${this.$store.state.user.id}`)
      .then(({ data: { data } }) => {
        this.model = data;
      })
      .catch(function(error) {});
    axios
      .get("/api/project-types")
      .then(response => {
        this.project_types = response.data;
      })
      .catch(function(error) {});
    this.originalUser = window.USER;
    if (this.originalUser.name == null) {
      this.originalUser.name = this.originalUser.full_name;
    }
  },
  created: function(){

  },
  methods: {
    loadProjects() {
      axios
        .get(`/api/publisher-projects?publisher_id=${this.$store.state.user.id}`)
        .then(response => {
          let data = response.data;
          this.aPendingApprovalProjects = data.aPendingApprovalProjects
            ? data.aPendingApprovalProjects
            : [];
          this.aRunningProjects = data.aRunningProjects
            ? data.aRunningProjects
            : [];
          this.aPendingPaymentProjects = data.aPendingPaymentProjects
            ? data.aPendingPaymentProjects
            : [];
          this.aCompletedProjects = data.aCompletedProjects
            ? data.aCompletedProjects
            : [];
        })
        .catch(function(error) {});
    },
    assignData(data) {
      this.model = data;
      if (this.model.aDevices.id == null) {
        this.model.aDevices_id = 0; //
      }
    },
    deleteProject(id) {
      this.$swal({
        title: "Are you sure?",
        text: "You want to delete this project?",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          return axios
            .delete(`/api/projects/${id}?test=0`)
            .then(() => this.loadProjects())
            .catch(e => (this.errors = e.response.message));
        }
      });
    },
    activitiesLog(){
      axios
        .get(`/api/publisher-projects/activity`)
        .then(response => {
            this.activity_logs = response.data;
            this.activity_col1 = this.activity_logs.slice(0, 3);
            this.activity_col2 = this.activity_logs.slice(3, 6);
          }
        )
        .catch(function(error){});
    }
  }
  };
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";

.custom-container{
  max-width: 100%;
  .text-blue{
    color: #0082cc;
  }
  .text-red{
    color: #e63423;
  }
  .text-bold{
    font-family: $font-family-brandon-bold;
  }
  .step-page-title{
    font-family: $font-family-UniNeue-bold;
    font-size : 30px;
    width: 100%;
    text-align: center;
    color: #363e48;
    margin: 5px 0 25px;
  }
  .dashboard-page{
    width: 100%;
    .white-box{
      .block-title{
        font-size: 20px;
        font-family: $font-family-UniNeue-bold;
        border-bottom: 1px solid #dadada;
        color: #0082cc;
        padding-bottom: 10px;
        margin-bottom: 10px;
        width: auto;
        min-height:35px;
      }
      .proj-status{
        font-size: 17px;
        font-family: $font-family-brandon-medium;
        margin-bottom: 0;
      }
      .proj-count{
        font-size: 40px;
        font-family: $font-family-UniNeue-bold;
        line-height: 30px;
        color: #0082cc;
      }
      .no-proj-desc{
        padding: 25px 0 10px;
        text-align:center;
      }
      .activity-list{
        ul{
          padding-left: 20px;
          list-style: disc;
          margin-bottom: 0;
          li{
            span{
              font-size: 14px;
            }
          }
        }
      }
    }
      .status-bar{
        width: 100%;
        border-radius: 4px;
        text-align: center;
        font-size: 17px;
        font-family: $font-family-brandon-medium;
        min-width: 40px;
        padding: 5px 0;
        background-color: #fff;
        margin-bottom: 20px;
      }
      .status-bar.blue-status-bar{
        color: #0082cc;
        border: 2px solid #0082cc;
      }
      .status-bar.green-status-bar{
        color: #2cac3d;
        border: 2px solid #2cac3d;
        display: none;
      }
    .blue-btn{
      width: 100%;
      padding: 2px 5px;
      font-size: 14px;
      letter-spacing: 0.05rem;
      border-radius: 20px;
      display: block;
      &:hover{
        background-color: #13b9fb;
      }
    }
    .post-btn{
      padding: 7px 10px;
    }
  }
}
@media screen and(max-width:1281px) {
  .custom-container{
    .dashboard-page{
      .white-box.proj-summary{
        padding: 20px 7px;
      }
      .blue-step-btn{
        font-size: 13px;
      }
    }
  }
}
@media screen and(max-width:1200px) {
  .custom-container{
    .page-title{
      font-size: 28px;
      margin: 0 0 20px;
    }
    .dashboard-page{
      .blue-btn{
        font-size: 12px;
        letter-spacing: 0;
      }
      .white-box{
        .block-title{
          font-size: 18px;
        }
        .proj-count{
          font-size: 28px;
          line-height: 24px;
        }
        .proj-status{
          font-size: 15px;
        }
      }
    }
  }
}
@media screen and(max-width:767px) {
 .custom-container{
    .dashboard-page{
      .status-bar{
        font-size: 14px;
      }
    }
 }
}
@media screen and(max-width:575px) {
  .custom-container{
    .page-title{
      font-size: 26px;
    }
    .dashboard-page{
      .blue-btn.view-profile-btn{
          max-width: 180px;
          margin: 0 auto 15px;
      }
      .white-box{
        line-height: 18px;
      }
      .white-box.proj-summary{
        padding: 20px 10px;
        max-height: 100px;
        min-height: 100px;
      }
      .status-bar{
        margin-bottom: 15px;
      }
      .post-btn{
        max-width: 150px;
        float: right;
        margin-bottom: 15px;
      }
    }
  }
}
</style>