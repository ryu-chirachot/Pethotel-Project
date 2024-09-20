<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rooms extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'rooms';
    protected $primaryKey = 'Rooms_id';
    protected $fillable = [
        'Pet_Room_typeID', 'Rooms_status','updated_at','deleted_at'
    ];

    public function pet_Type_Room_Type()
    {
        return $this->belongsTo(Pet_type_room_type::class, 'Pet_Room_typeID');
    }

    public function bookings()
    {
        return $this->hasMany(Bookings::class, 'Rooms_id');
    }
}
