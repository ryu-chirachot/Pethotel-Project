<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookings extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'bookings';
    protected $primaryKey = 'BookingOrderID';
    protected $fillable = [
        'BookingOrderID','Pet_id', 'User_id', 'Rooms_id', 'Start_date', 'End_date', 'Booking_date', 'Booking_status', 'Price', 'PaymentMethodID', 'PaymentDate','updated_at','deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'User_id' ,'id');
    }

    public function pet() 
    {
        return $this->belongsTo(Pets::class, 'Pet_id'); 
    }

    public function room()
    {
        return $this->belongsTo(Rooms::class, 'Rooms_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'PaymentMethodID');
    }

    public function review()
    {
        return $this->hasOne(Reviews::class, 'BookingOrderID', 'BookingOrderID');
    }


    public function pet_status()
    {
        return $this->hasMany(PetStatus::class, 'BookingOrderID', 'BookingOrderID');
    }

}
