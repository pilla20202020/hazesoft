<?php

namespace App\Modules\Models\RecieveCar;

use App\Modules\Models\CarModel\CarModel;
use App\Modules\Models\District\District;
use App\Modules\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecieveCarModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'carmodel_id',
        'customerlocation_id',
        'carlocation_id',
    ];

    public function carModel()
    {
        return $this->belongsTo(CarModel::class,'carmodel_id','id');
    }

    public function customerLocation()
    {
        return $this->belongsTo(District::class,'customerlocation_id','id');
    }

    public function carLocation()
    {
        return $this->belongsTo(District::class,'carlocation_id','id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id','id');
    }
}
