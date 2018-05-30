<template>
  <div class="bg-color">
    <div class="container custom-container">
      <div class="row">
        <div class="test-proj-fillup-page">
          <div class="white-box">
            <div class="row">
              <div class="col-12">
                <h4 class="block-title border-bottom-0">
                  Project Status
                </h4>
              </div>
              <div class="col-12">
                <div class="row">
                  <div class="col-2 text-center proj-status active">
                    <p class="proj-progress">
                      <i class="fa fa-circle-thin"></i>
                    </p>
                    <span class="d-none d-md-block text-medium">New</span>
                  </div>
                  <div class="col-2 text-center proj-status">
                    <p class="proj-progress">
                      <i class="fa fa-circle-thin"></i>
                    </p>
                    <span class="d-none d-md-block text-medium">Accepted/Working</span>
                  </div>
                  <div class="col-2 text-center proj-status">
                    <p class="proj-progress">
                      <i class="fa fa-circle-thin"></i>
                    </p>
                    <span class="d-none d-md-block text-medium">Submitted</span>
                  </div>
                  <div class="col-2 text-center proj-status">
                    <p class="proj-progress">
                      <i class="fa fa-circle-thin"></i>
                    </p>
                    <span class="d-none d-md-block text-medium"> Under Review</span>
                  </div>
                  <div class="col-2 text-center proj-status">
                    <p class="proj-progress">
                      <i class="fa fa-circle-thin"></i>
                    </p>
                    <span class="d-none d-md-block text-medium">Completed</span>
                  </div>
                  <div class="col-2 text-center proj-status">
                    <p class="proj-progress">
                      <i class="fa fa-circle-thin"></i>
                    </p>
                    <span class="d-none d-md-block text-medium"> Paid</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="white-box">
            <div class="row">
              <div class="col-12">
                <h4 class="text-bold block-title proj-name-wrap">
                  <span class="proj-name">Test</span>
                  <span class="badge-wrap text-right">
                    <span class="status-badge">
                      Status:Open Spot(Unlimited Candidates)
                    </span>
                  </span>
                </h4>
              </div>
              <div class="col-12 col-sm-6 col-xl-3">
                <p class="mb-1 mt-2 mt-sm-0">
                  <span class="text-bold">Devices :</span>
                  <span class="">The Beta Plan</span>
                </p>
                <p class="mb-xl-5 mb-3 mt-2 mt-sm-0">
                  <span class="text-bold">Type :</span>
                  <span class="">Games</span>
                </p>
              </div>
              <div class="col-12 col-sm-6 col-xl-3">
                <p class="mb-1 mt-2 mt-sm-0">
                  <span class="text-bold">Start Date : </span>
                  <span>10 January, 2018</span>
                </p>
                <p class="mb-xl-5 mb-3 mt-2 mt-sm-0">
                  <span class="text-bold">End Date : </span>
                  <span>15 January, 2018</span>
                </p>
              </div>
              <div class="col-12 col-xl-6 text-xl-right text-left">
                <p class="mb-xl-5 mb-3 mt-2 mt-sm-0">
                  <span class="text-bold">Time Needed to Test : </span>
                  <span class="d-block">1 hr 15 Minutes</span>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <h4 class="text-bold block-title">Project Description
                </h4>
              </div>
              <div class="col-12">
                <p class="proj-desc">
                  The project description goes here, and this project will have a number of testers, testing based on usability, bug detection and overall fun factor. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the...
                </p>
                <a href="#" class="view-more-link mb-xl-5 mb-md-3 md-1 w-100 float-right">
                  View More
                </a>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-md-6">
                <h4 class="block-title text-bold">Notes/Instruction</h4>
                <p class="mb-1">Notes and Instruction goes here...</p>
                <ul class="notes-list">
                  <li>point one</li>
                  <li>point two</li>
                </ul>
              </div>
              <div class="col-12 col-md-6">
                <h4 class="block-title text-bold">Required Devices</h4>
                <p class="test-device-list">
                  <span class="d-inline-block">
                    <img src="~img/test-device-1.png" class="img-fluid"/>
                  </span>
                  <span class="d-inline-block">
                    <img src="~img/test-device-2.png" class="img-fluid"/>
                  </span>
                  <span class="d-inline-block">
                    <img src="~img/test-device-3.png" class="img-fluid"/>
                  </span>
                  <span class="d-inline-block">
                    <img src="~img/test-device-4.png" class="img-fluid"/>
                  </span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-12 text-center">
            <a href="#" class="btn text-uppercase green-step-btn">start working / accept</a>
            <a href="#" class="btn text-uppercase green-step-btn">Back To Dashboard</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
    export default {
        name: "project-fillup"
    }
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";

