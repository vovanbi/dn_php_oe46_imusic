<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> Email</title>
</head>
<body class="">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
        <tr>
            <td>&nbsp;</td>
            <td class="container">
                <div class="content">
                    <table role="presentation" class="main">
                        <tr>
                            <td class="wrapper">
                                <table role="presentation" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>
                                            <h3>@lang('home.subjects') <span>@lang('home.evening')</span></h3>
                                            @if (isset($songs))
                                                <h2>@lang('home.listsong')</h2>
                                                <table class="table-border">
                                                    <thead>
                                                        <tr>
                                                            <th>@lang('home.no')</th>
                                                            <th>@lang('home.namesong')</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($songs as $song)
                                                            <tr>
                                                                <td>{{ $loop->index + 1 }}</td>
                                                                <td>{{ $song->name }} </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @elseif (isset($song))
                                                <h1>@lang('home.contents')</h1>
                                                <h3>@lang('home.namesong') {{ $song->name }}</h3>
                                            @endif
                                            <br>
                                            <table role="presentation" cellpadding="0" cellspacing="0"
                                                class="btn btn-primary">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <table role="presentation" cellpadding="0"
                                                                cellspacing="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <a href="{{ URL::current() }}"
                                                                                target="_blank">@lang('home.urlsong')
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p>@lang('home.thanks')</p>
                                            <p>@lang('home.imusicSign')</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
            <td>&nbsp;</td>
        </tr>
    </table>
</body>
</html>
