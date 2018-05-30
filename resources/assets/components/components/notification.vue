<template>
  <div class="notification-tabwrap">
      <!-- <b-dropdown-item exact>
          <div class="row">
              <div class="col-2 mt-2 ml-3 pr-0">
                  <div class="img-wrap rounded-circle">
                    <img class="img-fluid" src="~img/calendar_32x32.png">
                  </div>
              </div>
              <div class="col-9 mt-2">
                  <p> &nbsp;Lorem ipsum dolor sit amet, elit.
                      <br>
                      <small class="ml-1 text-info">Today </small>
                  </p>
              </div>
          </div>
      </b-dropdown-item> -->
      <b-dropdown-item>
        <div class="row m-0">
            <div class="col-2 mt-2 pr-0">
                <div class="img-wrap rounded-circle">
                  <slot name="thumb-icon"></slot>
                </div>
            </div>
            <div class="col-9 mt-2">
                <p> &nbsp;Lorem ipsum dolor sit amet, elit.
                    <br>
                    <small class="ml-1 text-info">Today </small>
                </p>
            </div>
        </div>
      </b-dropdown-item>
      <!-- <b-dropdown-item exact>
        <div class="row">
            <div class="col-2 mt-2 ml-3 pr-0">
              <div class="img-wrap rounded-circle">
                <img class="img-fluid" src="~img/payment_32x32.png">
              </div>
            </div>
            <div class="col-9 mt-2">
                <p> &nbsp;Lorem ipsum dolor sit amet, elit.
                    <br>
                    <small class="ml-1 text-info">Today </small>
                </p>
            </div>
        </div>
      </b-dropdown-item>
      <b-dropdown-item exact>
        <div class="row">
            <div class="col-2 mt-2 ml-3 pr-0">
              <div class="img-wrap rounded-circle">
                <img class="img-fluid" src="~img/profile_32x32.png">
              </div>
            </div>
            <div class="col-9 mt-2">
                <p> &nbsp;Lorem ipsum dolor sit amet, elit.
                    <br>
                    <small class="ml-1 text-info">Today </small>
                </p>
            </div>
        </div>
      </b-dropdown-item>
      <b-dropdown-item exact>
        <div class="row">
            <div class="col-2 mt-2 ml-3 pr-0">
              <div class="img-wrap rounded-circle">
                <img class="img-fluid" src="~img/project_32x32.png">
              </div>
            </div>
            <div class="col-9 mt-2">
                <p> &nbsp;Lorem ipsum dolor sit amet, elit.
                    <br>
                    <small class="ml-1 text-info">Today </small>
                </p>
            </div>
        </div>
      </b-dropdown-item> -->
    
    <!-- <b-dropdown-item class="dropdownheader socio-tabs1" exact> -->
      <!-- <b-tabs>
          <b-tab title="Notifications" class="tabs_cont" active>
              <b-dropdown-item exact>
                  <div class="row">
                      <div class="col-2 mt-2 ml-2">
                          <img class="rounded-circle" src="img/authors/avatar1.jpg">
                      </div>
                      <div class="col-9 mt-2">
                          <p> &nbsp;Lorem ipsum dolor sit amet, elit.
                              <br>
                              <small class="ml-1 text-info">Today </small>
                          </p>
                      </div>
                  </div>
              </b-dropdown-item>
              <b-dropdown-item exact>
                  <div class="row">
                      <div class="col-2 mt-2 ml-2">
                          <img class="rounded-circle" src="img/authors/avatar5.jpg">
                      </div>
                      <div class="col-9 mt-2">
                          <p> &nbsp;Lorem ipsum dolor sit amet, elit.
                              <br>
                              <small class="ml-1 text-muted">week ago</small>
                          </p>
                      </div>
                  </div>
              </b-dropdown-item>
              <b-dropdown-item exact>
                  <div class="row">
                      <div class="col-2 mt-2 ml-2">
                          <img class="rounded-circle" src="img/authors/avatar3.jpg">
                      </div>
                      <div class="col-9 mt-2">
                          <p> &nbsp;Lorem ipsum dolor sit amet, elit.
                              <br>
                              <small class="ml-1 text-muted">month ago</small>
                          </p>
                      </div>
                  </div>
              </b-dropdown-item>
              <b-dropdown-item exact class="mt-2 notifications_data">
                  <div class="row">
                      <div class="col-2 mt-2 ml-2">
                          <img class="rounded-circle" src="img/authors/avatar3.jpg">
                      </div>
                      <div class="col-9 mt-2">
                          <p> &nbsp;Lorem ipsum dolor sit amet, elit.
                              <br>
                              <small class="ml-1 text-muted">2 months ago</small>
                          </p>
                      </div>
                  </div>
              </b-dropdown-item>
              <b-dropdown-item class="dropdown-footer " exact>
                  <div>
                      <strong>View all</strong>
                  </div>
              </b-dropdown-item>
          </b-tab>
          <b-tab title="Events" class="event_date">
              <b-dropdown-item exact class="notifications_data">
                  <div class="noti_item">
                      <div class="row">
                          <div class="col-2   ml-3">
                              <i class="fa fa-calendar text-info noti_msg"></i>
                          </div>
                          <div class="col-9 mt-1">
                              <span>New Lorem Event from john.</span>
                              <br>
                              <span class="text-muted">Apr 29th 2017</span>
                          </div>
                      </div>
                  </div>
              </b-dropdown-item>
              <b-dropdown-item exact class="notifications_data">
                  <div class="row">
                      <div class="col-2 ml-3">
                          <i class="fa fa-calendar text-info noti_msg"></i>
                      </div>
                      <div class="col-9 mt-1">
                          <span>New Lorem Event from john.</span>
                          <br>
                          <span class="text-muted">Apr 29th 2017</span>
                      </div>
                  </div>
              </b-dropdown-item>
              <b-dropdown-item exact class="notifications_data">
                  <div class="row">
                      <div class="col-2 ml-3 mb-2">
                          <i class="fa fa-calendar text-info noti_msg"></i>
                      </div>
                      <div class="col-9 mt-1">
                          <span>New Lorem Event from john.</span>
                          <br>
                          <span class="text-muted">Apr 29th 2017</span>
                      </div>
                  </div>
              </b-dropdown-item>
              <b-dropdown-item class="dropdown-footer">
                  <div>
                      <strong>View all</strong>
                  </div>
              </b-dropdown-item>
          </b-tab>
          <b-tab title="Updates" disabled>
          </b-tab>
      </b-tabs> -->
    <!-- </b-dropdown-item> -->
    
  </div>
</template>

<script>
import Vue from "vue";
export default {
  name: "notification",
   props: {
    thumb_icon: {
      type: Array,
      default() {
        return [];
      }
    }
  },
}
</script>
<style lang="scss" scoped>
  @import "../layouts/css/_customvariables";
.notification-tabwrap{
    &:focus{
        outline: none !important;
    }
    .dropdown-item{
        padding: 0;
        &:focus{
            outline: none !important;
        }
        .img-wrap{
            img{
            height: 32px;
            width: 32px;
            }
        }
    }
}
</style>