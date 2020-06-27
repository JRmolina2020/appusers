<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name'
    ];
    public function roles()
    {
        return $this->belongsToMany('App\Model\Role')->withTimestamps();
    }
}