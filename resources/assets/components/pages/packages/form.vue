<template>
    <div id="scroll-top" >
        <div class="container custom-container">
            <div class="row">
              <div class="col-12">
                <h1 class="page-title">
                   {{model.id ? 'Edit' : ''}} Packages
                </h1>
              </div>
            </div>
            <div class="packages-page">
              <vue-form class="form-horizontal" :state="formstate" @submit.prevent="onSubmit">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="block-subtitle">
                            Package Details
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                          <div style="color: red" v-if="errors">
                              <ul id="example-1">
                                  <li v-for="error in errors" :key="error">
                                      {{ error }}
                                  </li>
                              </ul>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <validate tag="div" class="row pb-3">
                          <div class="col-md-6 mb-2 mb-sm-2 mb-md-1"><span>Package Name :</span></div>
                          <div class="col-md-6">
                            <input type="text" name="name" v-model="model.name" required autofocus placeholder="Enter Package Name" class="form-control custom-form-control " />
                            <field-messages name="name" show="$invalid && $submitted" class="text-danger">
                                <div slot="required">Please enter package name</div>
                            </field-messages>
                          </div>
                        </validate>
                        <validate tag="div" class="row pb-3">
                          <div class="col-md-6 mb-2 mb-sm-2 mb-md-1"><span>For first project, charge of per Tester is (In USD) :</span></div>
                          <div class="col-md-6">
                            <input type="text" placeholder="" name="first_project_per_tester_charge" v-model="model.first_project_per_tester_charge" required class="form-control custom-form-control " />
                            <field-messages name="first_project_per_tester_charge" show="$invalid && $submitted" class="text-danger">
                                <div slot="required">Please enter per tester charge in USD</div>
                            </field-messages>
                          </div>
                        </validate>
                        <validate tag="div" class="row pb-3">
                          <div class="col-md-6 mb-2 mb-sm-2 mb-md-1"><span>For second project onward, charge of per Tester is (In USD) :</span></div>
                          <div class="col-md-6">
                            <input type="text" placeholder="" name="regular_per_tester_charge" v-model="model.regular_per_tester_charge" required class="form-control custom-form-control " />
                            <field-messages name="regular_per_tester_charge" show="$invalid && $submitted" class="text-danger">
                                <div slot="required">Please enter per tester charge after first project in USD</div>
                            </field-messages>
                          </div>
                        </validate>
                        <div class="row pb-3">
                          <div class="col-md-6 mb-2 mb-sm-2 mb-md-1"><span>Default package? </span></div>
                          <div class="col-md-6">
                            <div class="radio form-check-inline mr-5">
                              <label>
                                <input type="radio" :disabled="model.id && model.is_default" name="is_default" :value="true" v-model="model.is_default">
                                <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                Yes
                              </label>
                          </div>
                          <div class="radio form-check-inline">
                            <label>
                              <input type="radio" :disabled="model.id && model.is_default" name="is_default" :value="false" v-model="model.is_default" checked>
                              <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                              No
                            </label>
                          </div>
                          </div>
                        </div>
                        <div class="row pb-3">
                          <div class="col-md-6 mb-2 mb-sm-2 mb-md-1"><span>Do you want to give discount in this package? </span></div>
                          <div class="col-md-6">
                            <div class="radio form-check-inline mr-5">
                              <label>
                                <input type="radio" name="o3" value="yes" v-model="discount">
                                <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                Yes
                              </label>
                          </div>
                          <div class="radio form-check-inline">
                            <label>
                              <input type="radio" name="o3" value="no" v-model="discount" checked>
                              <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                              No
                            </label>
                          </div>
                          </div>
                        </div>
                        <div v-if="discount == 'yes'">
                          <div class="row pb-3">
                            <div class="col-md-6 mb-2 mb-sm-0"><span>Discount applied after Testers greater than :</span></div>
                            <div class="col-md-6">
                              <input type="number" v-model="model.discount_after_number_of_tester" placeholder="" class="form-control custom-form-control " />
                            </div>
                          </div>
                          <div class="row pb-3">
                            <div class="col-md-6 mb-2 mb-sm-0"><span>What will be discount type :</span></div>
                              <div class="col-md-6">
                                 <div class="radio form-check-inline mr-5">
                                    <label>
                                      <input type="radio" name="discount" v-model="model.discount_type" :value="1" checked>
                                      <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                      Percentage
                                    </label>
                                </div>
                                <div class="radio form-check-inline">
                                  <label>
                                    <input type="radio" name="discount" v-model="model.discount_type" :value="2">
                                    <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                    Amount
                                  </label>
                                </div>
                            </div>
                          </div>
                          <div class="row pb-3">
                            <div class="col-md-6 mb-2 mb-sm-0"><span>What will be discount amount/percentage :</span></div>
                            <div class="col-md-6">
                              <input type="number" placeholder="" v-model="model.discount_amount" class="form-control custom-form-control " />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-12 text-center">
                     <router-link class="btn grey-btn" :to="{name: 'admin.packages.list'}">Back to Packages</router-link>
                    <button type="submit" class="btn purple-btn mr-0">
                      Save Package
                    </button>
                  </div>
                </div>
              </vue-form>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from "vue";
