window.axios = require("axios");
import Vue from "vue";
import App from "./App";
import router from "./router";
import store from "./store/store.js";
import "./filters";
import VueAnalytics from "vue-analytics";
import Nprogress from "nprogress";
import Datepicker from "vuejs-datepicker";
Vue.component("datepicker", Datepicker);

Nprogress.configure({ showSpinner: false });
window.Nprogress = Nprogress;

window.axios.defaults.headers.common = {
  "X-Requested-With": "XMLHttpRequest",
  "X-CSRF-TOKEN": window.Laravel.csrf,
  ...(localStorage.getItem("access_token")
    ? { Authorization: `Bearer ${localStorage.getItem("access_token")}` }
    : {})
};
// Add a request interceptor
axios.interceptors.request.use(
  config => {
    window.Nprogress.start();
    return config;
  },
  error => {
    window.Nprogress.done();
    return Promise.reject(error);
  }
);

// Add a response interceptor
axios.interceptors.response.use(
  response => {
    window.Nprogress.done();
    if ((response.data || {}).data && Array.isArray(response.data.data)) {
      return response.data;
    }
    return response;
  },
  function(error) {
    window.Nprogress.done();
    return Promise.reject(error);
  }
);

// Google Analytics
const google_analytics_key = store.state.google_analytics_key;

if (google_analytics_key) {
  Vue.use(VueAnalytics, {
    google_analytics_key,
    router,
    checkDuplicatedScript: true,
    autoTracking: {
      pageviewTemplate(route) {
        return {
          page: "default/" + route.path
        };
      }
    }
  });
}

// Remove the productionTip in dev tool console
Vue.config.productionTip = false;

window.VueApp = new Vue({
  el: "#app",
  router,
  store,
  render: h => h(App)
});

Date.prototype.toMysql = function() {
  let month = "" + (this.getMonth() + 1);
  let day = "" + this.getDate();
  let year = this.getFullYear();

  if (month.length < 2) month = "0" + month;
  if (day.length < 2) day = "0" + day;

  return [year, month, day].join("-");
};
