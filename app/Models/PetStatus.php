<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PetStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'BookingOrderID', 'Report','updateat','deleteat'
    ];

    public function booking()
    {
        return $this->belongsTo(Bookings::class, 'PetStatusID');
    }
}
