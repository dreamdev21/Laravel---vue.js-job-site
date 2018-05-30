<?php

namespace App\Models;

use Spatie\ModelStatus\Status as ParentStatus;

class Status extends ParentStatus
{
    const ACTIVE = 'Active';
    const DEACTIVE = 'Deactive';
    const PENDING_ACTIVATION = 'Pending Activated';
    const PENDING_NDA = 'Pending NDA';
    const STEP_1 = 'Step_1';
    const STEP_2 = 'Step_2';
    const REJECTED_NDA = 'Rejected NDA';
    const READY_FOR_TEST = 'Ready for Test';
    const UNDER_REVIEW = 'Under Review';
    const REJECTED = 'Rejected';
    const RUNNING = 'Running';
    const PENDING_APPROVAL = 'Pending Approval';
    const PENDING_PAYMENT = 'Pending Payment';
    const COMPLETED = 'Completed';
    const UNPAID = 'unpaid Projects - pending payments to receive';
    /** START tester Test status */
    const ACCEPTED = 'Accepted';
    const SUBMITTED = 'Submitted';
    const REVIEW = 'Review';
    const TEST_PASSED = 'Test Passed';
    const TEST_FAILED = 'Test Failed';

    const WITHDRAWAL_SUBMITTED = 'WITHDRAWAL_SUBMITTED';

    /** END tester Test status */
    protected $fillable = ['name'];


    /**
     *  dynamic status name
     */

    public static function getStatusConstant($name)
    {
        return constant('App\Models\Status::' . $name);
    }
}
