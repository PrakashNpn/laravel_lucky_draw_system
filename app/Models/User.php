<?php

namespace App\Models;
use App\Models\Prize;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function winning_numbers()
    {
        return $this -> hasMany( 'App\Models\WinningNumber' ) ;
    }

    public function prize()
    {
        return $this -> hasOne( Prize::class ) ;
    }

    public static function scopeMostWinningNumberCount($q)
    {
        $max_winning_number_count = (int) WinningNumber::getMaxWinningNumber();
        return $max_winning_number_count > 0
                ?
                $q -> with( 'winning_numbers' )
                -> has( 'winning_numbers' , $max_winning_number_count)
                :
                $q -> has( 'winning_numbers' );
    }

}

