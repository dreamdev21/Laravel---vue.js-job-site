<template>
  <div class="bg-color">
    <div class="container custom-container">
      <div class="row">
        <div class="projects-page">
          <div class="row">
            <div class="col-12">
              <h2 class="page-title">Projects</h2>
            </div>
          </div>
          <div class="white-box">
            <div class="row">
              <div class="col-12">
                <div class="tester-projects-tabwrap">
                  <b-tabs>
                    <b-tab :title="'Active (' + allActiveProjects.length + ')'" class="active-tab" active @click="tabUpdate('allActiveProjects', allActiveProjects.length)">
                        <div v-for="project in chunkedActiveProjects" :key="project.id">
                          <test-active-project-item :project="project" projectType="active"> </test-active-project-item>
                          <hr class="seprator">
                        </div>
                    </b-tab>
                    <!-- START OpenProjects -->
                    <b-tab :title="'Open ('+ allOpenProjects.length  +')'" @click="tabUpdate('allOpenProjects', allOpenProjects.length)">
                      <div class="proj-desc-block" v-for="project in chunkedOpenProjects" :key="project.id" >
                        <test-active-project-item :project="project" projectType="open"> </test-active-project-item>
                        <hr class="seprator">
                      </div>
                    </b-tab>
                    <!-- END OpenProjects -->
                    <b-tab :title="'Completed (' + allCompletedProjects.length +')'" projectType="completed" @click="tabUpdate('allCompletedProjects', allCompletedProjects.length)">
                      <div class="proj-desc-block" v-for="project in chunkedCompletedProjects" :key="project.id">
                        <test-active-project-item :project="project" projectType="completed"> </test-active-project-item>
                        <hr class="seprator">
                      </div>
                    </b-tab>
                    <b-tab :title="'Under Review (' +  + allSubmittedProjects.length +')'" @click="tabUpdate('allSubmittedProjects', allSubmittedProjects.length)">
                      <div v-for="project in chunkedSubmittedProjects" :key="project.id">
                        <test-active-project-item :project="project" projectType="underApproval"> </test-active-project-item>
                        <hr class="seprator">
                      </div>
                    </b-tab>
                  </b-tabs>
                </div>
              </div>
            </div>
            <!-- Start Pagination -->
            <pagination v-if="noOfPages>1" :perPage="perPage" :activeTab="activeTab" :noOfPages=noOfPages :currentPage=currentPage @getPageData="getPageData" @update-current-page="updateCurrentPage" :totalNoOfRecords="totalNoOfRecords"></pagination>
            <!-- End Pagination -->
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
import Pagination from "components/components/tester/pagination";
import StarRating from "components/components/star-rating";
import {TimeFilter} from "src/services/filter";
Vue.filter('times', TimeFilter);
export default {
  name: "projects",
  components: {
    'moment': moment,
    TestActiveProjectItem,
    StarRating,
    Pagination
  },
  data(){
    return{
      rating: window.USER.rating,
      model: {},
      isApprovedTester: 0,
      isApplicationSubmitted: 0,
      allActiveProjects: [],
      allCompletedProjects: [],
      allOpenProjects: [],
      allSubmittedProjects: [],
      chunkedActiveProjects: [],
      chunkedCompletedProjects: [],
      chunkedOpenProjects: [],
      chunkedSubmittedProjects: [],
      allChunkedActiveProjects: [],
      allChunkedCompletedProjects : [],
      allChunkedOpenProjects: [],
      allChunkedSubmittedProjects: [],
      latestStatus: "",
      activeTab: 'allActiveProjects',
      perPage: 3,
      currentPage: 1,
      noOfPages: 0,
      totalNoOfRecords: 0,
    }
  },
  mounted: function(){
    if(window.USER.latest_project_status){
      this.latestStatus = window.USER.latest_project_status.name;
    }
    axios
      .get(`/api/tester/dashboard/${this.$store.state.user.id}`)
      .then(response => {
        let data = response.data;
        this.isApplicationSubmitted = data.isApplicationSubmitted;
        this.isApprovedTester = data.isApprovedTester;
        this.allActiveProjects = data.aAcceptedProjects ? data.aAcceptedProjects : [];
        this.allCompletedProjects = data.aCompletedProjects ? data.aCompletedProjects : [];
        this.allOpenProjects = data.aOpenProjects ? data.aOpenProjects: [];
        this.allSubmittedProjects = data.aSubmittedProjects ? data.aSubmittedProjects : [];
        // chunked data
        this.allChunkedActiveProjects = _.chunk(this.allActiveProjects, this.perPage);
        this.allChunkedCompletedProjects = _.chunk(this.allCompletedProjects, this.perPage);
        this.allChunkedOpenProjects = _.chunk(this.allOpenProjects, this.perPage);
        this.allChunkedSubmittedProjects = _.chunk(this.allSubmittedProjects, this.perPage);
        // this.getPageData(this.currentPage);
        this.tabUpdate(this.activeTab, this.allActiveProjects.length );
      });
  },
  methods: {
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
    },
    getPageData: function(page){
      this.currentPage = page;
      page = page - 1;
      this.chunkedActiveProjects = this.allChunkedActiveProjects.hasOwnProperty(page) ? this.allChunkedActiveProjects[page] : {};
      this.chunkedCompletedProjects = this.allChunkedCompletedProjects.hasOwnProperty(page) ? this.allChunkedCompletedProjects[page] : {};
      this.chunkedOpenProjects = this.allChunkedOpenProjects.hasOwnProperty(page) ? this.allChunkedOpenProjects[ page ] : {};
      this.chunkedSubmittedProjects = this.allChunkedSubmittedProjects.hasOwnProperty(page) ? this.allChunkedSubmittedProjects[ page ] : {};
    },
    tabUpdate: function(tab, totalData){
      this.currentPage = 1;
      this.activeTab = tab;
      this.totalNoOfRecords = totalData;
      if( totalData < this.perPage && totalData > 0)
        this.noOfPages = 1;
      else
        this.noOfPages = Math.ceil(totalData / this.perPage);
      this.getPageData(this.currentPage);
    },
    updateCurrentPage: function(currentPage){
      this.currentPage = currentPage;
      this.getPageData(this.currentPage);
    }
  }
};
</script>

