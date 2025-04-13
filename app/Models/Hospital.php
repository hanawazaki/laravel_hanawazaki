<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
    protected $fillable = [
        'name',
        'address',
        'email',
        'phone_number'
    ];

    public function patients()
    {
        return $this->hasMany(Patient::class, 'hospital_id');
    }
}
