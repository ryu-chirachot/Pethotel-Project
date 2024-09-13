<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reviews extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'Review_id';

    protected $fillable = [
        'BookingOrderID', 'Rating', 'comment','updateat','deleteat'
    ];

    public function booking()
    {
        return $this->belongsTo(Bookings::class, 'BookingOrderID');
    }

    
}
