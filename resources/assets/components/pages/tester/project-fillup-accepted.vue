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
                  <div class="col-2 text-center proj-status done-step">
                    <p class="proj-progress">
                      <i class="fa fa-circle-thin"></i>
                    </p>
                    <span class="d-none d-md-block text-medium">New</span>
                  </div>
                  <div class="col-2 text-center proj-status active">
                    <p class="proj-progress">
                      <i class="fa fa-circle-thin"></i>
                    </p>
                    <span class="d-none d-md-block text-medium">Accepted/<br>Working</span>
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
                  <device-selector disabled v-model="testProject.selected_devices"></device-selector>
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
              <div class="col-12 col-md-6 mb-2 mt-2 mt-sm-0">
                <h4 class="block-title text-bold">Links Of App</h4>
                <p>
                  <span class="text-bold app-title">Title :</span>
                  <span class="app-link">thebetaplan.com</span>
                </p>
                <p>
                  <span class="text-bold app-title">Title :</span>
                  <span class="app-link">thebetaplan.com</span>
                </p>
                <p>
                  <span class="text-bold app-title">Title :</span>
                  <span class="app-link">thebetaplan.com</span>
                </p>
              </div>
              <div class="col-12 col-md-6 mb-2 mt-2 mt-sm-0">
                <h4 class="block-title text-bold">Upload App</h4>
                <p>
                  <span class="text-bold">The Beta Plan</span>
                </p>
                <p>
                  <span class="text-bold">The Beta Plan</span>
                </p>
                <p>
                  <span class="text-bold">The Beta Plan</span>
                </p>
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
          <div class="white-box">
            <div class="row">
              <div class="col-12">
                <h4 class="block-title">
                  Testing Process
                </h4>
              </div>
            </div>
            <div class="row">
             <div class="col-12">
                <div class="testing-process-tabwrap">
                  <b-tabs>
                    <b-tab title="Questions" class="active-tab" active>
                      <div class="tester-questions-tab">
                        <div class="row">
                          <div class="col-12 col-md-5">
                            <p class="mb-sm-1">
                              <span class="text-medium">Q1.</span>
                              Did you like the ambient sounds?
                            </p>
                          </div>
                          <div class="col-12 col-md-7">
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder=""/>
                            </div>
                          </div>
                          <div class="col-12 col-md-5">
                            <p class="mb-sm-1">
                              <span class="text-medium">Q2.</span>
                              Were you able to access all areas?
                            </p>
                          </div>
                          <div class="col-12 col-md-7">
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder=""/>
                            </div>
                          </div>
                          <div class="col-12 col-md-5">
                            <p class="mb-sm-1">
                              <span class="text-medium">Q3.</span>
                              Are there changes you would like to see?
                            </p>
                          </div>
                          <div class="col-12 col-md-7">
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder=""/>
                            </div>
                          </div>
                          <div class="col-12 col-md-5">
                            <p class="mb-sm-1">
                              <span class="text-medium">Q4.</span>
                              Would you pay for this app? How much?
                            </p>
                          </div>
                          <div class="col-12 col-md-7">
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder=""/>
                            </div>
                          </div>
                          <div class="col-12 col-md-5">
                            <p class="mb-sm-1">
                              <span class="text-medium">Q5.</span>
                              Would you refer to your friends as it is today?
                            </p>
                          </div>
                          <div class="col-12 col-md-7">
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder=""/>
                            </div>
                          </div>
                        </div>
                      </div>
                    </b-tab>
                    <b-tab title="Ratings/Scores">
                      <div class="tester-rating-tab">
                        <h4 class="total-score-txt">
                          Total Score: 79
                          <span class="effective-badge">Effective</span>
                        </h4>
                        <div role="tablist">
                          <b-card no-body class="mb-3 mb-sm-4 custom-accordion">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                              <b-btn block href="#" v-b-toggle.accordion1>
                                content
                                <span class="text-right">
                                  Total Score : 00
                                </span>
                              </b-btn>
                            </b-card-header>
                            <b-collapse id="accordion1" visible accordion="my-accordion" role="tabpanel">
                              <b-card-body>
                               <starRatings></starRatings>
                              </b-card-body>
                            </b-collapse>
                          </b-card>
                          <b-card no-body class="mb-3 mb-sm-4 custom-accordion">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                              <b-btn block href="#" v-b-toggle.accordion2>
                                <!-- <img src="~img/right-arrow.png" class="img-fluid mr-1"/> -->
                                Gameplay
                                <span class="text-right">
                                  Total Score : 00
                                </span>
                              </b-btn>

                            </b-card-header>
                            <b-collapse id="accordion2" accordion="my-accordion" role="tabpanel">
                              <b-card-body>
                                <starRatings></starRatings>
                              </b-card-body>
                            </b-collapse>
                          </b-card>
                          <b-card no-body class="mb-3 mb-sm-4 custom-accordion">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                              <b-btn block href="#" v-b-toggle.accordion3>
                                <!-- <img src="~img/right-arrow.png" class="img-fluid mr-1"/> -->
                                multimedia
                                <span class="text-right">
                                  Total Score : 00
                                </span>
                              </b-btn>
                            </b-card-header>
                            <b-collapse id="accordion3" accordion="my-accordion" role="tabpanel">
                              <b-card-body>
                                <starRatings></starRatings>
                              </b-card-body>
                            </b-collapse>
                          </b-card>
                        </div>
                        <h4 class="total-score-txt mb-0">
                          Total Score: 79
                          <span class="effective-badge">Effective</span>
                        </h4>
                      </div>
                    </b-tab>
                    <b-tab title="Issues">
                      <div class="tester-issues-tab">
                        <div class="issue-block">
                          <div class="row">
                            <div class="col-12">
                              <p class="text-bold text-green issue-type">Black Widow -  High type bug:</p>
                              <p>The issue(s) is critical / deadly to the app usability and must be dealt with immediately.</p>
                            </div>
                            <div class="col-12">
                              <div class="form-group mb-3 mb-md-5">
                                <div class="issue-link" v-for="cnt in cnt1">
                                  <div class="row">
                                    <div class="col-10 col-md-11">
                                      <input type="text" class="form-control custom-form-control" placeholder=""/>
                                    </div>

                                    <div class="col-2 col-md-1" v-if="cnt == cnt1" >
                                      <a data-bug-type="high"  href="#" class="remove-icon" v-on:click="addField">
                                        <i class="fa fa-plus-circle"></i>
                                      </a>
                                    </div>
                                    <div class="col-2 col-md-1" v-else >
                                      <a data-bug-type="high" href="#" class="remove-icon" v-on:click="removeField">
                                        <i class="fa fa-minus-circle"></i>
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="issue-block">
                          <div class="row">
                            <div class="col-12">
                              <p class="text-bold text-green issue-type">Wasp -  Medium type bug:</p>
                              <p>The issue(s) affects the flow / enjoyment of the app but can wait until the next update to be solved.</p>
                            </div>
                            <div class="col-12">
                              <div class="form-group mb-3 mb-md-5">
                                <div class="issue-link" v-for="cnt in cnt2">
                                  <div class="row">
                                    <div class="col-10 col-md-11">
                                      <input type="text" class="form-control custom-form-control" placeholder=""/>
                                    </div>

                                    <div class="col-2 col-md-1" v-if="cnt == cnt2" >
                                      <a data-bug-type="medium"  href="#" class="remove-icon" v-on:click="addField">
                                        <i class="fa fa-plus-circle"></i>
                                      </a>
                                    </div>
                                    <div class="col-2 col-md-1" v-else >
                                      <a data-bug-type="medium" href="#" class="remove-icon" v-on:click="removeField">
                                        <i class="fa fa-minus-circle"></i>
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="issue-block">
                          <div class="row">
                            <div class="col-12">
                              <p class="text-bold text-green issue-type">Gnat - Low type bug:</p>
                              <p>The issue(s) is annoying but not critical to app function or flow..</p>
                            </div>
                            <div class="col-12">
                              <div class="form-group mb-2">
                                <div class="issue-link">
                                  <div class="row">
                                    <div class="col-10 col-md-11">
                                      <input type="text" class="form-control" placeholder=""/>
                                    </div>
                                    <div class="col-2 col-md-1">
                                      <a href="#" class="remove-icon" v-on:click="addField">
                                        <i class="fa fa-plus-circle"></i>
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <hr class="line-seprator">
                        <div class="issue-block">
                          <div class="row">
                            <div class="col-12">
                              <p class="text-bold text-green issue-type">Did you find any cosmetic issue?</p>
                            </div>
                            <div class="col-12">
                              <div class="form-group mb-3 mb-md-5">
                                <div class="issue-link">
                                  <div class="row">
                                    <div class="col-10 col-md-11">
                                      <input type="text" class="form-control" placeholder=""/>
                                    </div>
                                    <div class="col-2 col-md-1">
                                      <a href="#" class="remove-icon">
                                        <i class="fa fa-plus-circle"></i>
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="issue-block">
                          <div class="row">
                            <div class="col-12">
                              <p class="text-bold text-green issue-type">Did you find any other issues you would like to mention?</p>
                            </div>
                            <div class="col-12">
                              <div class="form-group">
                                <div class="issue-link">
                                  <div class="row">
                                    <div class="col-10 col-md-11">
                                      <input type="text" class="form-control mb-0" placeholder=""/>
                                    </div>
                                    <div class="col-2 col-md-1">
                                      <a href="#" class="remove-icon">
                                        <i class="fa fa-plus-circle"></i>
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </b-tab>
                    <b-tab title="Attachment">
                      <div class="tester-attachment-tab">
                        <div class="row">
                          <div class="col-12">
                           <div class="text-uppercase green-step-btn add-files-btn">
                              <span>
                                Add Files
                              </span>
                              <input type="file" class="btn" />
                           </div>
                          </div>
                        </div>
                        <div class="attachment-table-wrap">
                          <div class="row">
                            <div class="col-12">
                              <div class="table-responsive">
                                <table class="table table-bordered attachment-table">
                                  <tbody>
                                    <tr>
                                      <td scope="row">
                                        <img src="~img/mp4-icon.png" class="img-fluid" />
                                      </td>
                                      <td class=" text-medium">File Name.mp4</td>
                                      <td>236 MB</td>
                                      <td class="text-center">
                                        <a href="#" class="d-inline-block"><i class="fa fa-eye"></i></a>
                                        <a href="#" class="d-inline-block"><i class="fa fa-trash"></i></a>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td scope="row">
                                          <img src="~img/pdf-icon.png" class="img-fluid" />
                                      </td>
                                      <td class="text-medium">File Name_2.pdf</td>
                                      <td>112 KB</td>
                                      <td class="text-center">
                                        <a href="#" class="d-inline-block"><i class="fa fa-eye"></i></a>
                                        <a href="#" class="d-inline-block"><i class="fa fa-trash"></i></a>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td scope="row">
                                        <img src="~img/png-icon.png" class="img-fluid" />
                                      </td>
                                      <td class="text-medium">File Name_3.png</td>
                                      <td>1.25 MB</td>
                                      <td class="text-center">
                                        <a href="#" class="d-inline-block"><i class="fa fa-eye"></i></a>
                                        <a href="#" class="d-inline-block"><i class="fa fa-trash"></i></a>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td scope="row">
                                        <img src="~img/jpg-icon.png" class="img-fluid" />
                                      </td>
                                      <td class="text-medium">File Name_4.jpg</td>
                                      <td>1.25 MB</td>
                                      <td class="text-center">
                                        <a href="#" class="d-inline-block"><i class="fa fa-eye"></i></a>
                                        <a href="#" class="d-inline-block"><i class="fa fa-trash"></i></a>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </b-tab>
                  </b-tabs>
                </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    <div class="col-12 text-center">
      <a href="#" class="btn text-uppercase green-step-btn">review and submit</a>
      <a href="#" class="btn text-uppercase green-step-btn">save as draft</a>
    </div>
  </div>