import VueForm from "vue-form";
import options from "src/validations/validations.js";
Vue.use(VueForm, options);

export default {
  name: "packageForm",
  data() {
    return {
      discount: "no",
      formstate: {},
      model: {
        is_default: false
      },
      errors: null
    };
  },
  methods: {
    onSubmit: function() {
      if (this.formstate.$invalid) {
        return;
      } else {
        const requestData = { ...this.model };
        let p;
        if (this.model.id) {
          p = axios.put(`/api/packages/${this.model.id}`, requestData);
        } else {
          p = axios.post("/api/packages", requestData);
        }
        p
          .then(response => {
            this.$router.push({ name: "admin.packages.list" });
          })
          .catch(error => {
            if (Array.isArray(error.response.data.message)) {
              this.errors = error.response.data.message;
            } else {
              this.errors = [error.response.data.message];
            }
          });
      }
    }
  },
  mounted() {
    if (this.$route.params.id) {
      axios
        .get(`/api/packages/${this.$route.params.id}`)
        .then(({ data: { data } }) => {
          this.model = data;
          if (this.model.discount_after_number_of_tester) {
            this.discount = "yes";
          }
        });
    }
  }
};
</script>

<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";
.custom-container {
  max-width: 100%;
  padding: 0;
}
.text-green {
  color: #2cac3d;
}
.page-title {
  font-family: $font-family-UniNeue-bold;
  font-size: 30px;
  width: 100%;
  text-align: center;
  color: #363e48;
  margin: 5px 0 25px;
}
.checkbox label:after,
.radio label:after {
  content: "";
  display: table;
  clear: both;
}

.checkbox .cr,
.radio .cr {
  position: relative;
  display: inline-block;
  border: 1px solid #3e3a94;
  border-radius: 0.25em;
  width: 1.3em;
  height: 1.3em;
  float: left;
  margin-right: 0.5em;
  color: #3e3a94;
}

.radio .cr {
  border-radius: 50%;
}

.checkbox .cr .cr-icon,
.radio .cr .cr-icon {
  position: absolute;
  font-size: 0.8em;
  line-height: 0;
  top: 50%;
  left: 20%;
}

.radio .cr .cr-icon {
  margin-left: 0.04em;
}

.checkbox label input[type="checkbox"],
.radio label input[type="radio"] {
  display: none;
}

.checkbox label input[type="checkbox"] + .cr > .cr-icon,
.radio label input[type="radio"] + .cr > .cr-icon {
  transform: scale(3) rotateZ(-20deg);
  opacity: 0;
  transition: all 0.3s ease-in;
}

.checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
.radio label input[type="radio"]:checked + .cr > .cr-icon {
  transform: scale(1) rotateZ(0deg);
  opacity: 1;
}

.checkbox label input[type="checkbox"]:disabled + .cr,
.radio label input[type="radio"]:disabled + .cr {
  opacity: 0.5;
}
.packages-page {
  width: 100%;
  .white-box {
    .block-subtitle {
      font-family: $font-family-brandon-bold;
      font-size: 20px;
      color: #3e3a94;
      border-bottom: 1px solid #dadada;
      padding-bottom: 10px;
      margin-bottom: 15px;
    }
    .custom-form-control {
      font-size: 15px;
      border-radius: 4px;
      padding: 2px 8px;
      &:hover {
        outline: none !important;
      }
      &:focus {
        outline: none !important;
      }
    }
  }
}
.purple-btn,
.grey-btn {
  display: inline-block;
  border-radius: 20px !important;
  padding: 6px 10px;
  max-width: 150px;
  min-width: 150px;
  margin: 0 auto;
  margin-right: 10px;
}
@media screen and(max-width:1200px) {
  .page-title {
    font-size: 28px;
    margin: 0 0 20px;
  }
  .packages-page {
    .white-box {
      .block-title {
        font-size: 18px;
      }
    }
  }
}
@media screen and(max-width:767px) {
}
@media screen and(max-width:575px) {
  .custom-container {
    padding: 0;
    .page-title {
      font-size: 26px;
      margin: 0 0 20px;
    }
    .packages-page {
      .white-box {
        line-height: 18px;
      }
    }
    .purple-btn,
    .grey-btn {
      margin-right: 5px;
      padding: 6px;
      max-width: 138px;
      min-width: 120px;
    }
  }
}
</style>