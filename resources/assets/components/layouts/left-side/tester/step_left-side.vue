 <template>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-aside sidebar-offcanvas custom-leftsidebar">
        <!-- sidebar: style can be found in sidebar-->
        <section class="sidebar">
            <div id="menu" role="navigation">
                <div class="nav_profile profile-wrap">
                  <div class="text-center user-avatar">
                    <img :src="this.$store.state.user.profile" alt="user-avatar"/>
                    <p class="user-name mb-2">
                      {{this.$store.state.user.first_name}}  {{this.$store.state.user.last_name}}
                    </p>
                  </div>
                </div>
                
                <div class="menu-wrap">
                  <ul>
                    <li :class="{ active : active_step === 'welcome' }" >
                      <span class="step-oval"></span>
                      <span class="step-text"> Welcome  </span>
                    </li>
                    <li :class="{ active: active_step === 'step1' }" >
                      <span class="step-oval"></span>
                      <span class="step-text" >Step 1-Complete Profile</span>
                    </li>
                    <li :class="{ active: active_step === 'step2'  }" >
                      <span class="step-oval"></span>
                      <span class="step-text">Step 2-Submission Process</span>
                    </li>
                    <li :class="{'active': active_step === 'step3' }" >
                      <span class="step-oval"></span>
                      <span class="step-text">Step 3-Ready for Test</span>
                    </li>
                    <li :class="{ active: active_step === 'step4' }">
                      <span class="step-oval"></span>
                      <span class="step-text">Step 4-In Review</span>
                    </li>
                  </ul>
                </div>
            </div>
            <!-- menu -->
        </section>
        <!-- /.sidebar -->
    </aside>
</template>
<script>
import { vmenu, vmenuItem, vsubMenu } from "../default/menu";
// import profile from "../left-profile/user_profile2.vue"
import menu_items from "../../../../tester_menu.js";
// import { latestProjectStatus } from "src/services/auth.js";
import { hasClearedStep1, isReadyForTest } from "src/services/tester";
export default {
  name: "left-side",
  components: {
    vmenu,
    vsubMenu,
    vmenuItem
  },
  data() {
    return {
      menuitems: menu_items
    };
  },
  computed: {
    latestProjectStatus() {
      if (this.$store.state.user.latest_project_status) {
        return this.$store.state.user.latest_project_status.name.toLowerCase();
      }
      return false;
    },
    user_status() {
      return this.$store.state.user.status.name.toLowerCase();
    },
    active_step() {
      if (this.latestProjectStatus === "submitted") {
        return "step4";
      }
      if (
        this.latestProjectStatus === "accepted" ||
        this.user_status === "step_2"
      ) {
        return "step3";
      }
      if (
        this.$route.name === "tester.step2" ||
        this.user_status === "step_1"
      ) {
        return "step2";
      }
      if (
        (this.$route.name == "tester.step1" ||
          this.user_status === "pending activated") &&
        this.$route.name !== "tester.welcome"
      ) {
        return "step1";
      }
      if (this.$route.name == "tester.welcome") {
        return "welcome";
      }
    }
  }
};
</script>
<style scoped lang="scss">
@import "../../css/customvariables";
.text-white {
  color: #fff;
}
.left-aside {
  width: $left_menu_width;
  background: $leftmenu_color;
  background-repeat: repeat-y;
  // font-family: $font-family-UniNeue-regular;
}

.navigation {
  padding: 0;
}

.divider {
  margin-top: 10px;
  list-style-type: none;
  border-bottom: 1px solid #ececec;
  padding-bottom: 6px;
}

.divider span {
  font-size: 15px;
  font-weight: 700;
  color: $divider-leftheader;
  margin: 20px 20px -15px 20px;
}

.sidebar {
  display: block;
  font-size: 14px;
  letter-spacing: 1px;
}

.content {
  display: block;
  width: auto;
  overflow-x: hidden;
  padding: 0 15px;
}

.badge-success {
  background-color: #22d69d;
}

.badge {
  padding: 0.6em 0.7em;
  border-radius: 0.75rem;
}

.custom-leftsidebar {
  background: #1f2027;
  .profile-wrap {
    // border-bottom: 1px solid #eee;
    margin: 40px 0px 50px;
    .user-avatar {
      padding-bottom: 25px;
      border-bottom: 1px solid #31323a;
      margin: 0 28px;
      img {
        max-width: 121px;
        border-radius: 50%;
      }
      .user-name {
        font-size: 16px;
        margin: 14px;
        text-transform: capitalize;
        color: #fff;
        font-family: $font-family-brandon-medium;
      }
    }
  }
  .menu-wrap {
    color: #fff;
    font-size: 13px;
    font-family: $font-family-UniNeue-regular;
    margin: 0 5px 0px 28px;
    ul {
      padding: 0px;
      margin: 0px;
      li {
        position: relative;
        margin-bottom: 40px;
        span.step-oval {
          position: relative;
          border: 2px solid #67696d;
          border-radius: 50%;
          width: 20px;
          height: 20px;
          display: inline-block;
          vertical-align: middle;
          margin-right: 3px;
        }
        span.step-text {
          color: #67696d;
          display: inline-block;
          vertical-align: top;
          width: calc(100% - 30px);
        }
      }
      li.active {
        span.step-oval {
          border: 2px solid #2cac3d;
          &::before {
            width: 10px;
            height: 10px;
            background: #2cac3d;
            position: absolute;
            top: 3px;
            left: 3px;
            content: "";
            border-radius: 50%;
          }
        }
        span.step-text {
          color: #fff;
        }
      }
    }
  }
}
@media screen and(max-width:1200px) {
  .custom-leftsidebar {
    .profile-wrap {
      margin: 30px 0 20px;
      .user-avatar {
        padding-bottom: 10px;
      }
    }
    .menu-wrap {
      ul {
        li {
          margin-bottom: 25px;
        }
      }
    }
  }
}
</style>