<style lang="scss" scoped>
  @import "../../layouts/css/_customvariables";
   .text-green{
      color: #2cac3d;
    }
    .text-red{
      color: #e63423;
    }
    .text-bold{
      font-family: $font-family-brandon-bold !important;
    }
    .text-medium{
      font-family: $font-family-brandon-medium;
    }
    .projects-page{
      width: 100%;
    }
    .custom-container{
      max-width: 100%;
    }
    .page-title {
      font-family: $font-family-UniNeue-bold;
      font-size: 30px;
      width: 100%;
      text-align: center;
      color: #363e48;
      margin: 5px 0 25px;
    }
    
  @media screen and(max-width:1281px) {
    .custom-container{
      .projects-page{
        .white-box{
          font-size: 14px;
        }
      }
    }
  }
  @media screen and(max-width:1200px) {
    .custom-container{
      .page-title {
        font-size: 28px;
        margin: 0 0 20px;
      }
    }
  }
  @media screen and(max-width:767px) {
    .custom-container{
        .projects-page{
          .green-btn{
            margin: 10px 15px 10px 0;
            max-width: 175px;
          }
        }
      }
  }
  @media screen and(max-width:575px) {
    .custom-container{
      .page-title {
        font-size: 26px;
      }
      .projects-page{
        .white-box{
          font-size: 14px;
          line-height: 18px;
        }
      }
      .green-btn{
        margin: 10px 15px 10px 0;
      }
    }
  }

</style>