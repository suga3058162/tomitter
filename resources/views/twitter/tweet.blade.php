<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>tomitter</title>
</head>
<body>
<a href="/twitter">back to timeline</a><br>
<h2>ツイートする</h2>
<form method="post" action="{{ url('/tweet') }}">
  {{ csrf_field() }}
  <p>
    <textarea name="status" placeholder="今どんな気分？"></textarea>
  </p>
  <p>
    <input type="submit" value="ツイートする">
  </p>
</form>
</body>
</html>