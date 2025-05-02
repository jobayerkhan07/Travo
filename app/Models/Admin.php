<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // This extends the base User class which implements Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins';
    protected $fillable = [
        'username',
        'password',
    ];
}
