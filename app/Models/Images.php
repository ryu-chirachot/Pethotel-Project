<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Images extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "images";
    protected $primaryKey = "ImagesID";
    protected $fillable = [
        'ImagesName', 'ImagesPath','updated_at','deleted_at'
    ];

    public function room()
    {
        return $this->hasOne(Rooms::class, 'ImageID');
    }

}
