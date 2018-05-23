<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    public function studies(){
        return $this->hasMany('App\Study');
        // return $this->hasMany(Study::class); //or use this way
        
    }
}
