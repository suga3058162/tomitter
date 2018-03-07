<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>tomitter</title>
</head>
<body>
<a href="/twitter">タイムライン画面へ</a><br>
<h2>{{ $listName }}リストのタイムライン</h2>
    @foreach($listStatuses as $listStatuse)
        tweet id:{{ $listStatuse['id'] }}<br>
        user id:{{ $listStatuse['user']['id'] }}<br>
        user name:{{ $listStatuse['user']['name'] }}<br>
        created_at:{{ $listStatuse['created_at'] }}<br><br>
        {{ $listStatuse['text'] }}
        @if(in_array($listStatuse['user']['id'],$followingusers))
            <form method="post" action="{{ url('/list/unfollow/'.$listStatuse['user']['id']) }}">
                {{ csrf_field() }}
                <input type="hidden" name="status">
                <input type="hidden" name="user_id" value="{{ $listStatuse['user']['id'] }}">
                <input type="submit" value="フォロー解除">
            </form>
        @else
            <form method="post" action="{{ url('/list/follow/'.$listStatuse['user']['id']) }}">
                {{ csrf_field() }}
                <input type="hidden" name="status">
                <input type="hidden" name="user_id" value="{{ $listStatuse['user']['id'] }}">
                <input type="submit" value="フォローする">
            </form>
        @endif
        <form method="post" action="{{ url('/list/follow_retweet/') }}">
            {{ csrf_field() }}
            <input type="hidden" name="status">
            <input type="hidden" name="user_id" value="{{ $listStatuse['user']['id'] }}">
            <input type="hidden" name="retweet_id" value="{{ $listStatuse['id'] }}">
            <input type="submit" value="リツイート&フォローする">
        </form>
        <br><br><br><br><br><br>
    @endforeach
</body>
</html>