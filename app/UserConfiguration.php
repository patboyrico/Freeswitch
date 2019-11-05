<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserConfiguration extends Model
{


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency_id()
    {
        return $this->belongsTo(Currency::class);
    }

    public function country_id()
    {
        return $this->belongsTo(Country::class);
    }



}
