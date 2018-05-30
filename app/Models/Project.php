<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;
use Spatie\Activitylog\Traits\LogsActivity;
use App\TheBetaPlan\Traits\HasInvoice;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use App\TheBetaPlan\Traits\HasRatings;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Project extends Model implements HasMedia
{
    use SoftDeletes, HasStatuses, LogsActivity, HasInvoice, HasMediaTrait, HasRatings;

    protected $table = 'projects';
    protected $fillable = [
        'name', 'publisher_id', 'project_description', 'project_type_id', 'amount', 'estimate_tester_time', 'start_date', 'tester_needed', 'is_test_project', 'end_date', 'notes_instruction', 'created_at'
    ];

    protected $append = ['status'];

    protected $casts = [
        'cost_per_tester' => 'float',
        'total_cost' => 'float',
        'applied_discount' => 'float'
    ];

    protected static $logOnlyDirty = true;

    public function publisher()
    {
        return $this->belongsTo(User::class, 'publisher_id');
    }

    public function status()
    {
        return $this->hasMany(Status::class, 'model_id');
    }

    public function projectType()
    {
        return $this->belongsTo(ProjectType::class, 'project_type_id');
    }

    public function devices()
    {
        return $this->belongsToMany(Device::class, 'project_devices')->withTimestamps();
    }

    public function links()
    {
        return $this->hasMany(ProjectLink::class, 'project_id');
    }

    public function questions()
    {
        return $this->hasMany(ProjectQuestion::class);
    }

    /** Given test related data */
    public function testers()
    {
        return $this->belongsToMany(User::class, 'project_testers', 'project_id', 'tester_id')->using(ProjectTester::class)
            ->withPivot(['id'])
            ->withTimestamps();
    }

    public function testerProjects()
    {
        return $this->hasMany(ProjectTester::class, 'project_id');
    }
    /**
     * methods
     */
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    // invoice related methods
    public function getInvoiceCustomerId()
    {
        return $this->publisher->id;
    }

    public function getAmount()
    {
        return $this->total_cost - $this->applied_discount;
    }

    public function scopeCurrentStatusIn(Builder $builder, array $names)
    {
        $builder->where(function ($q) use ($names) {
            foreach ($names as $name) {
                $q->orWhereHas('statuses', function (Builder $query) use ($name) {
                    $query
                        ->where('name', $name)
                        ->whereIn('id', function (QueryBuilder $query) use ($name) {
                            $query
                                ->select(\DB::raw('max(id)'))
                                ->from($this->getStatusTableName())
                                ->where('model_type', static::class)
                                ->groupBy('model_id');
                        });
                });
            }
        });
    }
}
