 <div class="container-fluid">
        <!-- title -->
        <div class="col-12">
            <div class="main__title main__title--page">
                <h1 class="text-center">Top 100 Trending Music</h1>
                <div class="scroll-content" >
                    <ul class="main__list main__list justify-content-center">
                        @foreach($songs as $song)
                        <li class="single-item">
                            <a data-playlist=""
                                data-title="1. Got What I Got"
                                data-artist="Jason Aldean"
                                data-img="img/covers/cover.svg"
                                href="https://dmitryvolkov.me/demo/blast2.0/audio/12071151_epic-cinematic-trailer_by_audiopizza_preview.mp3"
                                class="single-item__cover" >
                                <img src="/storage/{{$song->image}}" alt="" />
                            </a>
                            <div class="single-item__title">
                                <h4 class="text-warning"><a href="#">{{$loop->index+1}}.{{$song->name}}</a></h4>
                                <span><a href=""></a></span>
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
     </div>
</div>

