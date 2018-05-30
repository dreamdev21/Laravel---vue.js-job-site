<template>
  <div class="white-box">
    <div class="row">
      <div class="col-12">
        <h4 class="block-title">Payment Details of Testers
        </h4>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-3 statistics-info-wrap">
        <p class="mb-2 mb-sm-4">
          <span class="">
            Project Total Amount :
          </span>
          <span class="text-bold statistics-num">
            ${{ project.total_cost }}
          </span>
        </p>
        <p class="mb-2 mb-sm-4">
          <span class="">
            Total Testers :
          </span>
          <span class="text-bold statistics-num">
            {{project.allocated_tester}}
          </span>
        </p>
        <p class="mb-2 mb-sm-4">
          <span class="">
            Amount for each Tester:
          </span>
          <span class="text-bold statistics-num">
            ${{project.per_tester_admin_decided_cost}}
          </span>
        </p>
        <p class="mb-2 mb-sm-4">
          <span class="">
            Total Payable Amount :
          </span>
          <span class="text-bold statistics-num">
            $40
          </span>
        </p>
        <p class="mb-0">
          <span class="">
            Unpaid Amount :
          </span>
          <span class="text-bold statistics-num">
            $10
          </span>
        </p>
      </div>
      <div class="col-12 col-md-9">
        <table class="table">
          <thead>
            <tr>
              <th>Tester</th>
              <th>Given Rating</th>
              <th>Amount</th>
              <th v-if="isUserAdmin">Payment</th>
            </tr>
          </thead>
          <tr :key="tester.id" v-for="tester in project.testers">
            <td>
              {{tester.first_name}} {{tester.last_name}}
              <star-rating :disabled="true" v-model="testerRatings[tester.id]" :small="true"></star-rating>
            </td>
            <td>
              <button type="button" v-if="excludedUsers.indexOf(tester.id) === -1" @click="giveRating(tester)" class="purple-btn">Give Ratings</button>
              <star-rating :disabled="true" v-else :value="getTesterRating(tester)" :small="true"></star-rating>
            </td>
            <td>${{project.per_tester_admin_decided_cost}}</td>
            <td v-if="isUserAdmin">
              <button type="button" :disabled="paymentProcessingTesterId === tester.id" v-if="alreadyPaidTesters.indexOf(tester.id) === -1" @click="confirmAndPayToTester(tester)" class="purple-btn">Pay Tester</button>
              <label v-else class="badge badge-success">PAID</label>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <b-modal @shown="resetRatings" :cancel-disabled="true" ref="rating_modal" :title="rateModalTitle">
      <div class="col-md-12 mb-2">
        Completeness / Followed instructions
        <star-rating v-model="ratings.speed"></star-rating>
      </div>
      <div class="col-md-12 mb-2">
        Quality / Usefulness of feedback
        <star-rating v-model="ratings.quality"></star-rating>
      </div>
      <div class="col-md-12 mb-2">
        Professionalism
        <star-rating v-model="ratings.professionalism"></star-rating>
      </div>
      <div class="col-md-12 mb-4 text-center">
        Overall ratings
        <star-rating disabled v-model="avgRating"></star-rating>
      </div>
      <div slot="modal-footer">
        <button class="purple-btn" type="button" @click="handleRateSubmit">Submit</button>
      </div>
    </b-modal>
  </div>
