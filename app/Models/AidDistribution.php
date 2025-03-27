<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AidDistribution extends Model
{
    //
    protected $fillable = ['beneficiary_id', 'warehouse_id', 'aid_type', 'received_at'];

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

}
