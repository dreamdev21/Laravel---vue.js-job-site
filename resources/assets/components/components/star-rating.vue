<template>
  <div class="row">
    <div class="col-md-12">
      <i
        @mouseover="setRating(i)"
        class="starElement fa"
        :class="{
          'fa-star-o': currentRating < i,
          'fa-star-half-o': currentRating + 0.5 == i,
          'fa-star': currentRating >= i,
          'clickable': !disabled,
          small,
          label
        }"
        :key="i"
        @mouseout="setRating(value)"
        @click="selected(i)"
        v-for="i in totalStars"></i>
        <span v-if="small && label">{{displayRating}}</span>
    </div>
  </div>
</template>
<script>
export default {
  name: "StarRating",
  props: {
    value: {
      default: 0
    },
    disabled: {
      default: false
    },
    small: {
      default: false
    },
    label: {
      default: true
    }
  },
  data() {
    return {
      maxStars: 5,
      currentRating: 0,
      totalStars: []
    };
  },
  mounted() {
    this.currentRating = this.value;
    for (let i = 1; i <= this.maxStars; i++) {
      this.totalStars.push(i);
    }
  },
  watch: {
    value(newVal, oldVal) {
      this.currentRating = newVal;
    }
  },
  methods: {
    setRating(v) {
      if (this.disabled) {
        return true;
      }
      this.currentRating = v;
    },
    selected(v) {
      if (this.disabled) {
        return true;
      }
      this.setRating(v);
      this.$emit("input", v);
      this.$emit("change", v);
    }
  },
  computed: {
    displayRating() {
      if (this.totalStars.indexOf(this.currentRating) >= 0) {
        return this.currentRating;
      }
      if (/\.5$/.test(this.currentRating.toString())) {
        return this.currentRating;
      }
      return Math.floor(this.currentRating);
    }
  }
};
</script>
<style scoped lang="less">
span {
  font-size: 12px;
}
.starElement {
  font-size: 18px;
  margin-right: 12px;
  color: black;
  &.small {
    font-size: 12px;
    margin-right: 5px;
  }
  &.fa-star,
  &.fa-star-half-o {
    color: #ffd055;
  }
  &.clickable {
    cursor: pointer;
  }
}
</style>