<template>
    <div class="custom-container">
      <div class="row">
        <div class="col-12">
          <h3 class="page-title w-100 text-center mt-2 mb-4">
            Projects
          </h3>
        </div>
      </div>
      <successAlert></successAlert>
      <successAlert></successAlert>
      <div class="row">
        <div class="col-12">
          <div class="mb-4 mt-2 white-box ">
            <div class="d-block d-sm-inline-block align-top sort-by-wrap mr-xl-4 mr-3">
              <div class="form-group custom-form-group">
                <label>Sort By:</label>
                <select multiple class="form-control custom-form-control">
                  <option>Running</option>
                  <option>Pending Approval</option>
                  <option>Completed</option>
                  <option>Unpaid payment projects</option>
                </select>
              </div>
            </div>
            <div class="d-block d-sm-inline-block align-top devices-wrap mr-xl-4 mr-3">
              <div class="form-group custom-form-group">
                <label>Devices:</label>
                <select multiple class="form-control custom-form-control">
                  <option>All Devices</option>
                  <option>Cardboard</option>
                  <option>Daydream</option>
                  <option>Unpaid payment projects</option>
                </select>
              </div>
            </div>
            <div class="d-block d-sm-inline-block align-top input-box-wrap mr-xl-4 mr-3">
              <div class="form-grou custom-form-group">
                <label>Publisher:</label>
                <input type="text" class="form-control custom-form-control" placeholder="Enter Publisher Name">
              </div>
            </div>
            <div class="d-block d-sm-inline-block align-top input-box-wrap mr-xl-4 mr-3">
              <div class="form-group custom-form-group">
                <label>Tester:</label>
                <input type="text" class="form-control custom-form-control" placeholder="Enter Tester Name">
              </div>
            </div>
            <div class="d-block d-sm-inline-block align-top input-box-wrap">
              <div class="form-group custom-form-group">
                <label>Sort By:</label>
                 <select class="form-control custom-form-control" >
                  <option>Recent Activity</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="mb-4 mt-2 white-box ">
            <h4 class="chart-title">
              Running Projects
            </h4>
            <div class="row align-items-center">
              <div class="col-xl-10 col-12">
                <div class="project-block-wrap">
                  <h4 class="proj-title">
                    Tester Name
                  </h4>
                  <div class="row">
                    <div class="col-md-6 col-12 text-left">
                      <p>
                        <span class="text-bold"> Publisher :
                        </span>
                        Publisher_name
                      </p>
                      <p>
                        <span class="text-bold"> Devices :
                        </span>
                        Cardboard, Oculus Rift
                      </p>
                      <p>
                        <span class="text-bold"> Type :
                        </span>
                        AR Apps
                      </p>
                      <p>
                        <span class="text-bold"> Tester Needed :
                        </span>
                        5 (tester1, tester2, tester3,...,<a href="#" class="">more</a>)
                      </p>
                    </div>
                    <div class="col-md-6 col-12 text-md-right text-left">
                      <p class="mt-md-5 mt-sm-3 mt-1">
                        <span class="text-bold"> Registered on:
                        </span>
                        1 January, 2018
                      </p>
                      <p>
                        <span class="text-bold"> Registered on:
                        </span>
                        1 January, 2018
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-2 col-12">
                <a href="#" class="purple-btn view-btn">View Project</a>
              </div>
              <hr>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="mb-4 mt-2 white-box ">
            <h4 class="chart-title">
              Pending Approval Projects
            </h4>
            <div class="row align-items-center">
              <div class="col-xl-10 col-12">
                <div class="project-block-wrap">
                  <h4 class="proj-title">
                    Project Name 1.2
                  </h4>
                  <div class="row">
                    <div class="col-md-4 col-12 text-left">
                      <p>
                        <span class="text-bold"> Publisher :
                        </span>
                        Publisher_name
                      </p>
                      <p>
                        <span class="text-bold"> Devices :
                        </span>
                        Cardboard, Oculus Rift
                      </p>
                      <p>
                        <span class="text-bold"> Type :
                        </span>
                        AR Apps
                      </p>
                      <p>
                        <span class="text-bold"> Tester Needed :
                        </span>
                        6 Testers
                        <!-- 5 (tester1, tester2, tester3,...,<a href="#" class="">more</a>) -->
                      </p>
                    </div>
                    <div class="col-md-4 col-12 text-md-center text-left">
                      <p class="mt-md-5 mt-sm-3 mb-0">
                      <span class="green-badge">
                        Approve
                      </span>
                      </p>
                      <p class="mt-3">
                        <span class="text-bold">
                          Submitted on :
                        </span>
                        2 January,2018
                      </p>
                    </div>
                    <div class="col-md-4  col-12 text-md-right text-left">
                      <p class="mt-md-5 mt-sm-3 mt-1">
                        <span class="text-bold"> Project Total Amount :
                        </span>
                        <span class="proj-amt"> $ 210</span>
                      </p>
                      <p>
                        <span class="text-bold"> Start Date :
                        </span>
                        1 January, 2018
                      </p>
                      <p>
                        <span class="text-bold"> End Date :
                        </span>
                        15 January, 2018
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-2 col-12">
                <a href="#" class="purple-btn view-btn">View</a>
              </div>
              <hr>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="mb-4 mt-2 white-box ">
            <h4 class="chart-title">
              Unpaid Payment Projects
            </h4>
            <div class="row align-items-center">
              <div class="col-xl-10 col-12">
                <div class="project-block-wrap">
                  <h4 class="proj-title">
                    Project 1
                  </h4>
                  <div class="row">
                    <div class="col-md-4 col-12 text-left">
                      <p>
                        <span class="text-bold"> Publisher :
                        </span>
                        Publisher_name
                      </p>
                      <p>
                        <span class="text-bold"> Devices :
                        </span>
                        Cardboard, Oculus Rift
                      </p>
                      <p>
                        <span class="text-bold"> Type :
                        </span>
                        VR Apps
                      </p>
                      <p>
                        <span class="text-bold"> Testers :
                        </span>
                        4
                      </p>
                    </div>
                    <div class="col-md-4 col-12 text-md-center text-left">
                      <p class="mt-md-5 mt-sm-2">
                        <span class="text-bold">
                          Start Date :
                        </span>
                        10 January,2018
                      </p>
                      <p>
                        <span class="text-bold">
                          End Date :
                        </span>
                        15 January,2018
                      </p>
                    </div>
                    <div class="col-md-4 col-12 text-md-right text-left">
                      <p>
                        <span class="border-badge red-outline-badge mr-0 mr-md-3">
                          Unpaid
                        </span>
                        <span class="outline-badge green-outline-badge float-left float-md-none mr-3 mr-md-0">
                          Completed
                        </span>
                      </p>
                      <p class="mt-3 mt-md-0">
                        <span class="text-yellow">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        </span>
                        <span class="text-bold">
                          4.0
                        </span>
                      </p>
                      <p>
                        Completed on 5 January, 2018
                      </p>
                      <p>
                        <span class="text-bold"> Success Level :
                        </span>
                        <span class="text-darkgreen text-bold">Exemplary</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-2 col-12">
                <a href="#" class="purple-btn view-btn">View</a>
              </div>
              <hr>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="mb-4 mt-2 white-box ">
            <h4 class="chart-title">
              Unpaid payments projects
            </h4>
            <div class="row align-items-center">
              <div class="col-xl-10 col-12">
                <div class="project-block-wrap">
                  <h4 class="proj-title">
                    Project Name 1.2
                  </h4>
                  <div class="row">
                    <div class="col-md-4 col-12 text-left">
                      <p>
                        <span class="text-bold"> Publisher :
                        </span>
                        Publisher_name
                      </p>
                      <p>
                        <span class="text-bold"> Devices :
                        </span>
                        Oculus Rift , HTC Vive
                      </p>
                      <p>
                        <span class="text-bold"> Type :
                        </span>
                        AR Apps
                      </p>
                      <p>
                        <span class="text-bold"> Tester Needed :
                        </span>
                        6 Testers
                      </p>
                    </div>
                    <div class="col-md-4 col-12 text-md-center text-left">
                      <p class="mt-md-5 mt-sm-3 mb-0">
                        <span class="text-bold">
                          Approved on :
                        </span>
                        10 January,2018
                      </p>
                    </div>
                    <div class="col-md-4  col-12 text-md-right text-left">
                      <p class="mt-3 mt-sm-0">
                        <span class="outline-badge orange-outline-badge">
                          Unpaid
                        </span>
                      </p>
                      <p class="">
                        <span class="text-bold"> Project Total Amount :
                        </span>
                        <span class="proj-amt"> $ 210</span>
                      </p>
                      <p>
                        <span class="text-bold"> Test Started on :
                        </span>
                        3 January, 2018
                      </p>
                      <p>
                        <span class="text-bold"> Test Started on :
                        </span>
                        3 January, 2018
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-2 col-12">
                <a href="#" class="purple-btn view-btn">View Profile</a>
              </div>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
    import Vue from 'vue';
    import successAlert from 'components/pages/admin-success-alert.vue';

    export default {
        name: "Dashboard",
        components:{
          successAlert
        },
         data() {
          return{
            visible : false
          }
        }
    }
