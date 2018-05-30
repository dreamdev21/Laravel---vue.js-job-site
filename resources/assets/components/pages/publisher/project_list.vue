<template>
  <div>
    <div class="container custom-container">
      <div class="row">
        <div class="col-xl-10 col-md-9 col-sm-9 text-center">
          <h1 class="page-title">
            My Projects
          </h1>
        </div>
        <div class="col-xl-2 col-md-3 col-sm-3">
          <router-link :to="{name: 'publisher.project.add'}" class="blue-btn new-proj-btn">Add New Project</router-link>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="white-box" ref="testprojectList">
            <div class="publisher-project-tabwrap">
              <vue-tabs type="pills">
                <v-tab :title="'Running ( '+ aRunningProjects.length + ' )'">
                  <project-item :key="testproject.id" :project="testproject" @delete="deleteProject" v-for="testproject in aRunningProjects">
                  </project-item>
                </v-tab>

                <v-tab :title="'Waiting for Approval ( '+ aPendingApprovalProjects.length + ' )'">
                  <project-item :key="testproject.id" :project="testproject" @delete="deleteProject" v-for="testproject in aPendingApprovalProjects">
                  </project-item>
                </v-tab>

                <v-tab :title="'Pending Payment ( '+ aPendingPaymentProjects.length + ' )'">
                  <project-item :key="testproject.id" :project="testproject" @delete="deleteProject" v-for="testproject in aPendingPaymentProjects">
                  </project-item>
                </v-tab>

                <v-tab :title="'Completed ( '+ aCompletedProjects.length + ' )'">
                  <project-item :key="testproject.id" :project="testproject" @delete="deleteProject" v-for="testproject in aCompletedProjects">
                  </project-item>
                </v-tab>
              </vue-tabs>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ProjectItem from "components/components/publisher/project_item";

export default {
  name: "projects_list",
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
      running_project: ""
    };
  },
  mounted: function() {
    this.loadProjects();
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
    }
  }
};
</script>
<style>
  
 
</style>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";

.custom-container{
  max-width: 100%;
  padding: 0;
  .text-blue{
    color: #0082cc;
  }
  .text-red{
    color: #e63423;
  }
  .text-green{
    color: #2cac3d;
  }
  .text-bold{
    font-family: $font-family-brandon-bold;
  }
  .page-title{
    font-family: $font-family-UniNeue-bold;
    font-size : 30px;
    width: 100%;
    text-align: center;
    color: #363e48;
    margin: 5px 0 25px;
  }
   .blue-btn{
      width: 100%;
      padding: 6px 4px;
      font-size: 14px;
      font-family: $font-family-brandon-medium;
      letter-spacing: 0.05rem;
      border-radius: 20px;
      display: block;
    }
    .new-proj-btn{
      margin-top:15px;
      padding: 5px;
    }
}
@media screen and(max-width:991px) {
  .custom-container{
    max-width: 100%;
    padding:0px;
  }
}
@media screen and(max-width:767px) {
  .custom-container{
    .page-title{
      font-size:24px;
      margin:0 0 20px;
    }
    .new-proj-btn{
      margin-top:5px;
      padding: 4px 0;
    }
  }
}
@media screen and(max-width:575px) {
  .custom-container{
    .new-proj-btn{
      margin:0 auto 15px;
      max-width: 150px;
    }
  }
}
</style>