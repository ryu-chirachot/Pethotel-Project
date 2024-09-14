<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pets extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'Pet_id';
    protected $fillable = ['User_id', 'Pet_name', 'Pet_type_id', 'Pet_age', 'Pet_breed', 'Pet_weight', 'Pet_Gender', 'VaccinationRecord','updated_at','deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function petType()
    {
        return $this->belongsTo(Pet_Type::class, 'Pet_type_id');
    }
}
