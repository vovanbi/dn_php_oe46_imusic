@extends('layouts.app')
@section('content')
 <section class="box_main">
<div class="container-fluid">
    <div class="row row--grid">
        <!-- title -->
        <div class="col-12">
            <div class="main__title main__title--page">
                <h1>
                    @if (isset($album))
                        {{ $album->name }}
                    @elseif (isset($artist))
                        {{ $artist->name }}
                    @endif
                </h1>
            </div>
        </div>
        <div class="col-12">
            <div class="release">
                <div class="release__content">
                    <div class="release__cover">
                        @if (isset($album))
                            <img class="image-detail" src="{{ $album->image}}" alt="" />
                        @elseif (isset($artist))
                            <img class="image-detail" src="{{ $artist->avatar }}" alt="">
                        @endif
                    </div>
                    <div class="release__stat">
                        <span class="track-number">
                            {{ count($songs).' '.trans('homePage.tracks') }} 
                        </span>
                    </div>
                        @if (isset($album))
                            <a href="#modal-buy" class="release__buy open-modal"> {{ trans('homePage.addAlbum') }} </a>
                        @elseif (isset($artist))
                            @lang('homePage.artistInfo')
                            <p>{{ $artist->info }}</p>
                        @endif
                </div>

                <div class="release__list" data-scrollbar="true" tabindex="-1" style="overflow: hidden; outline: none;">
                    <div class="scroll-content">
                        <ul class="main__list main__list--playlist main__list--dashbox">
                            @if (count($songs) > 0)
                                @foreach ($songs as $song)
                                    <li class="single-item">
                                        <a class="single-item__cover">
                                            <img src="{{ $song->image }}" alt="" />
                                        </a>
                                        <div class="single-item__title">
                                            <h4><a class="play-music" href="#" data-id="{{ $song->id }}">{{ $loop->iteration }}. {{ $song->name }}</a></h4>
                                            <span><a href="">{{ $song->artist->name }}</a></span>
                                        </div>
                                        <a href="" data-id="{{ $song->id }}" title="{{ trans('homePage.playSong') }}" class="single-item__add play play-music">
                                            <i class="far fa-play-circle icon-play"></i>
                                            <i class="far fa-pause-circle icon-pause"></i>
                                        </a>
                                        <a href="#" title="{{ trans('homePage.addSong') }}" class="single-item__export">
                                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @endforeach
                            @else 
                                @if(isset($album))
                                    {{trans('homePage.noAlbumSong')}}
                                @else
                                    {{trans('homePage.noArtistSong')}}
                                @endif
                            @endif
                        </ul>
                    </div>
                    <div class="scrollbar-track scrollbar-track-x show" style="display: none;"><div class="scrollbar-thumb scrollbar-thumb-x" style="width: 586px; transform: translate3d(0px, 0px, 0px);"></div></div>
                    <div class="scrollbar-track scrollbar-track-y show" style="display: block;"><div class="scrollbar-thumb scrollbar-thumb-y" style="height: 228.097px; transform: translate3d(0px, 0px, 0px);"></div></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="article">
                <div class="article__content">
                    <h4>About new album</h4>

                    <p>
                        There are many <b>variations</b> of passages of Lorem Ipsum available, but the majority have <a href="#">suffered</a> alteration in some form, by injected humour, or randomised words which don't look even slightly
                        believable.
                    </p>

                    <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
                <div class="comments">
                    <div class="comments__title">
                        <h4>Comments</h4>
                        <span>3</span>
                    </div>

                    <ul class="comments__list">
                        <li class="comments__item">
                            <div class="comments__autor">
                                <img class="comments__avatar" src="img/avatar.svg" alt="" />
                                <span class="comments__name">John Doe</span>
                                <span class="comments__time">30.08.2021, 17:53</span>
                            </div>
                            <p class="comments__text">
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If
                                you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                            </p>
                            <div class="comments__actions">
                                <div class="comments__rate">
                                    <button type="button">

                                        12
                                    </button>

                                    <button type="button">
                                        7

                                    </button>
                                </div>

                                <button type="button">

                                    <span>Reply</span>
                                </button>
                                <button type="button">

                                    <span>Quote</span>
                                </button>
                            </div>
                        </li>

                        <li class="comments__item comments__item--answer">
                            <div class="comments__autor">
                                <img class="comments__avatar" src="img/avatar.svg" alt="" />
                                <span class="comments__name">John Doe</span>
                                <span class="comments__time">24.08.2021, 16:41</span>
                            </div>
                            <p class="comments__text">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                scrambled it to make a type specimen book.
                            </p>
                            <div class="comments__actions">
                                <div class="comments__rate">
                                    <button type="button">

                                        10
                                    </button>

                                    <button type="button">
                                        0

                                    </button>
                                </div>

                                <button type="button">

                                    <span>Reply</span>
                                </button>
                                <button type="button">

                                    <span>Quote</span>
                                </button>
                            </div>
                        </li>

                        <li class="comments__item">
                            <div class="comments__autor">
                                <img class="comments__avatar" src="img/avatar.svg" alt="" />
                                <span class="comments__name">John Doe</span>
                                <span class="comments__time">07.08.2021, 14:33</span>
                            </div>
                            <p class="comments__text">
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If
                                you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                            </p>
                            <div class="comments__actions">
                                <div class="comments__rate">
                                    <button type="button">

                                        7
                                    </button>

                                    <button type="button">
                                        4

                                    </button>
                                </div>

                                <button type="button">

                                    <span>Reply</span>
                                </button>
                                <button type="button">

                                    <span>Quote</span>
                                </button>
                            </div>
                        </li>
                    </ul>

                    <form action="#" class="comments__form">
                        <div class="sign__group">
                            <input type=""  id="text" name="text" class="sign__textarea" placeholder="Add comment">
                        </div>
                        <button type="button" class="sign__btn">Send</button>
                    </form>
                </div>
                <!-- end comments -->
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <!-- releases -->
            <div class="row row--sidebar">
                <!-- title -->
                <div class="col-12">
                    <div class="main__title main__title--sidebar">
                        <h3>Other releases</h3>
                    </div>
                </div>
                <!-- end title -->

                <div class="col-6 col-sm-4 col-lg-6">
                    <div class="album album--sidebar">
                        <div class="album__cover">
                            <img src="img/covers/cover8.jpg" alt="" />
                            <a href="release.html">

                            </a>
                            <span class="album__stat">
                                <span>

                                    22
                                </span>
                                <span>

                                    19 503
                                </span>
                            </span>
                        </div>
                        <div class="album__title">
                            <h3><a href="release.html">Space Melody</a></h3>
                            <span><a href="artist.html">VIZE</a> &amp; <a href="artist.html">Alan Walker</a> &amp; <a href="artist.html">Leony</a></span>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-sm-4 col-lg-6">
                    <div class="album album--sidebar">
                        <div class="album__cover">
                            <img src="img/covers/cover2.jpg" alt="" />
                            <a href="release.html">

                            </a>
                            <span class="album__stat">
                                <span>

                                    7
                                </span>
                                <span>

                                    4 731
                                </span>
                            </span>
                        </div>
                        <div class="album__title">
                            <h3><a href="release.html">Said Sum</a></h3>
                            <span><a href="artist.html">Moneybagg</a></span>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-sm-4 col-lg-6">
                    <div class="album album--sidebar">
                        <div class="album__cover">
                            <img src="img/covers/cover3.jpg" alt="" />
                            <a href="release.html">

                            </a>
                            <span class="album__stat">
                                <span>

                                    16
                                </span>
                                <span>

                                    300k
                                </span>
                            </span>
                        </div>
                        <div class="album__title">
                            <h3><a href="release.html">I Love My Country</a></h3>
                            <span><a href="artist.html">Florida Georgia</a></span>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-sm-4 col-lg-6">
                    <div class="album album--sidebar">
                        <div class="album__cover">
                            <img src="img/covers/cover6.jpg" alt="" />
                            <a href="release.html">

                            </a>
                            <span class="album__stat">
                                <span>

                                    16
                                </span>
                                <span>

                                    100k
                                </span>
                            </span>
                        </div>
                        <div class="album__title">
                            <h3><a href="release.html">Toosie Slide</a></h3>
                            <span><a href="artist.html">Drake</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
</div>
</div>
@endsection
