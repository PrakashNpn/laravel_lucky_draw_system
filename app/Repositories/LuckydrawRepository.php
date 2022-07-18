<?php

namespace App\Repositories;
use App\Models\User;
use App\Models\WinningNumber;

class LuckydrawRepository
{

    public static function all()
    {
        return WinningNumber::orderBy( 'created_at', 'desc' ) -> get() ;
    }

    public static function findById( $id )
    {
        return WinningNumber::find( $id ) ;
    }

    public static function findAuthUser()
    {
        return User::find( auth() -> user() -> id ) ;
    }

    public static function authUserWinningNumber()
    {
        return WinningNumber::where( 'user_id' , auth() -> user() -> id )
                            -> orderBy( 'created_at', 'desc' ) -> get() ;
    }

}
