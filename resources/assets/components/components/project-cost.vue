<template>
  <div class="white-box">
    <div class="row">
      <div class="col-12">
        <h4 class="block-title">
            Amount for Testers
        </h4>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div style="color: red" v-if="errors" >
          <ul id="example-1" class="pl-0">
            <li v-for="error in errors" :key="error">
            {{ error }}
            </li>
          </ul>
        </div>
      </div>
    </div>
      <div class="project-block-wrap">
        <div class="row align-items-center">
          <div class="col-md-4 col-12 text-left amt-block-wrap mb-2 mb-md-0">
            <div class="mb-3">
              <span class="text-bold mr-2 d-block d-sm-inline-block align-middle">
                Project cost :
              </span>
              <div class="d-block d-sm-inline-block align-middle">
                <span class="text-bold proj-amt">
                  ${{value.total_cost}}
                </span>
              </div>
            </div>
            <div class="mb-3">
              <span class="text-bold mr-2 d-block d-sm-inline-block align-middle">
                Tester requested :
              </span>
              <span class="text-bold  proj-amt d-block d-sm-inline-block align-middle">
               {{value.tester_needed}}
              </span>
            </div>
            <div class="mb-3">
              <span class="text-bold d-inline-block mr-2 d-block d-sm-inline-block align-middle">
                Tester assign :
              </span>
              <div class="d-block d-sm-inline-block align-middle">
                <div v-if="!disabled">
                  <input type="number" class="form-control" @input="calculateTotal" v-model="value.allocated_tester" />
                </div>
                <span v-else class="text-bold proj-amt">
                  {{value.allocated_tester}}
                </span>
              </div>
            </div>
            <div class="mb-3">
              <span class="text-bold d-inline-block mr-2 d-block d-sm-inline-block align-middle">
                Discount :
              </span>
              <div class="d-block d-sm-inline-block align-middle">
                <div v-if="!disabled">
                  <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type="number" class="form-control" v-model="value.applied_discount" />
                  </div>
                </div>
                <span v-else class="text-bold proj-amt">
                  {{value.applied_discount}}
                </span>
              </div>
            </div>
            <div class="mb-0">
              <span class="text-bold d-inline-block mr-2 d-block d-sm-inline-block align-middle">
                Total Invoice Amount :
              </span>
              <div class="d-block d-sm-inline-block align-middle">
                <span class="text-bold proj-amt">
                  ${{invoiceAmount}}
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-12 text-md-center text-left amt-block-wrap">
            <p class="pt-md-3 mb-md-2 text-bold">
              Amount for each Tester :
            </p>
              <div class="mb-md-5 mb-4 form-group text-center" v-if="!disabled">
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input class="form-control" type="number" v-model="value.per_tester_admin_decided_cost" />
                </div>
              </div>
              <span v-else class="text-purple tester-amt d-block mt-md-3 pb-md-4 pb-3">
                ${{value.per_tester_admin_decided_cost}}
              </span>
            </div>
          <div class="col-md-4 col-12 text-left mb-2 mb-md-0">
            <div class="mb-3">
              <span class="text-bold d-block d-sm-inline-block align-middle">
                Total allocated for Testers :
              </span>
              <span class="text-red proj-amt d-block d-sm-inline-block align-middle">
                ${{totalAllocatedForTester}}
              </span>
            </div>
            <div class="mb-0">
              <span class="text-bold d-block d-sm-inline-block align-middle">
                Balance owed to Testers :
              </span>
              <span class="text-darkgreen proj-amt d-block d-sm-inline-block align-middle">
                ${{value.total_cost - totalAllocatedForTester}}
              </span>
            </div>
          </div>
        </div>
      </div>

  </div>
</template>

<script>
export default {
  name: "ProjectCost",
  props: {
    value: {
      type: Object,
      required: true,
      default() {
        return {};
      }
    },
    disabled: {
      type: Boolean,
      default() {
        return false;
      }
    },
    errors: {
      type: Array,
      default() {
        return null;
      }
    }
  },
  methods: {
    calculateTotal() {
      if (this.disabled) {
        return true;
      }
      return axios
        .post("/api/project-cost", {
          testers: this.value.allocated_tester || this.value.tester_needed,
          project_id: this.value.id
        })
        .then(({ data }) => {
          const updatedValue = {
            ...this.value,
            allocated_tester:
              this.value.allocated_tester || this.value.tester_needed,
            cost_per_tester: data.per_tester_cost,
            per_tester_admin_decided_cost: this.value.per_tester_cost || 20, // $20 default
            total_cost: data.total
          };
          this.$emit("input", updatedValue);
          this.$emit("change", updatedValue);
        });
    }
  },
  computed: {
    totalAllocatedForTester() {
      return (
        this.value.allocated_tester * this.value.per_tester_admin_decided_cost
      );
    },
    invoiceAmount() {
      return this.value.total_cost - this.value.applied_discount;
    }
  },
  mounted() {
    this.calculateTotal();
  }
};
</script>
<style lang="scss" scoped>
@import "../layouts/css/customvariables";
.text-yellow {
  color: #ffcc00;
}
.text-orange {
  color: #ff8a0e;
}
.text-green {
  color: #02c505;
}
.text-darkgreen {
  color: #2cac3d;
}
.text-red {
  color: #f83636;
}
.text-bold {
  font-family: $font-family-brandon-bold;
}
.white-box {
  .block-title {
    font-size: 18px;
    font-family: $font-family-UniNeue-bold;
    border-bottom: 1px solid #dadada;
    color: #3e3a94;
    padding-bottom: 10px;
    margin-bottom: 10px;
    width: auto;
  }
  .project-block-wrap {
    margin-top: 5px;
    font-family: $font-family-brandon-regular;
    font-size: 16px;
    color: #606368;
    position: relative;
    p {
      margin-bottom: 25px;
    }
    a {
      color: #14c1bf;
      text-decoration: underline !important;
    }
    .proj-amt {
      font-size: 25px;
      font-family: $font-family-brandon-black;
    }
    .tester-amt {
      font-family: $font-family-brandon-black;
      font-size: 50px;
    }
    .form-group {
      max-width: 80%;
      margin: 0 auto;
      display: block;
    }
    .amt-block-wrap {
      position: relative;
      border-right: 1px solid #dadada;
    }
  }
}

@media screen and(max-width:1199px) {
  .white-box {
    .project-block-wrap {
      p {
        margin-bottom: 20px;
      }
      .proj-amt {
        font-size: 22px;
      }
      .form-group {
        margin: 0 auto;
        max-width: 80%;
      }
    }
  }
}
@media screen and(max-width:1112px) {
  .white-box {
    .project-block-wrap {
      font-size: 14px;
      margin-top: 10px;
      .proj-title {
        font-size: 18px;
        margin-bottom: 5px;
      }
    }
  }
}
@media screen and(max-width:767px) {
  .white-box {
    .project-block-wrap {
      p {
        margin-bottom: 5px;
      }
      .amt-block-wrap {
        border: none;
      }
      .tester-amt {
        font-size: 32px;
        line-height: 20px;
      }
      .form-group {
        margin: 0;
        max-width: 50%;
      }
    }
  }
}
</style>