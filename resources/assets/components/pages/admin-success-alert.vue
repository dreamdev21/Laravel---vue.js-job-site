<template>
  <div class="row">
    <div class="col-12">
      <div class="alert alert-dismissible fade show text-center sucess-alertwrap" role="alert" v-if="visible">
        3 New Project requested for Approval.
        <button type="button" class="close" @click="visible = !visible">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>
</template>
<script>
    import Vue from 'vue';

    export default {
     data() {
        return{
          visible : true
        }
      }
    }
</script>
<!-- styles -->
<!-- adding scoped attribute will apply the css to this component only -->

<style lang="scss" scoped>
@import "../layouts/css/customvariables";
    .text-yellow{
      color: #ffcc00;
    }
    .text-orange{
      color: #ff8a0e;
    }
    .text-green{
      color: #02c505;
    }
    .text-darkgreen{
      color: #2cac3d;
    }
    .text-red{
      color: #f83636;
    }
    .text-bold{
      font-family: $font-family-brandon-bold;
    }
    .sucess-alertwrap{
      background-color: #fff;
      border: 2px solid #2cac3d;
      color: #2cac3d;
      font-family: $font-family-brandon-medium;
      border-radius: 4px;
      font-size: 18px;
      padding: 5px;
      .close{
        font-size: 30px;
        padding: 5px;
        color: #2cac3d;
        opacity: 1;
      }
    }

@media screen and(max-width:1024px) {
  .sucess-alertwrap{
    font-size: 16px;
    .close{
      font-size: 30px;
      line-height: 24px;
    }
  }
}

@media screen and(max-width:576px) {
  .sucess-alertwrap{
    font-size: 15px;
    .close{
      padding: 0px 2px;
    }
  }
}
</style>
