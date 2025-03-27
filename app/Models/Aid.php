<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aid extends Model
{
    //
    protected $fillable = [
        'name',
        'type',
        'quantity',
        'arrival_date',
        'warehouse_id',
        'organization_id'
    ];
    
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
