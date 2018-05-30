const TestProjectStatusMap = {
    "new": 1,
    "accepted": 2,
    // "submitted": 3,
    "under review": 3,
    "test passed": 4,
    "test failed": 4
};

export function testProjectStatusWeight(status) {
    if (!status) {
        return false;
    }
    if (status == "Submitted") {
        status = "under review";
    }
    let statusWeight = TestProjectStatusMap[status.toLowerCase()];
    return statusWeight;
}