<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['user_id', 'name', 'detail', 'regency_id', 'phone'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function regency()
    {
        return $this->belongsTo('App\Regency');
    }
}
