<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    //
    protected $fillable = ['name', 'country', 'contact_email'];

    public function aids()
    {
        return $this->hasMany(Aid::class);
    }
}
