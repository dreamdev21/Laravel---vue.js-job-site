<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;
use App\Models\Device;
use App\Models\ProjectTester;
use App\Models\Status;
use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;
use App\TheBetaPlan\Traits\HasRatings;
use Auth;

class User extends Authenticatable implements HasMediaConversions
{
    use HasApiTokens, Notifiable, HasRoles, SoftDeletes, HasStatuses, HasMediaTrait, HasRatings;

    protected $guard_name = 'web';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'date_of_birth'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'first_name', 'last_name', 'middle_name', 'mobile_no', 'date_of_birth', 'gender', 'address', 'city', 'pin_code', 'token', 'token_created_at', 'country_id', 'additional_information', 'image_name', 'company_name','package_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'statuses'
    ];

    protected $append = ['default_paypal_email'];

    public function isAdmin()
    {
        return $this->hasRole(Role::ADMIN);
    }

    public function isPublisher()
    {
        return $this->hasRole(Role::PUBLISHER);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function devices()
    {
        return $this->belongsToMany(Device::class, 'user_devices')->withTimestamps();
    }

    public function systems()
    {
        return $this->belongsToMany(System::class, 'user_systems');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /** Given test related data */
    public function project()
    {
        return $this->belongsToMany(Project::class, 'project_testers', 'tester_id', 'project_id')->using(ProjectTester::class)->withTimestamps();
    }

    public function publisherProjects()
    {
        return $this->hasMany(Project::class, 'publisher_id');
    }

    public function testerProjects()
    {
        return $this->hasMany(ProjectTester::class, 'tester_id');
    }

    public function projectAnswers()
    {
        return $this->belongsTo(ProjectQuestionTesterAnswer::class, 'tester_id');
    }
    /**
     * methods
     */

    public function latestProjectStatus()
    {
        return count($this->testerProjects) ? $this->testerProjects->last()->latestStatus() : null;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->date_of_birth)->diff(Carbon::now())->format('%y years');
    }

    public function getIsActive()
    {
        $latestActiveStatus = $this->latestStatus(Status::DEACTIVE, Status::ACTIVE);
        return $latestActiveStatus && $latestActiveStatus->name == Status::ACTIVE ? true : false;
    }

    public function getIsApprovedTester()
    {
        $oProjectTester = ProjectTester::where('tester_id', $this->id)->first();
        return $oProjectTester && $oProjectTester->latestStatus(Status::TEST_PASSED) ? true : false;
    }

    public function getProfileImage()
    {
        if ($this->hasMedia('profile')) {
            return $this->getFirstMediaUrl('profile', 'thumb');
        }
        return url('images/user.jpg');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function earnings()
    {
        return $this->hasMany(TesterEarning::class, 'tester_id');
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class, 'tester_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'payer_id');
    }

    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class, 'owner_id');
    }

    public function createWallet()
    {
        if ($this->wallet) {
            throw new \Exception('wallet already exists');
        }
        $wallet = new Wallet();
        $wallet->user()->associate($this);
        $wallet->save();
        $this->wallet = $wallet;
        return $this->wallet;
    }

    public function getDefaultPaypalEmailAttribute()
    {
        $defualtPaymentMethod = $this->paymentMethods->first(function ($p) {
            return $p->is_default;
        });
        return optional($defualtPaymentMethod)->account_data;
    }
}
