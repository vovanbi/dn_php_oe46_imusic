<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LMussic - Trang quản lý</title>
     <link rel="stylesheet" href="{{asset('')}}/css/bootstrap.css">
    <link href="{{ asset('') }}css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('')}}css/sb-admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">LMussic</a>
            </div>
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>  <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Tài Khoản</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href=""><i class="fa fa-fw fa-power-off"></i> Đăng Xuất</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                  <div class="dropdown">
                       @php $locale = session()->get('locale'); @endphp
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @switch($locale)
                                @case('vi')
                                <img src="{{asset('image/vi.png')}}"> VN
                                @break
                                @case('en')
                                <img src="{{asset('image/en.png')}}"> English
                                @break
                                @default
                                <img src="{{asset('image/vi.png')}}"> VN
                            @endswitch
                            <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('change-language',['vi'])}}"><img src="{{asset('image/vi.png')}}"> VN</a>
                            <a class="dropdown-item" href="{{route('change-language',['en'])}}"><img src="{{asset('image/en.png')}}"> English</a>
                        </div>
                     </div>
                </li>
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="">
                        <a href=""><i class="fa fa-fw fa-home"></i> @lang('adminhome.home')</a>
                    </li>
                    <li class="">
                        <a href=""><i class="fa fa-fw fa-bar-chart-o"></i> @lang('adminhome.category')</a>
                    </li>
                    <li class="">
                        <a href=""><i class="fa fa-play-circle-o" aria-hidden="true"></i> @lang('adminhome.song') </a>
                    </li>
                    <li class="">
                        <a href=""><i class="fa fa-files-o" aria-hidden="true"></i>
                         @lang('adminhome.lyris') </a>
                    </li>
                    <li class="">
                        <a href=""><i class="fa fa-book" aria-hidden="true"></i>
                    </i> @lang('adminhome.albumn') </a>
                    </li>
                     <li class="">
                        <a href=""><i class="fa fa-music" aria-hidden="true"></i>
                    </i> @lang('adminhome.signer') </a>
                    </li>
                    <li class="">
                        <a href=""><i class="fa fa-users" aria-hidden="true"></i>
                    </i> Admin</a>
                    </li>
                    <li class="">
                        <a href=""><i class="fa fa-comments-o" aria-hidden="true"></i> @lang('adminhome.comment')</a>
                    </li>
                </ul>
            </div>
        </nav>
         @yield('content')
    </div>
   <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
</script>
    <script type="text/javascript" src="{{asset('js/lib.js')}}"></script>
    <!-- <script src="{{ asset('js/jquery.min.js') }}"></script> -->
    <!-- <script src="{{asset('')}}/js/app.js"></script> -->
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset('js/showimg.js')}}"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    @yield('script')
</body>
</html>
