const StatusMap = {
  "pending activation": 1,
  step_1: 2,
  step_2: 3,
  'ready for test': 4
};
export function hasClearedStep1(status) {
  if (!status) {
    return false;
  }
  const statusWeight = StatusMap[status.toLowerCase()];
  return statusWeight && statusWeight > 1;
}

export function hasClearedStep2(status) {
  if (!status) {
    return false;
  }
  const statusWeight = StatusMap[status.toLowerCase()];
  return statusWeight && statusWeight > 2;
}

export function isReadyForTest(status) {
  if (!status) {
    return false;
  }
  const statusWeight = StatusMap[status.toLowerCase()];
  return statusWeight && statusWeight >= 4;
}
