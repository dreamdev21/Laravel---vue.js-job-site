<template>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-aside sidebar-offcanvas tester-leftsidebar">
        <!-- sidebar: style can be found in sidebar-->
        <section class="sidebar">
            <div id="menu" role="navigation">
                <div class="nav_profile profile-wrap">
                    <div class="text-center user-avatar">
                        <!-- <img src="~img/user.png" class="img-fluid"/> -->
                        <img :src="this.$store.state.user.profile" alt="user-avatar"/>
                        <p class="user-name mb-2">
                            {{this.$store.state.user.first_name}}  {{this.$store.state.user.last_name}}
                        </p>
                    </div>
                </div>
                <div class="menu-wrap">
                    <vmenu>
                        <template v-for="item in menuitems">
                            <vmenu-item v-if="item.link" :link="item.link" :activeIcon="item.activeIcon" :src="item.src">{{ item.name}}
                            </vmenu-item>
                        </template>
                    </vmenu>
                </div>

                <!-- / .navigation -->
            </div>
            <!-- menu -->
        </section>
        <!-- /.sidebar -->
    </aside>
</template>
<script>
import { vmenu, vmenuItem, vsubMenu } from "../default/menu";
import menu_items from "src/tester_menu.js";
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
  }
};
</script>
<style>
.name {
  font-size: 14px;
  vertical-align: middle;
  padding-left: 20px !important;
}
.listbrdr {
  border-bottom: 1px solid #31323a;
}
</style>
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

.tester-leftsidebar {
  background: #1f2027;
  .profile-wrap {
    // border-bottom: 1px solid #eee;
    margin: 40px 0px 0px;
    .user-avatar {
      padding-bottom: 57px;
      border-bottom: 1px solid rgba(66, 68, 77, 0.5);
      margin: 0 28px;
      img {
        max-width: 121px;
        border-radius: 50%;
        height: 120px;
        width: 120px;
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
    span.step-text {
      color: #fff;
    }
    a.active {
      background-color: transparent;
    }
  }
}
@media screen and(max-width:1200px) {
  .tester-leftsidebar {
    .profile-wrap {
      .user-avatar {
        padding-bottom: 20px;
     }
    }
  }
}
</style>