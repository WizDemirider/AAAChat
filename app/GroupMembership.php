<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMembership extends Model
{
    protected $guarded = [];
    protected $table = 'group_membership';
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne('User');
    }

    public function group()
    {
        return $this->hasOne('Group');
    }
}
