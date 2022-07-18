<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Prize;
use App\Models\WinningNumber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Services\AdminLuckydrawService;
use App\Repositories\AdminLuckydrawRepository;
use App\Http\Requests\AdminLuckydrawValidationRequest;

class AdminLuckydrawController extends Controller
{

    public function __construct()
    {
        $this -> middleware( 'auth' );
    }

    public function index()
    {
        if ( Gate::allows( 'admin' , Auth::user() ) )
        {
            $users                  = AdminLuckydrawRepository::users();
            $prize_types            = AdminLuckydrawRepository::allPrizeTypes();
            $all_winning_numbers    = AdminLuckydrawRepository::allWinningNumbers();
            $max_winning_numbers    = AdminLuckydrawRepository::maxWinningNumbers();
            return view('admin.luckydraw',
                    compact( 'all_winning_numbers' ,
                    'max_winning_numbers' ,
                    'users' ,
                    'prize_types'
            )
            );
        }
        else
        {
            return abort( 401 );
        }
    }

    public function store( AdminLuckydrawValidationRequest $request )
    {
        // Check Generate Random yes and Draw First Prize
        if ( ( $request -> generate_random == "yes" ) && ( $request -> prize == "First Prize" ) )
        {
            $data = AdminLuckydrawService::drawFirstPrize( $request -> validated() ) ;
            return $data;
        }

        // Check Generate Random yes and Draw All Prize Except First Prize
        else if ( $request -> generate_random == "yes" )
        {
          $data = AdminLuckydrawService::drawOtherPrizes( $request -> validated() ) ;
          return $data;
        }
        // Not Generate Random and Draw Prize Manually
        else
        {
            $data = AdminLuckydrawService::drawPrizeManually( $request -> validated() ) ;
            return $data;
        }
    }

    public function resetWinningNumbers(){
        WinningNumber::truncate();
        return redirect('/adminluckydraw')
                   -> with( 'success' , 'All User Winning Numbers Cleared Successfully' ) ;
    }

    public function resetWinners(){
        Prize::truncate();
        return redirect('/home')
                   -> with( 'success' , 'All Winners Cleared Successfully' ) ;
    }

    public function resetUsers(){
        User::where('email', '!=', 'admin@ucsm.com')-> delete();
        WinningNumber::truncate();
        Prize::truncate();
        return redirect('/adminluckydraw')
                   -> with( 'success' , 'All Users Cleared Successfully' ) ;
    }

}
