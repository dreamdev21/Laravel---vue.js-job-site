<template>
  <div class="row">
    <div class="col-xl-8 col-lg-10 col-12 invoice-note-wrap">
      <div class="invoice-note">
        <div class="row">
          <div class="col-md-6">
            <img src="/images/home_logo.png" class="img-fluid"/>
            <div class="row mt-5">
              <div class="col-md-12">
                <b>The Beta Plan</b>
              </div>
              <!--<div class="col-md-12 mt-3">-->
                <!--2nd Floor Tulsi Complex, <br />-->
                <!--Behind Sahjanand College, Panjrapole, <br />-->
                <!--Ahmedabad. <br />-->
                <!--Gujarat. <br />-->
                <!--380015. <br />-->
                <!--India. <br />-->
              <!--</div>-->
              <!--<div class="col-md-12 mt-3">-->
                <!--Tax ID: AAFCT5546D-->
              <!--</div>-->
              <div class="col-md-12 mt-3">
                Phone: {{'1' + project.publisher.mobile_no | phone}}<br/>
                info@thebetaplan.com <br />
                <a href="http://thebetaplan.com">thebetaplan.com</a>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <h2>Invoice</h2>
            <div class="row mt-5">
              <div class="col-md-12">
                invoice # {{invoice.invoice_number}} <br />
                invoice Date: {{invoice.created_at | date}} <br />
                Due Date: {{invoice.due_on | date}}
              </div>
              <div class="col-md-12 mt-4">
                <div class="amount-box">
                  Amount due <br />
                  <b>$ {{amountDue}}</b>
                </div>
                <div class="payment-info mt-2" :class="{pending: !invoice.is_paid, paid: invoice.is_paid}">
                  <div class="payment-done-info" v-if="invoice.is_paid">
                    PAID on {{invoice.paid_on | date}}.<br />
                    Transaction id {{invoice.transaction_id}}
                  </div>
                  <div v-else>
                    Pending
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr />
          <div class="col-md-12 mt-3">
            <b>Bill To</b> <br />
            <!--{{project.publisher.company_name || project.publisher.first_name}} <br />-->
            {{project.publisher.first_name}} {{project.publisher.last_name}}<br />
            <div v-html="(project.publisher.address || '').split('\n').join('<br />')"></div>
          </div>
          <div class="col-md-12 mt-3">
            <div class="description-box row">
              <div class="col-md-6">Description</div>
              <div class="col-md-6 text-right">Amount</div>
            </div>
            <div class="mt-3 row">
              <div class="col-md-6">
                {{project.name}}
                  <span class="d-block d-sm-inline-block align-middle" style="margin-left: 20px">
                    <span class="">{{project.allocated_tester}} testers x ${{project.cost_per_tester}}/tester</span>
                  </span>
              </div>
              <div class="col-md-6 text-right">
                $ {{totalAmount}}
              </div>
            </div>
            <div class="mt-3 row" v-if="discount > 0">
              <div class="col-md-6">
              Discount
              </div>
              <div class="col-md-6 text-right">
                - $ {{discount}}
              </div>
            </div>
            <div class="mt-3 row" v-if="discount > 0" style="border-top: 1px solid #cecece;">
              <div class="col-md-6">
              Total Amount
              </div>
              <div class="col-md-6 text-right">
                $ {{amountDue}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <slot name="actions">
      <div class="col-md-12 mt-5 text-center">
        <router-link class="btn grey-btn" :to="{name: 'admin.project.view', params: {id: project.id}}">Back To Project</router-link>
      </div>
    </slot>
  </div>
</template>
<script>
import Vue from "vue";
Vue.filter("phone", function(phone) {
  return phone
    .replace(/[^0-9]/g, "")
    .replace(/(\d{1})(\d{3})(\d{3})(\d{4})/, "(+$1) $2-$3-$4");
});
export default {
  name: "ProjectInvoice",
  props: {
    invoice: {
      required: true,
      default() {
        return {};
      }
    },
    project: {
      required: true,
      default() {
        return { publisher: {} };
      }
    }
  },
  computed: {
    amountDue() {
      return this.invoice.amount + this.invoice.tax;
    },
    totalAmount() {
      return this.project.total_cost;
    },
    discount() {
      return this.project.applied_discount;
    }
  }
};
</script>
<style scoped lang="less">
.payment-info {
  padding: 15px;
  border: 1px solid #cecece;
  border-radius: 4px;
  text-align: center;
  &.pending {
    max-width: 250px;
    border-color: red;
    color: red;
  }
  &.paid {
    color: green;
    border-color: green;
  }
}
.invoice-note-wrap {
  margin: 0 auto;
  display: block;
  width: 100%;
  .invoice-note {
    margin: 0 auto;
    background: #fff;
    position: relative;
    padding: 15px;
    &:before {
      content: "";
      position: absolute;
      top: 0;
      right: 0;
      border-width: 0 50px 50px 0; /* This trick side-steps a webkit bug */
      border-style: solid;
      border-color: white #ebf2f6 white white; /* A bit more verbose to work with .rounded too */
      background: #fff; /* For when also applying a border-radius */
      display: block;
      width: 0; /* Only for Firefox 3.0 damage limitation */
      /* Optional: shadow */
      -webkit-box-shadow: -3px 4px 7px rgba(0, 0, 0, 0.1),
        -1px 1px 0px rgba(0, 0, 0, 0.2);
      -moz-box-shadow: -3px 4px 7px rgba(0, 0, 0, 0.1),
        -1px 1px 0px rgba(0, 0, 0, 0.2);
      box-shadow: -3px 4px 7px rgba(0, 0, 0, 0.1),
        -1px 1px 0px rgba(0, 0, 0, 0.2);
    }
  }
}
.grey-btn {
  padding: 8px 16px;
  border-radius: 6px;
}
.amount-box {
  padding: 15px;
  border: 1px solid #cecece;
  border-radius: 4px;
  text-align: center;
  max-width: 250px;
  b {
    font-size: 16px;
  }
}
.description-box {
  background: #f9f9f9;
  padding: 5px 10px;
  div {
    font-weight: 700;
    font-size: 14px;
  }
}
</style>