<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class WithdrawalResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data['status'] = $this->status;
        return $data;
    }
}
