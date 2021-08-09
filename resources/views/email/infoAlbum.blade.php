<html>
<head>
    <title>@lang('home.albumMail')</title>
</head>
<body>
    <h1>@lang('home.albumIntro')</h1>
    <h3>@lang('home.albumName') {{ $album->name }}</h3>
    <p>@lang('home.contentMail')</p>
    <p><a href="{{ URL::current() }}">@lang('home.toHomePage')</a></p>
    <p>@lang('home.thanksMail')</p>
</body>
</html>
