<div class="release__list" data-scrollbar="true" tabindex="-1">
    <div class="scroll-content">
        <ul class="main__list main__list--playlist main__list--dashbox">
             @foreach($cate_songs as $cate_song)
            <li class="single-item">
                <a
                    data-playlist=""
                    data-title="1. Got What I Got"
                    data-artist="Jason Aldean"
                    data-img="img/covers/cover.svg"
                    href="https://dmitryvolkov.me/demo/blast2.0/audio/12071151_epic-cinematic-trailer_by_audiopizza_preview.mp3"
                    class="single-item__cover"
                >
                    <img src="/storage/{{$cate_song->image}}" alt="" />

                </a>
                <div class="single-item__title">
                    <h4><a href="#">{{$loop->index+1}}.{{$cate_song->name}}</a></h4>
                    <span><a href="artist.html">{{$cate_song->artist->name}}</a></span>
                </div>
                <a href="#" class="single-item__add">
                <i class="fas fa-plus"></i>
                </a>
                <a href="#" class="single-item__export">
                <i class="fas fa-caret-right"></i>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
