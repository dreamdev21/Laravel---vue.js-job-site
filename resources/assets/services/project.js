const StatusMap = {
  "pending approval": 1,
  "pending payment": 2,
  running: 3,
  completed: 4
};
export function isProjectApproved(status) {
  if (!status) {
    return false;
  }
  const statusWeight = StatusMap[status.toLowerCase()];
  return statusWeight && statusWeight > 1;
}

export function isProjectRunning(status) {
  if (!status) {
    return false;
  }
  const statusWeight = StatusMap[status.toLowerCase()];
  return statusWeight && statusWeight > 2;
}

export function isProjectCompleted(status) {
  if (!status) {
    return false;
  }
  const statusWeight = StatusMap[status.toLowerCase()];
  return statusWeight && statusWeight > 3;
}
