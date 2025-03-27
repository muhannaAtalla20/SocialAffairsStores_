<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    //
    protected $fillable = ['name', 'national_id', 'phone', 'address'];

    public function aidDistributions()
    {
        return $this->hasMany(AidDistribution::class);
    }
}
