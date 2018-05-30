<template>
  <div>
    <div v-if="projectType=='active'|| projectType=='underApproval'" class="row" >
      <div class="col-12 col-sm-6">
        <router-link tag="a" :to="{ name:'tester.project.view', params:{ id: project.id } }" class="text-bold active-proj-name" >{{ project.name }}  </router-link>
      </div>
      <div class="col-12 col-sm-6 text-sm-right text-left">
        <span v-if="project.status.name != 'Submitted'">
          <span class="text-bold progress-txt">
            Progress : 0%
          </span>
          <img src="~/img/progress-bar.png" class="img-fluid">
        </span>
        <!-- <img v-if="!isApprovedTester && !aActiveProjects.length || aActiveProjects.length && !isApprovedTester && !isApplicationSubmitted" src="~/img/progress-bar.png" class="img-fluid">
        <img v-if="!isApprovedTester && isApplicationSubmitted || isApprovedTester && !aActiveProjects.length" src="~/img/green-progress-full.png"  class="img-fluid"> -->

      </div>
      <div class="col-12 col-sm-6 col-xl-3">
        <p class="mb-1 mt-2 mt-sm-0">
          <span class="text-bold">Device : </span>
          <device-selector disabled v-model="selected_devices" class="device-list"></device-selector>
        </p>
        <p class="mb-1 mt-2 mt-sm-0">
          <span class="text-bold">Type : </span>
          <span class="">{{project.project_type ? project.project_type.name : ''}}</span>
        </p>
      </div>
      <div class="col-12 col-sm-6 col-xl-3">

      </div>
      <div class="col-12 col-xl-6 text-xl-right text-left">
        <p class="mb-1 mt-2 mt-sm-0">

        </p>
        <p class="mb-1 mt-2 mt-sm-0">
          <span class="text-bold">Status : </span>
          <span class="">{{ project.status.name | firstUppercase }} {{ project.status.updated_at | datetime }}</span>
        </p>
      </div>
    </div>
    <div v-else-if="projectType=='open'" class="row align-items-center">
      <div class="col-12 col-md-9 col-xl-10 xl-border-right">
        <div class="row">
          <div class="col-12">
            <router-link tag="a" :to="{ name:'tester.project.view', params:{ id: project.id } }" class="text-bold active-proj-name" >{{ project.name }} </router-link>
          </div>
          <div class="col-lg-6 col-md-4">
            <p>
              <span class="text-bold">Device : </span>
            <device-selector disabled v-model="selected_devices" class="device-list"></device-selector>
            </p>
            <p>
              <span class="text-bold">Type : </span>
              <span class="">{{ project.project_type ? project.project_type.name : '' }}</span>
            </p>
            <p >
              <span class="text-bold">Time Needed to Test : </span>
              <span class="">{{ project.estimate_tester_time | times }}</span>
            </p>
          </div>
          <div class="col-lg-3 col-md-4" >
            <p>
              <span class="text-bold">Open spots : </span>
              <span>{{  project.allocated_tester - (project.testers || []).length }}</span>
            </p>
          </div>
          <div  class="col-lg-3 col-md-4 text-md-right text-left">
            <p>
              <span class="text-bold">You will be paid : </span>
              <span>{{ project.cost_per_tester | currency }}</span>
            </p>
            <p>
              <span class="text-bold">Start Date : </span>
              <span>{{ project.start_date | date}}</span>
            </p>
            <p>
              <span class="text-bold">End Date : </span>
              <span>{{ project.end_date | date}}</span>
            </p>
          </div>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-md-3 col-xl-2 btn-wrap">
        <router-link tag="a" :to="{ name:'tester.project.view', params:{ id: project.id } }" class="green-btn" >
          View Project
        </router-link>
      </div>
    </div>
    <div v-else-if="projectType=='completed'">
      <div class="row align-items-center">
        <div class="col-12 col-md-9 col-xl-10 xl-border-right">
          <div class="row">
            <div class="col-10 col-xl-11">
              <router-link tag="a" :to="{ name:'tester.project.view', params:{ id: project.id } }" class="text-bold proj-name" >{{ project.name }} </router-link>
            </div>
            <div class="col-2 col-xl-1">
              <span class="text-green text-bold proj-price"></span>
            </div>
            <div class="col-12 col-sm-6 col-xl-7">
              <p>
                <span class="text-bold">Device : </span>
                <device-selector disabled v-model="selected_devices" class="device-list"></device-selector>
              </p>
              <p>
                <span class="text-bold">Type : </span>
                <span class="">{{ project.project_type ? project.project_type.name : '' }}</span>
              </p>
            </div>
            <div class="col-12 col-xl-5 pl-xl-0 text-xl-right text-left">
              <span class="text-bold">Completed on : </span>
              <span>{{ project.created_at | date }}</span>
                <star-rating :disabled="true" v-model="project.rating.score" :small="true"></star-rating>
            </div>
          </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 col-xl-2 btn-wrap">
          <p class="badge-wrap">
            <span class="text-bold text-green complete-badge">
                {{project.status.name == "Test Passed" ? 'Approved' : project.status.name}}
            </span>
          </p>
          <p class="pending-amt" v-show="!project.is_test_project">
            <br>
            {{ project.amount ? '$' + project.amount : '' }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DeviceSelector from "components/components/device-selector";
import StarRating from "components/components/star-rating";
export default {
  name: "test-active-project-item",
  components: {
    DeviceSelector,
    StarRating
  },
  props: {
    project: {
      type: Object,
      required: true
    },
    projectType: {
      type: String,
      required: true
    }
  },
  computed: {
    selected_devices() {
      return (this.project.devices || []).map(({ id }) => id);
    }
  },
  methods: {
    onDelete(id) {
      this.$emit("delete", id);
    }
  }
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";
/*  Start developer */
.device-list {
  img {
    max-width: 20px;
    margin-left: 5px;
  }
}
/* End  developer */
.block-title {
  font-size: 20px;
  font-family: $font-family-UniNeue-bold;
  border-bottom: 1px solid #dadada;
  color: #2cac3d;
  padding-bottom: 10px;
  margin-bottom: 10px;
  width: auto;
  a {
    font-family: $font-family-brandon-medium;
    font-size: 17px;
    text-decoration: underline !important;
    float: right;
  }
}
.proj-status {
  font-size: 17px;
  font-family: $font-family-brandon-medium;
  margin-bottom: 0;
}
.proj-count {
  font-size: 40px;
  font-family: $font-family-UniNeue-bold;
  line-height: 30px;
}
.active-proj-name {
  font-size: 16px;
  text-transform: uppercase;
  color: #363e48;
}
.progress-txt {
  font-size: 17px;
}
.open-proj-txt {
  font-size: 17px;
  padding: 30px 0 10px;
  color: #9c9c9c;
}
.proj-desc-block {
  width: 100%;
  border-top: 1px solid #dadada;
  padding: 20px 0;
  font-size: 14px;
  &:first-child {
    border-top: none;
    padding-top: 10px;
  }
  &:last-child {
    padding-bottom: 5px;
  }
  p {
    margin: 5px 0;
  }
  .xl-border-right {
    border-right: 1px solid #dadada;
  }
  .btn-wrap {
    // border-left: 1px solid #dadada;
    position: relative;
    .green-btn {
      // margin: 35px 0 20px;
      padding: 3px;
    }
    .badge-wrap {
      position: relative;
      border: 1px solid #2cac3d;
      border-right: 0;
      border-top-left-radius: 16px;
      border-bottom-left-radius: 16px;
      margin-right: -20px;
      padding: 3px 40px;
      line-height: 20px;
      font-size: 15px;
      z-index: 1;
      margin-bottom: 15px;
      color: #2cac3d;
    }
    .pending-amt {
      font-size: 22px;
      line-height: 26px;
      text-align: center;
      font-family: $font-family-brandon-medium;
    }
  }
  .proj-name {
    color: #363e48;
    font-size: 16px;
    text-transform: uppercase;
  }
  .proj-price {
    font-size: 22px;
  }
  .rating-star {
    font-family: $font-icon-font-awesome;
    font-size: 16px;
    color: #ffcc00;
  }
}
hr.seprator {
  border-color: #dadada;
  float: left;
  position: relative;
  width: 100%;
  margin: 15px;
}
.white-box.proj-summary {
  padding: 30px 10px;
  max-height: 115px;
  min-height: 115px;
}
.white-box.ratings-wrap {
  padding: 15px 10px;
  .proj-count {
    line-height: 20px;
  }
  .ratings-block {
    font-family: $font-icon-font-awesome;
    font-size: 14px;
    color: #2cac3d;
    .rating-star {
      display: block;
    }
    .total-count {
      font-family: $font-family-brandon-bold;
      font-size: 14px;
      color: #606368;
    }
  }
  .proj-status {
    line-height: 16px;
  }
}
.green-btn {
  width: 100%;
  padding: 7px 10px;
  letter-spacing: 0.05rem;
  color: #fff;
  border-radius: 20px;
  display: block;
  text-align: center;
}
@media screen and(max-width:1281px) {
  .white-box.proj-summary {
    padding: 30px 7px;
  }
  .white-box.ratings-wrap {
    padding: 15px 7px;
  }
  .green-btn {
    font-size: 13px;
  }
}
@media screen and(max-width:1200px) {
  .step-page-title {
    font-size: 28px;
    margin: 0 0 20px;
  }
  .green-btn {
    font-size: 12px;
    letter-spacing: 0;
  }
  .block-title {
    font-size: 18px;
  }
  .proj-count {
    font-size: 28px;
    line-height: 24px;
  }
  .proj-status {
    font-size: 15px;
  }
  .proj-desc-block {
    .btn-wrap {
      .badge-wrap {
        padding: 3px 15px;
      }
      .green-btn {
        // margin: 60px 0 20px;
        font-size: 14px;
        padding: 3px 1px;
      }
      .pending-amt {
        font-size: 20px;
        line-height: 22px;
      }
    }
  }
  .white-box.ratings-wrap {
    .ratings-block {
      .total-count {
        font-size: 13px;
      }
    }
  }
}
@media screen and(max-width:991px) {
  .proj-desc-block {
    .btn-wrap {
      .badge-wrap {
        margin-right: -15px;
      }
    }
  }
}
@media screen and(max-width:767px) {
  .proj-desc-block {
    .proj-name {
      line-height: 22px;
    }
    .btn-wrap {
      border-left: 0;
      .green-btn {
        margin: 5px 0;
        max-width: 150px;
      }
      .badge-wrap {
        max-width: 180px;
        padding: 3px 30px;
        margin-left: -16px;
        border-right: 1px solid #2cac3d;
        border-left: 0;
        border-top-right-radius: 16px;
        border-bottom-right-radius: 16px;
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
        margin-top: 10px;
        margin-bottom: 0px;
      }
      .pending-amt {
        font-size: 22px;
        line-height: 26px;
      }
    }
    .xl-border-right {
      border-right: none;
    }
  }
}
@media screen and(max-width:575px) {
  .step-page-title {
    font-size: 26px;
  }
  .green-btn.view-profile-btn {
    max-width: 180px;
    margin: 0 auto 15px;
  }
  .block-title {
    a {
      font-size: 14px;
    }
  }
  .progress-txt {
    font-size: 14px;
    display: block;
    margin-top: 10px;
  }
  .proj-desc-block {
    .proj-price {
      font-size: 18px;
    }
    .btn-wrap {
      .pending-amt {
        font-size: 20px;
        line-height: 24px;
      }
    }
  }
  .white-box.proj-summary {
    padding: 20px 10px;
    max-height: 100px;
    min-height: 100px;
  }
  .white-box.ratings-wrap {
    padding: 12px 10px;
  }
}
</style>