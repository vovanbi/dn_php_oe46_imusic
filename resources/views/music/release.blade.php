<div class="release__list" data-scrollbar="true" tabindex="-1">
    <div class="scroll-content">
        <ul class="main__list main__list--playlist main__list--dashbox">
             @foreach($cate_songs as $cate_song)

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

