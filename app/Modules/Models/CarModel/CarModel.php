<?php

namespace App\Modules\Models\CarModel;

use App\Modules\Models\Car\Car;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'car_id',
        'slug',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
