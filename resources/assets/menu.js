import { ROUTE_PREFIX } from "src/router/router-prefix";
import dashboard_icon_active from "src/assets/img/admin-dashboard-icon-active.png";
import dashboard_icon_normal from "src/assets/img/admin-dashboard-icon.png";
import projects_icon_normal from "src/assets/img/admin-projects-icon.png";
import projects_icon_active from "src/assets/img/admin-projects-icon-active.png";
import publishers_icon_normal from "src/assets/img/admin-publishers-icon.png";
import publishers_icon_active from "src/assets/img/admin-publishers-icon-active.png";
import testers_icon_normal from "src/assets/img/admin-tester-icon.png";
import testers_icon_active from "src/assets/img/admin-tester-icon-active.png";
import finance_icon_normal from "src/assets/img/admin-finance-icon.png";
import finance_icon_active from "src/assets/img/admin-finance-icon-active.png";
import members_icon_normal from "src/assets/img/admin-members-icon.png";
import members_icon_active from "src/assets/img/admin-members-icon-active.png";
import profile_icon_normal from "src/assets/img/admin-profile-icon.png";
import profile_icon_active from "src/assets/img/admin-profile-icon-active.png";
import test_project_icon_normal from "src/assets/img/admin-test-project-icon.png";
import test_project_icon_active from "src/assets/img/admin-test-project-icon-active.png";
import inbox_icon_normal from "src/assets/img/admin-inbox-icon.png";
import inbox_icon_active from "src/assets/img/admin-inbox-icon-active.png";
import help_icon_normal from "src/assets/img/admin-help-icon.png";
import help_icon_active from "src/assets/img/admin-help-icon-active.png";


const menu_items = [{
        name: "Dashboard",
        link: `${ROUTE_PREFIX}/admin/dashboard`,
        icon: "",
        src: dashboard_icon_normal,
        activeIcon: dashboard_icon_active
    },
    {
        name: "Projects",
        link: `${ROUTE_PREFIX}/admin/projects`,
        icon: "",
        src: projects_icon_normal,
        activeIcon: projects_icon_active
    },
    {
        name: "Test Projects",
        link: `${ROUTE_PREFIX}/admin/test-projects`,
        icon: "",
        src: test_project_icon_normal,
        activeIcon: test_project_icon_active
    },
    {
        name: "Publishers",
        link: `${ROUTE_PREFIX}/admin/publishers`,
        icon: "",
        src: publishers_icon_normal,
        activeIcon: publishers_icon_active
    },
    {
        name: "Testers",
        link: `${ROUTE_PREFIX}/admin/testers`,
        icon: "",
        src: testers_icon_normal,
        activeIcon: testers_icon_active
    },
    {
        name: "Finances",
        link: `${ROUTE_PREFIX}/admin/finance`,
        icon: "",
        src: finance_icon_normal,
        activeIcon: finance_icon_active
    },
    {
        name: "Members",
        link: `${ROUTE_PREFIX}/admin/members`,
        icon: "",
        src: members_icon_normal,
        activeIcon: members_icon_active
    },
    {
        name: "Inbox",
        link: `${ROUTE_PREFIX}/`,
        icon: "",
        src: inbox_icon_normal,
        activeIcon: inbox_icon_active
    },
    {
        name: "Packages",
        link: `${ROUTE_PREFIX}/admin/packages`,
        icon: "",
        src: finance_icon_normal,
        activeIcon: finance_icon_active
    },
    {
        name: "Devices",
        link: `${ROUTE_PREFIX}/admin/devices`,
        icon: "",
        src: projects_icon_normal,
        activeIcon: projects_icon_active
    },
    {
        name: "Project type",
        link: `${ROUTE_PREFIX}/admin/project-type`,
        icon: "",
        src: projects_icon_normal,
        activeIcon: projects_icon_active
    },

];
export default menu_items;