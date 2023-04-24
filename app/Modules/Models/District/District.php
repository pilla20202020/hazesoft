<?php

namespace App\Modules\Models\District;

use App\Modules\Models\State\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'state_id',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public static function getDistricts()
    {
        return self::select('id', 'title')->get();
    }

    public static function getDistrictsByStateId($state_id)
    {
        return self::select('id', 'title')->where('state_id',$state_id)->get();
    }
}
