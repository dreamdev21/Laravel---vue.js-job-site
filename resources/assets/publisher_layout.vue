<template>
    <div>
        <preloader v-show="this.$store.state.preloader"></preloader>
        <vueadmin_header></vueadmin_header>
        <div class="wrapper row-offcanvas">
            <left_side v-show="this.$store.state.left_open"></left_side>
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
    import left_side from "components/layouts/left-side/publisher/left-side";

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
     * Style required for a fixed-menu layout
     */
    import "components/layouts/css/fixed-menu.scss";


    export default {
        name: "layout",
        components: {
            preloader,
            vueadmin_header,
            left_side,
            right_side
        },
        data() {
            return {
                showtopbtn: false
            };
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
