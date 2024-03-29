<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable= ['content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        // return $this->hasMany(Like::class);
        return $this->hasMany(Like::class)
                ->where(function($query){
                    if(auth()->check()){
                        $query->where('user_id', auth()->user()->id);
                    }
                });
            // ->withLikedBy();
    }

    public function totalLikes()
    {
        return Like::where('tweet_id', $this->id)->count();
    }

}
