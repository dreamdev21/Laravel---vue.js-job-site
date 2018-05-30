<template>
  <div class="bg-color">
    <div class="container custom-container">
      <div class="row">
        <h1 class="step-page-title">
          Dashboard
        </h1>
        <div class="dashboard-page">
          <!-- <div class="row" v-show="isApprovedTester"> -->
          <div class="row">
            <div class="col-12 col-sm-4 col-lg-4 col-xl-2 text-center">
              <div class="white-box proj-summary">
                <h3 class="text-green proj-count">{{aOpenProjects.length ? aOpenProjects.length : 0 }}</h3>
                 <router-link tag="a" :to="{ name:'tester.projects'}" class="proj-status text-grey" >Open Projects</router-link>
                <!-- <p class="proj-status">Open Projects</p> -->
              </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-4 col-xl-2 text-center">
              <div class="white-box proj-summary">
                <h3 class="text-green proj-count">{{activedProjectsCount ? activedProjectsCount : 0}}</h3>
                <router-link tag="a" :to="{ name:'tester.projects'}" class="proj-status text-grey" >Active Projects</router-link>
              </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-4 col-xl-2 text-center">
              <div class="white-box proj-summary">
                <h3 class="text-green proj-count">0</h3>
                <p class="proj-status">Inbox</p>
              </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-4 col-xl-2 text-center">
              <div class="white-box proj-summary">
                <h3 class="text-green proj-count">{{this.devicesCount  ? this.devicesCount  : 0}}</h3>
               <router-link tag="a" :to="{ name:'tester.devices'}" class="proj-status text-grey" >My Devices</router-link>
              </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-4 col-xl-2 text-center">
              <div class="white-box proj-summary ratings-wrap">
                <!-- <h3 class="text-green proj-count">-</h3> -->
                <div class="ratings-block">
                  <h3 class="text-green proj-count">{{this.rating ? this.rating : '0.0'}}</h3>
                  <star-rating :disabled="true" v-model="this.rating" :small="true" :label="false"></star-rating>
                  <!--<span class="rating-star">-->
                    <!--<i class="fa fa-star"></i>-->
                    <!--<i class="fa fa-star"></i>-->
                    <!--<i class="fa fa-star"></i>-->
                    <!--<i class="fa fa-star"></i>-->
                    <!--<i class="fa fa-star-o"></i>-->
                  <!--</span>-->
                  <span class="total-count">Total Reviews 14</span>
                </div>
                <p class="proj-status">My Rating</p>
              </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-4 col-xl-2 text-center">
              <div class="white-box proj-summary">
                <h3 class="text-green proj-count">$0</h3>
                <router-link tag="a" :to="{ name:'tester.payments'}" class="proj-status text-grey" >My Earnings</router-link>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="status-bar disapprove-status" v-show="!isApprovedTester && !aActiveProjects.length && (['Step_1']).includes(latestStatus)">
                To be approved as a Tester, please pick project from open and Submit!
              </div>
              <div class="status-bar disapprove-status" v-show="aActiveProjects.length && !isApprovedTester && !isApplicationSubmitted">
                To be approved as a Tester, please complete the active project!
              </div>
              <div class="status-bar underprocess-status" v-show="!isApprovedTester && isApplicationSubmitted || (['review']).includes(latestStatus)">
                Your test submission is being reviewed by our team. We'll let you know when you can start testing new VR apps!
              </div>
              <div v-show="isApprovedTester && !aActiveProjects.length" class="status-bar approve-status">
                Congratulations! You've been approved as a Tester and can now get paid for testing VR apps and games!
              </div>
            </div>
          </div>
          <div class="white-box">
            <div class="row">
              <div class="col-12">
                <h4 class="block-title">
                  Active Projects (<span> {{ aActiveProjects.length ? aActiveProjects.length:0 }} </span>)
                  <a v-show="isApprovedTester && (aActiveProjects.length > 5) " href="#" class="text-right text-underline text-green" @click="viewActiveprojects">View All</a>
                </h4>
                <p class="text-center open-proj-txt" v-show="aActiveProjects.length == 0">No Active Projects Available</p>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="proj-desc-block" v-for="testerProject in fActiveProjects">
                  <div class="row align-items-center">
                    <div class="col-12 col-md-9 col-xl-10 xl-border-right">
                      <div class="row">
                        <div class="col-md-8">
                          <router-link tag="a" :to="{ name:'tester.project.view', params:{ id: testerProject.id } }" class="text-bold active-proj-name" >{{ testerProject.name }}  </router-link>
                          <div class="mb-1 mt-2 mt-sm-0">
                            <span class="text-bold">Device : </span>
                            <span v-for="device in testerProject.devices" class="device-list" >
                              <img v-b-tooltip.hover :title="device.name" :src="device.icon" class="image-responsive device-image"/>
                            </span>
                          </div>
                          <div class="mb-1 mt-2 mt-sm-0">
                            <span class="text-bold">Type : </span>
                            <span class="">{{testerProject.project_type ? testerProject.project_type.name : ''}}</span>
                          </div>
                        </div>
                        <div class="col-md-4 text-md-right text-left">
                          <span v-if="testerProject.status.name != 'Submitted'">
                            <span class="text-bold progress-txt" >
                              Progress : {{!isApprovedTester && isApplicationSubmitted || isApprovedTester && !aActiveProjects.length ? '100':'0'}}%
                            </span>
                            <img v-if="!isApprovedTester && !aActiveProjects.length || aActiveProjects.length && !isApprovedTester && !isApplicationSubmitted" src="~/img/progress-bar.png" class="img-fluid">
                            <img v-if="!isApprovedTester && isApplicationSubmitted || isApprovedTester && !aActiveProjects.length" src="~/img/green-progress-full.png"  class="img-fluid">
                          </span>
                          <p class="mb-1 mt-2 mt-sm-0">
                            <span class="text-bold">{{ testerProject.status.name | firstUppercase }} on : </span>
                            <span class=""> {{ testerProject.status.updated_at | datetime }}</span>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-3 col-md-3 col-xl-2 btn-wrap text-center">
                      <p class="badge-wrap">
                        <span class="text-bold text-green complete-badge">
                            {{ testerProject.status.name }}
                        </span>
                      </p>
                      <router-link tag="a" :to="{ name:'tester.project.view', params:{ id: testerProject.id } }" class="view-link" >View Project</router-link>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="white-box">
            <div class="row">
              <div class="col-12">
                <h4 class="block-title">
                  Open Projects (<span>  {{ aOpenProjects.length ? aOpenProjects.length:0 }} </span>)
                  <a v-show="aOpenProjects.length > 5 && isApprovedTester" href="#" class="text-right text-underline text-green" @click="viewOpenprojects">View All</a>
                </h4>
                <p class="text-center open-proj-txt" v-show="aOpenProjects.length == 0">No Open Projects Available</p>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="proj-desc-block" v-for="project in fOpenProjects">
                   <div class="row align-items-center">
                      <div class="col-12 col-md-9 col-xl-10 xl-border-right">
                        <div class="row">
                          <div class="col-12">
                            <router-link tag="a" :to="{ name:'tester.project.view', params:{ id: project.id } }" class="text-bold active-proj-name" >{{ project.name }} </router-link>
                          </div>
                          <div class="col-lg-6 col-md-4">
                            <p>
                              <span class="text-bold">Device : </span>
                              <span v-for="device in project.devices" class="device-list" >
                                <img v-b-tooltip.hover :title="device.name" :src="device.icon" class="image-responsive device-image"/>
                              </span>
                            </p>
                            <p>
                              <span class="text-bold">Type : </span>
                              <span class="">{{ project.project_type ? project.project_type.name : '' }}</span>
                            </p>
                            <p v-if="isApprovedTester">
                              <span class="text-bold">Time Needed to Test : </span>
                              <span class="">{{ project.estimate_tester_time | times }}</span>
                            </p>
                          </div>
                          <div class="col-lg-3 col-md-4" v-if="isApprovedTester">
                            <p>
                              <span class="text-bold">Open spots : </span>
                              <span>{{  project.allocated_tester - project.testers.length }}</span>
                            </p>
                          </div>
                          <div v-if="isApprovedTester" class="col-lg-3 col-md-4 text-md-right text-left">
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
                      <!-- <hr class="seprator"> -->
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="white-box">
            <div class="row">
              <div class="col-12">
                <h4 class="block-title">
                  Completed Projects (<span> {{ aCompletedProjects.length ? aCompletedProjects.length:0 }} </span>)
                  <a v-show="aCompletedProjects.length > 5" href="#" class="text-right text-underline text-green" @click="viewCompletedProjects">View All</a>
                </h4>
                <p class="text-center open-proj-txt" v-show="aCompletedProjects.length == 0">No Completed Projects Available</p>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="proj-desc-block" v-for="project in fCompletedProjects">
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
                            <span v-for="device in project.devices" class="device-list" :key="device.id">
                              <img v-b-tooltip.hover :title="device.name" :src="device.icon" class="image-responsive device-image"/>
                            </span>
                          </p>
                          <p>
                            <span class="text-bold">Type : </span>
                            <span class="">{{ project.project_type ? project.project_type.name : '' }}</span>
                          </p>
                        </div>
                        <!-- <div class="col-12 col-sm-6 col-xl-4">
                          <p class="text-sm-right text-left">
                            <span class="text-bold">Start Date : </span>
                            <span>{{ testerProject.start_date | date}}</span>
                          </p>
                          <p class="text-sm-right text-left">
                            <span class="text-bold">End Date : </span>
                            <span>{{ testerProject.end_date | date }}</span>
                          </p>
                        </div> -->
                        <div class="col-12 col-xl-5 pl-xl-0 text-xl-right text-left">
                          <!-- <p>
                            <span class="rating-star">
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star-o"></i>
                            </span>
                            <span class="text-bold">4.0</span>
                            </p> -->
                          <span class="text-bold">Completed on : </span>
                          <span>{{ project.created_at | date }}</span>
                           <star-rating :disabled="true" v-model="project.rating.score" :small="true"></star-rating>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-3 col-md-3 col-xl-2 btn-wrap">
                      <div class="text-center">
                      <p class="badge-wrap">
                        <span class="text-bold text-green complete-badge">
                           {{project.status.name == "Test Passed" ? 'Approved' : project.status.name}}
                        </span>
                      </p>
                      <router-link tag="a" :to="{ name:'tester.project.view', params:{ id: project.id } }" class="view-link">View project</router-link>
                      </div>
                      <p class="pending-amt mt-2" v-show="!project.is_test_project">
                        {{ project.amount ? '$' + project.amount : '' }}
                      </p>
                    </div>
                    <!-- <hr class="seprator"> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Vue from "vue";
