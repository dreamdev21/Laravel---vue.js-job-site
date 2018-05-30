<template>
    <div>
        <preloader v-show="this.$store.state.preloader"></preloader>
        <vueadmin_header></vueadmin_header>
        <div class="wrapper row-offcanvas">
            <component :is="menuItem" v-show="this.$store.state.left_open"></component>
            <right_side>
                <router-view></router-view>
            </right_side>
        </div>
    </div>
</template>
<script>
/**
 * These are the files that enable you to change layouts and other options
 */

/**
 * import preloader
 * choose from preloader and bounce
 */
import preloader from "components/layouts/preloader/preloader";

/**
 * The right side content
 */
import right_side from "components/layouts/right-side";

/**
 * import left-side from default or horizontal-menu
 * eg: import left_side from 'components/layouts/left-side/horizontal-menu/left-side'
 */
import step_left_side from "components/layouts/left-side/tester/step_left-side";
import tester_left_side from "components/layouts/left-side/tester/tester_left-side";

/**
 * import from header or fixed-header or no-header
 */
import vueadmin_header from "components/layouts/header/fixed-header";

/**
 * Styles
 */

/**
 * Main stylesheet for the layout
 */
import "assets/sass/custom.scss";

/**
 * Style required for a boxed layout
 */
// import 'components/layouts/css/boxed.scss'

/**
 * Style required for a fixed-menu layout
 */
import "components/layouts/css/fixed-menu.scss";

/**
 * Style required for a compact-menu layout
 */
// import 'components/layouts/css/compact-menu.scss'

/**
 * Style required for a centered-logo layout
 */
// import 'components/layouts/css/centered-logo.scss'

/**
 * Style required for a content-menu layout
 */
// import 'components/layouts/css/content_menu.scss'

/**
 * import animejs for the menu transition effects
 */
import anime from "animejs";
import { isReadyForTest } from "src/services/tester";
import { isApprovedTester } from "src/services/auth";
import { isUserActive } from "src/services/auth";

export default {
  name: "layout",
  components: {
    preloader,
    vueadmin_header,
    right_side,
    tester_left_side,
    step_left_side
  },
  data() {
    return {
      showtopbtn: false
    };
  },
  computed: {
    menuItem() {
      if (isApprovedTester() || isUserActive()) {
        return "tester_left_side";
      }
      return "step_left_side";
    }
  },
  mounted() {
    if (window.innerWidth <= 992) {
      this.$store.commit("left_menu", "close");
    }
  }
};
</script>
<style lang="scss" scoped>
.wrapper:before,
.wrapper:after {
  display: table;
  content: " ";
}

.wrapper:after {
  clear: both;
}

.wrapper {
  display: table;
  overflow-x: hidden;
  width: 100%;
  max-width: 100%;
  table-layout: fixed;
}

.right-aside,
.left-aside {
  padding: 0;
  display: table-cell;
  vertical-align: top;
}

.right-aside {
  background-color: #ebf2f6 !important;
}

@media (max-width: 992px) {
  .wrapper > .right-aside {
    width: 100vw;
    min-width: 100vw;
  }
}
</style>