</div>
</template>
<script>
import Vue from "vue";
import starRatings from "components/components/project/rating.vue";

export default {
  name: "project-fillup-accepted",
  components: {
    starRatings
  },
  data() {
    return {
      cnt1: 3,
      cnt2: 2,
      cnt3: 1,
      seen: false
    };
  },
  methods: {
    removeField: function(event) {
      event.target.closest(".issue-link").remove();
    },
    addField: function(event) {
      this.cnt1++;
    },
    addexplanation: function(event) {
      console.log(event.target);
    }
  }
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";

.custom-container {
  max-width: 100%;
  .text-green {
    color: #2cac3d;
  }
  .text-red {
    color: #e63423;
  }
  .text-bold {
    font-family: $font-family-brandon-bold !important;
  }
  .text-medium {
    font-family: $font-family-brandon-medium;
  }
  .test-proj-fillup-page {
    width: 100%;
    .white-box {
      background-color: #fff;
      box-shadow: 0px 0px 3px 2px rgba(3, 3, 3, 0.05);
      border-radius: 4px;
      padding: 20px;
      margin-bottom: 20px;
      font-size: 17px;
      line-height: 22px;
      color: #606368;
      .block-title {
        font-size: 20px;
        font-family: $font-family-UniNeue-bold;
        border-bottom: 1px solid #dadada;
        color: #2cac3d;
        padding-bottom: 10px;
        margin-bottom: 10px;
        width: auto;
        .badge-wrap {
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
      .proj-status {
        padding: 0;
        padding-top: 8px;
        overflow: hidden;
        br {
          display: none;
        }
        &:first-child {
          .proj-progress {
            &::before {
              width: calc(50% - 30px);
              left: 15px;
            }
          }
        }
        &:last-child {
          .proj-progress {
            &::after {
              width: calc(50% - 30px);
              right: 15px;
            }
          }
        }
        .proj-progress {
          position: relative;
          margin-bottom: 5px;
          i {
            color: rgba(175, 177, 179, 0.5);
            font-size: 22px;
            line-height: 24px;
          }
          &::before {
            content: "";
            position: absolute;
            height: 3px;
            width: calc(50% - 5px);
            background-color: #ececec;
            left: -10px;
            top: 11px;
          }
          &::after {
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
      .proj-status.active {
        color: #2cac3d;
        .proj-progress {
          i {
            color: #2cac3d;
            font-size: 34px;
            line-height: 24px;
            position: relative;
            &::after {
              height: 15px;
              width: 15px;
              background-color: #2cac3d;
              content: "";
              border-radius: 50%;
              position: absolute;
              left: 7px;
              top: 4px;
            }
          }
          &::before {
            background-color: #2cac3d;
          }
        }
      }
      .proj-status.done-step {
        color: #2cac3d;
        .proj-progress {
          i {
            color: #2cac3d;
            font-size: 34px;
            line-height: 24px;
            position: relative;
            &::after {
              height: 15px;
              width: 15px;
              background-color: #2cac3d;
              content: "";
              border-radius: 50%;
              position: absolute;
              left: 7px;
              top: 4px;
            }
          }
          &::before {
            background-color: #2cac3d;
          }
          &::after {
            background-color: #2cac3d;
          }
        }
      }
      .proj-desc {
        letter-spacing: 0.01rem;
        margin-bottom: 5px;
      }
      .notes-list {
        padding-left: 15px;
        margin-bottom: 0px;
        li {
          position: relative;
          &::before {
            content: "-";
            position: absolute;
            left: -15px;
            top: -1px;
            color: #606368;
            font-size: 20px;
          }
        }
      }
      .view-more-link {
        font-size: 15px;
        font-family: $font-family-brandon-medium;
        color: #2cac3d;
        text-decoration: underline !important;
        text-align: right;
      }
      .app-title {
        min-width: 110px;
        display: inline-block;
      }
      .test-device-list {
        span {
          margin-right: 15px;
          margin-top: 10px;
        }
      }
      .tester-issues-tab {
        .line-seprator {
          margin: 0 0 20px;
        }
        .issue-block {
          .issue-type {
            margin-bottom: 5px;
            font-size: 18px;
          }
          .form-group {
            .form-control {
              margin-bottom: 20px;
            }
            .remove-icon {
              color: #606368;
              i {
                font-size: 34px;
              }
            }
          }
        }
      }
      .tester-attachment-tab {
        .add-files-btn {
          width: 160px;
          float: right;
          margin-top: 0;
          margin-bottom: 20px;
          input {
            opacity: 0;
            position: absolute;
            top: 0;
            right: 0;
          }
        }
        .attachment-table-wrap {
          .attachment-table {
            border-radius: 6px;
            margin-bottom: 0;
            tr {
              td {
                &:first-child {
                  min-width: 60px;
                  max-width: 60px;
                  width: 60px;
                  text-align: center;
                }
                &:last-child {
                  min-width: 130px;
                  max-width: 130px;
                  width: 130px;
                  display: table-cell;
                }
                &:nth-child(3) {
                  min-width: 160px;
                  max-width: 160px;
                  width: 160px;
                  display: table-cell;
                  text-align: center;
                }
                a {
                  margin-right: 10px;
                  color: #1f1f1f;
                  font-size: 20px;
                }
              }
            }
          }
        }
      }
      .tester-rating-tab {
        .total-score-txt {
          font-size: 25px;
          font-family: $font-family-UniNeue-bold;
          color: #363e48;
          text-align: center;
          width: 100%;
          margin-bottom: 25px;
          .effective-badge {
            font-family: $font-family-brandon-regular;
            color: #fff;
            font-size: 12px;
            background-color: #4be05e;
            border: 1px solid #2cac3d;
            border-radius: 16px;
            padding: 1px 8px;
            vertical-align: middle;
            margin-bottom: 5px;
            display: inline-block;
          }
        }
        .custom-accordion {
          border: none;
          &:hover {
            box-shadow: none;
          }
          .card-header {
            padding: 0 !important;
            border-bottom: none;
            &:hover {
              outline: none !important;
            }
            a.collapsed {
              border: 2px solid #118921;
              background-color: #2cac3d;
              color: #fff;
              border-radius: 6px;
              &:before {
                background-image: url("~img/right-arrow.png");
              }
              span {
                color: #fff;
              }
              img {
                display: inline-block;
                vertical-align: initial;
              }
            }
            a {
              padding: 10px 20px !important;
              padding-left: 35px !important;
              border-radius: 0px;
              border-top-right-radius: 6px;
              border-top-left-radius: 6px;
              text-align: left;
              color: #2cac3d;
              font-family: $font-family-UniNeue-heavy;
              font-size: 20px;
              text-align: left;
              text-transform: uppercase;
              background-color: #f2f2f2;
              // border: 1px solid #dadada;
              // border-bottom: none;
              border: none !important;
              &:before {
                background-image: url("~img/down-arrow.png");
                content: "";
                position: absolute;
                left: 15px;
                top: 20px;
                height: 14px;
                width: 14px;
                background-size: 100%;
                background-position: center;
              }
              span {
                float: right;
                font-family: $font-family-brandon-bold;
                font-size: 20px;
                text-transform: none;
                color: #2f2f2f;
              }
            }
          }
          .card-body {
            padding: 0 10px 10px;
            background-color: #f2f2f2;
            border-bottom-left-radius: 6px;
            border-bottom-right-radius: 6px;
            .detail-block-wrap {
              background-color: #fff;
              border: 1px solid #dadada;
              padding: 15px;
              border-radius: 6px;
              h4 {
                font-size: 18px;
                color: #2cac3d;
                font-family: $font-family-brandon-bold;
              }
              .detail-block {
                font-family: $font-family-brandon-medium;
                font-size: 14px;
                line-height: 16px;
                span {
                  width: calc(100% / 3 - 5px);
                  display: inline-block;
                  vertical-align: top;
                }
              }
              .explanation-wrap {
                textarea {
                  resize: none;
                  padding: 0px 10px;
                  font-size: 17px;
                  color: #9c9c9c;
                  &:hover,
                  &:focus {
                    outline: none !important;
                  }
                }
              }
              .ratings-block {
                margin-top: 10px;
                img {
                  width: 100%;
                }
              }
              .green-step-btn-wrap {
                .green-step-btn {
                  margin: 0;
                  margin-top: 30px;
                  font-size: 12px;
                  line-height: 14px;
                  text-transform: uppercase;
                  padding: 4px 8px;
                  cursor: pointer;
                }
              }
            }
          }
        }
      }
    }
  }
  .green-step-btn {
    width: 100%;
    max-width: 180px;
    padding: 7px 10px;
    border: 2px solid #118921;
    background-color: #2cac3d;
    font-size: 14px;
    font-family: $font-family-brandon-medium;
    letter-spacing: 0.05rem;
    color: #fff;
    border-radius: 20px;
    display: inline-block;
    text-align: center;
    margin: 10px 15px 30px 0px;
    &:hover {
      background-color: #158f25;
      color: #fff;
      outline: none !important;
    }
  }
}
@media screen and(max-width:1281px) {
  .custom-container {
    .test-proj-fillup-page {
      .white-box {
        font-size: 16px;
      }
      .green-step-btn {
        font-size: 13px;
      }
    }
  }
}
@media screen and(max-width:1200px) {
  .custom-container {
    .test-proj-fillup-page {
      .green-step-btn {
        font-size: 12px;
        letter-spacing: 0;
      }
      .white-box {
        font-size: 14px;
        .block-title {
          font-size: 18px;
          .badge-wrap {
            font-size: 15px;
          }
        }
      }
    }
  }
}
@media screen and(max-width:991px) {
  .custom-container {
    .test-proj-fillup-page {
      .white-box {
        padding: 15px;
        .block-title {
          .badge-wrap {
            right: 0;
          }
        }
      }
    }
  }
}
@media screen and(max-width:767px) {
  .custom-container {
    .test-proj-fillup-page {
      .status-bar {
        font-size: 14px;
      }
      .green-step-btn {
        margin: 10px 15px 10px 0;
        max-width: 175px;
      }
      .white-box {
        .block-title {
          .badge-wrap {
            right: 0;
            top: -3px;
          }
        }
        .proj-status {
          br {
            display: block;
          }
        }
        .notes-list {
          margin-bottom: 15px;
        }
        .proj-status.active {
          span {
            display: block !important;
          }
        }
        .tester-rating-tab {
          .custom-accordion {
            .card-header {
              a {
                font-size: 18px;
                padding: 10px !important;
                padding-left: 30px !important;
                &::before {
                  top: 18px;
                  left: 10px;
                }
                span {
                  font-size: 18px;
                }
              }
            }
          }
        }
        .tester-issues-tab {
          .issue-block {
            .issue-type {
              font-size: 16px;
            }
            .form-group {
              .remove-icon {
                margin-top: 3px;
                display: block;
                i {
                  font-size: 24px;
                }
              }
            }
          }
        }
        .tester-attachment-tab {
          .add-files-btn {
            float: left;
          }
          .attachment-table-wrap {
            .attachment-table {
              border-radius: 6px;
              tr {
                td {
                  &:nth-child(2) {
                    min-width: 320px;
                  }
                }
              }
            }
          }
        }
      }
    }
  }
}
@media screen and(max-width:575px) {
  .custom-container {
    .step-page-title {
      font-size: 26px;
    }
    .test-proj-fillup-page {
      .white-box {
        font-size: 14px;
        line-height: 18px;
        .block-title.proj-name-wrap {
          padding-bottom: 35px;
          .proj-name {
            display: block;
            width: 100%;
          }
          .badge-wrap {
            position: relative;
            float: right;
            margin-right: -15px;
            margin-top: 10px;
            font-size: 13px;
            display: block;
          }
        }
        .proj-status {
          &:first-child {
            .proj-progress {
              &::before {
                width: calc(50% - 25px);
              }
            }
          }
          &:last-child {
            .proj-progress {
              &::after {
                width: calc(50% - 25px);
              }
            }
          }
        }
        .proj-status.active {
          .proj-progress {
            i {
              font-size: 28px;
              &::after {
                height: 13px;
                width: 13px;
                left: 5px;
                top: 5px;
              }
            }
          }
        }
        .proj-status.done-step {
          .proj-progress {
            i {
              font-size: 28px;
              &::after {
                height: 13px;
                width: 13px;
                left: 5px;
                top: 5px;
              }
            }
          }
        }
        .tester-rating-tab {
          .total-score-txt {
            font-size: 22px;
            margin-bottom: 20px;
          }
          .custom-accordion {
            .card-header {
              a {
                font-size: 16px;
                padding: 5px 10px !important;
                padding-left: 30px !important;
                &::before {
                  top: 12px;
                  left: 10px;
                }
                span {
                  font-size: 16px;
                }
              }
            }
          }
        }
      }
    }
    .green-step-btn {
      margin: 10px 15px 10px 0;
    }
  }
}
@media screen and(max-width:360px) {
  .custom-container {
    .test-proj-fillup-page {
      .white-box {
        .tester-rating-tab {
          .total-score-txt {
            font-size: 18px;
            margin-bottom: 15px;
          }
          .custom-accordion {
            .card-header {
              a {
                font-size: 14px;
                padding-left: 20px !important;
                &::before {
                  top: 12px;
                  left: 8px;
                  height: 10px;
                  width: 10px;
                }
                span {
                  font-size: 14px;
                }
              }
            }
          }
        }
      }
    }
  }
}
</style>