<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pets extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pets';
    protected $primaryKey = 'Pet_id';
    protected $fillable = ['User_id', 'Pet_name', 'Pet_type_id', 'Pet_age', 'Pet_breed', 'Pet_weight', 'Pet_Gender', 'additional_info','updated_at','deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class,'User_id' ,'id');
    }

    public function petType()
    {
        return $this->belongsTo(Pet_Type::class, 'Pet_type_id');
    }

    public function bookings(){
        return $this->hasMany(Bookings::class,'Pet_id','Pet_id');
    }


}
