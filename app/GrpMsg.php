<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrpMsg extends Model
{
    protected $guarded = [];
    protected $table = 'grpmsgs';

    public function sender()
    {
        return $this->hasOne('User');
    }

    public function receiver()
    {
        return $this->hasOne('Group');
    }
}
