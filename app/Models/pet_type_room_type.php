<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pet_type_room_type extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pet_type_room_type';

    // Specify the correct primary key
    protected $primaryKey = 'Pet_Room_typeID'; // Adjust this to your actual primary key column

    protected $fillable = [
        'Rooms_type_id', 'Pet_type_id', 'Rooms_type_description', 'Room_price', 'ImagesID','updateat','deleteat'
    ];

    public function roomType()
    {
    return $this->belongsTo(Rooms_Type::class, 'Rooms_type_id');
    }

    public function petType()
    {
        return $this->belongsTo(Pet_Type::class, 'Pet_type_id');
    }

    public function image()
    {
        return $this->belongsTo(Images::class, 'ImagesID');
    }

    public function rooms()
    {
        return $this->hasMany(Rooms::class, 'Rooms_id');
    }
}
