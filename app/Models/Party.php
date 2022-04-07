<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'game_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected $hidden = [
        'user_id',
    ];

    // user that created the party
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    // members of the party
    public function members()
    {
        return $this->hasMany(Member::class, 'party_id');
    }

    // belongs to game model
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    // find by game
    public static function findByGame($game_id)
    {
        return Party::where('game_id', $game_id)->get();
    }
}
