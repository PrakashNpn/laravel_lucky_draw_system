<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prize extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'winning_number',
        'prize'
    ];

    public function user()
    {
        return $this -> belongsTo( User::class ) ;
    }

}
