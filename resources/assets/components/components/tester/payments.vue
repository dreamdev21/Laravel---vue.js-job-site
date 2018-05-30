<template>
  <div class="testing-process-tabwrap">
    <div class="info-wrap" v-if="pendingWithdrawRequest">
      Your request of <span class="text-bold">${{pendingWithdrawRequest[0].amount}}</span> on {{pendingWithdrawRequest[0].created_at | date}} is {{pendingWithdrawRequest[0].status}}.
    </div>
    <div class="white-box">
      <div class="row">
        <div class="col-md-8 col-12">
          <div class="content-wrap d-block d-sm-inline-block">
            <h4 class="username">Your default Paypal account</h4>
            <p class="usermail">{{($store.state.user.default_paypal_email || {}).email}}</p>
            <router-link :to="{name: 'tester.payment-methods'}" >Change</router-link>
          </div>
        </div>
        <div class="col-md-4 col-12 text-md-right">
            <span class="d-block">Current Balance</span>
            <span class="d-block text-bold">${{(wallet || {}).available_earnings || 0}}</span>
            <a @click.prevent="openWithdrawModal" v-if="(wallet || {}).available_earnings && !pendingWithdrawRequest" href="#" class="">Withdraw</a>
        </div>
      </div>
    </div>
    <div class="white-box">
      <h4 class="block-title">
        Transaction History
      </h4>
      <form>
        <div class="row">
          <div class="col-md-4 col-12">
            <div class="form-group custom-form-group">
              <span class="text-bold">Records : </span>
              <select class="form-control custom-form-control">
                <option>Last 1 Month</option>
                <option>Lat 3 Months</option>
                <option>Last 6 Months</option>
                <option>Custom</option>
              </select>
            </div>
          </div>
          <div class="col-md-4 col-12">
            <div class="form-group custom-form-group">
              <span class="text-bold">From Date : </span>
              <datepicker input-class="form-control custom-form-control" :format="'dd MMM yyyy'"></datepicker>
            </div>
          </div>
          <div class="col-md-4 col-12">
            <div class="form-group custom-form-group">
              <span class="text-bold">To Date : </span>
              <datepicker input-class="form-control custom-form-control" :format="'dd MMM yyyy'"></datepicker>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="white-box">
      <h4 class="block-title">
        Transactions
      </h4>
      <div class="table-responsive tester-payment-table">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Payment Date</th>
              <th scope="col">Project Name</th>
              <th scope="col" class="text-right">Amount</th>
              <th scope="col" class="text-right">Balance</th>
              <th scope="col" class="text-right">Ref. Id</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="t in transactionHistories" :key="t.id">
              <td scope="row">{{t.created_at | date}}</td>
              <td>{{t.note}}</td>
              <td class="text-right">{{t.note.indexOf('Withdrawal') >= 0 ? '-' : ''}}${{t.amount}}</td>
              <td class="text-right">${{t.balance_after}}</td>
              <td class="text-right"><a href="#" class="">{{t.id}}</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <p v-if="(wallet || {}).available_earnings && !pendingWithdrawRequest"> Your current balance is : <span class="text-bold">${{(wallet || {}).available_earnings || 0}}</span>. Would you like to withdraw balance amount ?
    </p>
    <button type="button" v-if="(wallet || {}).available_earnings && !pendingWithdrawRequest" @click.prevent="openWithdrawModal" class="btn text-uppercase text-center green-btn">withdraw</button>
    <b-modal @shown="resetAmount" :cancel-disabled="true" ref="withdrawal_model" title="Withdraw Amount">
        <div class="col-md-12 mb-2">
          <div className="form-group">
              <label>Amount To Withdraw</label>
                <input type="text" v-model="withdrawal_amount" class="form-control" required />
                <div style="color: red;" v-if="amount_error">{{amount_error}}</div>
          </div>
        </div>
        <div slot="modal-footer">
          <button class="btn text-uppercase text-center green-btn" style="max-width: 100%" :disabled="withdrawal_inProgress" type="button" @click="handleWithdrawSubmit">Submit Withdraw Request</button>
        </div>
    </b-modal>
  </div>
</template>

<script>
import Vue from "vue";
export default {
  name: "payment",
  data() {
    return {
      wallet: {},
      transactionHistories: [],
      withdrawal_amount: 0,
      amount_error: null,
      withdrawal_inProgress: false,
      pendingWithdrawRequest: null
    };
  },
  methods: {
    openWithdrawModal() {
      this.$refs.withdrawal_model.show();
    },
    resetAmount() {
      this.withdrawal_amount = 0;
      this.amount_error = null;
      this.withdrawal_inProgress = false;
    },
    handleWithdrawSubmit() {
      this.amount_error = null;
      if (!this.withdrawal_amount) {
        this.amount_error = "Amount is required";
      }
      if (isNaN(this.withdrawal_amount)) {
        this.amount_error = "Amount must be numeric";
      }
      if (this.amount_error) {
        return;
      }
      this.withdrawal_inProgress = true;
      axios
        .post("/api/withdraw", { amount: this.withdrawal_amount })
        .then(() => {
          this.$refs.withdrawal_model.hide();
          this.withdrawal_inProgress = false;
          this.getHistories();
          this.getWallet();
          this.getLatestPendingRequest();
        })
        .catch(error => {
          this.withdrawal_inProgress = false;
          if (Array.isArray(error.response.data.message)) {
            this.amount_error = error.response.data.message[0];
          } else {
            this.amount_error = error.response.data.message;
          }
        });
    },
    getHistories() {
      return axios
        .get("/api/transaction-histories")
        .then(({ data }) => (this.transactionHistories = data));
    },
    getWallet() {
      return axios
        .get("/api/wallet")
        .then(({ data: { data } }) => (this.wallet = data));
    },
    getLatestPendingRequest() {
      return axios
        .get("/api/transaction-histories/pending-withdrawal")
        .then(({ data }) => (this.pendingWithdrawRequest = data));
    }
  },
  mounted() {
    this.getWallet();
    this.getHistories();
    this.getLatestPendingRequest();
  }
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";
.text-green {
  color: #2cac3d;
}
.text-red {
  color: #e63423;
}
.text-blue {
  color: #00aff3;
}
.text-bold {
  font-family: $font-family-brandon-bold !important;
}
.text-medium {
  font-family: $font-family-brandon-medium;
}
.info-wrap {
  background-color: #fcb3b4;
  border-radius: 6px;
  padding: 8px;
  margin-bottom: 20px;
}
.white-box {
  a {
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
  width: 100%;
  max-width: 130px;
  padding: 7px 10px;
  color: #fff;
  margin: 15px auto;
  border-radius: 20px;
  display: block;
}
.blue-btn {
  width: 100%;
  max-width: 130px;
  padding: 7px 10px;
  color: #fff;
  margin: 15px auto;
  border-radius: 20px;
  display: block;
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
@media screen and(max-width:575px) {
  .white-box {
    line-height: 18px;
  }
}
</style>