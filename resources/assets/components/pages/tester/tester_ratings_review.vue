<template>
   <div class="detail-block-wrap mb-3">
    <h4>Visual Accuracy</h4>
    <div class="row">
      <div class="col-12">
        <div class="">
            <span class="rating-star">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star-o"></i>
              <i class="fa fa-star-o"></i>
              <i class="fa fa-star-o"></i>
            </span>
            <span class="ml-2 text-medium">
              Points: 0
            </span>
          </div>
          <p class="mb-0">
            This is other explanation on this rating category
          </p>
      </div>
    </div>
  </div>
</template>
<script>
import Vue from "vue";

export default {
  name: "StarRatingReview"
}
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";
.text-bold{
  font-family: $font-family-brandon-bold;
}
.text-medium{
  font-family: $font-family-brandon-medium;
}
.detail-block-wrap{
  background-color: #fff;
  border: 1px solid #dadada;
  padding: 15px;
  border-radius: 6px;
  h4{
    font-size: 18px;
    color: #2cac3d;
    font-family: $font-family-brandon-bold;
    margin-bottom: 20px;
  }
  .rating-star{
    font-size: 24px;
    color: #ffcc00;
  }
}
@media screen and(max-width:767px) {
  .detail-block-wrap{
    h4{
      margin-bottom: 15px;
    }
  }
  .rating-star{
    font-size: 20px;
  }
}
@media screen and(max-width:575px) {
  .detail-block-wrap{
    .rating-star{
      font-size: 18px;
    }
  }
}

</style>