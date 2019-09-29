<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];

    public function admin()
    {
        return $this->hasOne('User');
    }
}
