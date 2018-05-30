<template>
    <div class="bg-color">
        <div class="container">
            <div class="row">
                <div class="content-bg thanku-page">
                    <p>To become a Tester for The Beta Plan you must agree to our NDA policy.</p>
                    <h1 class="text-uppercase">Thank You</h1>
                    <a href="#" class="btn text-uppercase text-center green-btn">Back To login</a>
                    <a href="#" class="btn text-uppercase text-center green-btn">Back To Profile</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "thank-you"
    }
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";
.content-bg{
    background-image: url(~/images/content-bg.png);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: top center;
    min-height: 524px;
}
.thanku-page{
    text-align: center;
    padding: 210px 0px 0px;
    width: 100%;
    h1{
      color: #363e48;
      font-size: 40px;
      font-family: $font-family-UniNeue-bold;
    }
    p{
      color:#606368;
      font-size: 18px;
      span.text-green{
          color: #2cac3d;
          font-family: $font-family-brandon-bold;
      }
    }
}
.green-btn{
    width: 180px;
    padding: 7px 10px;
    color: #fff;
    margin: 15px auto;
    border-radius: 20px;
    margin-right: 20px;
    &:hover{
      background: #158f25;
    }
}
@media screen and(max-width:1200px) {
  .thanku-page{
    padding-top: 145px;
  }
}
@media screen and(max-width:991px) {
  .thanku-page{
    padding-top: 145px;
    h1{
     font-size: 34px;
    }
    p{
      font-size: 16px;
    }
  }
}
@media screen and(max-width:576px) {
  .thanku-page {
    h1{
      font-size: 28px;
    }
    p{
      font-size: 14px;
    }
  }
  .green-btn{
    margin: 15px auto;
    display: block;
    width: 145px;
    padding: 5px 10px;
    font-size: 13px;
  }
}
</style>

