<template>
  <div class="testing-process-tabwrap">
    <div class="info-wrap" v-if="!hasPaymentMethod">
      Please add paypal account to receive payment.
    </div>
    <div class="white-box" v-else>
      <div class="row">
        <div class="col-12">
          <div class="content-wrap d-block d-sm-inline-block">
            <h4 class="username">Your default Paypal account</h4>
            <p class="usermail">{{($store.state.user.default_paypal_email || {}).email}}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="white-box">
      <h4 class="block-title proj-name-block-wrap">
        All Paypal Accounts
        <a v-if="!addPaymentMethodMod" href="#" class="green-btn text-uppercase text-center pull-right add-new-account-btn" @click.prevent="addPaymentMethodMod=true">Add New Paypal Account</a>
      </h4>
      <div class="table-responsive tester-payment-method-table">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Default</th>
              <th scope="col">Accounts</th>
              <th scope="col" class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="p in paymentMethods" :key="p.id">
              <td scope="row" class="text-center">
                <div class="radio form-check-inline">
                  <label>
                    <input type="radio" name="o3" v-model="defaultEmailId" :value="p.id" :checked="p.is_default">
                    <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                  </label>
                </div>
              </td>
              <td scope="row">{{p.account_data.email}}</td>
              <td scope="row" class="text-center">
                <a href="#" @click.prevent="deletePaymentMethod(p)" class="link">Delete</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
        <a href="#" @click.prevent="updateDefaultEmail" class="green-btn text-uppercase text-center" v-if="hasPaymentMethod">Save</a>
    </div>
    <div class="white-box" v-if="addPaymentMethodMod">
      <h4 class="block-title">
        Add New Paypal Account
      </h4>
      <vue-form ref="addForm" :state="formstate" @submit.prevent="onSubmit">
        <div class="row justify-content-center">
          <div class="col-md-4 col-12">
            <div style="color: red" v-if="errors" >
              <ul id="example-1" class="pl-0">
                <li v-for="error in errors" :key="error">
                {{ error }}
                </li>
              </ul>
            </div>
            <validate tag="div" class="form-group custom-form-group mb-0">
              <span class="text-bold">Paypal account email : </span>
              <input v-model="model.email" name="email" id="email" type="email" required autofocus placeholder="E-mail" class="form-control custom-form-control mt-1" />
              <field-messages name="email" show="$invalid && $submitted" class="text-danger">
                  <div slot="required">Email is a required field</div>
                  <div slot="email">Email is not valid</div>
              </field-messages>
            </validate>
            <a href="#" class="green-btn text-uppercase text-center pull-right add-new-account-btn mt-1 ml-1" @click.prevent="addPaymentMethodMod=false">Cancel</a>
            <button type="submit" class="green-btn text-uppercase text-center pull-right add-new-account-btn mt-1">Add</button>
          </div>
        </div>
      </vue-form>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import VueForm from "vue-form";
import options from "src/validations/validations.js";
Vue.use(VueForm, options);
export default {
  name: "payment_mehods",
  data() {
    return {
      formstate: {},
      model: {
        email: ""
      },
      errors: null,
      defaultEmailId: null,
      paymentMethods: [],
      addPaymentMethodMod: false
    };
  },
  methods: {
    updateDefaultEmail() {
      if (!this.defaultEmailId) {
        return;
      }
      this.$swal({
        title: "Are you sure?",
        text: "You want to change default payment method?",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          return axios
            .put(`/api/payment-methods/${this.defaultEmailId}`, {
              is_default: true
            })
            .then(this.getPaymentMethods.bind(this));
        }
      });
    },
    deletePaymentMethod(p) {
      this.$swal({
        title: "Are you sure?",
        text: "You want to delete payment method?",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          return axios
            .delete(`/api/payment-methods/${p.id}`)
            .then(this.getPaymentMethods.bind(this));
        }
      });
    },
    getPaymentMethods() {
      return axios.get("/api/payment-methods").then(({ data }) => {
        this.paymentMethods = data;
        this.defaultEmailId = data.find(i => i.is_default).id;
      });
    },
    onSubmit() {
      this.errors = null;
      if (this.formstate.$invalid) {
        return;
      }
      return axios
        .post("/api/payment-methods", {
          gateway_type: "paypal",
          account_data: { email: this.model.email }
        })
        .then(() => {
          this.addPaymentMethodMod = false;
          this.model.email = "";
          this.$refs.addForm.reset();
          this.getPaymentMethods();
        })
        .catch(error => {
          if (Array.isArray(error.response.data.message)) {
            this.errors = error.response.data.message;
          } else {
            this.errors = [error.response.data.message];
          }
        });
    }
  },
  computed: {
    hasPaymentMethod() {
      return this.paymentMethods.length;
    }
  },
  mounted() {
    this.getPaymentMethods();
  }
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";
.text-green {
  color: #2cac3d;
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
  border: 1px solid #2cac3d;
  border-radius: 0.25em;
  width: 1.3em;
  height: 1.3em;
  float: left;
  margin-right: 0.5em;
  color: #2cac3d;
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
.checkbox label,
.radio label {
  margin-bottom: 2px;
}

.checkbox label input[type="checkbox"]:disabled + .cr,
.radio label input[type="radio"]:disabled + .cr {
  opacity: 0.5;
}
.info-wrap {
  background-color: #fcb3b4;
  border-radius: 6px;
  padding: 8px;
  margin-bottom: 20px;
}
.white-box {
  .link {
    font-size: 14px;
    color: #2cac3d;
    font-family: $font-family-brandon-regular;
    text-decoration: underline !important;
  }
  .block-title {
    font-size: 20px;
    font-family: $font-family-UniNeue-bold;
    border-bottom: 1px solid #dadada;
    color: #2cac3d;
    padding-bottom: 10px;
    margin-bottom: 10px;
  }
  .proj-name-block-wrap {
    padding-bottom: 15px;
  }
  .content-wrap {
    vertical-align: middle;
    .username {
      font-family: $font-family-UniNeue-regular;
      font-size: 25px;
      color: #363e48;
      margin-bottom: 0px;
    }
    .usermail {
      font-size: 15px;
      color: #73767b;
      font-family: $font-family-brandon-regular;
      margin-bottom: 0;
    }
  }
  .custom-form-group {
    .custom-form-control {
      background-color: transparent !important;
    }
  }
}
.green-btn {
  max-width: 130px;
  padding: 5px 10px;
  display: block;
  color: #fff !important;
  border-radius: 20px;
  font-family: $font-family-brandon-bold;
  margin: 0 auto;
}
.add-new-account-btn {
  padding: 4px 10px;
  max-width: 100%;
  margin-top: -3px;
}
@media screen and(max-width:1281px) {
  .white-box {
    .content-wrap {
      .username {
        font-size: 22px;
      }
    }
  }
}
@media screen and(max-width:1200px) {
  .white-box {
    .block-title {
      font-size: 18px;
    }
  }
}
@media screen and(max-width:767px) {
  .white-box {
    .content-wrap {
      margin-bottom: 5px;
      .username {
        font-size: 18px;
        margin-bottom: 5px;
      }
    }
  }
}
@media screen and(max-width:480px) {
  .white-box {
    line-height: 18px;
    .proj-name-block-wrap {
      float: left;
      width: 100%;
      padding-bottom: 10px;
    }
    .add-new-account-btn {
      padding: 3px 6px;
      font-size: 12px;
      margin-top: 5px;
    }
  }
  .green-btn {
    margin: 5px auto 0;
  }
}
</style>