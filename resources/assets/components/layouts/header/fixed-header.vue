<template>
    <header :class="[ 'header fixed-top tester-topbar', userClass ]" >
        <nav>
            <!-- Sidebar toggle button-->
            <div class="float-left toggle-menu-btn">
                <a href="javascript:void(0)" class="sidebar-toggle" @click="toggle_menu">
                    <i class="fa fa-bars"></i>
                </a>
            </div>

            <router-link to="/" class="logo">
                <a href="#"><img src="~img/logo.png" alt="The Beta Plan"/></a>
            </router-link>

            <div class="navbar-right">

                <!--drop downs-->
                <div>
                    <!-- <div class="dropdown hidden-xs-down btn-group fullscreen" v-if="fullscreen">
                        <a href="javascript:void(0)" @click="fullscreen">
                            <i class="fa fa-arrows-alt"></i>
                        </a>
                    </div> -->
                    <b-dropdown class="notifications-menu bell_bg" right link>
                        <span slot="text">
                            <i class="fa fa-bell noti-icon"></i>
                            <div class="notifications_badge_top">
                                <span class="badge badge-danger">4
                                </span>
                            </div>
                        </span>
                        <notifications v-if="hasTesterRole">
                            <div slot="thumb-icon">
                                 <img src="~img/tester_calendar_32x32.png" class="img-fluid" />
                            </div>
                        </notifications>
                        <notifications v-else-if="hasPublisherRole">
                            <div slot="thumb-icon">
                                 <img src="~img/publisher_calendar_32x32.png" class="img-fluid" />
                            </div>
                        </notifications>
                        <notifications v-if="hasTesterRole">
                            <div slot="thumb-icon">
                                 <img src="~img/tester_message_32x32.png" class="img-fluid" />
                            </div>
                        </notifications>
                        <notifications v-else-if="hasPublisherRole">
                            <div slot="thumb-icon">
                                 <img src="~img/publisher_message_32x32.png" class="img-fluid" />
                            </div>
                        </notifications>
                        <notifications v-if="hasTesterRole">
                            <div slot="thumb-icon">
                                 <img src="~img/tester_payment_32x32.png" class="img-fluid" />
                            </div>
                        </notifications>
                        <notifications v-else-if="hasPublisherRole">
                            <div slot="thumb-icon">
                                 <img src="~img/publisher_payment_32x32.png" class="img-fluid" />
                            </div>
                        </notifications>
                        <notifications v-if="hasTesterRole">
                            <div slot="thumb-icon">
                                 <img src="~img/tester_profile_32x32.png" class="img-fluid" />
                            </div>
                        </notifications>
                        <notifications v-else-if="hasPublisherRole">
                            <div slot="thumb-icon">
                                 <img src="~img/publisher_profile_32x32.png" class="img-fluid" />
                            </div>
                        </notifications>
                        <notifications v-if="hasTesterRole">
                            <div slot="thumb-icon">
                                 <img src="~img/tester_project_32x32.png" class="img-fluid" />
                            </div>
                        </notifications>
                        <notifications v-else-if="hasPublisherRole">
                            <div slot="thumb-icon">
                                 <img src="~img/publisher_project_32x32.png" class="img-fluid" />
                            </div>
                        </notifications>
                       
                    </b-dropdown>
                    <!-- User Account: style can be found in dropdown-->
                    <b-dropdown class="user user-menu bell_bg user_btn" right link>
                        <span slot="text">
                             <!--<img :src="this.$store.state.user.picture" class="rounded-circle" alt="User Image">-->
                            <!-- User name-->
                            <p class="user_name_max">{{this.$store.state.user.first_name}}
                            </p>
                                <!-- ({{this.$store.state.user.roles[0].name}}) -->
                        </span>
                        <b-dropdown-item exact class="dropdown_content">
                            <router-link tag="a" :to="{ name: 'tester.tester-profile' }" exact class="drpodowtext" v-if="hasTesterRole">
                                <i class="fa fa-user-o"></i> Profile
                            </router-link>
                            <router-link tag="a" :to="{ name: 'publisher.profile' }" exact class="drpodowtext" v-else-if="hasPublisherRole">
                                <i class="fa fa-user-o"></i> Profile
                            </router-link>
                        </b-dropdown-item>
                        <b-dropdown-item exact class="dropdown_content">
                            <router-link tag="a" :to="{name: 'tester.settings'}" exact class="drpodowtext" v-if="hasTesterRole">
                                <i class="fa fa-cog"></i> Settings
                            </router-link>
                            <router-link tag="a" :to="{name: 'publisher.settings'}" exact class="drpodowtext" v-else-if="hasPublisherRole">
                                <i class="fa fa-cog"></i> Settings
                            </router-link>
                        </b-dropdown-item>
                        <b-dropdown-item exact class="dropdown_content">
                            <a @click="logout()" class="drpodowtext">
                                <i class="fa fa-sign-out"></i> Logout
                            </a>
                        </b-dropdown-item>
                    </b-dropdown>
                </div>
            </div>
        </nav>
    </header>
