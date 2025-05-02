<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    protected $fillable = [
        'vendor_id',
        'owner_name',
        'owner_phone',
        'owner_email',
        'car_model',
        'capacity',
        'car_color',
        'plate_number',
        'air_conditioning',
        'images',
        'price_per_day',
        'price_per_week',
        'status'
    ];

    protected $casts = [
        'images' => 'array',
        'air_conditioning' => 'boolean',
    ];
}
