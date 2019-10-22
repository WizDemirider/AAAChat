<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class P2PMsg extends Model
{
    protected $guarded = [];
    protected $table = 'p2pmsgs';

    public function sender()
    {
        return $this->hasOne('App\User');
    }

    public function receiver()
    {
        return $this->hasOne('App\User');
    }
}
