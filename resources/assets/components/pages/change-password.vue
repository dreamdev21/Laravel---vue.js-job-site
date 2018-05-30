<template>
  <div>
  
    <div class="container custom-container">
      <div class="row">
        <h1 class="page-title">
          Change Password
        </h1>
        <div class="change-password-page">
            <div class="white-box">
              <div class="row">
                <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-12">
                  <div class="form-group custom-form-group">
                    <span class="text-bold">Current password</span>
                      <input type="text" class="form-control custom-form-control mt-1" placeholder="Current password">
                  </div>
                  <div class="form-group custom-form-group">
                    <span class="text-bold">Old password</span>
                      <input type="text" class="form-control custom-form-control mt-1" placeholder="Old password">
                  </div>
                  <div class="form-group custom-form-group">
                    <span class="text-bold">New Password</span>
                      <input type="text" class="form-control custom-form-control mt-1" placeholder="New password">
                  </div>
                </div>
              </div>
            </div>
            <a href="#" class="btn text-uppercase text-center purple-btn">change password</a>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Vue from "vue";
import VueForm from "vue-form";
export default {
  name: "change-password"
};
</script>
<style lang="scss" scoped>
@import "../layouts/css/_customvariables";

.text-bold{
  font-family:$font-family-brandon-bold;
}
.custom-container {
  max-width: 100%;
  .page-title {
    font-family: $font-family-UniNeue-bold;
    font-size: 30px;
    width: 100%;
    text-align: center;
    color: #363e48;
    margin: 5px 0 25px;
  }
  .change-password-page {
    width: 100%;
    .white-box {
      font-size: 17px;
      color: #606368;
      letter-spacing: 0;
      .block-title {
        font-size: 20px;
        font-family: $font-family-UniNeue-bold;
        border-bottom: 1px solid #dadada;
        color: #2cac3d;
        padding-bottom: 10px;
        margin-bottom: 10px;
      }
    }
    .purple-btn{
      border-radius: 25px;
      padding: 8px 10px;
      margin: 0 auto;
      display: block;
      max-width: 200px;
    }
  }
}
@media screen and(max-width:1281px) {
  .custom-container {
    .change-password-page {
      .white-box {
        font-size: 14px;
      }
    }
  }
}
@media screen and(max-width:1200px) {
  .custom-container {
    .page-title {
      font-size: 28px;
      margin: 0 0 20px;
    }
    .change-password-page {
      .white-box {
        .block-title {
          font-size: 18px;
        }
      }
    }
  }
}
@media screen and(max-width:575px) {
  .custom-container {
    .page-title {
      font-size: 26px;
    }
    .change-password-page {
      .white-box {
        line-height: 18px;
      }
    }
  }
}
</style>