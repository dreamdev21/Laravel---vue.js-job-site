<template>
    <div>
      <div class="row">
            <div class="col-xl-10 col-lg-9 col-md-8 col-sm-8 col-12 text-center">
                <h1 class="page-title">
                    Packages
                </h1>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-12 pull-right">
              <router-link :to="{name: 'admin.packages.add'}" class="btn purple-btn" > Add New Package </router-link>
            </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
              <div class="white-box">
                  <div class="col-lg-12">
                      <div style="color: red" v-if="errors" >
                          <ul id="example-1">
                              <li :v-for="error in errors">
                                  {{ error }}
                              </li>
                          </ul>
                      </div>
                  </div>
                  <div class="user.responsive admin-custom-table">
                      <v-server-table ref="packageTable" url="/api/packages" :columns="columns" :options="options">
                          <div slot="default_package" slot-scope="props">
                            <i class="fa" :class="{'fa-check' : props.row.is_default, 'fa-times': !props.row.is_default}"></i>
                          </div>
                          <div slot="actions" slot-scope="props">
                              <router-link :to="{ name: 'admin.packages.edit', params: { id: props.row.id }}" class="">
                                <img src="~img/edit_18x18.png" class="img-fluid"/>
                                  <!-- <i class="fa fa-edit"></i> -->
                              </router-link>
                              <a href="javascript:;" @click.prevent="deletePackage(props.row.id)" class="">
                                <img src="~img/bin_18x18.png" class="img-fluid"/>
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
  name: "PackagesList",
  data() {
    return {
      errors: null,
      columns: [
        "name",
        "first_project_per_tester_charge",
        "regular_per_tester_charge",
        "discount",
        "created_at",
        "default_package",
        "actions"
      ],
      options: {
        headings: {
          name: "Package Name"
        },
        sortable: ["name"],
        orderBy: {
          column: "name",
          ascending: true
        },
        requestFunction: function(data) {
          return axios
            .get(this.url, {
              params: {
                ...data,
                order: data.ascending ? "asc" : "desc",
                column: this.orderBy.column
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
              first_project_per_tester_charge: `$${
                t.first_project_per_tester_charge
              }`,
              regular_per_tester_charge: `$${t.regular_per_tester_charge}`,
              discount: `${
                t.discount_type
                  ? t.discount_type === 1
                    ? t.discount_amount + "%"
                    : "$" + t.discount_amount
                  : "N/A"
              }`
            })),
            count: response.meta.total
          };
        },
        dateColumns: ["created_at"]
      }
    };
  },
  methods: {
    deletePackage(id) {
      this.$swal({
        title: "Are you sure?",
        text: "You want to delete the package?",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          return axios
            .delete(`/api/packages/${id}`)
            .then(() => this.$refs.packageTable.refresh())
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
.purple-btn {
  border-radius: 6px;
  padding: 8px 3px;
  margin: 10px auto 0;
  display: block;
  width: 100%;
  max-width: 160px;
  float: right;
}

@media screen and(max-width:1281px) {
  .purple-btn {
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
  .purple-btn {
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
    margin: 0 0 10px;
  }
  .white-box {
    line-height: 18px;
  }
  .purple-btn {
    margin: 0px auto 20px;
    max-width: 160px;
    float: none;
  }
}
</style>