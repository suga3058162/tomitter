<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>tomitter</title>
</head>
<body>
<a href="/tweet">ツイートする</a><br>
<h2>timeline</h2>
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
        <br><br><br><br><br><br>
    @endforeach
</body>
</html>