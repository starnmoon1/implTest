<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>seller</title>
</head>
<body>
<div>
    <p> Chuc mung ban tro thanh mot nguoi mua</p>
    @if(empty($buyer->requestUser))
    <form method="post" action="{{route('request.buyer')}}">
        @csrf
            <label for=""> Ban co muon tro thanh nguoi ban</label>
        <input type="submit" class="btn btn-success">
    </form>
    @else
    <button class="btn btn-infor"> Dang cho xac nhan</button>
    @endif
</div>
</body>
</html>
