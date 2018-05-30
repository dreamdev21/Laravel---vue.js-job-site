import {
  isReadyForTest,
  hasClearedStep1,
  hasClearedStep2
} from "src/services/tester";

const layout = [
  {
    path: "/",
    redirect: "dashboard"
  },
  {
    path: "dashboard",
    component: resolve => require(["pages/tester/dashboard"], resolve),
    meta: {
      title: "Dashboard"
    },
    name: "tester.dashboard",
    beforeEnter(to, from, next) {
      if (
        window.USER.is_approved_tester ||
        isReadyForTest(window.USER.status.name) ||
        hasClearedStep2(window.USER.status.name)
      ) {
        next();
      } else {
        if (hasClearedStep1(window.USER.status.name)) {
          next({ name: "tester.step2" });
        } else {
          next({ name: "tester.step1" });
        }
      }
    }
  },
  {
    path: "projects",
    component: resolve => require(["pages/tester/projects"], resolve),
    meta: {
      title: "Projects"
    },
    name: "tester.projects"
  },
  {
    path: "step-1",
    component: resolve => require(["pages/tester/step1"], resolve),
    meta: {
      title: "Step-1"
    },
    name: "tester.step1"
  },
  {
    path: "step-2",
    component: resolve => require(["pages/tester/step2"], resolve),
    meta: {
      title: "Step2"
    },
    name: "tester.step2",
    beforeEnter(to, from, next) {
      if (hasClearedStep1(window.USER.status.name)) {
        next();
      } else {
        next({ name: "tester.unauthorized" });
      }
    }
  },
  {
    path: "welcome",
    component: resolve => require(["pages/tester/welcome"], resolve),
    meta: {
      title: "Welcome"
    },
    name: "tester.welcome"
  },
  {
    path: "unauthorised",
    component: resolve => require(["pages/tester/unauthorised"], resolve),
    meta: {
      title: "Unauthorised Action"
    },
    name: "tester.unauthorized"
  },
  {
    path: "thank-you",
    component: resolve => require(["pages/tester/thank-you"], resolve),
    meta: {
      title: "Thank You"
    },
    name: "tester.thank-you"
  },
  {
    path: "nda-policy",
    component: resolve => require(["pages/tester/nda-policy"], resolve),
    meta: {
      title: "NDA Policy"
    },
    name: "tester.nda-policy"
  },
  {
    path: "test-project-fillup",
    component: resolve =>
      require(["pages/tester/test-project-fillup"], resolve),
    meta: {
      title: "Test Project Fillup"
    },
    name: "tester.test-project-fillup"
  },
  {
    path: "project-fillup",
    component: resolve => require(["pages/tester/project-fillup"], resolve),
    meta: {
      title: "Project Fillup"
    },
    name: "tester.project-fillup"
  },
  {
    path: "project-fillup-accepted",
    component: resolve =>
      require(["pages/tester/project-fillup-accepted"], resolve),
    meta: {
      title: "Project Fillup Accepted"
    },
    name: "tester.test-project-fillup-accepted"
  },
  {
    path: "project-list",
    component: resolve => require(["pages/tester/project-list"], resolve),
    meta: {
      title: "Project list"
    },
    name: "tester.project-list"
  },
  {
    path: "project/:id/view",
    component: resolve => require(["pages/tester/project_view"], resolve),
    meta: {
      title: "Project View"
    },
    name: "tester.project.view"
  },
  {
    path: "test-project/:id/submission",
    component: resolve => require(["pages/tester/project-submission"], resolve),
    meta: {
      title: "Project Submission"
    },
    name: "tester.project-submission"
  },
  {
    path: "test-project/:id/view-submission",
    component: resolve =>
      require(["pages/tester/project-view-submission"], resolve),
    meta: {
      title: "Project View Submission"
    },
    name: "tester.project-view-submission"
  },
  {
    path: "project-test/:id",
    component: resolve => require(["pages/tester/project-test"], resolve),
    meta: {
      title: "Project Test"
    },
    name: "tester.project-test"
  },
  // {
  //   path: "project-review/:id",
  //   component: resolve => require(["pages/tester/project-review"], resolve),
  //   meta: {
  //     title: "Project Review"
  //   },
  //   name: "tester.project-review"
  // },
  {
    path: "project-submitted/:id",
    component: resolve => require(["pages/tester/project-submitted"], resolve),
    meta: {
      title: "Project Submitted"
    },
    name: "tester.project-submitted"
  },
  {
    path: "profile",
    component: resolve => require(["pages/tester/profile"], resolve),
    meta: {
      title: "Tester Profile"
    },
    name: "tester.tester-profile"
  },
  {
    path: "edit-profile",
    component: resolve => require(["pages/tester/edit-profile"], resolve),
    meta: {
      title: "Tester Edit Profile"
    },
    name: "tester.edit-profile"
  },
  {
    path: "devices-list",
    component: resolve => require(["pages/tester/tester-devices"], resolve),
    meta: {
      title: "My Devices"
    },
    name: "tester.devices"
  },
  {
    path: "payments",
    component: resolve => require(["pages/tester/payments"], resolve),
    meta: {
      title: "Payments"
    },
    name: "tester.payments"
  },
  {
    path: "payment-methods",
    component: resolve => require(["pages/tester/payment-methods"], resolve),
    meta: {
      title: "Payment methods"
    },
    name: "tester.payment-methods"
  },
  {
    path: "settings",
    component: resolve => require(["pages/tester/settings"], resolve),
    meta: {
      title: "Settings"
    },
    name: "tester.settings"
  },
  {
    path: "setting/change-password",
    component: resolve => require(["pages/tester/change-password"], resolve),
    meta: {
      title: "Change Password"
    },
    name: "tester.change-password"
  },
  {
    path: "add-system",
    component: resolve => require(["pages/tester/add-system"], resolve),
    meta: {
      title: "Add System"
    },
    name: "tester.add-system"
  },
  {
    path: "systems/:id/edit",
    component: resolve => require(["pages/tester/add-system"], resolve),
    meta: {
      title: "Edit System"
    },
    name: "tester.system.edit"
  }
];
export default layout;
