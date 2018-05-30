import admin_layout_routes from "./layout";
import tester_layout_routes from "./tester_layout";
import publisher_layout_routes from "./publisher_layout";
import {
    isLoggedIn,
    isAdmin,
    hasTesterRole,
    hasPublisherRole,
    isUserActive,
    isApprovedTester
} from "src/services/auth";
import AdminLogin from "pages/login";
import TesterLogin from "pages/tester/login";
import { ROUTE_PREFIX } from "./router-prefix";

const routes = [{
    path: ROUTE_PREFIX,
    meta: { title: "TheBetaPlan Portal" },
    component: { template: "<router-view />" },
    children: [
        { path: ``, redirect: `login` },
        { path: `admin"`, redirect: `admin/login` },
        {
            path: `admin`,
            component: resolve => require(["src/layout"], resolve),
            children: admin_layout_routes,
            beforeEnter(to, from, next) {
                return isLoggedIn()
                    .then(() => {
                        if (isAdmin()) {
                            return next();
                        }
                        return next({ name: "login" });
                    })
                    .catch(() => next({ name: "admin.login" }));
            },
            name: "admin"
        },
        {
            path: `admin/login`,
            unsecure: true,
            name: "admin.login",
            component: AdminLogin,
            meta: {
                title: "Login"
            },
            beforeEnter(to, from, next) {
                return isLoggedIn()
                    .then(() => {
                        if (isAdmin()) {
                            return next({ name: "admin.dashboard" });
                        }
                        logout();
                        return next({ name: "login" });
                    })
                    .catch(() => next());
            }
        },
        {
            path: `login`,
            unsecure: true,
            name: "login",
            component: TesterLogin,
            meta: {
                title: "Login"
            },
            beforeEnter(to, from, next) {
                return isLoggedIn()
                    .then(() => {
                        if (hasTesterRole()) {
                            if (isUserActive() || isApprovedTester()) {
                                this.$router.push({ name: "tester.dashboard" });
                            } else {
                                this.$router.push({ name: "tester.welcome" });
                            }
                        }
                        logout();
                        return next();
                    })
                    .catch(() => next());
            }
        },
        {
            path: `tester`,
            component: resolve => require(["src/tester_layout"], resolve),
            children: tester_layout_routes,
            beforeEnter(to, from, next) {
                return isLoggedIn()
                    .then(() => {
                        if (hasTesterRole()) {
                            return next();
                        }
                        logout();
                        return next({ name: "login" });
                    })
                    .catch(() => next({ name: "login" }));
            },
            name: "tester"
        },
        {
            path: `publisher`,
            component: resolve => require(["src/publisher_layout"], resolve),
            children: publisher_layout_routes,
            beforeEnter(to, from, next) {
                return isLoggedIn()
                    .then(() => {
                        if (hasPublisherRole()) {
                            return next();
                        }
                        logout();
                        return next({ name: "login" });
                    })
                    .catch(() => next({ name: "login" }));
            },
            name: "publisher"
        },
        {
            path: `register`,
            component: resolve => require(["pages/register"], resolve),
            unsecure: true,
            meta: {
                title: "register"
            },
            beforeEnter(to, from, next) {
                return isLoggedIn()
                    .then(() => next({ name: "admin.dashboard" }))
                    .catch(next);
            }
        },
        {
            path: `forgotpassword`,
            component: resolve => require(["pages/forgotpassword"], resolve),
            unsecure: true,
            meta: {
                title: "Forgot Password"
            },
            beforeEnter(to, from, next) {
                return isLoggedIn()
                    .then(() => next({ name: "admin.dashboard" }))
                    .catch(() => next());
            },
            name: "forgetpassword"
        },
        {
            path: `reset_password`,
            component: resolve => require(["pages/reset_password"], resolve),
            unsecure: true,
            meta: {
                title: "Reset Password"
            },
            beforeEnter(to, from, next) {
                return isLoggedIn()
                    .then(() => next({ name: "admin.dashboard" }))
                    .catch(() => next());
            }
        },
        {
            path: `lockscreen`,
            component: resolve => require(["pages/lockscreen"], resolve),
            meta: {
                title: "Lockscreen"
            }
        },
        {
            path: `500`,
            component: resolve => require(["pages/500"], resolve),
            unsecure: true,
            meta: {
                title: "500"
            }
        },
        {
            path: "*",
            component: resolve => require(["pages/404"], resolve),
            unsecure: true,
            meta: {
                title: "404"
            }
        }
    ]
}];
export default routes;