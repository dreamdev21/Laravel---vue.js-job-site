<template>
  <div class="bg-color">
    <div class="container custom-container">
      <div class="row">
        <h1 class="step-page-title">
          Our NDA Policy
        </h1>
        <div class="nda-policy-page">
          <div class="white-box">
            <div class="row">
              <div class="col-12">
                <p>Confidential/Nondisclosure Agreement</p>
                <p>1. Definition of Confidential Information. For purposes of this Agreement, "Confidential Information" shall include all information or material that has or could have commercial value or other utility in the business in which Disclosing Party is engaged.</p>
                <p>2. Exclusions from Confidential Information. Receiving Party's obligations under this Agreement do not extend to information that is: (a) publicly known at the time of disclosure or subsequently becomes publicly known through no fault of the Receiving Party; (b) discovered or created by the Receiving Party before disclosure by Disclosing Party; (c) learned by the Receiving Party through legitimate means other than from the Disclosing Party or Disclosing Party's representatives; or (d) is disclosed by Receiving Party with Disclosing Party's prior written approval.</p>
                <p>3. Obligations of Receiving Party. Receiving Party shall hold and maintain the Confidential Information in strictest confidence for the sole and exclusive benefit of the Disclosing Party. Receiving Party shall not, without prior written approval of Disclosing Party, use for Receiving Party's own benefit, publish, copy, or otherwise disclose to others, or permit the use by others for their benefit or to the detriment of Disclosing Party, any Confidential Information. Receiving Party shall return to Disclosing Party any and all records, notes, and other written, printed, or tangible materials in its possession pertaining to Confidential Information.</p>
                <p>4. Time Periods. The nondisclosure provisions of this Agreement shall survive the termination of this Agreement and Receiving Party's duty to hold Confidential Information in confidence shall remain in effect until the Confidential Information no longer qualifies as a trade secret or until Disclosing Party sends Receiving Party written notice releasing Receiving Party from this Agreement, whichever occurs first.</p>
                <p>5. Relationships. Nothing contained in this Agreement shall be deemed to constitute either party a partner, joint venture or employee of the other party for any purpose.</p>
                <p>6. Integration. This Agreement expresses the complete understanding of the parties with respect to the subject matter and supersedes all prior proposals, agreements, representations, and understandings. This Agreement may not be amended except in a writing signed by both parties.</p>
                <p>8. Waiver. The failure to exercise any right provided in this Agreement shall not be a waiver of prior or subsequent rights.
                This Agreement and each party's obligations shall be binding on the representatives, assigns, and successors of such party.</p>
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-center"> 
                <div class="agree-btn-group" v-if="isApprovedTester">
                   <a href="javascript:;" @click="onAgree" class="btn text-uppercase green-btn">Back to Profile</a>
                </div>
                <div class="agree-btn-group" v-else="">
                  <a href="javascript:;" @click="onAgree" class="btn text-uppercase green-btn">I Agree</a>
                  <a href="javascript:;" @click="ondisAgree" class="btn text-uppercase red-btn">I Disagree</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Vue from "vue";
import { isApprovedTester } from "src/services/auth.js"
let VueScrollTo = require('vue-scrollto');
Vue.use(VueScrollTo, {
  container: "body",
  duration: 500,
  easing: "ease"
});

export default {
  name: "nda-policy",
  data() {
    return {
      isApprovedTester: isApprovedTester(),
    }
  },
  methods: {
    onAgree: function() {
      localStorage.setItem("nda-agree", 1);
      this.$emit("done");
      if(this.isApprovedTester)
         this.$router.push({ name: "tester.tester-profile" });
      else
         this.$router.push({ name: "tester.step1" });
    },
    ondisAgree: function() {
      localStorage.setItem("nda-agree", 0);
      this.$emit("done");
      this.$router.push({ name: "tester.step1" });
    }
  },
  mounted: function(){
    VueScrollTo.scrollTo('body');
  }
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";

.custom-container {
  max-width: 100%;
  .step-page-title {
    font-family: $font-family-UniNeue-bold;
    font-size: 30px;
    width: 100%;
    text-align: center;
    color: #363e48;
    margin: 5px 0 25px;
  }
  .nda-policy-page {
    width: 100%;
    .white-box {
      font-size: 17px;
      line-height: 20px;
      .agree-btn-group {
        width: 100%;
        border-top: 1px solid #dadada;
        .green-btn {
          min-width: 130px;
          padding: 7px 10px;
          color: #fff;
          margin: 15px auto 0;
          border-radius: 20px;
          display: inline-block;
          margin-right: 10px;
        }
        .red-btn {
          min-width: 130px;
          padding: 7px 10px;
          border: 2px solid #940000;
          background-color: #e80000;
          font-size: 14px;
          font-family: $font-family-brandon-medium;
          letter-spacing: 0.05rem;
          color: #fff;
          margin: 15px auto 0;
          border-radius: 20px;
          display: inline-block;
          &:hover {
            background-color: #d41111;
          }
        }
      }
    }
  }
}
@media screen and(max-width:1281px) {
  .custom-container {
    .nda-policy-page {
      .white-box {
        font-size: 16px;
      }
    }
  }
}
@media screen and(max-width:1200px) {
  .custom-container {
    .step-page-title {
      font-size: 28px;
      margin: 0 0 20px;
    }
    .nda-policy-page {
      .white-box {
        font-size: 15px;
      }
    }
  }
}

@media screen and(max-width:575px) {
  .custom-container {
    .step-page-title {
      font-size: 26px;
    }
    .nda-policy-page {
      .white-box {
        font-size: 14px;
        line-height: 18px;
        .agree-btn-group {
          .green-btn,
          .red-btn {
            min-width: 105px;
          }
        }
      }
    }
  }
}
</style>