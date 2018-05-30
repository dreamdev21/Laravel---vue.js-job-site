<template>
    <div>
        <div class="row pb-3">
          <div class="col-md-8 col-12">
              <h1 class="page-title"> Moderate Test Projects</h1>
          </div>
          <div class="col-md-4 col-12 pl-md-0">
              <div class="pull-md-right float-none mt-0 mt-sm-2 text-md-right text-center">
                   <router-link :to="{name: 'admin.test_projects'}" class="btn purple-btn back-proj-btn" > Back To Test Project </router-link>
              </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-5">
                <div class="white-box" ref="testprojectList">
                    <div v-if="fetched && testprojects.length === 0">
                        <div class="row">
                            <div class="col-md-12 pb-3">
                                <h3>No test have been submitted</h3>
                            </div>
                        </div>
                    </div>
                    <div v-else class="proj-block-wrap" v-for="testproject in testprojects" :key="testproject.id">
                        <div class="row align-items-center">
                            <div class="col-md-12 col-xl-10 border-xl-right">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <span class="text-bold mr-1 d-block d-sm-inline-block">Tester Name : </span>
                                        <span class="proj-title text-uppercase d-block d-sm-inline-block">
                                          {{ testproject.tester.first_name }} {{ testproject.tester.last_name }}
                                        </span>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="mb-2">
                                          <span class="text-bold">
                                            <router-link class="proj-link" :to="{ name: 'admin.test_project.view-submission', params: { id: testproject.id }}"> {{ testproject.project.name }}</router-link>
                                         </span>
                                        </div>
                                        <div class="mb-2">
                                            <span class="text-bold mr-1 d-block d-sm-inline-block">Tester Email : </span>
                                            <span class="d-block d-sm-inline-block">
                                                {{ testproject.tester.email }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-md-right text-left">
                                         <div class="mb-2">
                                            <!-- <span class="text-bold mr-1 d-block d-sm-inline-block">Type : </span> -->
                                            <span class="d-block d-sm-inline-block">
                                               {{ testproject.project.project_type.name }}
                                            </span>
                                        </div>
                                        <div class="mb-2">
                                            <span class="text-bold mr-1 d-block d-sm-inline-block">Submission Date : </span>
                                            <span class="d-block d-sm-inline-block">
                                               {{ testproject.updated_at | datetime }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-2 btn-wrap">
                                <router-link class="btn purple-btn d-inline-block view-proj-btn" :to="{ name: 'admin.test_project.view-submission', params: { id: testproject.id }}">View Project</router-link>
                                <!-- <div class="icon-wrap d-inline-block">
                                    <a href="javascript:;" @click="acceptProjectSubmission(testproject)" class="btn accept-icon">
                                        <i class="fa fa-check"></i>
                                    </a>
                                    <a href="javascript:;" @click.prevent="rejectProjectSubmission(testproject)" class="btn reject-icon"><i class="fa fa-times"></i></a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: "projects_list",
  data() {
    return {
      testprojects: [],
      aDevices: [],
      model: {},
      fetched: false
    };
  },
  mounted: function() {
    this.loadModerateProjects();
    axios
      .get("/api/devices")
      .then(response => {
        this.aDevices = response.data;
      })
      .catch(function(error) {});
  },
  methods: {
    loadModerateProjects() {
      this.fetched = false;
      axios
        .get("/api/moderate-projects")
        .then(response => {
          this.testprojects = response.data;
          this.fetched = true;
        })
        .catch(error => {
          this.fetched = true;
        });
    },
    changeStatus(project, status) {
      return axios
        .post(`/api/test/${project.id}/status`, {
          status
        })
        .then(() => this.loadModerateProjects());
    },
    acceptProjectSubmission(project) {
      return this.changeStatus(project, "TEST_PASSED");
    },
    rejectProjectSubmission(project) {
      this.$swal({
        title: "Are you sure?",
        text: "You want to reject this test?",
        icon: "warning",
        buttons: true
      }).then(willDelete => {
        if (willDelete) {
          return this.changeStatus(project, "TEST_FAILED");
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
      width: 100%;
    }
    .back-proj-btn{
        max-width: 200px;
    }
    .white-box{
    .proj-block-wrap{
      padding: 15px 0;
      font-family: $font-family-brandon-regular;
      font-size: 14px;
      color: #606368;
      position: relative;
      border-bottom: 1px solid #dadada;
      .proj-link{
        color: #363e48;
      }
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
    .icon-wrap{
        text-align: center;
        width: 100%;
    }
    .accept-icon{
      color: #3e3a94;
      font-size: 24px;
      padding: 0;
      background-color: transparent;
      border: none;
      &:hover{
        border: none;
        outline: none;
      }
      &:focus{
        border: none;
        outline: none;
      }
    }
    .reject-icon{
      color: #f83636;
      font-size: 24px;
      padding: 0;
      background-color: transparent;
      border: none;
       &:hover{
        border: none;
        outline: none;
      }
      &:focus{
        border: none;
        outline: none;
      }
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
      padding: 15px 0 10px;
      .border-xl-right{
        border-right: none;
      }
      .icon-wrap{
          text-align: right;
          width: auto;
          float: right;
        }
      .btn-wrap{
        .accept-icon,.reject-icon{
            line-height: 14px;
            padding: 0;
        }
      }
   }
  }
}
@media screen and(max-width:767px) {
  .page-title{
    font-size: 26px;
    text-align: center;
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
    max-width: 185px;
    font-size: 14px;
    padding: 3px 6px;
    vertical-align: top;
  }
  .view-proj-btn{
    max-width: 150px;
  }
}
</style>
