<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    //

    protected $fillable = ['name', 'location', 'representative_id'];

    public function representative()
    {
        return $this->belongsTo(User::class, 'representative_id');
    }
    public function aids()
    {
        return $this->hasMany(Aid::class);
    }
    public function aidDistributions()
    {
        return $this->hasMany(AidDistribution::class);
    }

}
