 <template>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-aside sidebar-offcanvas admin-sidebar">
        <!-- sidebar: style can be found in sidebar-->
        <section class="sidebar">
            <div id="menu" role="navigation">
                 <div class="nav_profile profile-wrap">
                  <div class="text-center user-avatar">
                    <!-- <img src="~img/user-avatar.jpg" alt="user-avatar"/> -->
                    <p class="user-name mb-2">
                      Johm Williams
                    </p>
                  </div>
                </div>
                <vmenu>
                    <!-- <template v-for="item in menuitems">
                        <li class="divider mt-3 " v-if="item.title">
                            <span>{{item.name}}</span>
                        </li>
                        <vsub-menu v-if="item.child" :title="item.name" :icon="item.icon">
                            <vmenu-item v-for="child in item.child" :link="child.link" :icon="child.icon" :key="child.name">{{child.name}}</vmenu-item>
                        </vsub-menu>
                        <vmenu-item v-if="item.link" :link="item.link" :icon="item.icon">{{ item.name}}
                        </vmenu-item>
                    </template> -->
                     <template v-for="item in menuitems">
                            <vmenu-item v-if="item.link" :link="item.link" :activeIcon="item.activeIcon" :src="item.src">{{ item.name}}
                            </vmenu-item>
                        </template>
                </vmenu>
                <!-- / .navigation -->
            </div>
            <!-- menu -->
        </section>
        <!-- /.sidebar -->
    </aside>
</template>
<script>
import { vmenu, vmenuItem, vsubMenu } from "./menu";
// import profile from "../left-profile/user_profile2.vue"
import menu_items from "../../../../menu.js";
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
        border-bottom: 1px solid rgba(66, 68, 77, 0.5);
        margin: 0 20px;
    }
    .menu-wrap {
        margin-right: 28px !important;
    }
</style>
<style scoped lang="scss">
@import "../../css/customvariables";
.left-aside {
  width: $left_menu_width;
  background: $leftmenu_color;
  background-repeat: repeat-y;
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
.nav_profile {
  border-bottom: 1px solid #eee;
}
.admin-sidebar{
  background-color: #1c1855;
  .profile-wrap {
    border-bottom: 1px solid transparent;
    margin: 40px 0px 0px;
    .user-avatar {
      padding-bottom: 25px;
      border-bottom: 1px solid rgba(66,68,77,0.5);
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
}
</style>
