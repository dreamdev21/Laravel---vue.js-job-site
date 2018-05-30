<template>
    <div>
        <div class="row">
            <div class="col-md-12 mb-5">
                <h1>{{ tester_name }}'s projects</h1>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card box_shadow pb-5" ref="testprojectList">
                            <div class="card-header bg-white border-0">
                                <vue-tabs type="pills">
                                    <v-tab :title="'Active ( '+ aActiveProjects.length + ' )'">
                                        <project-item :key="testproject.id" :project="testproject" @delete="deleteProject" v-for="testproject in aActiveProjects">
                                        </project-item>
                                    </v-tab>
                                    <v-tab :title="'Pending Payment ( '+ aPendingPaymentProjects.length + ' )'">
                                        <project-item :key="testproject.id" :project="testproject" @delete="deleteProject" v-for="testproject in aPendingPaymentProjects">
                                        </project-item>
                                    </v-tab>
                                    <v-tab :title="'Pending Approval ( '+ aPendingApprovalProjects.length + ' )'">
                                        <project-item :key="testproject.id" :project="testproject" @delete="deleteProject" v-for="testproject in aPendingApprovalProjects">
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
                <router-link :to="{name: 'admin.tester'}" class="btn btn-secondary">Back to Testers</router-link>
            </div>
        </div>
    </div>
</template>

<script>
  import ProjectItem from "components/components/tester/project_item";

  export default {
    name: "tester_projects",
    components: {
      ProjectItem
    },
    data() {
      return {
        aActiveProjects: [],
        aPendingPaymentProjects: [],
        aPendingApprovalProjects: [],
        aCompletedProjects: [],
        formstate: {},
        model: {},
        originalUser: {},
        aDevices: {},
        additional_devices: [],
        project_types: {},
        running_project: "",
        tester_name: ""
      };
    },
    created: function(){
      axios
        .get(`/api/tester/${this.$route.params.id}`)
        .then(response => {
          this.tester_name = response.data.data['full_name'];
        })
        .catch(function(error) {});
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
          .get(`/api/tester-projects?tester_id=${this.$route.params.id}`)
          .then(response => {
            let data = response.data;
            this.aActiveProjects = data.aActiveProjects
              ? data.aActiveProjects
              : [];
            this.aPendingPaymentProjects = data.aPendingPaymentProjects
              ? data.aPendingPaymentProjects
              : [];
            this.aPendingApprovalProjects = data.aPendingApprovalProjects
              ? data.aPendingApprovalProjects
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
    .active_tab {
        color: #00aff3 !important;
        background-color: transparent !important;
        border-bottom: 1px solid #00aff3 !important;
        /*border-radius: 0 !important;*/
    }
    .tabs__link {
        font-size: 14px;
        border-bottom: 1px solid #ccc;
        -webkit-border-radius: 0 !important;
        -moz-border-radius: 0 !important;
        border-radius: 0 !important;
        margin-right: 30px;
    }
    .vue-tab .nav-tabs-navigation {
        padding-bottom: 20px !important;
    }
</style>
<style scoped lang="scss">
    .border-row-bottom {
        border-bottom: 1px solid #797979 !important;
    }
    select {
        height: 34px;
    }
    .font-12 {
        font-weight: 400;
        font-style: normal;
        font-size: 12px;
    }
    .font-24 {
        font-weight: 400;
        font-style: normal;
        font-size: 24px;
    }
    .font-bold-12 {
        font-weight: 700;
        font-style: normal;
        font-size: 12px;
    }
    .font-bold-16 {
        font-weight: 700;
        font-style: normal;
        font-size: 16px;
    }
    .font-title-color {
        color: #666699;
    }
</style>