</template>
<script>
import screenfull from "screenfull";
import notifications from 'components/components/notification.vue';
import {
    logout,
    hasTesterRole,
    hasPublisherRole
} from "src/services/auth";
export default {
  name: "vueadmin_header",
  components: {
      notifications
      },
  data() {
    return {
        userClass: 'tester-topbar',
        hasTesterRole: hasTesterRole(),
        hasPublisherRole: hasPublisherRole()
    }
  },
  mounted: function() {
    if (hasPublisherRole()) {
        this.userClass = 'publisher-topbar';
    }
  },
  methods: {
    toggle_menu() {
      this.$store.commit("left_menu", "toggle");
    },
    fullscreen() {
      if (screenfull.enabled) {
        screenfull.toggle();
      }
    },
    logout() {
      logout();
      let name = "/login";
      if (this.$route.path.indexOf("/admin") >= 0) {
        name = "/admin/login";
      }
      window.location = '/logout?next=/portal' + name;
    }
  }
};
</script>
<style lang="scss" scoped>
@import "../css/customvariables";
.header {
  z-index: 1030;
  nav {
    margin-bottom: 0;
    height: 100px;
    background: $header_color;
    background-size: 100% 100%;
    box-shadow: 0px 0px 10px #ccc;
  }
  .navbar-right {
    float: right;
    margin-right: 15px;
  }
  .logo {
    display: block;
    float: left;
    height: 50px;
    line-height: 41px;
    padding: 3px 10px;
    text-align: center;
    width: 250px;
    background: $header_color;
    img {
      width: 125px;
    }
  }
  .navbar-right {
    .dropdown-item {
      padding: 0;
      width: 100%;
      outline: none;
    }
    div.dropdown {
      > a {
        color: $zoom_color;
      }
      .dropdown-menu > button {
        padding: 10px 15px;
      }
      &.notifications-menu {
        height: 50px;
        .noti-icon {
          font-size: 18px;
        }
      }
      > a > i {
        font-size: 23px;
      }
      > a {
        display: block;
        padding: 12px;
      }
      &:hover > a {
        background-color: #ededed;
        color: #000;
      }
      > a.padding-user {
        padding-top: 8px;
        padding-bottom: 6px;
      }
    }
  }
  nav .sidebar-toggle {
    float: left;
    color: $toggle_color;
    font-size: 19px;
    padding-top: 10px;
  }
}

/* .tester-topbar{
    nav {
        background-color: #2cac3d;
    }
} */

.tester-topbar{
    // min-height: 100px;
    // background-color: #2cac3d;
    color: #ffffff;
    font-family: $font-family-brandon-regular;
    nav {
        height: 70px;
        -webkit-box-shadow: none;
        background-color: #2cac3d;
        box-shadow: none;
        font-size: 14px;
    }
    .logo{
        background: transparent;
        margin-top: 10px;
        text-align: left;
        padding-left: 25px;
    }
    .toggle-menu-btn{
        display: none;
    }

    .navbar-right {
        margin-top: 15px;
        div.dropdown.notifications-menu {
            .noti-icon{
                color: #fff;
                font-size: 20px;
            }
        }
    }
}

.publisher-topbar{
    nav {
        background-color: #0081CC;
    }
}

