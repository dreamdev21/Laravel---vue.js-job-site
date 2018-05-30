const layout = [
    {
        path: "/",
        redirect: "dashboard"
    },{
        path: "dashboard",
        component: resolve =>
            require(["pages/publisher/project_dashboard"], resolve),
        meta: {
            title: "Dashboard"
        },
        name: "publisher.dashboard"
    },
    {
        path: "dashboard-standard",
        component: resolve =>
            require(["pages/publisher/dashboard-standard"], resolve),
        meta: {
            title: "Dashboard Standard"
        },
        name: "publisher.dashboard-standard"
    },
    {
        path: "add-project",
        component: resolve =>
            require(["pages/publisher/add-project"], resolve),
        meta: {
            title: "Add Project"
        },
        name: "publisher.add-project"
    },
    {
        path: "projects",
        component: resolve => require(["pages/publisher/project_list"], resolve),
        meta: {
            title: "My Projects"
        },
        name: "publisher.projects"
    },
    {
        path: "projects/add",
        component: resolve => require(["pages/publisher/project_post"], resolve),
        meta: {
            title: "Post Project"
        },
        name: "publisher.project.add"
    },
    {
        path: "project/:id/edit",
        component: resolve => require(["pages/publisher/project_post"], resolve),
        meta: {
            title: "Edit Project"
        },
        name: "publisher.project.edit"
    },
    {
        path: "project/:id/view",
        component: resolve => require(["pages/publisher/project_view"], resolve),
        meta: {
            title: "View Project"
        },
        name: "publisher.project.view"
    },
    {
        path: "project/:id/invoice",
        component: resolve =>
            require(["pages/publisher/project_invoice_view"], resolve),
        meta: {
            title: "View Invoice"
        },
        name: "publisher.project.invoice"
    },
    {
        path: "finance",
        component: resolve => require(["pages/publisher/finance"], resolve),
        meta: {
            title: "Finance"
        },
        name: "publisher.finance"
    },
    {
        path: "payment-methods",
        component: resolve => require(["pages/publisher/payment-methods"], resolve),
        meta: {
            title: "Payment Methods"
        },
        name: "publisher.publisher-payment-methods"
    },
    {
        path: "setting/change-password",
        component: resolve =>
            require(["pages/publisher/change-password"], resolve),
        meta: {
            title: "Change Password"
        },
        name: "publisher.change-password"
    },
    {
        path: "settings",
        component: resolve =>
            require(["pages/publisher/settings"], resolve),
        meta: {
            title: "Settings"
        },
        name: "publisher.settings"
    },
    {
        path: "members",
        component: resolve => require(["pages/publisher/members"], resolve),
        meta: {
            title: "Members"
        },
        name: "publisher.members"
    },
    {
        path: "members/add",
        component: resolve => require(["pages/publisher/add-member"], resolve),
        meta: {
            title: "Add Member"
        },
        name: "publisher.add-member"
    },
    {
        path: "profile",
        component: resolve => require(["pages/publisher/profile"], resolve),
        meta: {
            title: "Publisher Profile"
        },
        name: "publisher.profile"
    },
    // {
    //     path: "project/:id/edit",
    //     component: resolve => require(["pages/publisher/project_post"], resolve),
    //     meta: {
    //         title: "Edit Project"
    //     },
    //     name: "publisher.project.edit"
    // },

];
export default layout;