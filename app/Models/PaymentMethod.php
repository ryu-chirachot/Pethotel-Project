<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'PaymentMethodID';
    protected $fillable = [
        'PaymentName','updated_at','deleted_at'
    ];

    public function bookings()
    {
        return $this->hasMany(Bookings::class, 'PaymentMethodID');
    }
}
