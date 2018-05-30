<template>
  <div class="">
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
      <div class="table-responsive publisher-payment-table">
        <table class="table">
          <thead>
            <tr>
              <th>Payment Date</th>
              <th>Project Name</th>
              <th>From Accout</th>
              <th class="text-right">Amount</th>
              <th class="text-right">Ref. Id</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="payment in paymentsEntries" :key="payment.id">
              <td>{{payment.paid_on | date}}</td>
              <td>{{((payment.invoice || {}).entity || {}).name}}</td>
              <td>{{payment.paypal_payer_email || payment.paypal_payer_id || '---'}}</td>
              <td class="text-right">${{payment.total_amount}}</td>
              <td class="text-right"><a href="#" class="">{{payment.transaction_id}}</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
export default {
  name: "payment",
  data() {
    return {
      paymentsEntries: []
    };
  },
  methods: {
    getPayments() {
      axios
        .get("/api/payments")
        .then(({ data }) => (this.paymentsEntries = data));
    }
  },
  mounted() {
    this.getPayments();
  }
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";

.info-wrap {
  background-color: #fcb3b4;
  border-radius: 6px;
  padding: 8px;
  margin-bottom: 20px;
}
.white-box {
  letter-spacing: 0;
  a {
    font-size: 14px;
    color: #0082cc;
    font-family: $font-family-brandon-regular;
    text-decoration: underline !important;
  }
  .block-title {
    font-size: 20px;
    font-family: $font-family-UniNeue-bold;
    border-bottom: 1px solid #dadada;
    color: #0082cc;
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