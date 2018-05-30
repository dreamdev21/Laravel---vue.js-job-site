<template>
    <div class="proj-block-wrap">
        <div class="row align-items-center">
            <div class="col-md-12 col-xl-10 border-xl-right">
                <div class="row">
                    <div class="col-12 mb-2">
                        <router-link class="proj-title text-uppercase" :to="{ name: 'admin.test_project.view', params: { id: project.id }}">{{ project.name }}</router-link>
                    </div>
                    <div class="col-md-6 text-left">
                        <div class="mb-2">
                            <span class="text-bold mr-1 d-block d-sm-inline-block">Devices : </span>
                            <span class="d-block d-sm-inline-block">
                            <device-selector disabled v-model="selected_devices"></device-selector>
                        </span>
                        </div>
                        <div class="mb-2">
                            <span class="text-bold mr-1 d-block d-sm-inline-block">Type : </span>
                            <span class="d-block d-sm-inline-block">
                            {{ project.project_type.name }}
                        </span>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-right text-left">
                        <div class="mb-2">
                            <span class="text-bold mr-1 d-block d-sm-inline-block">Created on : </span>
                            <span class="d-block d-sm-inline-block">{{project.created_at | date}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-2 btn-wrap">
                <router-link class="btn purple-btn d-xl-block view-proj-btn" :to="{ name: 'admin.test_project.view', params: { id: project.id }}">View Project</router-link>
                <div class="d-xl-block text-xl-center text-right">
                    <router-link :to="{ name: 'admin.test_project.edit', params: { id: project.id }}" class="btn edit-icon mr-xl-0 mr-1">
                        <img src="~img/edit_18x18.png" class="img-fluid"/>
                        <!-- <i class="fa fa-edit"></i> -->
                    </router-link>
                    <a href="javascript:;" @click.prevent="deleteTestProject(project.id)" class="btn delete-icon">
                        <img src="~img/bin_18x18.png" class="img-fluid"/>
                        <!-- <i class="fa fa-trash"></i> -->
                    </a>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
  import DeviceSelector from "components/components/device-selector";
  export default {
    name: "ProjectListItem",
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
            .edit-icon{
                padding: 5px 0;
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
            .delete-icon{
                padding: 5px 0;
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
                .border-xl-right{
                    border-right: none;
                }
                .edit-icon,.delete-icon{
                    line-height: 14px;
                    padding: 0;
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