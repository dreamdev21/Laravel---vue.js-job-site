import { ROUTE_PREFIX } from "src/router/router-prefix";
import dashboard_icon_active from "src/assets/img/tester-dashboard-icon-active.png";
import dashboard_icon_normal from "src/assets/img/tester-dashboard-icon.png";
import projects_icon_normal from "src/assets/img/tester-project-icon.png";
import projects_icon_active from "src/assets/img/tester-project-icon-active.png";
import profile_icon_active from "src/assets/img/tester-profile-icon-active.png";
import profile_icon_normal from "src/assets/img/tester-profile-icon.png";
import devices_icon_active from "src/assets/img/tester-devices-icon-active.png";
import devices_icon_normal from "src/assets/img/tester-devices-icon.png";
import inbox_icon_active from "src/assets/img/tester-inbox-icon-active.png";
import inbox_icon_normal from "src/assets/img/tester-inbox-icon.png";
import payments_icon_active from "src/assets/img/tester-payments-icon-active.png";
import payments_icon_normal from "src/assets/img/tester-payments-icon.png";
import help_icon_active from "src/assets/img/tester-help-icon-active.png";
import help_icon_normal from "src/assets/img/tester-help-icon.png";


const menu_items = [{
        name: "DASHBOARD",
        link: `${ROUTE_PREFIX}/tester/dashboard`,
        src: dashboard_icon_normal,
        activeIcon: dashboard_icon_active
    },
    {
        name: "PROJECTS",
        link: `${ROUTE_PREFIX}/tester/projects`,
        icon: "",
        src: projects_icon_normal,
        activeIcon: projects_icon_active
    },
    {
        name: "MY DEVICES",
        link: `${ROUTE_PREFIX}/tester/devices-list`,
        icon: "",
        src: profile_icon_normal,
        activeIcon: profile_icon_active
    },
    {
        name: "INBOX",
        link: `${ROUTE_PREFIX}/tester/dashboard3`,
        icon: "",
        src: inbox_icon_normal,
        activeIcon: inbox_icon_active
    },
    {
        name: "PAYMENTS",
        link: `${ROUTE_PREFIX}/tester/payments`,
        icon: "",
        src: payments_icon_normal,
        activeIcon: payments_icon_active
    },
    {
        name: "HELP",
        link: `${ROUTE_PREFIX}/tester/dashboard5`,
        icon: "",
        src: help_icon_normal,
        activeIcon: help_icon_active
    },
];
export default menu_items;