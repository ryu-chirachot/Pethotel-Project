<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User_pethotel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "user_pethotel";
    protected $primaryKey = "User_id";
    protected $fillable = ["Name", "User_email", "User_password", "Tel", "User_Role", "created_at", "updated_at"];
}
