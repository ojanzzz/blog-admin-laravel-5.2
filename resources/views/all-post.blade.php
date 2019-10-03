@extends('layout.master')

@section('title', 'Mbojo')

@section('content')

    <section id="heading-post-title" style="background: url('{{url('/assets/landing')}}/../landing/kuliner-bima.jpeg') no-repeat center center fixed;">
        <div class="heading-title-cover">
            <div class="heading-title-text-category">
                <br><br>
                <p class="header-text-start">Mbojo</p><br><br>
            </div>
        </div>
    </section>

    <div class="heading"></div>

    <article>
        <div class="container">
            <div class="flexibel-post-grid">
                @forelse($post as $globalpost)
                    <div class="flexibel-post-grid-mobile grid-3 card-1">
                        @if($globalpost->featured_images !='')
                            <div class="flexibel-post-grid-mobile-img">
                                <img class="img-responsive" src="{{url('/photos/contents/medium')}}/{{$globalpost->featured_images}}" alt="{{$globalpost->post_title}}">
                            </div>
                        @else
                            <div class="flexibel-post-grid-mobile-img">
                                <img class="img-responsive" src="assets/landing/no-thumb-500x500.png" alt="{{$globalpost->post_title}}">
                            </div>
                        @endif
                        <div class="flexibel-post-grid-mobile-content">
                            <div class="grid-content">
                                <h3 class="grid-blog-title"><a href="{{url('/mbojo')}}/{{$globalpost->post_title}}">{{$globalpost->post_title}}</a></h3><hr>
                                <p class="info-content">{{$globalpost->author}} / {{date('j F Y', strtotime($globalpost->created_at))}}</p>
                                <div class="info-content-mobile">
                                    @if(count($globalpost->PostCategory))
                                        @foreach($globalpost->PostCategory->slice(0,1) as $cat)
                                            <span class="info-content">#{{$cat->name}}</span>
                                        @endforeach
                                        <hr>
                                    @endif
                                </div>                                
                            </div>
                        </div>
                    </div>
                    @empty
                    <p>Post is empty</p>
                @endforelse
            </div>
        </div>
    </article>

    <div class="container">
        <div class="pager">
            {!! $post->links() !!}
        </div>
    </div>

@endsection