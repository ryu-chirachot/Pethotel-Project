<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PetStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pet_status';
    protected $primaryKey = 'PetStatusID';
    protected $fillable = [
        'BookingOrderID', 'Report','status','imgreport','updated_at','deleted_at'
    ];

    public function booking()
    {
    return $this->belongsTo(Bookings::class, 'BookingOrderID', 'BookingOrderID');
    }


    public function user()
    {
        return $this->belongsTo(User::class,'Admin_id' ,'id');
    }
}
