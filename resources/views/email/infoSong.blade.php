<html>
<head>
    <title>@lang('home.subjectS')</title>
</head>
<body>
    <h1>@lang('home.subjectS')</h1>
    <p>@lang('home.contentS')</p>
    <p>@lang('home.Namesong') <h1>{{$song->name}}</h1> <a href="{{URL::current()}}">@lang('home.urlsong')</a></p>
    <p>@lang('home.thankS')</p>
</body>
</html>
