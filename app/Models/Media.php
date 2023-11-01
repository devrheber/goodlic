<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'size', 'file_type', 'url','booking_appointment_id'];
    public function appointments(){
        return $this->belongsTo(BookAppointment::class,'booking_appointment_id','id');
    }
}
