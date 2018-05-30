<template>
  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
          <div class="col-md-12">
            <div class="block-title">
              Project Status
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-left">
            <Steps :steps="steps" :active="get_project_current_stage"></Steps>
          </div>
        </div>
      </div>
      <div class="row" v-if="get_project_current_stage === 3">
        <div class="col-md-12">
          <div class="success-box">Your project has been approved for testing. Once your payment is made your project will be sent to Beta Plan testers.</div>
        </div>
      </div>
      <div class="row" v-if="get_project_current_stage === 4">
        <div class="col-md-12">
          <div class="success-box">
            Thank you for the payment. You have paid ${{project.total_cost}} on {{ project.status.created_at|datetime }}. Project is running now. Go to statistics area and check for the submission from the tester.
          </div>
          <br/>
        </div>
      </div>

      <div class="row mt-3" v-if="project.status && project.status.name == 'Pending Payment' ">
        <div class="col-12">
          <invoice :invoice="invoice" :project="project">
            <div slot="actions" class="col-md-12 text-center mt-4">
              <div :id="paypal_btn_id" style="margin-bottom: 12px;" v-if="!invoice.is_paid"></div>
            </div>
          </invoice>
        </div>
      </div>
    
      <div class="white-box">
        <h4 class="block-subtitle">
              Basic Information
        </h4>
        <div class="row pb-3 pb-md-4">
          <div class="col-md-5">
            <div class="mb-1">
              <span class="text-bold">
                Title :
              </span>
              <span class="">
                {{this.project.name}}
              </span>
            </div>
            <div class="mb-1">
              <span class="text-bold">
                Type :
              </span>
              <span class="">
                {{this.project.project_type ? this.project.project_type.name : ''}}
              </span>
            </div>
            <div class="mb-1">
              <span class="text-bold">
                Total Amount :
              </span>
              <span class="">
                <span class="text-bold text-red"> $ {{project.total_cost}}</span>
                <span class="">({{project.allocated_tester}} testers x ${{project.cost_per_tester}}/tester)</span>

              </span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="mb-1">
              <span class="text-bold">
                Start Date :
              </span>
              <span class="">
                {{this.project.start_date | date}}
              </span>
            </div>
            <div class="mb-1">
              <span class="text-bold">
                End Date :
              </span>
              <span class="">
                {{this.project.end_date | date}}
              </span>
            </div>
            <div class="mb-1">
              <span class="d-block d-sm-inline-block align-middle text-bold">
                Request for approval sent on :
              </span>
              <span class="d-block d-sm-inline-block align-middle">
              30 Mar 2018 10:49 AM
              </span>
            </div>
          </div>
          <div class="col-md-3">
            <div class="mb-1">
              <span class="text-bold">Time Needed to Test : </span>
              <span class="">
                {{this.project.estimate_tester_time | times}}
              </span>
            </div>
            <div class="mb-1">
              <span class="text-bold">
                Tester Needed :
              </span>
              <span>
                {{this.project.tester_needed}}
              </span>
            </div>
          </div>
        </div>
        <h4 class="block-subtitle">
            Project Description
        </h4>
        <div class="">
          <div class="row">
            <div class="col-md-12 pb-3">
                <p v-html="this.project.project_description"></p>
            </div>
            <div class="col-md-6 pt-3">
                <div class="form-group">
                    <h4 class="block-subtitle">
                        Links
                    </h4>
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <ul class="pl-0 mb-2">
                                <li v-for="link in project.links" :key="link.id">
                                  {{link.title}}:  <a :href="link.link" target="_blank" > {{ link.link }}</a>
                                  <!-- <a :href="val.link" class="project-link" target="_blank">{{ val.link }}</a> -->
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pt-3">
              <div class="form-group">
                  <h4 class="block-subtitle">
                      Files
                  </h4>
                  <file-viewer :files="project.media"></file-viewer>
              </div>
            </div>
            <div class="col-md-6 col-12 pt-3">
                <div class="form-group">
                    <h4 class="block-subtitle">
                        Notes / Instruction
                    </h4>
                    <div class="">
                        {{this.project.notes_instruction}}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 pt-3">
              <h4 class="block-subtitle">
                  Required Devices
              </h4>
              <div class="">
                <device-selector disabled v-model="project.selected_devices"></device-selector>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="white-box">
          <h4 class="block-title">
              Questions
          </h4>
          <div class="">
              <div class="form-group">
                  <p>
                      Your Questions to Testers which they have to fil up while submitting test Result
                  </p>
                  <ul v-for="(ques, index) in this.project.questions" class="pl-0 mb-3">
                      <li>
                          <span class="text-bold mr-2">
                              Question {{ index + 1 }} :
                          </span>
                            {{ ques.question }}
                      </li>
                  </ul>
              </div>
          </div>
      </div>

      <!------- Statistics Section -->
      <project-statistics v-if="this.isProjectRunning" :errors="errors" v-model="project" @onCompleted="projectCompleted"></project-statistics>
      <div class="row" v-if="project.status && project.status.name == 'Pending Payment' ">
        <div class="col-md-12 text-center">
          <router-link class="d-inline-block mr-sm-2 mr-0 grey-btn back-proj-btn" :to="{name: 'publisher.projects'}">Back To Projects</router-link>
          <router-link class="d-inline-block mr-sm-2 mr-0 grey-btn back-proj-btn" :to="{name: 'publisher.project.edit', params:{ id: project.id }}">Edit Project</router-link>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Steps from "components/components/publisher/steps";
