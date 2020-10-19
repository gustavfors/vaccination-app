<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;

    protected $dates = [
        'date',
        'expire',
        'time'
    ];

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile', 'profile_id');
    }

    public function vaccine()
    {
        return $this->belongsTo('App\Models\Vaccine', 'vaccine_id');
    }

}
