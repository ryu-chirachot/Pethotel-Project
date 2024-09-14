<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pet_type extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pet_type';
    protected $primaryKey = 'pet_type_id';
    protected $fillable = ['Pet_nametype','updated_at','deleted_at'];

    public function pets()
    {
        return $this->hasMany(Pets::class, 'Pet_type_id');
    }

    public function petRoomTypes()
    {
        return $this->hasMany(pet_type_room_type::class, 'Pet_type_id');
    }

}