import invoice from "components/components/invoice";
import DeviceSelector from "components/components/device-selector";
import ProjectStatistics from "components/components/project-statistics";
import FileViewer from "components/components/publisher/file-viewer";
import { isProjectApproved, isProjectRunning, isProjectCompleted } from "src/services/project";
import Vue from "vue";
import {TimeFilter} from "src/services/filter";
Vue.filter('times', TimeFilter);

export default {
  name: "ProjectInvoice",
  components: {
    Steps,
    invoice,
    DeviceSelector,
    ProjectStatistics,
    FileViewer
  },
  data() {
    return {
      type_name: "",
      errors: null,
      paypalConfig: {},
      payment: {},
      invoice: {},
      project: {
        publisher: {}
      },
      isProjectApproved: false,
      isProjectCompleted: false,
      isProjectRunning: false,
      steps: [
        { id: 1, name: "Submitted" },
        { id: 2, name: "Waiting For Approval" },
        { id: 3, name: "Pay" },
        { id: 4, name: "Ready to Test" }
      ]
    };
  },
  methods: {
    projectCompleted() {
      this.getProject();
    },
    getProject() {
      axios
        .get(`/api/projects/${this.$route.params.id}`)
        .then(({ data: { data } }) => {
          this.project = data;
          this.isProjectApproved = isProjectApproved(data.status.name);
          this.isProjectCompleted = isProjectCompleted(data.status.name);
          this.isProjectRunning = isProjectRunning(data.status.name);          
          this.project.selected_devices = data.devices.map(({ id }) => id); });
          this.project.project_description =  this.project.project_description ? this.project.project_description.replace(/\r?\n/g, '<br \>') : '';
      axios
        .get(`/api/projects/${this.$route.params.id}/invoice`)
        .then(({ data: { data } }) => {
          this.invoice = data;
          return axios.get(`/api/paypal-config`);
        })
        .then(({ data }) => {
          this.paypalConfig = data;
          if (!this.invoice.is_paid) {
            this.buildPaypalBtn();
          }
        });
    },
    loadPaypaljs() {
      return new Promise(resolve => {
        const s = document.createElement("script");
        s.onload = resolve;
        s.src = "https://www.paypalobjects.com/api/checkout.js";
        document.body.appendChild(s);
      });
    },
    buildPaypalBtn() {
      this.loadPaypaljs().then(() => {
        paypal.Button.render(
          {
            env: this.paypalConfig.mode, // Or 'sandbox'
            client: {
              sandbox: this.paypalConfig.client_id,
              production: this.paypalConfig.client_id
            },
            commit: true, // Show a 'Pay Now' button
            style: {
              size: "medium",
              color: "blue",
              shape: "pill",
              label: "pay"
            },
            payment: (data, actions) => {
              return axios
                .post(`/api/invoices/${this.invoice.id}/pay`)
                .then(response => {
                  this.payment = response.data.data;
                  return this.payment.transaction_id;
                });
            },
            onAuthorize: (data, actions) => {
              return actions.payment.execute().then(payment =>
                axios
                  .post(`/api/invoices/${this.invoice.id}/paid`, {
                    id: this.payment.id,
                    transaction_id: this.payment.transaction_id,
                    paypal_payer_id:
                      ((payment.payer || {}).payer_info || {}).payer_id || null,
                    paypal_payer_email: ((payment.payer || {}).payer_info || {}).email || null,
                    sell_id: (
                      (
                        (payment.transactions[0] || {}).related_resources[0] ||
                        {}
                      ).sale || {}
                    ).id
                  })
                  .then(response => {
                    this.getProject();
                  })
              );
            }
          },
          this.paypal_btn_id
        );
      });
    }
  },
  computed: {
    paypal_btn_id() {
      return `paypal_${this.invoice.id}_button`;
    },
    get_project_current_stage() {
      if (isProjectRunning((this.project.status || {}).name)) {
        return 4;
      }
      return 3;
    }
  },
  mounted() {
    this.getProject();
  }
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";

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
    box-shadow: -3px 4px 7px rgba(0, 0, 0, 0.1), -1px 1px 0px rgba(0, 0, 0, 0.2);
  }
}
.btn.btn-grey {
  background: #898a8c;
  color: white;
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
.bb-1 {
  border-bottom: 1px solid #cecece;
}
.btn-paypal {
  background: #01aff6;
  color: white;
  border: 1px solid #0691d9;
  border-radius: 10px;
}
ul {
  padding: 0;
}
.text-l {
  font-size: 16px;
}
.font-bold {
  font-weight: bolder;
}
.font-xl {
  font-size: 20px;
  font-weight: 700;
}
.text-blue {
  color: #4da2d9;
}
.success-box {
  border: 2px solid #6bc577;
  color: #6bc577;
  font-size: 14px;
  font-weight: 600;
  text-align: center;
  border-radius: 4px;
  padding: 12px;
  background: #ffffff;
}
.font-amount-color-2 {
  color: #009933;
}
  .white-box{
    background-color: #fff;
    box-shadow: 0px 0px 3px 2px rgba(3, 3, 3, 0.05);
    border-radius: 4px;
    padding: 20px;
    margin-bottom: 20px;
    font-size: 14px;
    line-height: 22px;
    color: #606368;
    .block-title{
      font-size: 18px;
      font-family: $font-family-UniNeue-bold;
      border-bottom: 1px solid #dadada;
      color: #606368;
      padding-bottom: 10px;
      margin-bottom: 10px;
      width: auto;
    }
  }
.grey-btn{
  width: auto;
  max-width: 180px;
  margin: 0 auto;
  padding: 8px 15px;
  border:2px solid #606368;
  background-color: #898a8c;
  font-size: 14px;
  font-family: $font-family-brandon-medium;
  letter-spacing: 0.05rem;
  color: #fff;
  border-radius: 20px;
  display: block;
  text-align: center;
  text-transform: uppercase;
  &:hover{
    background-color: #95979a;
  }
}
.text-bold {
  font-family: $font-family-brandon-bold !important;
}
.text-medium {
  font-family: $font-family-brandon-medium;
}
.text-blue {
  color: #0082cc;
}
.white-box {
  background-color: #fff;
  box-shadow: 0px 0px 3px 2px rgba(3, 3, 3, 0.05);
  border-radius: 4px;
  padding: 20px;
  margin-bottom: 20px;
  font-size: 14px;
  line-height: 22px;
  color: #606368;
  // letter-spacing: 0;
  .block-title {
    font-size: 18px;
    font-family: $font-family-UniNeue-bold;
    border-bottom: 1px solid #dadada;
    color: #606368;
    padding-bottom: 10px;
    margin-bottom: 10px;
    width: auto;
  }
  .block-subtitle {
    font-size: 18px;
    font-family: $font-family-brandon-bold !important;
    border-bottom: 1px solid #dadada;
    color: #606368;
    padding-bottom: 10px;
    margin-bottom: 10px;
    width: auto;
  }
  .proj-name-wrap {
    // padding-bottom: 30px;
    .proj-name {
      font-family: $font-family-UniNeue-bold;
      font-size: 24px;
      line-height: 18px;
      color: #0082cc;
    }
  }
  .project-link {
    color: #0082cc;
    text-decoration: underline !important;
  }
  .proj-title-name {
    font-size: 40px;
    font-family: $font-family-brandon-bold !important;
    text-decoration: underline;
  }
  .proj-name-status {
    font-family: $font-family-brandon-bold !important;
    font-size: 20px;
    color: #00aff5;
    text-decoration: none !important;
  }
  .proj-detail {
    max-width: 45%;
    line-height: 26px;
    margin: 20px auto;
  }
  .proj-status {
    padding: 0;
    padding-top: 8px;
    overflow: hidden;
    br {
      display: none;
    }
    &:first-child {
      .proj-progress {
        &::before {
          width: calc(50% - 30px);
          left: 15px;
        }
      }
    }
    &:last-child {
      .proj-progress {
        &::after {
          width: calc(50% - 30px);
          right: 15px;
        }
      }
    }
    .proj-progress {
      position: relative;
      margin-bottom: 5px;
      i {
        color: rgba(175, 177, 179, 0.5);
        font-size: 22px;
        line-height: 24px;
      }
      &::before {
        content: "";
        position: absolute;
        height: 3px;
        width: calc(50% - 5px);
        background-color: #ececec;
        left: -10px;
        top: 11px;
      }
      &::after {
        content: "";
        position: absolute;
        height: 3px;
        width: calc(50% - 5px);
        background-color: #ececec;
        right: -10px;
        top: 11px;
      }
    }
  }
  .proj-status.active {
    color: #0082cc;
    .proj-progress {
      i {
        color: #0082cc;
        font-size: 34px;
        line-height: 24px;
        position: relative;
        &::after {
          height: 15px;
          width: 15px;
          background-color: #0082cc;
          content: "";
          border-radius: 50%;
          position: absolute;
          left: 7px;
          top: 4px;
        }
      }
      &::before {
        background-color: #0082cc;
      }
    }
  }
  .proj-status.done-step {
    color: #0082cc;
    .proj-progress {
      i {
        color: #0082cc;
        font-size: 34px;
        line-height: 24px;
        position: relative;
        &::after {
          height: 15px;
          width: 15px;
          background-color: #0082cc;
          content: "";
          border-radius: 50%;
          position: absolute;
          left: 7px;
          top: 4px;
        }
      }
      &::before {
        background-color: #0082cc;
      }
      &::after {
        background-color: #0082cc;
      }
    }
  }
}
.back-proj-btn {
  max-width: 180px;
}
.cancel-btn {
  max-width: 180px;
}
.blue-step-btn {
  width: auto;
  padding: 8px 15px;
  border: 2px solid #0082cc;
  background-color: #00aff5;
  font-size: 14px;
  font-family: $font-family-brandon-medium;
  letter-spacing: 0.05rem;
  color: #fff;
  border-radius: 20px;
  display: block;
  text-align: center;
  &:hover {
    background-color: #13b9fb;
  }
}
.grey-btn {
  width: auto;
  padding: 8px 15px;
  border: 2px solid #606368;
  background-color: #898a8c;
  font-size: 14px;
  font-family: $font-family-brandon-medium;
  letter-spacing: 0.05rem;
  color: #fff;
  border-radius: 20px;
  display: block;
  text-align: center;
  &:hover {
    background-color: #95979a;
  }
}
.red-btn {
  width: auto;
  padding: 8px 15px;
  border: 2px solid #940000;
  background-color: #e80000;
  font-size: 14px;
  font-family: $font-family-brandon-medium;
  letter-spacing: 0.05rem;
  color: #fff;
  border-radius: 20px;
  display: block;
  text-align: center;
}
@media screen and(max-width:1281px) {
  .white-box {
    font-size: 16px;
    .proj-title-name {
      font-size: 34px;
    }
    .proj-detail {
      max-width: 65%;
      margin: 20px auto 0;
    }
  }
}
@media screen and(max-width:1200px) {
  .white-box {
    font-size: 16px;
  }
}
@media screen and(max-width:991px) {
  .white-box {
    padding: 15px;
    font-size: 14px;
    .proj-title-name {
      font-size: 32px;
    }
    .proj-name-status {
      font-size: 18px;
    }
  }
}
@media screen and(max-width:767px) {
  .white-box {
    .proj-title-name {
      font-size: 30px;
    }
    .proj-name-status {
      font-size: 16px;
    }
    .proj-detail {
      line-height: 22px;
    }
    .proj-status.active {
      span {
        display: block !important;
      }
    }
  }
}
@media screen and(max-width:575px) {
  .cancel-btn,
  .back-proj-btn {
    font-size: 12px;
    padding: 6px;
  }
  .white-box {
    .block-title {
      font-size: 18px;
    }
    .proj-title-name {
      font-size: 22px;
    }
    .proj-name-status {
      font-size: 14px;
    }
    .proj-detail {
      max-width: 100%;
      line-height: 22px;
      margin: 10px auto 0;
    }
    .proj-status {
      &:first-child {
        .proj-progress {
          &::before {
            width: calc(50% - 25px);
          }
        }
      }
      &:last-child {
        .proj-progress {
          &::after {
            width: calc(50% - 25px);
          }
        }
      }
    }
    .proj-status.active,
    .proj-status.done-step {
      .proj-progress {
        i {
          font-size: 28px;
          &::after {
            height: 13px;
            width: 13px;
            left: 6px;
            top: 5px;
          }
        }
      }
    }
  }
}
@media screen and(max-width:991px) {
  .white-box{
    padding: 15px;
  }
  .grey-btn{
    padding: 4px;
    max-width: 165px;
  }
}
</style>
