<?php

namespace App\Http\Controllers;
use App\Services\LuckydrawService;
use App\Repositories\LuckydrawRepository;
use App\Http\Requests\WinningNumberValidationRequest;

class LuckydrawController extends Controller
{

    public function __construct()
    {
        $this->middleware( 'auth' ) ;
    }

    public function index()
    {
        $user                   = LuckydrawRepository::findAuthUser() ;
        $user_winning_numbers   = LuckydrawRepository::authUserWinningNumber() ;
        return view('luckydraw' ,
                compact( 'user_winning_numbers', 'user' )
        );
    }

    public function store( WinningNumberValidationRequest $request )
    {
        LuckydrawService::store( $request -> validated() ) ;
        return redirect('/luckydraw')
                ->with( 'success', 'Drawed The Winning Number Successfully' ) ;
    }

    public function destroy( $id )
    {
        $user_winning_numbers = LuckydrawRepository::findById( $id ) ;
        $user_winning_numbers -> delete() ;
        return redirect('/luckydraw')
                ->with( 'success', 'Deleted The Winning Number Successfully' ) ;
    }

}
