<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<div>
    @foreach($codes as $code)
        <img src="data:image/png;base64, {!! base64_encode($code) !!} " style="margin-right: 20px; margin-bottom: 20px">
    @endforeach
</div>
</body>
</html>
