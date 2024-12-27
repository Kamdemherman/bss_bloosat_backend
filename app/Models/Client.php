<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'type',
        'status',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}