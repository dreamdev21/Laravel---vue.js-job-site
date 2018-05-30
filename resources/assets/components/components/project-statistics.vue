<template>
  <div>
    <div class="white-box">
      <div class="row">
        <div class="col-12">
          <h4 class="block-title">Statistics
          </h4>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-3 statistics-info-wrap">
          <p class="mb-2 mb-sm-4">
            <span class="">
              Tester Needed :
            </span>
            <span class="text-bold statistics-num">
              {{ value.tester_needed }}
            </span>
          </p>
          <p class="mb-2 mb-sm-4">
            <span class="">
              Tester Submitted :
            </span>
            <span class="text-bold statistics-num">
              {{ value.testers ? value.testers.length : 0 }}
            </span>
          </p>
          <p class="mb-2 mb-sm-4">
            <span class="">
              Ratings/score :
            </span>
            <span class="text-bold statistics-num">
              88
            </span>
          </p>
          <p class="mb-2 mb-sm-4">
            <span class="">
              Issues :
            </span>
            <span class="text-bold statistics-num">
              11
            </span>
          </p>
          <p class="mb-0">
            <span class="">
              Attachments :
            </span>
            <span class="text-bold statistics-num">
              10
            </span>
          </p>
        </div>
        <div class="col-12 col-md-6">
          <div class="filter-tester-wrap" v-if="Object.keys(value.testers).length">
            <div class="form-group mb-4">
              <label>Filter by Testers: </label>
              <select class="form-control" v-model="filteredTesterId" >
                <option v-for="tester in value.testers" :key="tester.id" :value="tester.id">{{ tester.first_name }} {{ tester.last_name }}</option>
              </select>
            </div>
            <a @click="filterByTester" href="javascript:;" class="purple-btn">
              Filter
            </a>
          </div>
          <div v-else class="warning-box">
            Waiting for tester to apply
          </div>
        </div>
        <div class="col-12 col-md-3">
          <div class="row" v-if="Object.keys(value.testers).length" >
            <div class="col-12 text-center">
              <span class="text-bold float-right">
                Progress : 60%
              </span>
              <div class="float-right w-100 mt-2">
                <img src="~/img/progress-bar.png" class="img-fluid float-right"/>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12" v-show="value.status && value.status.name != 'Completed' ">
                <a @click="markAsCompleted" class="purple-btn mark-comple-btn" >Mark as Completed</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-show="filteredTester">
      <project-testing-process-review ref="projectTestingProcessReview" :projectId=projectId :testerId=filteredTesterId ></project-testing-process-review>
    </div>
  </div>
</template>

<script>
import ProjectTestingProcessReview from "components/components/project-testing-process-review";
export default {
  name: "ProjectStatistics",
  components: {
    ProjectTestingProcessReview
  },
  data() {
    return {
      selected: '',
      filteredTesterId: null,
      filteredTester: false,
      projectId: this.value.id,
      testerId: null,
    }
  },
  props: {
    value: {
      type: Object,
      required: true,
      default() {
        return {};
      }
    },
    disabled: {
      type: Boolean,
      default() {
        return false;
      }
    },
    errors: {
      type: Array,
      default() {
        return null;
      }
    },
    isProjectApproved: {
      type: Boolean,
      default(){
        return null;
      }
    }
  },
  methods: {
    markAsCompleted() {
      const requestData = _.pick(this.value, [
        "cost_per_tester",
        "allocated_tester",
        "total_cost",
        "name"
      ]);
      requestData.status = "COMPLETED";
      axios
        .put(`/api/projects/${this.value.id}`, requestData)
        .then(({ data: { data } }) => {
          this.$emit("onCompleted");
        })
        .catch(error => {
          this.errors = error.response.data.message;
        });
    },
    getTesterData(){
      axios.get(``)
    },
    filterByTester(){
      this.filteredTester = true;
      this.$refs.projectTestingProcessReview.reloadTestingProcessData();
    },
  }
};
</script>
<style lang="scss" scoped>
@import "../layouts/css/_customvariables";

.text-bold {
  font-family: $font-family-brandon-bold !important;
}
.text-medium {
  font-family: $font-family-brandon-medium;
}
.text-blue {
  color: #0082cc;
}
.text-purple {
  color: #363e48;
}
.warning-box {
  border: 2px solid #faebcc;
  color: #8a6d3b;
  font-size: 14px;
  font-weight: 600;
  text-align: center;
  border-radius: 4px;
  padding: 12px;
  background: #fcf8e4;
}
.white-box {
  background-color: #fff;
  box-shadow: 0px 0px 3px 2px rgba(3, 3, 3, 0.05);
  border-radius: 4px;
  padding: 15px;
  margin-bottom: 20px;
  font-size: 14px;
  line-height: 22px;
  color: #606368;
  .block-title {
    font-size: 18px;
    font-family: $font-family-UniNeue-bold;
    border-bottom: 1px solid #dadada;
    color: #0082cc;
    padding-bottom: 10px;
    margin-bottom: 10px;
    width: auto;
  }
  .block-subtitle {
    font-size: 20px;
    font-family: $font-family-brandon-bold !important;
    border-bottom: 1px solid #dadada;
    color: #0082cc;
    padding-bottom: 10px;
    margin-bottom: 10px;
    width: auto;
  }
  .mark-comple-btn {
    float: right;
    margin-top: 15px;
  }
}
.blue-btn {
  width: auto;
  padding: 8px 15px;
  border: 2px solid #0082cc;
  background-color: #00aff5;
  font-size: 14px;
  font-family: $font-family-brandon-medium;
  letter-spacing: 0.05rem;
  color: #fff;
  border-radius: 20px;
  display: block;
  text-align: center;
  color: #fff;
  &:hover {
    background-color: #13b9fb;
  }
}
.purple-btn {
  background-color: #5651b9;
  border: 2px solid #3e3a94;
  color: #fff !important;
  font-size: 15px;
  line-height: 16px;
  font-family: $font-family-brandon-medium;
  border-radius: 6px;
  padding: 3px 6px;
  -webkit-transition: all 0.4s ease;
  -moz-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  -ms-transition: all 0.4s ease;
  transition: all 0.4s ease;
  cursor: pointer;
  &:hover {
    outline: none !important;
    background-color: #6b65e0;
  }
  &:focus {
    outline: none !important;
  }
}
@media screen and(max-width:991px) {
  .white-box {
    padding: 15px;
  }
  .purple-btn{
    padding: 3px 5px;
    font-size: 14px;
  }
}
@media screen and(max-width:991px) {
  .purple-btn{
    padding: 3px 10px;
  }
}
@media screen and(max-width:575px) {
  .white-box {
    .block-title{
      font-size: 16px;
    }
  }
}
</style>

