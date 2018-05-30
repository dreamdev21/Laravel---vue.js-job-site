<template>
    <div class="">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-6 col-12 text-center">
                <h1 class="page-title">
                    Publishers
                </h1>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 pull-right">
                <router-link :to="{name: 'admin.add_publisher'}" class="purple-btn" > Add New Publisher </router-link>
            </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="white-box">
              <div class="row">
                <div class="col-lg-12">
                    <!-- <div style="color: red" v-if="errors" v-text="errors"></div> -->
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
                  <v-server-table ref="publisherTable" url="/api/publisher" :columns="columns" :options="options">
                      <div slot="status" slot-scope="props">
                          <router-link v-if="props.row.status == 'Pending Activated'" class="proj-title text-uppercase" :to="'/portal/login?token='+props.row.token">{{  props.row.status }}</router-link>
                          <span v-else class="proj-title text-uppercase" >{{  props.row.status }}</span>
                      </div>
                      <div slot="registration_date" slot-scope="props">
                          {{ props.row.registration_date | date }}
                      </div>
                      <div slot="view_projects" slot-scope="props" class="text-center">
                          <router-link :to="{name: 'admin.publisher.projects', params: {id: props.row.id, name: props.row.name}}">{{ props.row.view_projects }}</router-link>
                      </div>
                      <div slot="actions" slot-scope="props">
                          <router-link :to="{ name: 'admin.publisher.profile', params: { id: props.row.id }}" class="mr-1">
                              <!-- <i class="fa fa-eye"></i> -->
                            <img src="~img/eye_icon.png" class="img-fluid" />
                          </router-link>
                          <router-link :to="{ name: 'admin.publisher.edit', params: { id: props.row.id }}" class="mr-1">
                            <img src="~img/edit_18x18.png" class="img-fluid" />
                              <!-- <i class="fa fa-edit"></i> -->
                          </router-link>
                          <a href="javascript:;" @click.prevent="deleteUser(props.row.id)">
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
        name: "publishers_list",
        data() {
            return {
                errors: null,
                columns: [
                    "name",
                    "email",
                    "registration_date",
                    "status",
                    "view_projects",
                    "actions"
                ],
                options: {
                    sortable: ["name", "email", "registration_date", "view_projects"],
                    orderBy: {
                        column: "registration_date",
                        ascending: false
                    },
                    requestFunction: function(data) {
                        return axios
                            .get(this.url, {
                                params: {
                                    ...data,
                                    order: data.ascending ? "asc" : "desc",
                                    column:
                                        this.orderBy.column === "registration_date"
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
                                name: `${t.first_name} ${t.middle_name || ""} ${t.last_name ||
                                ""}`,
                                registration_date: t.created_at,
                                status: t.status ? t.status.name : "Not Known",
                                view_projects: t.publisher_projects.length
                            })),
                            count: response.meta.total
                        };
                    },
                    dateColumns: ["registration_date"]
                }
            };
        },
        methods: {
            deleteUser(id) {
                this.$swal({
                    title: "Are you sure?",
                    text: "You want to delete publisher?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true
                }).then(willDelete => {
                    if (willDelete) {
                        return axios
                            .delete(`/api/publisher/${id}`)
                            .then(() => this.$refs.publisherTable.refresh())
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
    padding: 8px 10px;
    margin: 10px auto 0;
    display: block;
    width: 100%;
    max-width: 160px;
    float: right;
  }
  
@media screen and(max-width:1281px) {
  
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