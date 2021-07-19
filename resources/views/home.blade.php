@extends('layouts.app')
@section('content')
    <section class="box_main">
        <ul class="nav_bar_main">
          <li><a href="#">Study</a></li>
            <li><a href="#">Romantic</a></li>
            <li><a href="#">Piano</a></li>
            <li><a href="#">Live</a></li>
        </ul>
        <div class="music">
          <div class="recently_played">
            <h2>@lang('home.song')</h2>
            <div class="row get_song">
              <a class="box_music" href="#" id="play">
                  <img src="img/album/loud-like-love.jpg" alt="Loud Like Love">
                  <h3>Loud Like Love</h3>
                  <h4>Placebo</h4>
              </a>
              <a class="box_music" href="#">
                  <img src="img/album/love-is-dead.jpg" alt="Love is Dead">
                  <h3>Love is Dead</h3>
                  <h4>CHVRCHES</h4>
              </a>
              <a class="box_music" href="#">
                  <img src="img/album/love.jpg" alt="Love">
                  <h3>Love</h3>
                  <h4>The Giornalisti</h4>
              </a>
              <a class="box_music" href="#">
                  <img src="img/album/random-access-memory.jpg" alt="Random Access Memory">
                  <h3 id="ram">Random Access Memory</h3>
                  <h4>Daft Punk</h4>
              </a>
              <a class="box_music" href="#">
                  <img src="img/album/the-2nd-law.jpg" alt="The 2nd Law">
                  <h3>The 2nd Law</h3>
                  <h4>Muse</h4>
              </a>
              <a class="box_music" href="#">
                  <img src="img/album/the-dark-side-of-the-moon.jpg" alt="The Dark Side of The Moon">
                  <h3>The Dark Side of The Moon</h3>
                  <h4>Pink Floyd</h4>
              </a>
            </div>
          </div>
          <div class="artists">
            <h2>@lang('home.artist')</h2>
            <div class="row">
              <a class="box_music" href="#">
                  <img src="img/artists/death-cab-for-cutie.jpg" alt="Death Cab fot Cutie">
                  <h3>Death Cab fot Cutie</h3>
              </a>
              <a class="box_music" href="#">
                  <img src="img/artists/florence-the-machine.jpg" alt="Florence + The Machine">
                  <h3>Florence + The Machine</h3>
              </a>
              <a class="box_music" href="#">
                  <img src="img/artists/imagine-dragons.jpg" alt="Imagine Dragons">
                  <h3>Imagine Dragons</h3>
              </a>
              <a class="box_music" href="#">
                  <img src="img/artists/the-xx.jpg" alt="The xx">
                  <h3>The xx</h3>
              </a>
            </div>
          </div>
          <div class="daily-mix">
            <h2>@lang('home.album')</h2>
            <div class="row">
              <a class="box_music get_album" href="#">
                  <img src="img/daily-mix/daily-mix-1.jpg" alt="Daily Mix 1">
                  <h3>Daily Mix 1</h3>
              </a>
              <a class="box_music" href="#">
                  <img src="img/daily-mix/daily-mix-2.jpg" alt="Daily Mix 2">
                  <h3>Daily Mix 2</h3>
              </a><a class="box_music" href="#">
                  <img src="img/daily-mix/daily-mix-3.jpg" alt="Daily Mix 3">
                  <h3>Daily Mix 3</h3>
              </a>
            </div>
          </div>
        </div>
    </section>
  </div>
</div>
@stop
