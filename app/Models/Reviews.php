<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reviews extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'reviews';
    protected $primaryKey = 'Review_id';
    protected $fillable = [
        'BookingOrderID', 'Rating', 'content','updated_at','deleted_at'
    ];

    public function booking()
    {
        return $this->belongsTo(Bookings::class, 'BookingOrderID');
    }

    
}
