import Vue from "vue";
import DateFormatter from "./date-filter";
import DateTimeFormatter from "./date-time-filter";
import FileSizeFilter from "./file-size-filter";
import FirstUppercase from "./first-uppercase-filter";
import CurrencyFormatter from "./currency-filter";

Vue.filter("date", DateFormatter);
Vue.filter("datetime", DateTimeFormatter);
Vue.filter("fileSize", FileSizeFilter);
Vue.filter("firstUppercase", FirstUppercase);
Vue.filter('currency', CurrencyFormatter);