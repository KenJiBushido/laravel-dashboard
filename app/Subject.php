<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    public function studies(){
        return $this->hasMany('App\Study');
        
    }
}
