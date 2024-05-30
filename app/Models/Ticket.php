<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'visit_date',
        'ticket_count',
        'promo_code',
        'total_price',
        'status',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(UserCustomer::class, 'user_id', 'id');
    }
}
