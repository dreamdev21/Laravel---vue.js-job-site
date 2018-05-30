<template>
  <div>
  <div class="bg-color">
    <div class="container custom-container">
      <div class="row">
        <h1 class="page-title">
          Payments
        </h1>
          <div class="payment-page">
            <payments></payments>
          </div>
      </div>
    </div>
  </div>
  </div>
</template>
<script>
import Vue from "vue";
import payments from "components/components/admin/payments.vue";

export default {
  name: "admin-finance",
  components: {
    payments
  }
};
</script>
<style lang="scss" scoped>
@import "../layouts/css/_customvariables";

.custom-container {
  max-width: 100%;
  .page-title {
    font-family: $font-family-UniNeue-bold;
    font-size: 30px;
    width: 100%;
    text-align: center;
    color: #363e48;
    margin: 5px 0 25px;
  }
  .payment-page {
    width: 100%;
  }
}
@media screen and(max-width:1200px) {
  .custom-container {
    .page-title {
      font-size: 28px;
      margin: 0 0 20px;
    }
  }
}
@media screen and(max-width:575px) {
  .custom-container {
    .page-title {
      font-size: 26px;
    }
  }
}
</style>