<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TwitterAccess;
use App\Models\User;
use Redirect;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // eelから引用
    // public function redirectToTwitter()
    // {
    //     $user = Auth::user();
    //     $viewVars = $this->getCommonData($user->id);
    //     if($user->isTwitterOAuth()){
    //         $this->TwitterAccess->accessByDBTwitterInfo($user);
    //         return redirect('/campaign/tweet/confirm/#display');
    //     }else{
    //         return redirect::to($this->TwitterAccess->login());
    //     }
    // }

    // public function handleTwitterCallback()
    // {
        // $user = Auth::user();
        // $viewVars = $this->getCommonData($user->id);
        // $this->TwitterAccess->updateAndSetSeccionAccessToken($request,$user);
        // $path = 'tweet.confirm';

        // $tweetPreset = $this->TweetPreset->getRandomTweetPreset($user->last_tweet_preset_id);
        // $viewVars['tweetPreset'] = $tweetPreset;

        // return view($path, $viewVars);
        // return view('twitter/login');
    // }
}
