<template>
<div>
    <div id="app">
        <router-view></router-view>
    </div>
</div>
</template>
<script>
import Vue from "vue";
import {tabs, tab, tabGroup} from "vue-strap";
import BootstrapVue from "bootstrap-vue";
import ToggleButton from "vue-js-toggle-button";
import VueSwal from "vue-swal";
import VueTabs from 'vue-nav-tabs'
import 'vue-nav-tabs/themes/vue-tabs.css'

Vue.use(VueSwal);
Vue.use(ToggleButton);
Vue.use(BootstrapVue);
Vue.use(VueTabs)

export default {
  name: "app"
};
</script>
<style lang="scss" src="assets/sass/bootstrap/bootstrap.scss">

</style>
<style src="font-awesome/css/font-awesome.css">

</style>
<style src="bootstrap-vue/dist/bootstrap-vue.css">

</style>
<style src="nprogress/nprogress.css">

</style>
<style lang="scss" src="assets/sass/custom.scss">

</style>