</script>
<!-- styles -->
<!-- adding scoped attribute will apply the css to this component only -->

<style lang="scss" scoped>
@import "../layouts/css/customvariables";

    .custom-container{
      max-width: 100%;
      margin: 0 auto;
    }
    .page-title{
      font-size: 30px;
      color: #363e48; 
      font-family: $font-family-UniNeue-bold;
    }
    .text-green{
      color: #02c505;
    }
    .text-darkgreen{
      color: #2cac3d;
    }
    .white-box{
      font-size: 15px;
      padding: 15px;
      letter-spacing: 0 !important;
      .chart-title{
        text-align: left;
        font-size: 20px;
        color: #3e3a94;
        border-bottom: 1px solid #dadada;
        padding-bottom: 15px;
        font-family: $font-family-UniNeue-bold;
        margin-bottom: 15px;
      }
       hr{
        display: block;
        width: 97%;
        border-color: #dadada;
      }
      .project-block-wrap{
        margin-top: 5px;
        font-family: $font-family-brandon-regular;
        font-size: 14px;
        color: #606368;
        position: relative;
        &::after{
          content: "";
          position: absolute;
          right: -15px;
          top: 0;
          height: 100%;
          width: 1px;
          background-color: #dadada;
        }
        p{
          margin-bottom: 5px;
        }
        a{
          color: #14c1bf;
          text-decoration: underline !important;
        }
        .proj-title{
          font-family: $font-family-brandon-bold;
          font-size: 16px;
          text-transform: uppercase;
          color: #363e48;
          margin-bottom: 10px;
        }
        .green-badge{
          background-color: #2cac3d;
          border: 2px solid #118921;
          padding: 0 10px 3px;;
          border-radius: 16px;
          color: #fff;
          font-size: 15px;
        }
        .grey-badge{
          background-color: #898a8c;
          border: 2px solid #606368;
          padding: 0 10px 3px;;
          border-radius: 16px;
          color: #fff;
          font-size: 15px;
        }
        .grey-outline-badge{
          color: #878888;
          border: 1px solid #989898;
        }
        .green-outline-badge{
          color: #2cac3d;
          border: 1px solid #2cac3d;
        }
        .red-outline-badge{
          color: #e80000;
          border: 1px solid #e80000;
        }
        .orange-outline-badge{
          color: #ff7802;
          border: 1px solid #ff7802;
        }
        .outline-badge{
          padding: 2px 0px 2px 15px;
          border-top-left-radius: 16px;
          border-bottom-left-radius: 16px;
          font-family: $font-family-brandon-bold;
          border-right: none;
          font-size: 15px;
        }
        .border-badge{
          padding: 2px 12px;
          border-radius: 16px;
          font-family: $font-family-brandon-medium;
          font-size: 15px;
          text-align: center;
        }
        .proj-amt{
          font-size: 20px;
          font-family: $font-family-brandon-black;
        }
      }
      .view-btn{
        width: 100%;
        display: block;
        text-align: center;
      }
      .custom-form-group{
        color: #606368;
        margin-bottom: 0;
       label{
         font-size: 17px;
         letter-spacing: 0;
         margin-bottom: 10px;
       }
       .custom-form-control{
         font-size: 16px;
         padding: 0;
         max-height: 100px;
         border-radius: 6px;
         &:hover{
           outline: none !important;
         }
         &:focus{
           outline: none !important;
         }
         option{
           padding: 4px 8px;
         }
         select:-internal-list-box option:checked {
           background-color: #d8d8ea;
         }
        }
        input.custom-form-control{
          padding: 4px;
        }
      }
      .sort-by-wrap{
        min-width: 310px;
        max-width: 310px;
      }
      .devices-wrap{
        max-width: 130px;
      }
      .input-box-wrap{
        min-width: 160px;
        max-width: 160px;
      }
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
@media screen and(max-width:1199px) {
  .white-box{
    .project-block-wrap{
      &::after{
        display: none;
      }
    }
    .view-btn{
      padding: 5px 20px;
      max-width: 150px;
      float: right;
      margin: 20px 0 10px;
    }
    .view-profile-btn{
      margin: 20px 0 10px;
      text-align: center;
      max-width: 145px;
      padding: 7px 11px;
      float: right;
    }
    .sort-by-wrap{
      min-width: auto;
      max-width: 100%;
      width: calc(100% / 5 - 15px);
    }
    .devices-wrap{
      min-width: auto;
      max-width: 100%;
      width: calc(100% / 5 - 15px);
    }
    .input-box-wrap{
      min-width: auto;
      max-width: 100%;
      width: calc(100% / 5 - 15px);
    }
  }
}
@media screen and(max-width:1112px) {
  .white-box{
    .chart-title{
      font-size: 18px;
      padding-bottom: 10px;
      margin-bottom: 10px;
    }
    .project-block-wrap{
      margin-top: 10px;
      .proj-title{
        margin-bottom: 5px;
      }
    }
    .view-btn{
      margin: 10px 0 5px;
    }
    hr{
      margin-bottom: 0;
    }
  }
}
@media screen and(max-width:1024px) {
  .page-title{
    margin-top: 0 !important;
  }
  .sucess-alertwrap{
    font-size: 16px;
    .close{
      font-size: 30px;
    }
  }
  .white-box{
    padding: 15px;
    .view-profile-btn{
      margin: 10px 0;
    }
  }
}
@media screen and(max-width:767px) {
  .white-box{
    .view-btn{
      float: left;
    }
    .view-profile-btn{
      float: left;
    }
    .project-block-wrap{
      .outline-badge{
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        border-top-right-radius: 16px;
        border-bottom-right-radius: 16px;
        border-left: 0;
        border-right: 1px solid;
        padding: 0px 15px 2px 5px;
      }
    }
    .sort-by-wrap,
    .devices-wrap,
    .input-box-wrap{
      width: 100%;
      margin-bottom: 15px;
    }
  }
}
@media screen and(max-width:576px) {
  .sucess-alertwrap{
    font-size: 15px;
  }
}
</style>
