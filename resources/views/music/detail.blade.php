@extends('layouts.app')
@section('content')
 <section class="box_main">
   <div class="container-fluid">
    <div class="row row--grid">
        <!-- title -->
        <div class="col-12">
            <div class="main__title main__title--page">
                <h1>{{$song->name}}</h1>
            </div>
        </div>
        <div class="col-12">
            <div class="release">
                <div class="release__content">
                    <div class="release__cover">
                        <img src="/storage/{{$song->image}}" alt="" />
                    </div>
                    <div class="release__stat">
                        <span>
                           {{$song->view}}
                        </span>
                        <span>
                           <i class="fa fa-headphones" aria-hidden="true"></i>
                        </span>
                    </div>
                    <a href="#modal-buy" class="release__buy open-modal">{{$song->artist->name}}</a>
                </div>
                 @include('music.release')
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-8">
        <div class="article">
            <div class="article__content">
                <h4>@lang('home.lyric') </h4>
                      @if(isset($song->lyrics->content))
                       {!!$song->lyrics->content!!}
                      @else
                          Ban co the them loi bai hat
                    @endif
            </div>
             <div class="comments">
                <div class="comments__title">
                    <h4>Comments</h4>
                        <span>3</span>
                    </div>
                    @foreach($comments as $comment)
                    <ul class="comments__list">
                        <li class="comments__item">
                            <div class="comments__autor">
                                <img class="comments__avatar" src="/storage/{{ $comment->user->avatar }}" alt="" />
                                <span class="comments__name">{{$comment->user->fullname}}</span>
                                <span class="comments__time">{{$comment->created_at->diffForHumans()}}</span>
                            </div>
                            <p class="comments__text">
                              {{$comment->content}}
                            </p>
                            <div class="comments__actions">
                                <div class="comments__rate">
                                        @for($i = 1;$i <=5; $i++)
                                         <span class="list-inline-item">
                                             <i class="fas fa-star {{ $i > $comment->rate_star ? '' : 'text-warning'}} "></i>
                                        </span>
                                        @endfor

                                    </span>
                                </div>
                            </div>
                        </li>
                    </ul>
                    @endforeach
                    <form class="comments__form">
                        <div class="rating">
                            <span><input type="radio" name="rate_star" id="str5" value="5"><label for="str5" class="fas fa-star"></label></span>
                            <span><input type="radio" name="rate_star" id="str4" value="4"><label for="str4" class="fas fa-star"></label></span>
                            <span><input type="radio" name="rate_star" id="str3" value="3"><label for="str3" class="fas fa-star"></label></span>
                            <span><input type="radio" name="rate_star" id="str2" value="2"><label for="str2" class="fas fa-star" ></label></span>
                            <span><input type="radio" name="rate_star" id="str1" value="1"><label for="str1" class="fas fa-star"></label></span>
                        </div>
                        <textarea type=""  id="_contend" name="content" class="comment_input" placeholder="Add comment"> </textarea>
                        <button type="submit" data-song = "{{$song->id}}" data-user="{{auth()->user()->id}}" class="sign__btn" id="submit_c">Send</button>
                    </form>
                </div>
                <!-- end comments -->
            </div>
        </div>
    </div>
</div>
</section>
</div>
</div>
@endsection

