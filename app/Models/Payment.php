<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Payment extends Model
{
    protected $fillable = [
        'reference',
        'client_name',
        'amount',
        'payment_method',
        'date',
        'notes',
        'status'
    ];
    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2'
    ];
}