.custom-container{
  max-width: 100%;
  .text-green{
    color: #2cac3d;
  }
  .text-red{
    color: #e63423;
  }
  .text-bold{
    font-family: $font-family-brandon-bold !important;
  }
  .text-medium{
    font-family: $font-family-brandon-medium;
  }
  .test-proj-fillup-page{
    width: 100%;
    .white-box{
      background-color: #fff;
      box-shadow: 0px 0px 3px 2px rgba(3, 3, 3, 0.05);
      border-radius: 4px;
      padding: 20px;
      margin-bottom: 20px;
      font-size: 17px;
      line-height: 22px;
      color: #606368;
      .block-title{
        font-size: 20px;
        font-family: $font-family-UniNeue-bold;
        border-bottom: 1px solid #dadada;
        color: #2cac3d;
        padding-bottom: 10px;
        margin-bottom: 10px;
        width: auto;
        .badge-wrap{
          border: 1px solid #2cac3d;
          background-color: #2cac3d;
          color: #fff;
          font-size: 16px;
          right: -5px;
          position: absolute;
          border-top-left-radius: 16px;
          border-bottom-left-radius: 16px;
          padding: 2px 12px;
          top: -5px;
          font-family: $font-family-brandon-regular;
        }
      }
      .proj-status{
        padding: 0;
        padding-top: 8px;
        overflow: hidden;
        &:first-child{
          .proj-progress{
            &::before{
              width: calc(50% - 30px);
              left: 15px;
            }
          }
        }
        &:last-child{
          .proj-progress{
            &::after{
              width: calc(50% - 30px);
              right: 15px;
            }
          }
        }
        .proj-progress{
          position: relative;
          margin-bottom: 5px;
          i{
            color:rgba(175, 177, 179, 0.5);
            font-size: 22px;
            line-height: 24px;
          }
          &::before{
            content: "";
            position: absolute;
            height: 3px;
            width:calc(50% - 5px);
            background-color: #ececec;
            left: -10px;
            top: 11px;
          }
          &::after{
            content: "";
            position: absolute;
            height: 3px;
            width: calc(50% - 5px);
            background-color: #ececec;
            right: -10px;
            top: 11px;
          }
        }
      }
      .proj-status.active{
        color: #2cac3d;
        .proj-progress{
          i{
            color: #2cac3d;
            font-size: 34px;
            line-height: 24px;
            position: relative;
            &::after{
              height: 15px;
              width: 15px;
              background-color: #2cac3d;
              content: "";
              border-radius:50%;
              position: absolute;
              left: 7px;
              top: 4px;
            }
          }
          &::before{
            background-color: #2cac3d;
          }
        }
      }
      .proj-desc{
        letter-spacing: 0.01rem;
        margin-bottom: 5px;
      }
      .notes-list{
        padding-left: 15px;
        margin-bottom: 0px;
        li{
          position: relative;
          &::before{
            content: "-";
            position: absolute;
            left: -15px;
            top: -1px;
            color: #606368;
            font-size: 20px;
          }
        }
      }
      .view-more-link{
        font-size: 15px;
        font-family: $font-family-brandon-medium;
        color: #2cac3d;
        text-decoration: underline !important;
        text-align: right;
      }
      .test-device-list{
        span{
          margin-right: 15px;
          margin-top: 10px;
        }
      }
    }
    .green-step-btn{
      width: 100%;
      max-width: 240px;
      padding: 7px 10px;
      border:2px solid #118921;
      background-color: #2cac3d;
      font-size: 14px;
      font-family: $font-family-brandon-medium;
      letter-spacing: 0.05rem;
      color: #fff;
      border-radius: 20px;
      display: inline-block;
      text-align: center;
      margin: 10px 15px 30px 0px;
      &:hover{
        background-color: #158f25;
      }
    }
  }
}
@media screen and(max-width:1281px) {
  .custom-container{
    .test-proj-fillup-page{
      .white-box{
        font-size: 16px;
      }
      .green-step-btn{
        font-size: 13px;
      }
    }
  }
}
@media screen and(max-width:1200px) {
  .custom-container{
    .test-proj-fillup-page{
      .green-step-btn{
        font-size: 12px;
        letter-spacing: 0;
      }
      .white-box{
        font-size: 14px;
        .block-title{
          font-size: 18px;
          .badge-wrap{
            font-size: 15px;
          }
        }
      }
    }
  }
}
@media screen and(max-width:991px) {
  .custom-container{
    .test-proj-fillup-page{
      .white-box{
        padding: 15px;
        .block-title{
          .badge-wrap{
            right: 0;
          }
        }
      }
    }
  }
}

@media screen and(max-width:767px) {
 .custom-container{
    .test-proj-fillup-page{
      .status-bar{
        font-size: 14px;
      }
      .green-step-btn{
        margin: 10px 15px 10px 0;
        max-width: 175px;
      }
      .white-box{
        .block-title{
          .badge-wrap{
            right: 0;
            top: -3px;
          }
        }
        .notes-list{
          margin-bottom: 15px;
        }
        .proj-status.active{
          span{
            display: block !important;
          }
        }
      }
    }
 }
}
@media screen and(max-width:575px) {
  .custom-container{
    .step-page-title{
      font-size: 26px;
    }
    .test-proj-fillup-page{
      .white-box{
        font-size: 14px;
        line-height: 18px;
        .block-title.proj-name-wrap{
          padding-bottom: 35px;
          .proj-name{
            display: block;
            width: 100%;
          }
          .badge-wrap{
            position: relative;
            float: right;
            margin-right: -15px;
            margin-top: 10px;
            font-size: 13px;
          }
        }
        .proj-status{
          &:first-child{
            .proj-progress{
              &::before{
                width: calc(50% - 25px);
              }
            }
          }
          &:last-child{
            .proj-progress{
              &::after{
                width: calc(50% - 25px);
              }
            }
          }
        }
        .proj-status.active{
          .proj-progress{
            i{
              font-size:28px;
              &::after{
                height: 13px;
                width: 13px;
                left: 6px;
                top: 5px;
              }
            }
          }
        }
      }
    }
    
  }
}

</style>