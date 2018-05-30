<template>
  <div class="proj-block-wrap">
    <div class="row align-items-center">
      <div class="col-md-12 col-xl-10 border-xl-right">
        <div class="row mb-3">
          <div class="col-md-8">
            <router-link class="proj-title text-uppercase" :to="{ name: 'admin.project.view', params: { id: project.id }}">{{ project.name }}</router-link>
          </div>
          <div class="col-md-4 text-md-right text-left">
            <span class="bg-badge-wrap">
              {{ project.project_type.name }}
            </span>
          </div>
          <div class="col-12 d-none">
            please find attached link of the HTC vive. Download in Vive and test.
          </div>
        </div>
        <div class="row">
          <div class="col-xl-4">
            <div class="mb-2">
              <span class="text-bold mr-2">Publisher - </span>
              <span class="d-sm-inline-block d-block"> {{ project.publisher.name ? project.publisher.name : project.publisher.first_name + ' ' + project.publisher.last_name }}</span>
            </div>
            <div class="mb-2">
              <span class="text-bold mr-2">Time needed to test - </span>
              <span class="d-sm-inline-block d-block">{{ project.estimate_tester_time | times }}</span>
            </div>
            <div class="mb-2">
              <span class="text-bold mr-2 d-inline-block">Devices - </span>
              <span class="d-sm-inline-block d-block">
                <device-selector disabled v-model="selected_devices"></device-selector>
              </span>
            </div>
          </div>
          <div class="col-xl-8">
            <div class="row">
              <div class="col-sm-6 mb-2 text-xl-center">
                  <span class="d-block text-bold mb-sm-2 mb-1">Start Date - End Date </span>
                  <span class="d-block mb-0"> {{ project.start_date | date}} - {{project.end_date | date}}</span>
              </div>
              <div class="col-sm-3 mb-2 text-xl-center" v-if="project.status.name == 'Running'">
                <span class="d-block d-sm-inline-block">{{ project.testersSubmitted.length }} Testers Submitted </span>
                <span class="d-block d-sm-inline-block">{{ project.tester_needed - project.testersSubmitted.length }} Pending</span>
              </div>
              <div class="col-sm-3 mb-2 text-xl-center" v-else-if="project.status.name == 'Pending Approval'">
                <span class="d-block text-bold">Testers needed</span>
                <h3 class="d-block text-bold">{{ project.tester_needed }} </h3>
              </div>
              <div class="col-sm-3 mb-2 text-xl-center">
                <span class="d-block d-sm-inline-block text-bold  mb-2">Total Amount</span>
                <h3 class="text-bold m-0">${{project.total_cost - project.applied_discount}}</h3>
              </div>
              <div class="col-12 text-xl-right">
                <span v-if="this.project.status.name == 'Running'" class="text-bold mr-1 d-block d-sm-inline-block pl-xl-0">
                  Started On
                </span>
                <span v-if="this.project.status.name == 'Pending Approval'" class="text-bold mr-1 d-block d-sm-inline-block pl-xl-0">
                  Request for approval sent on
                </span>
                {{project.created_at | datetime }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-xl-2 btn-wrap text-xl-center">
        <router-link class="purple-btn view-proj-btn" :to="{ name: 'admin.project.view', params: { id: project.id }}">View Project</router-link>
        <router-link tag="a" :to="{ name: 'admin.project.edit', params: { id: project.id }}" class="d-block mt-xl-0 mt-3">Edit project</router-link>
          <!-- <div class="d-xl-block text-xl-center text-right">
              <router-link :to="{ name: 'admin.project.edit', params: { id: project.id }}" class="edit-icon mr-xl-0 mr-2">
                  <img src="~img/edit_18x18.png" class="img-fluid"/>
              </router-link>
              <a href="javascript:;" @click.prevent="onDelete(project.id)" class="delete-icon">
                  <img src="~img/bin_18x18.png" class="img-fluid"/>
              </a>
          </div> -->
      </div>
    </div>
  </div>
</template>
<script>
import DeviceSelector from "components/components/device-selector";
import Vue from "vue";
import { TimeFilter } from "src/services/filter";
Vue.filter("times", TimeFilter);

export default {
  name: "ProjectItem",
  components: {
    DeviceSelector
  },
  props: {
    project: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      originalUser: window.USER
    };
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
.text-blue {
  color: #0082cc;
}
.project-link {
  color: #212529;
}
.text-red {
  color: #e63423;
}
.text-green {
  color: #2cac3d;
}
.text-purple {
  color: #3e3a94;
}
.text-bold {
  font-family: $font-family-brandon-bold;
}
.text-medium {
  font-family: $font-family-brandon-medium;
}
.proj-block-wrap {
  padding: 15px 0;
  font-family: $font-family-brandon-regular;
  font-size: 14px;
  color: #606368;
  position: relative;
  border-bottom: 1px solid #dadada;
  &:first-child {
    padding-top: 0;
  }
  &:last-child {
    padding-bottom: 0;
    border: none;
  }
  span {
    vertical-align: top;
  }
  .border-xl-right {
    border-right: 1px solid #dadada;
  }
  .proj-title {
    font-family: $font-family-brandon-bold;
    font-size: 16px;
    color: #363e48;
  }
  .view-proj-btn {
    border-radius: 16px;
    // width: 100%;
    display: block;
    margin-bottom: 10px;
    color: #fff;
  }
  a {
    color: #3e3a94;
  }
  .bg-badge-wrap {
    background-color: #e3e3e3;
    border-top-left-radius: 6px;
    border-bottom-left-radius: 6px;
    margin-right: -15px;
    padding: 2px 5px;
    margin-top: 3px;
    font-size: 12px;
  }
}
@media screen and(max-width:1200px) {
  .proj-block-wrap {
    .view-proj-btn {
      float: left;
      margin-right: 15px;
      margin-top: 10px;
      max-width: 150px;
      margin-bottom: 0;
    }
    .border-xl-right {
      border-right: none;
    }
    .bg-badge-wrap {
      margin-right: -20px;
    }
  }
}
@media screen and(max-width:991px) {
  .proj-block-wrap {
    .view-proj-btn {
      float: left;
      padding: 5px 10px;
    }
  }
}
@media screen and(max-width:767px) {
  .proj-block-wrap {
    padding: 10px 0 15px;
    .proj-title {
      font-size: 20px;
    }
    .bg-badge-wrap {
      margin: 10px 0;
      margin-left: -15px;
      border-radius: 0px;
      border-top-right-radius: 6px;
      border-bottom-right-radius: 6px;
      float: left;
      position: relative;
    }
  }
}

@media screen and(max-width:575px) {
  .view-proj-btn {
    max-width: 120px;
  }
  .proj-block-wrap {
    .proj-title {
      font-size: 16px;
    }
  }
}
</style>
