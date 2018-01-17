<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>tomitter</title>
</head>
<body>
<a href="twitter/logout">ログアウト</a><br>
<a href="/list">リスト画面へ</a><br>
<a href="/tweet">ツイートする</a><br>
<h2>タイムライン</h2>
    @foreach($home_time_lines as $home_time_line)
        tweet id:{{ $home_time_line['id'] }}<br>
        user id:{{ $home_time_line['user']['id'] }}<br>
        user name:{{ $home_time_line['user']['name'] }}<br>
        created_at:{{ $home_time_line['created_at'] }}<br><br>
        {{ $home_time_line['text'] }}
        @if($loginuser === $home_time_line['user']['id'])
            <form method="post" action="{{ url('/tweet/destroy/'.$home_time_line['id']) }}">
            {{ csrf_field() }}
                <input type="hidden" name="status">
                <input type="hidden" name="id" value="{{ $home_time_line['id'] }}">
                <input type="submit" value="ツイート削除">
            </form>
        @endif
        @if(in_array($home_time_line['id'],$favoriteIds))
            <form method="post" action="{{ url('/tweet/unfavorite/'.$home_time_line['id']) }}">
                {{ csrf_field() }}
                    <input type="hidden" name="status">
                    <input type="hidden" name="id" value="{{ $home_time_line['id'] }}">
                    <input type="submit" value="いいね！解除">
            </form>
        @else
        <form method="post" action="{{ url('/tweet/favorite/'.$home_time_line['id']) }}">
            {{ csrf_field() }}
                <input type="hidden" name="status">
                <input type="hidden" name="id" value="{{ $home_time_line['id'] }}">
                <input type="submit" value="いいね！">
        </form>
        @endif
        <br><br><br><br><br><br>
    @endforeach
</body>
</html>