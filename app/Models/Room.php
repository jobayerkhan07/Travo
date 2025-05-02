<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
    protected $casts = [
        'room_images' => 'array',
    ];

    protected $fillable = [
        'vendor_id',
        'room_number',
        'property_name',
        'floor_number',
        'location',
        'room_size',
        'room_type',
        'num_beds',
        'max_capacity',
        'air_conditioning',
        'wifi',
        'balcony',
        'price_per_night',
        'extra_guest_price',
        'room_images',
        'available_from',
        'available_to',
    ];
}
