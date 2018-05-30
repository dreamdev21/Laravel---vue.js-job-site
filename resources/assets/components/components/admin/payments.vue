<template>
  <div class="">
    <!-- <div class="white-box">
      <div class="row">
        <div class="col-md-8 col-12">
          <div class="content-wrap d-block d-sm-inline-block">
            <h4 class="username">Your default Paypal account</h4>
            <p class="usermail">{{($store.state.user.default_paypal_email || {}).email}}</p>
            <router-link :to="{name: 'admin.payment-methods'}" class="link">Change</router-link>
          </div>
        </div>
      </div>
    </div> -->
    <transactions></transactions>
    <wallet-transfers></wallet-transfers>
    <pending-withdrawal></pending-withdrawal>
  </div>
</template>

<script>
import Vue from "vue";
import WalletTransfers from "./wallet-transfers";
import Transactions from "./transactions";
import PendingWithdrawal from "./pending-withdrawal";
export default {
  name: "admin-payment",
  components: {
    WalletTransfers,
    Transactions,
    PendingWithdrawal
  }
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";

.text-green {
  color: #2cac3d;
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
    color: #3e3a94;
    font-family: $font-family-brandon-regular;
    text-decoration: underline !important;
  }
  .block-title {
    font-size: 20px;
    font-family: $font-family-UniNeue-bold;
    border-bottom: 1px solid #dadada;
    color: #3e3a94;
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
}
.purple-btn {
  padding: 0px 12px;
  color: #fff !important;
  text-decoration: none !important;
  margin: 0;
  border-radius: 20px;
  font-size: 13px;
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