<template>
  <div class="bg-color">
    <div class="container custom-container">
      <div class="row">
        <h1 class="page-title">
          Settings
        </h1>
        <div class="settings-page">
          <div class="white-box">
            <div class="row">
              <div class="col-12">
                <h3 class="block-title">Password</h3>
                <router-link tag="a" :to="{name: 'tester.change-password'}" exact class="">
                  Change Password
                </router-link>
              </div>
            </div>
          </div>
          <div class="white-box">
            <div class="row">
              <div class="col-12">
                <h3 class="block-title">Timezone</h3>
                <p class="mb-0"> Default Timezone : <span>PST</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Vue from "vue";


export default {
  name: "settings"
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";

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
  .settings-page {
    width: 100%;
    .white-box {
      a{
        color: #606368;
        font-size: 15px;
        text-decoration: underline !important;
      }
      .block-title {
        font-size: 20px;
        font-family: $font-family-UniNeue-bold;
        border-bottom: 1px solid #dadada;
        color: #2cac3d;
        padding-bottom: 10px;
        margin-bottom: 10px;
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
    .settings-page {
      .white-box {
         .block-title {
          font-size: 18px;
        }
      }
    }
  }
}

@media screen and(max-width:991px) {
  .custom-container {
    .settings-page {
      .white-box {
        font-size: 14px;
        a{
        font-size: 14px;
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
    .settings-page {
      .white-box {
        font-size: 14px;
        line-height: 18px;
      }
    }
  }
}
</style>