@media screen and(max-width:991px) {
    .tester-topbar{
        .logo{
            text-align: left;
            padding-left: 0px;
        }
        .toggle-menu-btn{
            display: Block;
            margin: 8px 15px;
            .sidebar-toggle{
                color: #fff;
                font-size: 24px;
                padding: 10px;
                margin: 0;
            }
        }
    }
}
@media screen and(max-width:560px) {
    .tester-topbar{
        .logo{
            width: auto !important;
            margin-top: 10px;
        }
        .toggle-menu-btn{
            margin: 5px;
            .sidebar-toggle{
                padding-bottom: 0px;
            }
        }
        .navbar-right{
            margin: 20px 0px 0px;
            // width: 100%;
            width: auto;
            padding: 0 15px;
            .notifications-menu{
                height: auto !important;
                float: left;
            }
        }
        .user_btn{
            float: right;
        }
    }
}

.user_name_max {
  display: inline-block;
  max-width: 180px;
  white-space: nowrap;
  overflow: hidden !important;
  text-overflow: ellipsis;
  margin: 0 0 -4px;
    @media screen and(max-width:560px) {
        display: none;
    }
}

.noti_msg {
  font-size: 16px;
  padding: 10px;
  border: 1px solid #4f90c1;
  border-radius: 50px;
  margin-top: 10px;
}

.user.user-menu > button img {
  width: 35px;
  height: 35px;
}
/**** END HEADER RIGHT SIDE DROPDOWNS ****/

@media screen and (max-width: 767px) {
  .dropdown.open .dropdown-menu {
    position: absolute;
  }
  .navbar-right > li > a {
    padding: 10px 12px;
  }
}
/* Fix menu positions on xs screens to appear correctly and fully */

@media (max-width: 560px) {
  body .header .logo,
  body .header nav {
    width: auto;
  }
  body .header nav .sidebar-toggle {
    padding-left: 15px;
  }
  nav {
    // height: 100px !important;
  }
}

.notifications_badge_top {
  margin-top: -28px;
  margin-left: 10px;
  position: absolute;
  span {
    top: 1px;
    left: 2px;
    border-radius: 50%;
  }
}

.notifications-menu .dropdown-item {
  width: 100%;
  display: block;
}

.dropdown-footer {
  padding: 10px !important;
}

</style>
<style type="text/css" lang="scss">
@import "../css/customvariables";
.wrapper {
  margin-top: 70px;
  @media screen and (max-width: 560px) {
    // margin-top: 100px;
  }
}

.sidebar-toggle {
  margin-left: 10px;
}


.bell_bg {
  button.btn-secondary {
    background-color: $bell-color;
    border: none;
    border-radius: 0;
    box-shadow: none !important;
    &:hover {
      background-color: #ededed !important;
    }
    &:active {
      color: $toggle_color !important;
    }
  } //.btn-secondary:active
  &.show button {
    background-color: $bell-active !important;
  }
  &.user_btn .dropdown-toggle {
    padding: 7px 9px;
  }
}

.tester-topbar{
    .navbar-right {

        .user,
        .bell_bg{
            button.btn-secondary{
                background-color: transparent !important;
                outline: none !important;
                text-transform: capitalize;
                color: #fff;
                font-size: 13px;
                font-weight: 600;
                position: relative;
            }
            button.btn-secondary:hover,
            button.btn-secondary:focus{
                background-color: transparent !important;
                border: 0px !important;
                box-shadow: none !important;
                outline: none !important;
            }
        }
        .user{
            button.btn-secondary{
                padding-right: 15px;
            }
            button.btn-secondary:before{
                color: #fff;
                position: absolute;
                right:0;
                top:15px;
                content:'';
                border-top: .3em solid;
                border-right: .3em solid transparent;
                border-bottom: 0;
                border-left: .3em solid transparent;
            }
        }
    }
}

.tabs_cont,
.event_date {
  background-color: #fff !important;
}
@media screen and (max-width: 560px) {
    .tester-topbar{
        .navbar-right {
            .user{
                button.btn-secondary{
                padding-right: 5px;
                }
            }
        }
    }
}
</style>

