<?php

namespace App\Modules\Models\State;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public static function getStates()
    {
        return self::select('id','title')->get();
    }
}
