const layout = [
    {
        path: "/",
        redirect: "dashboard"
    },{
        path: "dashboard",
        component: resolve => require(["pages/index"], resolve),
        meta: {
            title: "Dashboard"
        },
        name: "admin.dashboard"
    },
    {
        path: "admin-projects",
        component: resolve => require(["pages/admin-projects"], resolve),
        meta: {
            title: "Admin Projects"
        },
        name: "admin.admin-projects"
    },
    {
        path: "view-project",
        component: resolve => require(["pages/view-project"], resolve),
        meta: {
            title: "View Project"
        },
        name: "admin.view-project"
    },
    {
        path: "pending-payment-project",
        component: resolve => require(["pages/pending-payment-project"], resolve),
        meta: {
            title: "Pending Payment Project"
        },
        name: "admin.pending-payment-project"
    },
    {
        path: "running-project-detail",
        component: resolve => require(["pages/running-project-detail"], resolve),
        meta: {
            title: "Running Project Detail"
        },
        name: "admin.running-project-detail"
    },
    {
        path: "projects",
        component: resolve => require(["pages/projects/index"], resolve),
        meta: {
            title: "Projects"
        },
        name: "admin.projects"
    },
    {
        path: "project/:id/view",
        component: resolve => require(["pages/projects/view"], resolve),
        meta: {
            title: "View Project"
        },
        name: "admin.project.view"
    },
    {
        path: "project/:id/edit",
        component: resolve =>
            require(["pages/publisher/project_post"], resolve),
        meta: {
            title: "Edit Project"
        },
        name: "admin.project.edit"
    },
    {
        path: "project/:id/invoice",
        component: resolve => require(["pages/projects/invoice"], resolve),
        meta: {
            title: "View Project Invoice"
        },
        name: "admin.project.invoice"
    },
    {
        path: "testers",
        component: resolve => require(["pages/testers_list"], resolve),
        meta: {
            title: "Testers"
        },
        name: "admin.tester"
    },
    {
        path: "testers/add",
        component: resolve => require(["pages/add_edit_tester"], resolve),
        meta: {
            title: "Add Tester"
        },
        name: "admin.add_tester"
    },
    {
        path: "testers/:id/edit",
        component: resolve => require(["pages/add_edit_tester"], resolve),
        meta: {
            title: "Edit Tester"
        },
        name: "admin.tester.edit"
    },
    {
        path: "testers/:id/profile",
        component: resolve => require(["pages/tester_profile"], resolve),
        meta: {
            title: "Tester Profile"
        },
        name: "admin.tester.profile"
    },
    {
        path: "publishers",
        component: resolve => require(["pages/publisher/list"], resolve),
        meta: {
            title: "Publishers List"
        },
        name: "admin.publisher"
    },
    {
        path: "publishers/add",
        component: resolve => require(["pages/publisher/add"], resolve),
        meta: {
            title: "Add Publisher"
        },
        name: "admin.add_publisher"
    },
    {
        path: "publishers/:id/edit",
        component: resolve => require(["pages/publisher/add"], resolve),
        meta: {
            title: "Edit Publisher"
        },
        name: "admin.publisher.edit"
    },
    {
        path: "publishers/:id/profile",
        component: resolve => require(["pages/publisher/profile"], resolve),
        meta: {
            title: "Publisher Profile"
        },
        name: "admin.publisher.profile"
    },
    {
        path: "publishers/:id/projects",
        component: resolve =>
            require(["pages/publisher/publisher_projects"], resolve),
        meta: {
            title: "Publisher Projects"
        },
        name: "admin.publisher.projects"
    },
    {
        path: "testers/:id/projects",
        component: resolve => require(["pages/tester/tester_projects"], resolve),
        meta: {
            title: "Tester Projects"
        },
        name: "admin.tester.projects"
    },
    {
        path: "devices",
        component: resolve => require(["pages/device/list"], resolve),
        meta: {
            title: "Devices"
        },
        name: "admin.device"
    },
    {
        path: "devices/add",
        component: resolve => require(["pages/device/add"], resolve),
        meta: {
            title: "Add New Device"
        },
        name: "admin.add_new_device"
    },
    {
        path: "devices/:id/edit",
        component: resolve => require(["pages/device/add"], resolve),
        meta: {
            title: "Edit Device"
        },
        name: "admin.device.edit"
    },
    {
        path: "project-type",
        component: resolve => require(["pages/project-type/list"], resolve),
        meta: {
            title: "Project type"
        },
        name: "admin.project-type"
    },
    {
        path: "project-type/add",
        component: resolve => require(["pages/project-type/add"], resolve),
        meta: {
            title: "Add New Project Type"
        },
        name: "admin.projectType.add"
    },
    {
        path: "project-type/:id/edit",
        component: resolve => require(["pages/project-type/add"], resolve),
        meta: {
            title: "Edit Project Type"
        },
        name: "admin.projectType.edit"
    },
    {
        path: "test-projects",
        component: resolve =>
            require(["pages/test-project/test_project_list"], resolve),
        meta: {
            title: "Test Projects"
        },
        name: "admin.test_projects"
    },
    {
        path: "moderate-test-projects",
        component: resolve =>
            require(["pages/test-project/moderate_test_projects"], resolve),
        meta: {
            title: "Moderate Test Projects"
        },
        name: "admin.test_project.moderate"
    },
    {
        path: "test-project/add",
        component: resolve =>
            require(["pages/test-project/test_project_add"], resolve),
        meta: {
            title: "New Test Project"
        },
        name: "admin.test_project.add"
    },
    {
        path: "test-project/:id/edit",
        component: resolve =>
            require(["pages/test-project/test_project_add"], resolve),
        meta: {
            title: "Edit Test Project"
        },
        name: "admin.test_project.edit"
    },
    {
        path: "test-project/:id/view",
        component: resolve =>
            require(["pages/test-project/test_project_view"], resolve),
        meta: {
            title: "View Project"
        },
        name: "admin.test_project.view"
    },
    {
        path: "test-project/:id/view-submission",
        component: resolve =>
            require(["pages/test-project/test_project_submission"], resolve),
        meta: {
            title: "View Project Submission"
        },
        name: "admin.test_project.view-submission"
    },
    {
        path: "setting/change-password",
        component: resolve => require(["pages/change-password"], resolve),
        meta: {
            title: "Change Password"
        },
        name: "admin.change-password"
    },
    {
        path: "settings",
        component: resolve => require(["pages/settings"], resolve),
        meta: {
            title: "Settings"
        },
        name: "admin.settings"
    },
    {
        path: "packages",
        component: resolve => require(["pages/packages/index"], resolve),
        meta: {
            title: "Packages"
        },
        name: "admin.packages",
        children: [{
                path: "",
                component: resolve => require(["pages/packages/list"], resolve),
                meta: { title: "Packages" },
                name: "admin.packages.list"
            },
            {
                path: "add",
                component: resolve => require(["pages/packages/form"], resolve),
                meta: { title: "Add Package " },
                name: "admin.packages.add"
            },
            {
                path: ":id",
                component: resolve => require(["pages/packages/form"], resolve),
                meta: { title: "Edit Package " },
                name: "admin.packages.edit"
            }
        ]
    },
    {
        path: "members",
        component: resolve => require(["pages/members"], resolve),
        meta: {
            title: "Members"
        },
        name: "admin.members"
    },
    {
        path: "members/add",
        component: resolve => require(["pages/add-member"], resolve),
        meta: {
            title: "Add Member"
        },
        name: "admin.add_member"
    },
    {
        path: "finance",
        component: resolve => require(["pages/finance"], resolve),
        meta: {
            title: "Finance"
        },
        name: "admin.finance"
    },
    {
        path: "payment-methods",
        component: resolve => require(["pages/payment-methods"], resolve),
        meta: {
            title: "Payment Methods"
        },
        name: "admin.payment-methods"
    },
    {
        path: "tester-list",
        component: resolve => require(["pages/tester-list"], resolve),
        meta: {
            title: "Tester List"
        },
        name: "admin.tester-list"
    },
];

export default layout;