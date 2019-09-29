<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P2PMsg extends Model
{
    protected $guarded = [];
    protected $table = 'p2pmsgs';

    public function sender()
    {
        return $this->hasOne('User');
    }

    public function receiver()
    {
        return $this->hasOne('User');
    }
}
