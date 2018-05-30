<?php

namespace App\Models;

use Spatie\MediaLibrary\Media as ParentMedia;

class Media extends ParentMedia
{
    protected $append = ['url'];
    protected $hidden = ['model_id', 'model_type'];
    public function getUrlAttribute()
    {
        return $this->getFullUrl();
    }
}
