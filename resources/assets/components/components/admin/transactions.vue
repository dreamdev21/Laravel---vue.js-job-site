<template>
  <div class="white-box">
    <h4 class="block-title">
      Transactions
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
    <hr />
    <div class="table-responsive admin-payment-table">
      <table class="table">
        <thead>
          <tr>
            <th>Publisher</th>
            <th>Payment Date</th>
            <th>Project Name</th>
            <th>From Accout</th>
            <th class="text-right">Amount</th>
            <th class="text-right">Ref. Id</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="t in transactionEntries" :key="t.id">
            <td>{{(t.payer || {}).first_name}} {{(t.payer || {}).last_name}}</td>
            <td>{{t.paid_on | date}}</td>
            <td>{{((t.invoice || {}).entity || {}).name}}</td>
            <td>{{t.paypal_payer_email || t.paypal_payer_id || '---'}}</td>
            <td class="text-right">${{t.total_amount}}</td>
            <td class="text-right"><a href="#">{{t.transaction_id}}</a></td>
            </tr>
        </tbody>
      </table>
    </div>
    <hr v-if="total > transactionEntries.length" />
    <b-pagination v-if="total > transactionEntries.length" @input="getTransactionEntries" size="md" :total-rows="total" v-model="currentPage" :per-page="perPage">
    </b-pagination>
  </div>
</template>
<script>
export default {
  name: "Transactions",
  data() {
    return {
      currentPage: 1,
      transactionEntries: [],
      total: 0,
      perPage: 25
    };
  },
  methods: {
    getTransactionEntries() {
      return axios
        .get(
          `/api/admin/transaction-histories?page=${this.currentPage}&perPage=${
            this.perPage
          }`
        )
        .then(response => {
          this.transactionEntries = response.data;
          this.total = response.meta.total;
        });
    }
  },
  mounted() {
    this.getTransactionEntries();
  }
};
</script>
<style scoped lang="scss">
@import "../../layouts/css/_customvariables";
.block-title {
  font-size: 20px;
  font-family: $font-family-UniNeue-bold;
  border-bottom: 1px solid #dadada;
  color: #3e3a94;
  padding-bottom: 10px;
  margin-bottom: 10px;
}
</style>