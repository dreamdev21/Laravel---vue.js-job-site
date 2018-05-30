<template>
    <div class="">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-8 col-12 text-center">
                <h1 class="page-title">
                    Project Type
                </h1>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 col-12 pull-right">
                <router-link :to="{name: 'admin.projectType.add'}" class="btn purple-btn" > Add New Project type </router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                  <div class="row">
                    <div class="col-lg-12">
                        <div style="color: red" v-if="errors" >
                            <ul id="example-1">
                                <li :v-for="error in errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>
                    </div>
                  </div>
                    <div class="user.responsive admin-custom-table">
                        <v-server-table ref="projectTypeTable" url="/api/project-type" :columns="columns" :options="options">
                            <div slot="actions" slot-scope="props">
                                <router-link :to="{ name: 'admin.projectType.edit', params: { id: props.row.id }}" class="">
                                    <img src="~img/edit_18x18.png" class="img-fluid" />
                                    <!-- <i class="fa fa-edit"></i> -->
                                </router-link>
                                <a href="javascript:;" @click.prevent="deleteType(props.row.id)" class="">
                                    <img src="~img/bin_18x18.png" class="img-fluid" />
                                    <!-- <i class="fa fa-trash"></i> -->
                                </a>
                            </div>
                        </v-server-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Vue from "vue";
    import { ServerTable, Event } from "vue-tables-2";
    Vue.use(ServerTable, {
        sortIcon: {
            base: "fa",
            up: "fa-chevron-up",
            down: "fa-chevron-down",
            is: "fa-sort"
        }
    });

    export default {
        name: "projectType_list",
        data() {
            return {
                errors: null,
                columns: ["name", "status", "created_at", "actions"],
                options: {
                    sortable: ["name", "status", "created_at"],
                    orderBy: {
                        column: "created_at",
                        ascending: false
                    },
                    requestFunction: function(data) {
                        return axios
                            .get(this.url, {
                                params: {
                                    ...data,
                                    order: data.ascending ? "asc" : "desc",
                                    column:
                                        this.orderBy.column === "created_at"
                                            ? "created_at"
                                            : this.orderBy.column
                                }
                            })
                            .catch(
                                function(e) {
                                    this.dispatch("error", e);
                                }.bind(this)
                            );
                    },
                    responseAdapter: function(response) {
                        return {
                            data: response.data.map(t => ({
                                ...t,
                                created_at: t.created_at
                            })),
                            count: response.meta.total
                        };
                    },
                    dateColumns: ["created_at"]
                }
            };
        },
        methods: {
            deleteType(id) {
                this.$swal({
                    title: "Are you sure?",
                    text: "You want to delete the project type?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true
                }).then(willDelete => {
                    if (willDelete) {
                        return axios
                            .delete(`/api/project-type/${id}`)
                            .then(() => this.$refs.projectTypeTable.refresh())
                            .catch(e => (this.errors = e.response.message));
                    }
                });
            }
        }
    };
</script>

<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";
.page-title {
    font-family: $font-family-UniNeue-bold;
    font-size: 30px;
    width: 100%;
    text-align: center;
    color: #363e48;
    margin: 5px 0 25px;
  }
  .purple-btn{
    border-radius: 6px;
    padding: 8px 3px;
    margin: 10px auto 0;
    display: block;
    width: 100%;
    max-width: 190px;
    float: right;
  }
   
@media screen and(max-width:1281px) {
  .purple-btn{
    font-size: 14px;
  }
}
@media screen and(max-width:1200px) {
    .page-title {
      font-size: 28px;
      margin: 0 0 20px;
    }
    .white-box {
      .block-title {
        font-size: 18px;
      }
    }
    .purple-btn{
      margin-top: 3px;
      max-width: 160px;
      float: right;
    }
}
@media screen and(max-width:991px) {
}
@media screen and(max-width:575px) {
  .page-title {
    font-size: 26px;
    margin:  0 0 10px;
  }
  .white-box {
    line-height: 18px;
  }
  .purple-btn{
      margin: 0px auto 20px;
      max-width: 160px;
      float: none;
  }
}
</style>