<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WinningNumber extends Model
{

    use HasFactory;

    protected $fillable = [
        'winning_number'
    ];

    public function user()
    {
        return $this -> belongsTo( 'App\Models\User' ) ;
    }

    public static function getMaxWinningNumber()
    {
        $winning_number = WinningNumber::addSelect(DB::raw('COUNT(*) as winningNumberCount'))
            ->groupBy(['user_id'])
            ->latest('winningNumberCount');
        return $winning_number->exists()? $winning_number->first()->winningNumberCount : 0;
    }

}