</template>
<script>
import { isAdmin } from "src/services/auth";
import StarRating from "./star-rating";
const defaultRating = {
  speed: 0,
  quality: 0,
  professionalism: 0
};
export default {
  name: "projectTesterRatings",
  components: {
    StarRating
  },
  props: {
    project: {
      type: Object,
      required: true
    },
    exclude: {
      type: Array,
      default() {
        return [];
      }
    }
  },
  data() {
    return {
      currentRatingTester: null,
      ratings: { ...defaultRating },
      alreadyRatedUsers: [],
      alreadyPaidTesters: [],
      paymentProcessingTesterId: null,
      isUserAdmin: false,
      testerRatings: []
    };
  },
  methods: {
    giveRating(tester) {
      this.currentRatingTester = tester;
      return this.$refs.rating_modal.show();
    },
    resetRatings() {
      this.ratings = { ...defaultRating };
    },
    handleRateSubmit() {
      axios
        .post(
          `/api/projects/${this.project.id}/rating/${
            this.currentRatingTester.id
          }`,
          { ratings: this.avgRating }
        )
        .then(({ data: { data } }) => {
          this.alreadyRatedUsers = [
            ...this.alreadyRatedUsers,
            { ...data, tester_id: this.currentRatingTester.id }
          ];
          this.$emit("onRating", {
            ...this.currentRatingTester,
            ratings: this.avgRating
          });
          this.currentRatingTester = null;
          this.resetRatings();
        });
      this.$refs.rating_modal.hide();
    },
    confirmAndPayToTester(tester) {
      return this.$swal({
        title: "Are you sure?",
        text: `You want to send $${this.project.cost_per_tester} to ${
          tester.first_name
        }?`,
        icon: "info",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          this.payTester(tester);
        }
      });
    },
    payTester(tester) {
      axios
        .post("/api/tester-earnings", {
          amount: this.project.per_tester_admin_decided_cost,
          note: `${this.project.name}`,
          is_bonus: false, // later ask for bonus if required
          tester_id: tester.id,
          project_id: this.project.id
        })
        .then(() => {
          this.alreadyPaidTesters = [...this.alreadyPaidTesters, tester.id];
          this.paymentProcessingTesterId = null;
          this.$swal({
            title: "Success!",
            text: `${tester.first_name}'s account has credited with $${
              this.project.per_tester_admin_decided_cost
            }`,
            icon: "success"
          });
        })
        .catch(error => {
          this.paymentProcessingTesterId = null;
          this.$swal({
            title: "Fail!",
            text: error.response.data.message,
            icon: "error"
          });
        });
    },
    getTesterRating(tester) {
      const i = this.alreadyRatedUsers
        .filter(({ tester_id }) => tester_id === tester.id)
        .pop();
      if (i) {
        return i.score;
      }
      return 0;
    }
  },
  computed: {
    rateModalTitle() {
      const currentRatingTester = this.currentRatingTester || {};
      return `Rate Tester ${currentRatingTester.first_name} ${
        currentRatingTester.last_name
      }`;
    },
    avgRating() {
      return (
        Object.keys(this.ratings).reduce((t, k) => t + this.ratings[k], 0) /
        Object.keys(this.ratings).length
      );
    },
    excludedUsers() {
      return (this.alreadyRatedUsers || [])
        .map(({ tester_id }) => tester_id)
        .map(d => d);
    }
  },
  mounted() {
    this.isUserAdmin = isAdmin();
    this.testerRatings = [];
    this.project.testers.forEach(t => {
      if (t.ratings.length) this.testerRatings[t.id] = t.ratings[0].score;
    });
    axios
      .get(`/api/projects/${this.project.id}/rated`)
      .then(({ data }) => (this.alreadyRatedUsers = data));
    axios
      .get(`/api/projects/${this.project.id}/paid`)
      .then(({ data }) => (this.alreadyPaidTesters = data));
  }
};
</script>
<style lang="scss" scoped>
@import "../layouts/css/_customvariables";

.purple-btn {
  background-color: #5651b9;
  border: 2px solid #3e3a94;
  color: #fff !important;
  font-size: 15px;
  line-height: 16px;
  font-family: $font-family-brandon-medium;
  border-radius: 6px;
  padding: 3px 6px;
  -webkit-transition: all 0.4s ease;
  -moz-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  -ms-transition: all 0.4s ease;
  transition: all 0.4s ease;
  cursor: pointer;
  &:hover {
    outline: none !important;
    background-color: #6b65e0;
  }
  &:focus {
    outline: none !important;
  }
}
.statistics-info-wrap {
  border-right: 1px solid #cecece;
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
.text-purple {
  color: #363e48;
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
  .block-title {
    font-size: 18px;
    font-family: $font-family-UniNeue-bold;
    border-bottom: 1px solid #dadada;
    color: #0082cc;
    padding-bottom: 10px;
    margin-bottom: 10px;
    width: auto;
  }
  .block-subtitle {
    font-size: 20px;
    font-family: $font-family-brandon-bold !important;
    border-bottom: 1px solid #dadada;
    color: #0082cc;
    padding-bottom: 10px;
    margin-bottom: 10px;
    width: auto;
  }
  .mark-comple-btn {
    float: right;
    margin-top: 15px;
  }
}
.blue-btn {
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
  color: #fff;
  &:hover {
    background-color: #13b9fb;
  }
}
.purple-btn {
  background-color: #5651b9;
  border: 2px solid #3e3a94;
  color: #fff !important;
  font-size: 15px;
  line-height: 16px;
  font-family: $font-family-brandon-medium;
  border-radius: 25px;
  padding: 5px 10px;
  -webkit-transition: all 0.4s ease;
  -moz-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  -ms-transition: all 0.4s ease;
  transition: all 0.4s ease;
  cursor: pointer;
  &:hover {
    outline: none !important;
    text-decoration: underline !important;
    background-color: #6b65e0;
  }
  &:focus {
    outline: none !important;
  }
}
@media screen and(max-width:991px) {
  .white-box {
    padding: 15px;
  }
}
@media screen and(max-width:767px) {
  .statistics-info-wrap {
    border-right: none;
  }
}
@media screen and(max-width:575px) {
  .white-box {
    .block-title {
      font-size: 16px;
    }
  }
}
</style>