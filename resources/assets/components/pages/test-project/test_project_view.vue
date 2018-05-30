<template>
  <div>
    <div class="container custom-container">
      <div class="">
        <AdminTestProjectDetails :testProject="testproject" :currentTestStatus="currentTestStatus"> </AdminTestProjectDetails>
      </div>
       <div class="row">
        <div class="col-12 btn-wrap text-center">
            <a href="javascript:;" class="red-btn" @click.prevent="deleteTestProject(testproject.id)">Delete</a>
            <router-link tag="a" class="purple-btn" :to="{ name: 'admin.test_project.edit', params: { id: testproject.id }}">Edit</router-link>
            <router-link tag="a" :to="{name: 'admin.test_projects'}" class="grey-btn"> Back to Test Projects</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AdminTestProjectDetails from "components/components/admin/test-project";
export default {
  name: "view_project",
  components: {
    AdminTestProjectDetails
  },
  data() {
    return {
      testproject: {},
    };
  },
  created:function () {
    axios
      .get(`/api/projects/${this.$route.params.id}`)
      .then(({ data: { data } }) => {
        this.testproject = data;
        this.testproject.selected_devices = data.devices.map(({ id }) => id);
        this.testproject.project_description = this.testproject.project_description.replace(/\r?\n/g, '<br \>');
      })
  .catch(function(error) {});
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
  },
   methods: {
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
              .then(() => this.$router.push({ name: "admin.test_projects" }) )
              .catch(e => (this.errors = e.response.message));
          }
        });
      }
    }
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";

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
   .btn-wrap{
    .purple-btn{
      color: #fff;
      font-size: 15px;
      line-height: 16px;
      font-family: $font-family-brandon-medium;
      border-radius: 6px;
      padding: 7px 10px;
      min-width: 70px;
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
    .grey-btn{
      color: #fff;
      font-size: 15px;
      line-height: 16px;
      font-family: $font-family-brandon-medium;
      border-radius: 6px;
      padding:7px 10px;
       min-width: 160px;
      min-height: 35px;
      margin-right: 0px;
      &:hover{
        outline: none !important;
        background-color: #7a7b7d;
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
      min-height: 35px;
      max-height: 35px;
      margin-right: 10px;
      display: inline-block;
      &:hover{
        outline: none !important;
        background-color:  #940000;
      }
      &:focus{
        outline: none !important;
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
    .purple-btn,.grey-btn{
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
    .grey-btn,.purple-btn{
      display: block;
      margin: 10px auto;
      max-width: 200px;
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
    .btn-wrap{
      .red-btn,.purple-btn{
        margin-right: 5px;
      }
      .grey-btn{
        display: inline-block;
        padding: 7px 5px;
        min-width: 145px;
      }
    }
  }
}
</style>