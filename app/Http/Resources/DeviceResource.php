<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class DeviceResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $device = parent::toArray($request);
        $icon = $this->getIcon();
        if ($icon) {
            $device['icon'] = $icon;
        } else {
            $device['icon'] = url('/images/device_no_icon.png');
        }
        return $device;
    }
}
