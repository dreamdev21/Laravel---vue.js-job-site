<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;

class Device extends Model implements HasMediaConversions
{
    //
    use SoftDeletes, HasMediaTrait;
    protected $table = 'devices';
    protected $fillable = ['name', 'status'];
    protected $appends = ['icon'];
    /**
     * Always capitalize the first letter
     */
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->keepOriginalImageFormat()
            ->width(50)
            ->height(50);
    }

    public function getIcon()
    {
        return $this->getFirstMediaUrl('icon', 'thumb');
    }

    public function getIconAttribute()
    {
        return $this->getIcon() ? $this->getIcon() : url('/images/device_no_icon.png');
    }
}
