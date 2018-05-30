export function isLoggedIn() {
  return new Promise((resolve, reject) => {
    axios
      .get(
        "/api/user",
        localStorage.getItem("access_token")
          ? {
              headers: {
                Authorization: `Bearer ${localStorage.getItem("access_token")}`
              }
            }
          : {}
      )
      .then(res => {
        window.USER = res.data.data;
        window.VueApp.$store.commit("set_user", res.data.data);
        resolve();
      }, reject);
  });
}

export function isUserActive() {
  return window.USER.is_active;
}

export function isApprovedTester() {
  return window.USER.is_approved_tester;
}

export function latestProjectStatus(){
  if(window.USER.latest_project_status){
    return window.USER.latest_project_status.name.toLowerCase();
  }
  return false;
}

export function logout() {
  localStorage.removeItem("access_token");
  window.USER = null;
}

export function hasTesterRole() {
  if (!window.USER) {
    return false;
  }
  const roles = window.USER.roles;
  const role = roles.find(({ name }) => name === "tester");
  return role && role.id !== undefined;
}

export function hasPublisherRole() {
  if (!window.USER) {
    return false;
  }
  const roles = window.USER.roles;
  const role = roles.find(({ name }) => name === "publisher");
  return role && role.id !== undefined;
}

export function isAdmin() {
  if (!window.USER) {
    return false;
  }
  const roles = window.USER.roles;
  const role = roles.find(({ name }) => name === "admin");
  return role && role.id !== undefined;
}
