<?php

namespace App;

// use Illuminate\Notifications\Notifiable;
// use Illuminate\Foundation\Auth\User as Authenticatable;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use App\Traits\UserObservable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'yahoo_uid',
        'twitter_uid',
        'twitter_raw_info',
        'battery_count',
        'is_rule_skip',
        'first_login_at',
        'last_login_at',
        'is_skip_rule',
        'last_tweet_preset_id',
        'createed_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isTwitterOAuth()
    {
        if($this->twitter_uid && $this->twitter_raw_info){
            $isTwitterOAuth = true;
        }else{
            $isTwitterOAuth = false;
        }
        return $isTwitterOAuth;
    }

    // public function isLiked() {
    //     $like = Like::where('post_id', $this->id)->where('user_id', Auth::user()->id)->first();
    //     logger(isset($like));
    //     return isset($like);
    //   }


    public function isFollowed($postUserId)
    {
        $authorized_user = Twitter::getCredentials();
        $loginuser = $authorized_user->id;

        $getFriendsIds = Twitter::getFriendsIds(['user_id' => $loginuser]);
        $followinguser = $getFriendsIds->ids;

        if(in_array($postUserId, $getFriendsIds))
        {
            $isFollowed = true;
        }else{
            $isFollowed = false;
        }
        return $isFollowed;
    }
}
