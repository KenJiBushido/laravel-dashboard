<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    //
    protected $with = ['student', 'subject'];

    public function student(){
        return $this->belongsTo('App\Student');

    }

    public function subject(){
        return $this->belongsTo('App\Subject');

    }
}
