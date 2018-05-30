<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = parent::toArray($request);
        $user['date_of_birth'] = optional($this->date_of_birth)->toDateString();
        $user['status'] = $this->statuses->first();
        $user['is_active'] = $this->getIsActive();
        $user['is_approved_tester'] = $this->getIsApprovedTester();
        $user['latest_project_status'] = $this->latestProjectStatus();
        $user['full_name'] = $this->fullName;
        $user['profile'] = $this->getProfileImage();
        $user['rating'] = $this->ratings;
        $user['default_paypal_email'] = $this->default_paypal_email;
        return $user;
    }
}
