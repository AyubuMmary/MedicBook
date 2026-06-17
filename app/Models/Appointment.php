<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'appointment_id', 'patient_id', 'doctor_id',
        'appointment_date', 'appointment_time',
        'status', 'symptoms'
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}