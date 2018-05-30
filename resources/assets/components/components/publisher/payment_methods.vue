<template>
  <div class="">
    <div class="info-wrap">
      Please add paypal account to receive payment.
    </div>
    <div class="white-box">
      <div class="row">
        <div class="col-12">
          <div class="content-wrap d-block d-sm-inline-block">
            <h4 class="username">Your default Paypal account</h4>
            <p class="usermail">ndtester1@yopmail.com</p>
            <a href="#" class="link">Change</a>
          </div>
        </div>
      </div>
    </div>
    <div class="white-box">
      <h4 class="block-title">
        All Paypal Accounts
      </h4>
      <div class="table-responsive publisher-payment-method-table">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Default</th>
              <th scope="col">Accounts</th>
              <th scope="col" class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td scope="row" class="text-center">
                <div class="radio form-check-inline">
                  <label>
                    <input type="radio" name="o3" value="yes">
                    <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                  </label>
                </div>
              </td>
              <td scope="row">tester1@thebetaplan.com</td>
              <td scope="row" class="text-center">
                <a href="#" class="link">Delete</a>
              </td>
            </tr>
             <tr>
              <td scope="row"  class="text-center">
                <div class="radio form-check-inline">
                  <label>
                    <input type="radio" name="o3" value="yes" checked>
                    <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                  </label>
                </div>
              </td>
              <td scope="row">ndtester1@yopmail.com</td>
              <td scope="row" class="text-center">
                <a href="#" class="link">Delete</a>
              </td>
            </tr>
             <tr>
              <td scope="row"  class="text-center">
                <div class="radio form-check-inline">
                  <label>
                    <input type="radio" name="o3" value="yes">
                    <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                  </label>
                </div>
              </td>
              <td scope="row">ndtester3@yopmail.com</td>
              <td scope="row" class="text-center">
                <a href="#" class="link">Delete</a>
              </td>
            </tr>
             <tr>
              <td scope="row"  class="text-center">
                <div class="radio form-check-inline">
                  <label>
                    <input type="radio" name="o3" value="yes">
                    <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                  </label>
                </div>
              </td>
              <td scope="row">ndtester5@yopmail.com</td>
              <td scope="row" class="text-center">
                <a href="#" class="link">Delete</a>
              </td>
            </tr>
             <tr>
              <td scope="row"  class="text-center">
                <div class="radio form-check-inline">
                  <label>
                    <input type="radio" name="o3" value="yes">
                    <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                  </label>
                </div>
              </td>
              <td scope="row">tester1@thebetaplan.com</td>
              <td scope="row" class="text-center">
                <a href="#" class="link">Delete</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="white-box">
      <h4 class="block-title">
        Add New Paypal Account
      </h4>
      <form>
        <div class="row justify-content-center">
          <div class="col-md-4 col-12">
            <div class="form-group custom-form-group">
              <span class="text-bold">Paypal account email : </span>
              <input type="text" class="form-control custom-form-control mt-1" placeholder="email"/>
            </div>
          </div>
        </div>
        <a href="#" class="blue-btn text-uppercase text-center">Save</a>
      </form>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
export default {
  name: "payment_methods"
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";
.text-green {
  color: #2cac3d;
}
.checkbox label:after,
.radio label:after {
  content: "";
  display: table;
  clear: both;
}

.checkbox .cr,
.radio .cr {
  position: relative;
  display: inline-block;
  border: 1px solid #0082cc;
  border-radius: 0.25em;
  width: 1.3em;
  height: 1.3em;
  float: left;
  margin-right: 0.5em;
  color: #0082cc;
}

.radio .cr {
  border-radius: 50%;
}

.checkbox .cr .cr-icon,
.radio .cr .cr-icon {
  position: absolute;
  font-size: 0.8em;
  line-height: 0;
  top: 50%;
  left: 20%;
}

.radio .cr .cr-icon {
  margin-left: 0.04em;
}

.checkbox label input[type="checkbox"],
.radio label input[type="radio"] {
  display: none;
}

.checkbox label input[type="checkbox"] + .cr > .cr-icon,
.radio label input[type="radio"] + .cr > .cr-icon {
  transform: scale(3) rotateZ(-20deg);
  opacity: 0;
  transition: all 0.3s ease-in;
}

.checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
.radio label input[type="radio"]:checked + .cr > .cr-icon {
  transform: scale(1) rotateZ(0deg);
  opacity: 1;
}
.checkbox label ,.radio label{
  margin-bottom: 2px;
}

.checkbox label input[type="checkbox"]:disabled + .cr,
.radio label input[type="radio"]:disabled + .cr {
  opacity: 0.5;
}
.info-wrap {
  background-color: #fcb3b4;
  border-radius: 6px;
  padding: 8px;
  margin-bottom: 20px;
}
.white-box {
  .link {
    font-size: 14px;
    color: #0082cc;
    font-family: $font-family-brandon-regular;
    text-decoration: underline !important;
  }
  .block-title {
    font-size: 20px;
    font-family: $font-family-UniNeue-bold;
    border-bottom: 1px solid #dadada;
    color: #0082cc;
    padding-bottom: 10px;
    margin-bottom: 10px;
  }
  .content-wrap {
    vertical-align: middle;
    .username {
      font-family: $font-family-UniNeue-regular;
      font-size: 25px;
      color: #363e48;
      margin-bottom: 0px;
    }
    .usermail {
      font-size: 15px;
      color: #73767b;
      font-family: $font-family-brandon-regular;
      margin-bottom: 0;
    }
  }
  .custom-form-group {
    .custom-form-control {
      background-color: transparent !important;
    }
  }
}
.blue-btn {
  width: 100%;
  max-width: 130px;
  padding: 7px 10px;
  color: #fff !important;
  margin: 5px auto 0;
  border-radius: 20px;
  display: block;
  font-family: $font-family-brandon-bold;
}
@media screen and(max-width:1281px) {
  .white-box {
    .content-wrap {
      .username {
        font-size: 22px;
      }
    }
  }
}
@media screen and(max-width:1200px) {
  .white-box {
    .block-title {
      font-size: 18px;
    }
  }
}
@media screen and(max-width:767px) {
  .white-box {
    .content-wrap {
      margin-bottom: 5px;
      .username {
        font-size: 18px;
        margin-bottom: 5px;
      }
    }
  }
}
@media screen and(max-width:575px) {
  .white-box {
    line-height: 18px;
  }
}
</style>