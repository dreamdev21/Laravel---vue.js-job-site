import { ROUTE_PREFIX } from "src/router/router-prefix";
import dashboard_icon_active from "src/assets/img/publisher-dashboard-icon-active.png";
import dashboard_icon_normal from "src/assets/img/publisher-dashboard-icon.png";
import finance_icon_normal from "src/assets/img/publisher-finance-icon.png";
import finance_icon_active from "src/assets/img/publisher-finance-icon-active.png";
import help_icon_normal from "src/assets/img/publisher-help-icon.png";
import help_icon_active from "src/assets/img/publisher-help-icon-active.png";
import members_icon_normal from "src/assets/img/publisher-members-icon.png";
import members_icon_active from "src/assets/img/publisher-members-icon-active.png";
import test_project_icon_normal from "src/assets/img/publisher-test-project-icon.png";
import test_project_icon_active from "src/assets/img/publisher-test-project-icon-active.png";
import inbox_icon_normal from "src/assets/img/publisher-inbox-icon.png";
import inbox_icon_active from "src/assets/img/publisher-inbox-icon-active.png";
import profile_icon_normal from "src/assets/img/publisher-profile-icon.png";
import profile_icon_active from "src/assets/img/publisher-profile-icon-active.png";
import projects_icon_normal from "src/assets/img/publisher-projects-icon.png";
import projects_icon_active from "src/assets/img/publisher-projects-icon-active.png";

const menu_items = [{
        name: "DASHBOARD",
        link: `${ROUTE_PREFIX}/publisher/dashboard`,
        icon: "",
        src: dashboard_icon_normal,
        activeIcon: dashboard_icon_active
    },
    {
        name: "PROJECTS",
        link: `${ROUTE_PREFIX}/publisher/projects`,
        icon: "",
        src: projects_icon_normal,
        activeIcon: projects_icon_active
    },
    {
        name: "FINANCES",
        link: `${ROUTE_PREFIX}/publisher/finance`,
        icon: "",
        src: finance_icon_normal,
        activeIcon: finance_icon_active
    },
    {
        name: "MEMBERS",
        link: `${ROUTE_PREFIX}/publisher/members`,
        icon: "",
        src: members_icon_normal,
        activeIcon: members_icon_active
    },
    {
        name: "INBOX",
        link: `${ROUTE_PREFIX}/publisher/inbox`,
        icon: "",
        src: inbox_icon_normal,
        activeIcon: inbox_icon_active
    },
    {
        name: "HELP",
        link: `${ROUTE_PREFIX}/publisher/help`,
        icon: "",
        src: help_icon_normal,
        activeIcon: help_icon_active
    }
];
export default menu_items;