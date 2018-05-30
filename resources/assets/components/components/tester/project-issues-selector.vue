<template>
  <div class="">
    <div class="issue-block" v-for="typeOfIssue in typesOfIssues">
      <div class="row">
        <div class="col-12">
          <p class="text-bold text-green issue-type">{{ typeOfIssue.title }}</p>
          <p>{{ typeOfIssue.description }}</p>
        </div>
        <div class="col-12">
          <div class="form-group mb-3 mb-md-5">
            <div class="issue-link" v-for="cnt in typeOfIssue.total">
              <div class="row">
                <div class="col-10 col-md-11">
                  <input type="text" v-on:change="bugInput" :v-model="`${typeOfIssue.input_name}[${cnt}]`" class="form-control custom-form-control" placeholder=""/>
                </div>

                <div class="col-2 col-md-1" v-if="cnt == typeOfIssue.total" >
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
  </div>
</template>

<script>
  export default {
    name: 'ProjectIssuesSelector',
    data() {
      return{
        typesOfIssues:{
          high: {
            title: 'High Type Bugs:',
            input_name: 'high_type_issues',
            total: 3,
            description: 'The defect must be solved as soon as possible as it affects the system severely and cannot be used until it is fixed',
          },
          medium: {
            title: 'Medium Type Bugs:',
            input_name: 'medium_type_issues',
            total: 2,
            description: 'During the normal course of development activities defect should be revolved. It can wait until a new version is created',
          },
          low: {
            title: 'Low Type Bugs:',
            input_name: 'low_type_issues',
            total: 1,
            description : 'The defect is an irritant but repair can be done once the more serious defect have been fixed.'
          },
          cosmetic:{
            title: 'Did you find any cosmetic issue?',
            input_name: 'cosmetic_issues',
            total: 1,
            description: '',
          },
          other:{
            title: 'Did you find any other issues you would like to mention?',
            input_name: 'other_issues',
            total: 1,
            description: '',
          }
        },
        seen : false,
        high_type_issues: {},
        medium_type_issues : {},
        low_type_issues : {},
        cosmetic_issues: {},
        other_issues: {}
      }
    },
    methods:{
      removeField:function(event){
        event.target.closest('.issue-link').remove();
      },
      addField:function(event){
        this.cnt1++;
      },
      bugInput: function(event){
        this.$emit("update-issues", this.high_type_issues);
        // this.$emit("change", this.high_type_issues);
      }
    }
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
        br{
          display: none;
        }
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
      .proj-status.done-step{
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
          &::after{
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
      .app-title{
        min-width: 110px;
        display: inline-block;
      }
      .test-device-list{
        span{
          margin-right: 15px;
          margin-top: 10px;
        }
      }
      .tester-issues-tab{
        .line-seprator{
          margin: 0 0 20px;
        }
        .issue-block{
          .issue-type{
            margin-bottom: 5px;
            font-size: 18px;
          }
          .form-group{
            .form-control{
              margin-bottom: 20px;
            }
            .remove-icon{
              color: #606368;
              i{
                font-size: 34px;
              }
            }
          }
        }
      }
      .tester-attachment-tab{
        .add-files-btn{
            width: 160px;
            float: right;
            margin-top: 0;
            margin-bottom: 20px;
            input{
              opacity: 0;
              position: absolute;
              top: 0;
              right: 0;
            }
          }
        .attachment-table-wrap{
          .attachment-table{
            border-radius: 6px;
            margin-bottom: 0;
            tr{
              td{
                &:first-child{
                  min-width: 60px;
                  max-width: 60px;
                  width: 60px;
                  text-align: center;
                }
                &:last-child{
                  min-width: 130px;
                  max-width: 130px;
                  width: 130px;
                  display: table-cell;
                }
                &:nth-child(3){
                  min-width: 160px;
                  max-width: 160px;
                  width: 160px;
                  display: table-cell;
                  text-align: center;
                }
                a{
                  margin-right: 10px;
                  color: #1f1f1f;
                  font-size: 20px;
                }
              }
            }
          }
        }
      }
      .tester-rating-tab{
        .total-score-txt{
          font-size: 25px;
          font-family: $font-family-UniNeue-bold;
          color: #363e48;
          text-align: center;
          width: 100%;
          margin-bottom: 25px;
          .effective-badge{
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
        .custom-accordion{
          border: none;
          &:hover{
            box-shadow: none;
          }
          .card-header{
            padding: 0 !important;
            border-bottom: none;
            &:hover{
              outline: none !important;
            }
            a.collapsed{
              border: 2px solid #118921;
              background-color: #2cac3d;
              color: #fff;
              border-radius: 6px;
              &:before{
                background-image: url("~img/right-arrow.png");
              }
              span{
                color: #fff;
              }
              img{
                display: inline-block;
                vertical-align: initial;
              }
            }
            a{
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
              &:before{
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
              span{
                float: right;
                font-family: $font-family-brandon-bold;
                font-size: 20px;
                text-transform: none;
                color: #2f2f2f;
              }
            }
          }
          .card-body{
            padding: 0 10px 10px;
            background-color: #f2f2f2;
            border-bottom-left-radius: 6px;
            border-bottom-right-radius: 6px;
            .detail-block-wrap{
              background-color: #fff;
              border: 1px solid #dadada;
              padding: 15px;
              border-radius: 6px;
              h4{
                font-size: 18px;
                color: #2cac3d;
                font-family: $font-family-brandon-bold;
              }
              .detail-block{
                font-family: $font-family-brandon-medium;
                font-size: 14px;
                line-height: 16px;
                span{
                  width: calc(100% / 3 - 5px);
                  display: inline-block;
                  vertical-align: top;
                }
              }
              .explanation-wrap{
                  textarea{
                    resize: none;
                    padding: 0px 10px;
                    font-size: 17px;
                    color: #9c9c9c;
                    &:hover,&:focus{
                      outline: none !important;
                    }
                  }
                }
                .ratings-block{
                  margin-top: 10px;
                  img{
                    width: 100%;
                  }
                }
              .green-step-btn-wrap{
                .green-step-btn{
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
  .green-step-btn{
    width: 100%;
    max-width: 180px;
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
      color: #fff;
      outline: none !important;
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
        .proj-status{
          br{
            display: block;
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
        .tester-rating-tab{
          .custom-accordion{
            .card-header{
              a{
                font-size: 18px;
                padding: 10px !important;
                padding-left: 30px !important;
                &::before{
                  top: 18px;
                  left: 10px;
                }
                span{
                  font-size: 18px;
                }
              }
            }
          }
        }
        .tester-issues-tab{
          .issue-block{
            .issue-type{
              font-size: 16px;
            }
            .form-group{
              .remove-icon{
                margin-top: 3px;
                display: block;
                i{
                  font-size: 24px;
                }
              }
            }
          }
        }
        .tester-attachment-tab{
          .add-files-btn{
            float: left;
          }
          .attachment-table-wrap{
            .attachment-table{
              border-radius: 6px;
              tr{
                td{
                  &:nth-child(2){
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
            display: block;
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
                left: 5px;
                top: 5px;
              }
            }
          }
        }
        .proj-status.done-step{
          .proj-progress{
            i{
              font-size:28px;
              &::after{
                height: 13px;
                width: 13px;
                left: 5px;
                top: 5px;
              }
            }
          }
        }
        .tester-rating-tab{
          .total-score-txt{
            font-size: 22px;
            margin-bottom: 20px;
          }
          .custom-accordion{
            .card-header{
              a{
                font-size: 16px;
                padding: 5px 10px !important;
                padding-left: 30px !important;
                &::before{
                  top: 12px;
                  left: 10px;
                }
                span{
                  font-size: 16px;
                }
              }
            }
          }
        }
      }
    }
    .green-step-btn{
      margin: 10px 15px 10px 0;
    }
  }
}
@media screen and(max-width:360px) {
  .custom-container{
    .test-proj-fillup-page{
      .white-box{
        .tester-rating-tab{
          .total-score-txt{
            font-size: 18px;
            margin-bottom: 15px;
          }
          .custom-accordion{
            .card-header{
              a{
                font-size: 14px;
                padding-left: 20px !important;
                &::before{
                  top: 12px;
                  left: 8px;
                  height: 10px;
                  width: 10px;
                }
                span{
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