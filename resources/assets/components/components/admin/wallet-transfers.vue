<template>
  <div class="white-box">
    <h4 class="block-title">
      Wallet Transfers
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
            <th>Payment Date</th>
            <th>Project Name</th>
            <th class="text-right">Amount</th>
            <th class="text-center">Debit/Credit</th>
            <th class="text-right">Balance After</th>
            <th class="text-right">Ref. Id</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="t in walletEntries" :key="t.id">
              <td scope="row">{{t.created_at | date}}</td>
              <td>{{t.note}}</td>
              <td class="text-right">${{t.amount}}</td>
              <td class="text-center">{{t.note.indexOf('Withdrawal') >= 0 ? 'Debit' : 'Credit'}}</td>
              <td class="text-right">${{t.balance_after}}</td>
              <td class="text-right"><a href="#" class="">{{t.id}}</a></td>
            </tr>
        </tbody>
      </table>
    </div>
    <hr v-if="total > walletEntries.length" />
    <b-pagination v-if="total > walletEntries.length" @input="getWalletEntries" size="md" :total-rows="total" v-model="currentPage" :per-page="perPage">
    </b-pagination>
  </div>
</template>
<script>
export default {
  name: "WalletTransfers",
  data() {
    return {
      currentPage: 1,
      walletEntries: [],
      total: 0,
      perPage: 25
    };
  },
  methods: {
    getWalletEntries() {
      return axios
        .get(
          `/api/admin/wallet-histories?page=${this.currentPage}&perPage=${
            this.perPage
          }`
        )
        .then(response => {
          this.walletEntries = response.data;
          this.total = response.total;
        });
    }
  },
  mounted() {
    this.getWalletEntries();
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