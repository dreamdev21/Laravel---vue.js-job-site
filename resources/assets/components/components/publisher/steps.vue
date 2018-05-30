<template>
  <!-- <div class="row">
    <div class="col-md-12"> -->
      <div :class="['steps-container ', projectTypeClass]">
          <div :key="step.id" v-for="step in steps" :class="['step-wrap',{active : isCompleted(step.id), current_active_step: step.id === active}]">
            <div class="step">
              <div class="line" :class="{fill: step.id <= active}"></div>
              <div class="dot"><div class="fill"></div></div>
              <div class="line" :class="{fill: step.id < active || step.id === steps.length}"></div>
            </div>
            <div class="title-container"><div class="title">{{step.name}}</div></div>
          </div>
      </div>
    <!-- </div>
  </div> -->
</template>
<script>
export default {
  name: "Steps",
  props: {
    steps: {
      type: Array,
      default() {
        return [];
      }
    },
    active: {
      type: Number,
      default() {
        return 1;
      }
    },
    projectTypeClass: {
      type: String,
      default() {
        return 'paid-project';
      }
    }
  },
  methods: {
    isCompleted(id) {
      if (id <= this.active) {
        return true;
      }
      return false;
    }
  }
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";

.steps-container {
  display: flex;
  margin: 25px 0 10px;
}
.steps-container div {
  flex: 1;
}
.step {
  display: flex;
  align-content: center;
  justify-content: center;
}
.title-container {
  width: 100%;
  text-align: center;
  display: block;
  margin-top: 0px;
  line-height: 0px;
}
.title {
  font-size: 17px;
  color: #85878b;
}
.line {
  height: 3px;
  border-top: 3px solid #ececec;
  flex: 2;
}
.dot {
  width: 30px;
  position: relative;
  top: -14px;
  max-width: 30px;
  height: 30px;
  border-radius: 50%;
  background: white;
  flex: 1;
  border: 3px solid transparent;
  display: flex;
  align-content: center;
  justify-content: center;
  align-items: center;
  .fill {
    background: transparent;
    border: 2px solid rgba(175,177,179,0.5);
    width: 16px;
    height: 16px;
    max-width: 16px;
    border-radius: 50%;
  }
}
.paid-project{
  .active {
    .title {
      color: #01aef7;
    }
    .line.fill {
      border-color: #01aef7;
    }
    .dot {
      border-color: #01aef7;
      .fill {
        background: #01aef7;
        border-color: transparent;
      }
    }
  }
}
.test-project{
  .active {
    .title {
      color: #2cac3d;
      font-family: $font-family-brandon-bold;
    }
    .line.fill {
      border-color: #2cac3d;
    }
    .dot {
      border-color: #2cac3d;
      .fill {
        background: #2cac3d;
        border-color: transparent;
      }
    }
  }
}
@media screen and(max-width:991px) {
  .dot {
    width: 28px;
    top: -13px;
    max-width: 28px;
    height: 28px;
    .fill {
      width: 14px;
      height: 14px;
      max-width: 14px;
    }
  }
  .title{
    font-size: 15px;
  }
}
@media screen and(max-width:767px) {
   .title-container {
    line-height: 16px;
  }
}
@media screen and(max-width:575px) {
  .title-container {
    line-height: 16px;
  }
  .test-project,.paid-project{
    .step-wrap{
      .title{
        display: none;
      }
    }
    .current_active_step{
      .title {
        display: block;
      }
    }
  }
  .dot {
    width: 20px;
    top: -9px;
    max-width: 20px;
    height: 20px;
    .fill {
      width: 10px;
      height: 10px;
      max-width: 10px;
    }
  }
}
</style>