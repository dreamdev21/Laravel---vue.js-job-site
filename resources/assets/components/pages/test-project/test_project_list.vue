<template>
  <div>
    <div class="row">
      <div class="col-md-12 mb-5">
        <div class="row pb-3">
          <div class="col-xl-6 col-lg-4  col-md-4 col-12">
              <h1 class="page-title text-center text-md-left"> Test Projects</h1>
          </div>
          <div class="col-xl-6 col-lg-8 col-md-8 col-12 pl-md-0">
              <div class="pull-md-right float-none mt-0 mt-sm-2 text-center text-md-right">
                  <router-link :to="{name: 'admin.test_project.moderate'}" class="btn purple-btn mr-0 mr-sm-2 mb-sm-0 mb-3" > View New Tester Submissions </router-link>
                  <router-link :to="{name: 'admin.test_project.add'}" class="btn purple-btn" > Create New Test Project </router-link>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="white-box">
                <test-project-item :key="testproject.id" :project="testproject" @delete="deleteTestProject" v-for="testproject in testprojects"></test-project-item>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import TestProjectItem from "components/components/admin/testproject_list_item";
    export default {
    name: "projects_list",
    components: {
        TestProjectItem
    },
    data() {
        return {
        testprojects: {},
        formstate: {},
        model: {},
        originalUser: {},
        aDevices: {},
        additional_devices: [],
        project_types: {}
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
    computed: {
        selected_devices(index) {
          return (this.project.devices || []).map(({ id }) => id);
        }
    },
    methods: {
        loadProjects() {
        axios
            .get("/api/projects?test=1")
            .then(response => {
            this.testprojects = response.data;
            })
            .catch(function(error) {});
        },
        assignData(data) {
        this.model = data;
        if (this.model.aDevices.id == null) {
            this.model.aDevices_id = 0; //
        }
        },
        deleteTestProject(id) {
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
    .purple-btn{
      border-radius: 25px;
      padding: 4px 6px;
    }
    .white-box{
      .proj-block-wrap{
        padding: 15px 0;
        font-family: $font-family-brandon-regular;
        font-size: 14px;
        color: #606368;
        position: relative;
        border-bottom: 1px solid #dadada;
        &:first-child{
          padding-top: 0;
        }
        &:last-child{
          padding-bottom: 0;
          border: none;
        }
        span{
          vertical-align: top;
        }
        .border-xl-right{
          border-right: 1px solid #dadada;
        }
      .proj-title{
        font-family: $font-family-brandon-bold;
        font-size: 16px;
        color: #363e48;
      }
    }
}
@media screen and(max-width:1200px) {
  .view-proj-btn{
    float: left;
    max-width: 150px;
  }
 .white-box{
  .proj-block-wrap{
      .border-xl-right{
        border-right: none;
      }
   }
  }
}
@media screen and(max-width:767px) {
  .page-title{
    font-size: 26px;
  }
  .proj-block-wrap{
    padding: 10px 0 15px;
    .proj-title{
      font-size: 20px;
    }
  }
}

@media screen and(max-width:575px) {
  .page-title{
    font-size: 24px;
    margin-bottom: 15px;
  }
  .proj-block-wrap{
    .proj-title{
      font-size: 18px;
    }
  }
  .purple-btn{
    width: 100%;
    max-width: 220px;
    font-size: 14px;
    padding: 3px 6px;
    vertical-align: top;
  }
  .view-proj-btn{
    max-width: 150px;
  }
}
</style>
