<template>
  <span class="">
    <slot :calculation="{per_tester_cost, total_cost}">
      x
      <span v-if="calculating">Calculating cost...</span>
      <span v-else>
        <span class="text-bold"> ${{per_tester_cost}}</span> / Tester =
        <span class="text-red text-bold tester-amt d-block d-sm-inline-block">${{total_cost}}</span>
      </span>
    </slot>
  </span>
</template>
<script>
export default {
  name: "ProjectCostCalculator",
  props: {
    testers: {
      type: Number,
      default() {
        return 0;
      }
    },
    projectId: {
      type: Number,
      default() {
        return undefined;
      }
    }
  },
  data() {
    return { resultsMap: {}, per_tester_cost: 0, calculating: false };
  },
  methods: {
    getProjectCost() {
      if (this.testers <= 0) {
        this.perTesterCost = 0;
        return;
      }
      this.calculating = true;
      return axios
        .post("/api/project-cost", {
          testers: this.testers,
          project_id: this.projectId
        })
        .then(({ data }) => {
          this.resultsMap[this.testers] = data.per_tester_cost;
          this.per_tester_cost = data.per_tester_cost;
          this.calculating = false;
        })
        .catch(() => (this.calculating = false));
    }
  },
  computed: {
    total_cost() {
      return this.per_tester_cost * this.testers;
    }
  },
  mounted() {
    return this.getProjectCost();
  },
  watch: {
    testers(newValue, oldValue) {
      if (newValue !== oldValue) {
        if (this.resultsMap[newValue]) {
          return true;
        }
        return this.getProjectCost();
      }
    }
  }
};
</script>