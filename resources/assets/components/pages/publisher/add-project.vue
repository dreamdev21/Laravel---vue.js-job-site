<template>
    <div class="container custom-container">
      <div class="row">
        <h1 class="step-page-title">
          New Project
        </h1>
        <div class="add-project-page">
          <div class="white-box">
            <div class="row">
              <div class="col-12">
                <h4 class="block-subtitle">
                  Project Details
                </h4>
              </div>
            </div>
            <form class="proj-detail-form">
              <div class="row">
                <div class="col-12 col-md-6">
                  <div class="form-group mb-2 custom-form-group">
                    <label class="d-block d-md-inline-block">Project Title :</label>
                    <input type="text" class="form-control custom-form-control d-block d-md-inline-block" placeholder="Enter Project Title">
                  </div>
                  <div class="form-group mb-2 custom-form-group">
                    <label class="d-block d-md-inline-block">Type :</label>
                    <input type="text" class="form-control custom-form-control d-block d-md-inline-block" placeholder="Enter Project Title">
                  </div>
                  <div class="form-group mb-2 custom-form-group">
                    <label class="d-block d-md-inline-block">Start Date :</label>
                    <input type="text" class="form-control custom-form-control d-block d-md-inline-block" placeholder="mm/dd/yyyy">
                  </div>
                  <div class="form-group mb-2 custom-form-group">
                    <label class="d-block d-md-inline-block">End Date :</label>
                    <input type="text" class="form-control custom-form-control d-block d-md-inline-block" placeholder="mm/dd/yyyy">
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="form-group mb-2">
                    <span class="text-bold">Time Needed to Test : </span>
                      <input type="text" class="form-control custom-form-control d-block d-md-inline-block" placeholder="--:--:--">
                  </div>
                  <div class="form-group mb-2">
                      <label class="d-block d-md-inline-block">Tester Needed :</label>
                      <input type="text" class="form-control custom-form-control d-block d-md-inline-block" placeholder="">
                  </div>
                  <div class="form-group">
                    <label class="d-block d-md-inline-block">
                        Devices to test on :
                    </label>
                    <div class="test-devices-wrap d-block d-md-inline-block">
                      <img class="img-fluid d-inline-block mr-3 mb-3" src="~img/test-device-1.png"/>
                      <img class="img-fluid d-inline-block mr-3 mb-3" src="~img/test-device-2.png"/>
                      <img class="img-fluid d-inline-block mr-3 mb-3" src="~img/test-device-3.png"/>
                      <img class="img-fluid d-inline-block mr-3 mb-3" src="~img/test-device-4.png"/>
                      <img class="img-fluid d-inline-block mr-3 mb-3" src="~img/test-device-5.png"/>
                      <img class="img-fluid d-inline-block mr-3" src="~img/test-device-6.png"/>
                      <img class="img-fluid d-inline-block mr-3" src="~img/test-device-7.png"/>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</template>

<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";

.custom-container{
  max-width: 100%;
  .text-blue{
    color: #0082cc;
  }
  .text-red{
    color: #e63423;
  }
  .text-green{
    color: #2cac3d;
  }
  .text-bold{
    font-family: $font-family-brandon-bold;
  }
  .step-page-title{
    font-family: $font-family-UniNeue-bold;
    font-size : 30px;
    width: 100%;
    text-align: center;
    color: #363e48;
    margin: 5px 0 25px;
  }
  .add-project-page{
    width: 100%;
    .white-box{
      background-color: #fff;
      box-shadow: 0px 0px 3px 2px rgba(3, 3, 3, 0.05);
      border-radius: 4px;
      padding: 20px;
      margin-bottom: 20px;
      font-size: 17px;
      color: #606368;
      .block-title{
        font-size: 20px;
        font-family: $font-family-UniNeue-bold;
        border-bottom: 1px solid #dadada;
        color: #0082cc;
        padding-bottom: 10px;
        margin-bottom: 10px;
        width: auto;
        min-height:35px;
        a{
          font-family: $font-family-brandon-medium;
          font-size: 17px;
          text-decoration: underline !important;
          float: right;
        }
      }
      .block-subtitle{
        font-family: $font-family-brandon-bold;
        font-size: 20px;
        color: #0082cc;
        border-bottom: 1px solid #dadada;
        padding-bottom: 10px;
        margin-bottom: 15px;
      }
      .proj-detail-form{
        label{
          min-width: 200px;
          font-size: 17px;
          vertical-align: middle;
        }
        .custom-form-control{
          width: calc(100% - 205px);
          vertical-align:middle;
          margin-bottom: 15px;
          font-size: 17px;
        }
        .test-devices-wrap{
          width: calc(100% - 205px);
          vertical-align:top;
        }
      }
    }
    .blue-step-btn{
      width: 100%;
      padding: 2px 4px;
      border:2px solid #0082cc;
      background-color: #00aff5;
      font-size: 14px;
      font-family: $font-family-brandon-medium;
      letter-spacing: 0.05rem;
      color: #fff;
      border-radius: 20px;
      display: block;
      text-align: center;
      &:hover{
        background-color: #13b9fb;
      }
    }
    .post-btn{
      padding: 7px 10px;
    }
  }
}
@media screen and(max-width:1281px) {
  .custom-container{
    .add-project-page{
      .white-box{
        font-size: 16px;
      }
      .blue-step-btn{
        font-size: 13px;
      }
    }
  }
}
@media screen and(max-width:1200px) {
  .custom-container{
    .page-title{
      font-size: 28px;
      margin: 0 0 20px;
    }
    .add-project-page{
      .blue-step-btn{
        font-size: 12px;
        letter-spacing: 0;
      }
      .white-box{
        font-size: 14px;
        .block-title{
          font-size: 18px;
        }
      }
    }
  }
}
@media screen and(max-width:991px) {
  .custom-container{
    .add-project-page{
      .white-box{
        padding: 15px;
      }
    }
  }
}
@media screen and(max-width:767px) {
 .custom-container{
    .add-project-page{
      .status-bar{
        font-size: 14px;
      }
      .white-box{
      }
    }
 }
}
@media screen and(max-width:575px) {
  .custom-container{
    .page-title{
      font-size: 26px;
    }
    .add-project-page{
      .blue-step-btn{
          max-width: 180px;
          margin: 15px 0 0;
      }
      .white-box{
        font-size: 14px;
        line-height: 18px;
      }
    }
  }
}
</style>