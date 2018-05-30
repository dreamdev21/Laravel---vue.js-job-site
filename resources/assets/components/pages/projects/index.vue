<template>
    <div>
      <div class="row">
        <div class="col-md-12 text-center">
          <h1 class="page-title">Projects</h1>
        </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="white-box">
                <div class="admin-project-tabwrap">
                  <vue-tabs type="pills">
                      <v-tab :title="'Running ( '+ aRunningProjects.length + ' )'">
                          <project-item :key="testproject.id" :project="testproject" @delete="deleteProject" v-for="testproject in aRunningProjects"></project-item>
                      </v-tab>
                      <v-tab :title="'Waiting for approval ( '+ aPendingApprovalProjects.length + ' )'">
                          <project-item :key="testproject.id" :project="testproject" @delete="deleteProject" v-for="testproject in aPendingApprovalProjects"></project-item>
                      </v-tab>
                      <v-tab :title="'Pending Payment ( '+ aPendingPaymentProjects.length + ' )'">
                          <project-item :key="testproject.id" :project="testproject" @delete="deleteProject" v-for="testproject in aPendingPaymentProjects"></project-item>
                      </v-tab>
                      <v-tab :title="'Completed ( '+ aCompletedProjects.length + ' )'">
                          <project-item :key="testproject.id" :project="testproject" @delete="deleteProject" v-for="testproject in aCompletedProjects"></project-item>
                      </v-tab>
                  </vue-tabs>
                </div>
            </div>
          </div>
      </div>
  </div>
</template>

<script>
import ProjectItem from "components/components/admin/project_list_item";
export default {
  name: "projects_list",
  components: {
    ProjectItem
  },
  data() {
    return {
      testprojects: {},
      formstate: {},
      model: {},
      originalUser: {},
      aDevices: {},
      additional_devices: [],
      project_types: {},
      aPendingApprovalProjects: [],
      aRunningProjects: [],
      aPendingPaymentProjects: [],
      aCompletedProjects: []
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
    this.originalUser = window.USER;
    if (this.originalUser.name == null) {
      this.originalUser.name = this.originalUser.full_name;
    }
  },
  methods: {
    loadProjects() {
      axios
        .get("/api/projects?test=0")
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
            .delete(`/api/projects/${id}?test=1`)
            .then(() => this.loadProjects())
            .catch(e => (this.errors = e.response.message));
        }
      });
    }
  }
};
</script>

<style lang="scss" scoped>
    @import "../../layouts/css/_customvariables";
    .page-title{
      font-size: 30px;
      color: #363e48; 
      font-family: $font-family-UniNeue-bold;
      margin-bottom: 25px;
    }
    .text-yellow{
      color: #ffcc00;
    }
    .text-orange{
      color: #ff8a0e;
    }
    .text-green{
      color: #02c505;
    }
    .text-darkgreen{
      color: #2cac3d;
    }
    .text-red{
      color: #f83636;
    }
    .text-bold{
      font-family: $font-family-brandon-bold;
    }
    .text-medium{
      font-family: $font-family-brandon-medium;
    }
    // .purple-btn{
    //   background-color: #5651b9;
    //   border: 2px solid #3e3a94;
    //   color: #fff;
    //   font-size: 15px;
    //   line-height: 16px;
    //   font-family: $font-family-brandon-medium;
    //   border-radius: 25px;
    //   padding: 4px 6px;
    //   -webkit-transition: all 0.4s ease;
    //   -moz-transition: all 0.4s ease;
    //   -o-transition: all 0.4s ease;
    //   -ms-transition: all 0.4s ease;
    //   transition: all 0.4s ease;
    //   &:hover{
    //     outline: none !important;
    //     text-decoration: underline !important;
    //   }
    //   &:focus{
    //     outline: none !important;
    //   }
    // }
    .white-box{
      background-color: #fff;
      box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.1);
      border-radius: 4px;
      font-family: $font-family-brandon-medium;
      font-size: 14px;
      color: #606368;
      padding: 15px;
    }
@media screen and(max-width:991px) {
 .page-title{
    font-size: 28px;
  }
}
@media screen and(max-width:767px) {
  .page-title{
    font-size: 24px;
    margin-bottom: 20px;
  }
}
</style>
