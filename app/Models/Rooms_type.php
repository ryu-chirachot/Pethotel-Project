<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Rooms_type extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'rooms_type';
    protected $primaryKey = 'Rooms_type_id';
    protected $fillable = ['Rooms_type_name','updated_at','deleted_at'];

    public function petTypes(): BelongsToMany
    {
        return $this->belongsToMany(Pet_type::class, 'Rooms')
                ->withTimestamps();
    }
}
