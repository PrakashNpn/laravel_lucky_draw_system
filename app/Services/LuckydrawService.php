<?php

namespace App\Services;
use App\Models\WinningNumber;

class LuckydrawService
{

    public static function store( array $data )
    {
        // Create And Store New WinningNumber
        $winning_number                 = new WinningNumber ;
        $winning_number->user_id        = auth() -> user() -> id ;
        $winning_number->winning_number = $data[ 'winning_number' ] ;
        $winning_number->save() ;
        // Or
        // WinningNumber::create( [
        //     'user_id'        => auth() -> user() -> id ,
        //     'winning_number' => $data[ 'winning_number' ]
        // ] );
    }

}
