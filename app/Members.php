<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    //
    protected $table= 'members';

    public function scopeSearch($query, $s) {
        return $query->where('name', 'like', '%' .$s. '%')
                    ->orwhere('surname', 'like', '%' .$s. '%');
                    //->orwhere('surname', 'like', '%' .$s. '%');
                    //
    }
}
