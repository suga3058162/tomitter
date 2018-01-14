<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct ()
    {
        $this->user = \App::make('\App\User');
        // $this->game = \App::make('\App\Models\Game');
        // $this->mark = \App::make('\App\Models\Mark');
        // $this->incentive = \App::make('\App\Models\Incentive');
        // $this->userIncentive = \App::make('\App\Models\UserIncentive');
        // $this->TweetPreset   = \App::make('\App\Models\TweetPreset');
        // $this->TwitterAccess = \App::make('\App\Models\TwitterAccess');
        // $this->serial = \App::make('\App\Models\Serial');
    }

    // public function getCommonData($userId = null)
    // {
        // if($userId){
            // ユーザ情報取得
            // $response['user'] = $this->user->where('id', $userId)->first();

            // 現在のボール情報取得
            // $response['game'] = $this->game->getNowPlayGame($userId);
            // $response['ballPaths'] = $this->game->getBallimagePath();

            // ユーザ取得済のインセンティブを取得
        //     $response['userIncentives'] = $this->userIncentive->getUserIncentiveList($userId);
        // }
        // インセンティブ情報取得
    //     $response['incentives'] = $this->incentive->get();
    //     return $response;
    // }
}
