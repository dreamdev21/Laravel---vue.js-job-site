<template>
   <div class="detail-block-wrap mb-3">
    <h4>{{ title }}</h4>
    <div class="row">
      <div class="col-12" :class="{'col-xl-12': disabled, 'col-xl-10': !disabled}">
        <div class="detail-block">
          <span class="d-none d-md-inline-block" v-for="(description,i) in aDescription" :key="i">
            {{ description }}
          </span>
        </div>
        <div class="ratings-block">
          <div class="rating-item"
            @mouseover="setRating(item)"
            @mouseout="setRating(value.score)"
            @click="selected(item)"
            :style="ratingItemStyle"
            :class="{
              first: i === 0,
              last: i === starBlocks.length - 1,
              fill: ratingValue.score >= item
            }" v-for="(item, i) in starBlocks" :key="i">
            {{item}} <i class="fa fa-star-o"></i>
          </div>
        </div>
      </div>
      <div class="col-12 col-xl-2 pl-xl-0 float-right" v-if="!disabled">
        <div class="green-step-btn-wrap">
          <a class="green-step-btn" @click="add_suggestion = !add_suggestion">add explaination/ suggestion</a>
        </div>
      </div>
    </div>
    <div class="explanation-wrap mt-2" v-if="add_suggestion">
      <textarea class="form-control" :value="ratingValue.suggestion" @input="addSuggestion" placeholder="your explanation" rows="2" />
    </div>
    <div class="explanation-wrap mt-2" v-if="!add_suggestion && ratingValue.suggestion">{{ratingValue.suggestion}}</div>
  </div>
</template>
<script>
export default {
  name: "ProjectRating",
  props: {
    title: {
      default() {
        return "Visual Accuracy";
      }
    },
    aDescription:{
      type: Array,
      default(){
        return [
          'Physics issues, bugs/image jitters. Causes motion sickness1',
          'Some good representations, some poor representations1.',
          'No bugs, jitters, image is accurately represented. No motion sickness1.'
        ]
      }
    },
    maxRating: {
      default() {
        return 5;
      }
    },
    value: {
      default() {
        return {
          score: 0,
          suggestion: ""
        };
      }
    },
    new: {},
    disabled: {
      default() {
        return false;
      }
    }
  },
  data() {
    return {
      add_suggestion: false,
      ratingValue: {
        score: 0,
        suggestion: ""
      }
    };
  },
  methods: {
    emitChange() {
      this.$emit("input", this.ratingValue);
      this.$emit("change", this.ratingValue);
    },
    addSuggestion(e) {
      this.ratingValue.suggestion = e.target.value;
      this.emitChange();
    },
    setRating(v) {
      if (this.disabled) {
        return true;
      }
      this.ratingValue.score = v;
    },
    selected(v) {
      if (this.disabled) {
        return true;
      }
      this.setRating(v);
      this.emitChange();
    }
  },
  computed: {
    starBlocks() {
      return Array.from({ length: this.maxRating }).map((_, i) => i + 1);
    },
    ratingFillColor() {
      if (this.ratingValue.score === 1) return "#F83636";
      if (this.ratingValue.score === 2) return "#FF8A0D";
      if (this.ratingValue.score === 3) return "#FFC21F";
      if (this.ratingValue.score === 4) return "#73DF23";
      if (this.ratingValue.score === 5) return "#02C506";
    },
    ratingItemStyle() {
      const baseStyle = {};
      if (!this.disabled) {
        baseStyle.cursor = "pointer";
      }
      if (this.ratingValue.score) {
        return {
          ...baseStyle,
          color: "white",
          background: this.ratingFillColor
        };
      }
      return { ...baseStyle };
    }
  },
  mounted() {
    this.ratingValue = { ...this.value };
  },
  watch: {
    value(newVal, oldVal) {
      this.ratingValue = { ...newVal };
    }
  }
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";
.ratings-block {
  display: flex;
  .rating-item {
    flex: 1;
    min-height: 40px;
    margin-right: 12px;
    text-align: center;
    font-size: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    &:not(.fill) {
      color: #606368 !important;
      background: #f2f2f2 !important;
    }
    i {
      margin-left: 3px;
    }
    &.fill {
      i:before {
        content: "\F005";
      }
    }
    &.first {
      border-bottom-left-radius: 20px;
      border-top-left-radius: 20px;
    }
    &.last {
      border-top-right-radius: 20px;
      border-bottom-right-radius: 20px;
    }
  }
}
.detail-block-wrap {
  background-color: #fff;
  border: 1px solid #dadada;
  padding: 15px;
  border-radius: 6px;
  h4 {
    font-size: 18px;
    color: #2cac3d;
    font-family: $font-family-brandon-bold;
  }
  .detail-block {
    font-family: $font-family-brandon-medium;
    font-size: 14px;
    line-height: 16px;
    span {
      width: calc(100% / 3 - 5px);
      display: inline-block;
      vertical-align: top;
    }
  }
  .explanation-wrap {
    textarea {
      resize: none;
      padding: 0px 10px;
      font-size: 17px;
      color: #9c9c9c;
      &:hover,
      &:focus {
        outline: none !important;
      }
    }
  }
  .ratings-block {
    margin-top: 10px;
    img {
      width: 100%;
    }
  }
  .green-step-btn-wrap {
    .green-step-btn {
      margin: 0;
      margin-top: 30px;
      font-size: 12px;
      line-height: 14px;
      text-transform: uppercase;
      padding: 4px 8px;
      cursor: pointer;
      color: #fff;
    }
  }
}
.green-step-btn {
  width: 100%;
  max-width: 180px;
  padding: 7px 10px;
  border: 2px solid #118921;
  background-color: #2cac3d;
  color: #fff;

  font-size: 14px;
  font-family: $font-family-brandon-medium;
  letter-spacing: 0.05rem;
  color: #fff;
  border-radius: 20px;
  display: inline-block;
  text-align: center;
  margin: 10px 15px 30px 0px;
  &:hover {
    background-color: #158f25;
    color: #fff;
    outline: none !important;
  }
}
@media screen and(max-width:1281px) {
  .custom-container {
    .test-proj-fillup-page {
      .white-box {
        font-size: 16px;
      }
      .green-step-btn {
        font-size: 13px;
      }
    }
  }
}
@media screen and(max-width:1200px) {
  .detail-block-wrap {
    .green-step-btn-wrap {
      max-width: 200px;
      float: right;
      .green-step-btn {
        margin-top: 20px;
      }
    }
  }
}
@media screen and(max-width:991px) {
}
@media screen and(max-width:767px) {
  .detail-block-wrap {
    h4 {
      font-size: 16px;
    }
    .ratings-block {
      margin-top: 0;
    }
    .green-step-btn-wrap {
      max-width: 160px;
      .green-step-btn {
        margin-top: 10px;
        font-size: 12px;
        line-height: 12px;
      }
    }
  }
}
@media screen and(max-width:575px) {
  .detail-block-wrap {
    .green-step-btn-wrap {
      max-width: 130px;
      .green-step-btn {
        font-size: 10px;
      }
    }
  }
}
</style>