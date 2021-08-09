<html>
<head>
    <title>@lang('home.subjects')</title>
</head>
<body>
    <h1>@lang('home.subjects')</h1>
    <p>@lang('home.contents')</p>
    <p>@lang('home.namesong') <h1>{{$song->name}}</h1> <a href="{{URL::current()}}">@lang('home.urlsong')</a></p>
    <p>@lang('home.thanks')</p>
</body>
</html>
