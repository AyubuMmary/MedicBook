<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'appointment_id', 'user_id', 'amount',
        'stripe_payment_id', 'status'
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}