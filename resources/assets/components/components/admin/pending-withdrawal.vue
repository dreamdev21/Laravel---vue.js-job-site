<template>
  <div class="white-box">
    <h4 class="block-title">
      Pending Withdrawal Requests ({{total}})
    </h4>
    <div class="table-responsive admin-payment-table">
      <table class="table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Tester</th>
            <th class="text-md-right text-left">Status</th>
            <th class="text-right">Withdraw Amount</th>
            <th class="text-center">Action / Status</th>
            <th class="text-right">Ref. Id</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="w in withdrawalEntries" :key="w.id">
            <td> {{w.created_at | date}} </td>
            <td> <a href="#" class="link">{{w.tester.first_name}} {{w.tester.last_name}}</a></td>
            <td  class="text-md-right text-left">Pending</td>
            <td class="text-right">${{w.amount}}</td>
            <td class="text-center">
              <a href="#" @click.prevent="processWithdraw(w.id)" v-if="w.status === 'WITHDRAWAL_SUBMITTED'" class="purple-btn">Pay</a>
              <label v-else>{{w.status}}</label>
            </td>
            <td class="text-right"><a href="#" class="link">{{w.id}}</a></td>
          </tr>
        </tbody>
      </table>
    </div>
    <hr v-if="total > withdrawalEntries.length" />
    <b-pagination v-if="total > withdrawalEntries.length" @input="getWithdrawalEntries" size="md" :total-rows="total" v-model="currentPage" :per-page="perPage">
    </b-pagination>
  </div>
</template>
<script>
export default {
  name: "PendingWithdrawal",
  data() {
    return {
      currentPage: 1,
      withdrawalEntries: [],
      total: 0,
      perPage: 25
    };
  },
  methods: {
    processWithdraw(withdrawal_id) {
      return axios
        .post("/api/admin/process-withdraw", {
          withdrawal_id
        })
        .then(response => {
          this.$swal({
            title: "Success",
            text: "The payout has been initiated!",
            icon: "success"
          });
          return this.getWithdrawalEntries();
        })
        .catch(e => {
          const message = e.response.data.message;
          this.$swal({
            title: "Error",
            text: message,
            icon: "error"
          });
        });
    },
    getWithdrawalEntries() {
      return axios
        .get(
          `/api/admin/transaction-histories/pending-withdrawal?page=${
            this.currentPage
          }&perPage=${this.perPage}`
        )
        .then(response => {
          this.withdrawalEntries = response.data;
          this.total = response.meta.total;
        });
    }
  },
  mounted() {
    this.getWithdrawalEntries();
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
.purple-btn {
  padding: 0px 12px;
  color: #fff !important;
  text-decoration: none !important;
  margin: 0;
  border-radius: 20px;
  font-size: 13px;
}
</style>