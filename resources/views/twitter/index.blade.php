<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>tomitter</title>
</head>
<body>
<p>フォロワーのツイートを取得</p>
@foreach($home_time_lines as $home_time_line)
{{ $home_time_line['created_at'] }}</br>
{{ $home_time_line['text'] }}</br></br></br></br></br></p>
@endforeach
</body>
</html>