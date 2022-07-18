<?php

namespace App\Services;
use App\Models\User;
use App\Models\Prize;
use App\Models\WinningNumber;
use App\Repositories\AdminLuckydrawRepository;

class AdminLuckydrawService
{

    public static function drawFirstPrize( array $data )
    {
        // Check winning number exist or not in database
        $winning_number = AdminLuckydrawRepository::checkAvailableWinningNumber();
        if( count( $winning_number ) > 0 )
        {
            // Get The User_id Of Users With Most Amount Of Winnning Numbers
            $max_user_id =  User::mostWinningNumberCount()
                         -> get() -> pluck( 'id' ) -> toArray() ;
            // And Generate Randomly Winning Numbers Of These Users
            $first_prize_data = WinningNumber::whereIn(
                'user_id' ,
                $max_user_id
            ) -> get() -> random() ;
            // Add Data to database
            Prize::create([
                'prize'          => $data[ 'prize' ] ,
                'user_id'        => $first_prize_data -> user_id ,
                'winning_number' => $first_prize_data -> winning_number
            ]);
            // Redirect to View
            return redirect('home')
                    -> with( 'success' , 'Prize Draw Successfully' ) ;
        }
        // If There is no winning number in database
        else
        {
            return redirect('adminluckydraw')
                    ->with( 'error' , ' There is no winning number in database. One User can award only at once! ' ) ;
        }

    }

    public static function drawOtherPrizes( array $data )
    {
        // Check winning number exist or not in database
        $winning_number = AdminLuckydrawRepository::checkAvailableWinningNumber();
        if ( count( $winning_number ) > 0 )
        {
            // Get Prize Data in Random Order of Not winner
            $prize_data  = $winning_number -> random() ;
            // Add Data To Database
            Prize::create([
                'prize'            => $data[ 'prize' ] ,
                'user_id'          => $prize_data -> user_id ,
                'winning_number'   => $prize_data -> winning_number
            ]);
            return redirect('home')
                    -> with( 'success' , 'Prize Draw Successfully' ) ;
        }

        // If There is no winning number in database
        else
        {
            return redirect('adminluckydraw')
            ->with( 'error' , ' There is no winning number in database. One User can award only at once! ' ) ;
        }

    }

    public static function drawPrizeManually( array $data )
    {
        // Get Requested Winning Number Data form Frontend
        $request_winning_number = $data[ 'winning_number' ] ;
        $winning_number_data    = WinningNumber::where(
             'winning_number' ,
             $request_winning_number
        ) -> get() ;
        // Check requseted winning number exist or not in database
        if ( count( $winning_number_data ) > 0 )
        {
            // Get User Id Of the Requested Winning Number
            $user_id = $winning_number_data -> first() -> user_id ;
            // Check The Winner's Prize exist or not with the requested winning number
            $check_prize      = Prize::where( 'user_id' , $user_id ) -> get() ;
            if ( count( $check_prize ) > 0 )
            {
                return redirect('adminluckydraw')
                -> with( 'error' , " Requested winning number User has already awarded. Please choose another User's winning number " ) ;
            }
            // If The Winner Not Exist, Then Create
            else
            {
                // Add Data To Database
                Prize::create([
                    'user_id'        => $user_id,
                    'prize'          => $data[ 'prize' ],
                    'winning_number' => $request_winning_number
                ]);
                // Redirect To View
                return redirect('home')
                        -> with( 'success' , 'Prize Draw Successfully' ) ;
            }
        }
        // If requested winning number does not exist in database
        else
        {
            return redirect('adminluckydraw')
                    -> with( 'error' , 'Winning number you enter does not exist in database. Please enter the correct winning number' ) ;
        }

    }

}
