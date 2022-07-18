<?php

namespace App\Repositories;
use App\Models\User;
use App\Models\Prize;
use App\Models\PrizeType;
use App\Models\WinningNumber;

class AdminLuckydrawRepository
{

    public static function allWinningNumbers()
    {
        return WinningNumber::orderBy( 'created_at', 'desc' ) -> get() ;
    }

    public static function allPrizeTypes(){
        return PrizeType::orderBy( 'prize_type' , 'asc' ) -> get();
    }

    public static function maxWinningNumbers()
    {
        return WinningNumber::get() -> groupBy( 'user_id' ) -> max() ;
    }

    public static function users()
    {
        return User::whereNotIn( 'email' , [ 'admin@ucsm.com' ] ) -> get() ;
    }

    public static function checkAvailableWinningNumber(){
        // Get Winner's User_id from database
        $winner_user_id = Prize::pluck( 'user_id' ) -> toArray();
        // And Check Not To Pick Winner's Winning Number
        $winning_number = WinningNumber::whereNotIn(
            'user_id' ,
            $winner_user_id
        ) -> get();
        return $winning_number;
    }

}