import moment from 'moment';
import TestActiveProjectItem from "components/components/tester/test-active_project_item";
import StarRating from "components/components/star-rating";
import {TimeFilter} from "src/services/filter";
import { isReadyForTest, hasClearedStep1 } from 'src/services/tester';
Vue.filter('times', TimeFilter);
export default {
  name: "tester-profile",
  components:{
    'moment': moment,
    TestActiveProjectItem,
    StarRating
  },
  data(){
    return{
      rating: window.USER.rating,
      model: {},
      isApprovedTester: 0,
      isApplicationSubmitted: 0,
      aActiveProjects: [],
      aCompletedProjects: [],
      aOpenProjects: [],
      fActiveProjects: [],
      fCompletedProjects: [],
      fOpenProjects: [],
      latestStatus: "",
      activedProjectsCount: 0,
      devicesCount: 0
    }
  },
  mounted: function(){
    if(window.USER.latest_project_status){
      this.latestStatus = window.USER.latest_project_status.name;
    }
    axios
      .get(`/api/tester/${this.$store.state.user.id}`)
      .then(response => {
        this.devicesCount = response.data.data.devices.length;
    });
    axios
      .get(`/api/tester/dashboard/${this.$store.state.user.id}`)
      .then(response => {
        let data = response.data;
        this.isApplicationSubmitted = data.isApplicationSubmitted;
        this.isApprovedTester = data.isApprovedTester;
        this.aAcceptedProjects = data.aAcceptedProjects ? data.aAcceptedProjects : [];
        this.aSubmittedProjects = data.aSubmittedProjects ? data.aSubmittedProjects : [];
        this.aActiveProjects = [...this.aAcceptedProjects, ...this.aSubmittedProjects ];
        this.aCompletedProjects = data.aCompletedProjects ? data.aCompletedProjects : [];
        this.aOpenProjects = data.aOpenProjects ? data.aOpenProjects : [];
        this.activedProjectsCount = this.aAcceptedProjects.length + this.aSubmittedProjects.length;

        if(this.isApprovedTester) {
          this.fOpenProjects = this.aOpenProjects ? this.aOpenProjects.slice(0, 5) : [];
        } else {
          this.fOpenProjects = this.aOpenProjects;
        }
        this.fActiveProjects = this.aActiveProjects ? this.aActiveProjects.slice(0, 5) : [];
        this.fCompletedProjects = this.aCompletedProjects ? this.aCompletedProjects.slice(0, 5) : [];
      })
  },
  methods: {
    viewOpenprojects: function() {
      this.fOpenProjects = this.aOpenProjects;
    },
    viewActiveprojects: function() {
      this.fActiveProjects = this.aActiveProjects;
    },
    viewCompletedProjects: function() {
      this.fCompletedProjects = this.aCompletedProjects;
    },
    acceptProject: function() {
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
  },
}
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
  .text-grey{
    color: #606368;
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
    .status-bar.disapprove-status{
      border: 2px solid #e63423;
      color: #e63423;
    }
    .status-bar.approve-status{
      /* display: none; */
      border: 2px solid #2cac3d;
      color: #2cac3d;
    }
    .status-bar.underprocess-status{
      /* display: none; */
      width: 100%;
      border: 2px solid #ff7800;
      color: #ff7800;
      border-radius: 4px;
      text-align: center;
      font-size: 17px;
      font-family: $font-family-brandon-medium;
      min-width: 40px;
      padding: 5px 0;
      background-color: #fff;
      margin-bottom: 20px;
    }
     .xl-border-right{
        border-right: 1px solid #dadada;
      }
      .view-link{
        font-family: $font-family-brandon-medium;
        font-size: 14px;
        text-decoration: underline !important;
        color: #2cac3d;
      }
    .white-box{
      background-color: #fff;
      box-shadow: 0px 0px 3px 2px rgba(3, 3, 3, 0.05);
      border-radius: 4px;
      padding: 20px;
      margin-bottom: 20px;
      font-size: 14px;
      color: #606368;
      /*  Start developer */
      .device-list{
        img{
          max-width: 20px;
          margin-left: 5px;
        }
      }
      /* End  developer */
      .block-title{
        font-size: 20px;
        font-family: $font-family-UniNeue-bold;
        border-bottom: 1px solid #dadada;
        color: #2cac3d;
        padding-bottom: 10px;
        margin-bottom: 10px;
        width: auto;
        a{
          font-family: $font-family-brandon-medium;
          font-size: 17px;
          text-decoration: underline !important;
          float: right;
        }
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
      }
      .active-proj-name{
        font-size: 16px;
        text-transform: uppercase;
        color: #363e48;
      }
      .progress-txt{
        font-size: 17px;
      }
      .open-proj-txt{
        font-size: 17px;
        padding: 30px 0 10px;
        color: #9c9c9c;
      }
      .proj-desc-block{
        width: 100%;
        border-top: 1px solid #dadada;
        padding: 20px 0;
        font-size: 14px;
        &:first-child{
          border-top: none;
          padding-top: 10px;
        }
        &:last-child{
          padding-bottom: 5px;
        }
        p{
          margin: 5px 0;
        }

        .btn-wrap{
          // border-left: 1px solid #dadada;
          position: relative;
          .green-btn{
            // margin: 35px 0 20px;
            padding: 3px;
          }
          .badge-wrap{
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
            margin-bottom: 5px;
          }
          .pending-amt{
            font-size: 22px;
            line-height: 26px;
            text-align: center;
            font-family: $font-family-brandon-medium;
          }
        }
        .proj-name{
          color: #363e48;
          font-size: 16px;
          text-transform: uppercase;
        }
        .proj-price{
          font-size: 22px;
        }
        .rating-star{
          font-family: $font-icon-font-awesome;
          font-size: 16px;
          color: #ffcc00;
        }
      }
      hr.seprator{
        border-color: #dadada;
        float: left;
        position: relative;
        width: 100%;
        margin: 15px;
      }
    }
    .white-box.proj-summary{
      padding: 30px 10px;
      max-height: 115px;
      min-height: 115px;
    }
    .white-box.ratings-wrap{
      padding: 15px 10px;
      .proj-count{
        line-height: 20px;
      }
      .ratings-block{
        font-family: $font-icon-font-awesome;
        font-size: 14px;
        color: #2cac3d;
        .rating-star{
          display: block;
        }
        .total-count{
          font-family: $font-family-brandon-bold;
          font-size: 14px;
          color: #606368;
        }
      }
      .proj-status{
        line-height: 16px;
      }
    }
    .green-btn{
      width: 100%;
      padding: 7px 10px;
      border:2px solid #118921;
      background-color: #2cac3d;
      font-size: 14px;
      font-family: $font-family-brandon-medium;
      letter-spacing: 0.05rem;
      color: #fff;
      border-radius: 20px;
      display: block;
      text-align: center;
      &:hover{
        background-color: #158f25;
      }
    }
  }
}
@media screen and(max-width:1281px) {
  .custom-container{
    .dashboard-page{
      .white-box.proj-summary{
        padding: 30px 7px;
      }
      .white-box.ratings-wrap{
        padding: 15px 7px;
      }
      .green-btn{
        font-size: 13px;
      }
    }
  }
}
@media screen and(max-width:1200px) {
  .custom-container{
    .step-page-title{
      font-size: 28px;
      margin: 0 0 20px;
    }
    .dashboard-page{
      .green-btn{
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
        .proj-desc-block{
          .btn-wrap{
            .badge-wrap{
              padding: 3px 15px;
            }
            .green-btn{
              // margin: 60px 0 20px;
              font-size: 14px;
              padding: 3px 1px;
            }
            .pending-amt{
              font-size: 20px;
              line-height: 22px;
            }
          }
        }
      }
      .white-box.ratings-wrap{
          .ratings-block{
            .total-count{
              font-size: 13px;
            }
          }
        }
    }
  }
}
@media screen and(max-width:991px) {
  .custom-container{
    .dashboard-page{
      .white-box{
        padding: 15px;
        .proj-desc-block{
          .btn-wrap{
            .badge-wrap{
              margin-right: -15px;
            }
          }
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
      .white-box{
        .proj-desc-block{
          .proj-name{
            line-height: 22px;
          }
          .btn-wrap{
            border-left: 0;
            .green-btn{
              margin:5px 0;
              max-width: 150px;
            }
            .badge-wrap{
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
              margin-bottom: 5px;
            }
            .pending-amt{
              font-size: 22px;
              line-height: 26px;
            }
          }
           .xl-border-right{
              border-right: none;
            }
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
    .dashboard-page{
      .green-btn.view-profile-btn{
          max-width: 180px;
          margin: 0 auto 15px;
      }
      .white-box{
        line-height: 18px;
        .block-title{
          a{
            font-size: 14px;
          }
        }
        .progress-txt{
          font-size: 14px;
          display: block;
          margin-top: 10px;
        }
        .proj-desc-block{
          .proj-price{
            font-size: 18px;
          }
          .btn-wrap{
            .pending-amt{
              font-size: 20px;
              line-height: 24px;
            }
          }
        }
      }
      .white-box.proj-summary{
        padding: 20px 10px;
        max-height: 100px;
        min-height: 100px;
      }
      .white-box.ratings-wrap{
        padding: 12px 10px;
      }
    }

  }
}

</style>