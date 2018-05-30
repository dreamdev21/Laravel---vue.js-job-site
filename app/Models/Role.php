<?php

namespace App\Models;

use Spatie\Permission\Models\Role as ParentRole;

class Role extends ParentRole
{
    const ADMIN = 'admin';
    const TESTER = 'tester';
    const PUBLISHER = 'publisher';

    protected $fillable = ['name'];

    public static function admin()
    {
        return (new static)->where('name', static::ADMIN)->firstOrFail();
    }

    public static function tester()
    {
        return (new static)->where('name', static::TESTER)->firstOrFail();
    }

    public static function publisher()
    {
        return (new static)->where('name', static::PUBLISHER)->firstOrFail();
    }
}
