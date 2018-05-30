<template>
    <div class="card-body">
        <div class="border-row-bottom mb-4">
            <div class="row">
                <div class="col-md-12 pb-3 text-left">
                    <span class="font-bold-16 font-title-color">{{ project.name }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-left">
                    <ul class="pl-0">
                        <li>
                            <label class="font-bold-12">Publisher: </label>
                            <span class="font-12">{{ originalUser.full_name }}</span>
                        </li>
                        <li>
                            <label class="font-bold-12">Devices: </label>
                            <device-selector disabled v-model="selected_devices"></device-selector>
                        </li>
                        <li>
                            <label class="font-bold-12">Type: </label>
                            <span class="font-12">{{ project.project_type.name }}</span>
                        </li>
                        <li>
                            <label class="font-bold-12">Tester working: </label>
                            <span class="font-12">{{ project.tester_needed }} Testers</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 text-center">
                    <router-link class="btn btn-primary rounded-0 px-5" :to="{ name: `admin.test_project.view`, params: { id: project.id }}">View Project</router-link>
                </div>
                <div class="col-md-3 text-right">
                    <ul>
                        <li>
                            <label class="font-bold-12">Start Date: </label>
                            <span class="font-12">{{ project.start_date | date}}</span>
                        </li>
                        <li>
                            <label class="font-bold-12">End Date: </label>
                            <span class="font-12">{{project.end_date | date}}</span>
                        </li>
                    </ul>
                    <!--<router-link :to="{ name: 'publisher.project.edit', params: { id: project.id }}" class="btn btn-info text-white">-->
                        <!--<i class="fa fa-edit"></i>-->
                    <!--</router-link>-->
                    <!--<a href="javascript:;" @click.prevent="onDelete(project.id)" class="btn btn-warning text-white"><i class="fa fa-trash"></i></a>-->
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import DeviceSelector from "components/components/device-selector";
  import { isProjectApproved } from "src/services/project";
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
      },
      project_approved() {
        return isProjectApproved(this.project.status.name);
      }
    },
    methods: {
      onDelete(id) {
        this.$emit("delete", id);
      }
    }
  };
</script>