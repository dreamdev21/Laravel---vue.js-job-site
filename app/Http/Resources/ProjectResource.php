<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProjectResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $project = parent::toArray($request);
        $project['status'] = $this->statuses->first();
        $project['testers'] = UserResource::collection($this->whenLoaded('testers'));
        $project['media'] = MediaResource::collection($this->whenLoaded('media'));
        return $project;
    }
}
