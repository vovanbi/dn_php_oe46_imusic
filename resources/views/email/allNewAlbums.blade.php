<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Simple Transactional Email</title>
</head>

<body class="">
    <table class="body">
        <tr>
            <td>&nbsp;</td>
            <td class="container">
                <div class="content">

                    <!-- START CENTERED WHITE CONTAINER -->
                    <table class="main">

                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class="wrapper">
                                <table>
                                    <tr>
                                        <td>
                                            <h3>@lang('home.emailDear')</h3>
                                            @if (isset($albums))
                                                <h2>@lang('home.albumRelease')</h2>
                                                <table class="table-border">
                                                    <thead>
                                                        <tr>
                                                            <th>@lang('home.no')</th>
                                                            <th>@lang('home.albumName')</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($albums as $alb)
                                                            <tr>
                                                                <td>{{ $loop->index + 1 }}</td>
                                                                <td>{{ $alb->name }} </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @elseif (isset($album))
                                                <h1>@lang('home.albumIntro')</h1>
                                                <h3>@lang('home.albumName') {{ $album->name }}</h3>
                                                <p>@lang('home.contentMail')</p>
                                            @endif
                                            <br>

                                            <table class="btn btn-primary">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <table>
                                                                <tbody>
                                                                    <tr>
                                                                        <td> <a href="{{ URL::current() }}"
                                                                                target="_blank">@lang('home.toHomePage')</a> </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p>@lang('home.thanksMail')</p>
                                            <p>@lang('home.imusicSign')</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- END MAIN CONTENT AREA -->
                    </table>
                    <!-- END CENTERED WHITE CONTAINER -->
                </div>
            </td>
            <td>&nbsp;</td>
        </tr>
    </table>
</body>

</html>
