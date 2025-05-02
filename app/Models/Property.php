<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    protected $guarded = [];

    protected $casts = [
        'images'            => 'array',
        'children_allowed'  => 'boolean',
        'pets_allowed'      => 'boolean',
    ];
}
