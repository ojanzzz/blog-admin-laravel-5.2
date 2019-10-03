@extends('layout.master')

@section('title')
    {{$post->post_title}}
@endsection

@section('content')
<style>
a:link {
  color: black;
}

a:visited {
  color: black;
}

a:hover {
  color: black;
}


a:active {
  color: black;
}
</style>
    @if($post->featured_images !='')
    <section id="heading-post-title" style="background: url('{{url('/photos/contents')}}/{{$post->featured_images}}') no-repeat center center fixed;">
    @else
    <section id="heading-post-title" style="background: url('{{url('/assets/landing')}}/../landing/kuliner-bima.jpeg') no-repeat center center fixed;">
    @endif
        <div class="heading-title-cover">
            <div class="heading-title-text">
                <br><br>
                <p class="header-text-start">{{$post->post_title}}</p><br><br>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="single-container">
            <article id="Post_{{$post->id}}" class="single-content card-1">
                <div class="container">
                    <h1 class="title-content">{{$post->post_title}}</h1>
                    <span class="info-content">di publish oleh: {{$post->author}}</span>,
                    <span class="info-content">pada tanggal: {{date('j F Y', strtotime($post->created_at))}}</span><br>
                    @if(count($post->PostCategory))
                        <span class="info-content">Kategori: </span>
                        @foreach($post->PostCategory as $categories)
                            <span class="info-content">#{{$categories->name}}</span>
                        @endforeach
                    @endif
                    <hr>

                    <img class="img-responsive" style="width:400px;height:400px;display:block;margin-left:auto;margin-right:auto;" src="{{url('/photos/contents/medium')}}/{{$post->featured_images}}" >
                    <br>
                    {!! $post->post_content !!}

                    <br>
                    <br>
                    <br>
                    <hr>
                    <h3>Artikel Terkait</h3>
                    <div class="flexibel-blog-grid-2">
                        @if(count($related))
                            @foreach($related as $related_post)
                                <div class="grid-3-1 card-1">
                                    <div class="grid-break">
                                        @if($related_post->featured_images !='')
                                            <img class="img-responsive" src="{{url('/photos/contents/medium')}}/{{$related_post->featured_images}}" alt="{{$related_post->post_title}}">
                                        @else
                                            <img class="img-responsive" src="../assets/landing/no-thumb-500x500.png" alt="{{$related_post->post_title}}">
                                        @endif
                                    </div>
                                    <div class="grid-content">
                                        <h3 class="grid-blog-title"><a href="{{url('/mbojo')}}/{{$related_post->post_title}}">{{$related_post->post_title}}</a></h3>
                                        <span class="info-content">{{$related_post->author}}</span>,
                                        <span class="info-content">{{date('j F Y', strtotime($related_post->created_at))}}</span>
                                        @if(count($related_post->PostCategory))
                                            @foreach($related_post->PostCategory->slice(0,1) as $related_cat)
                                                <p class="info-content"><a href="{{url('/mbojo')}}/{{$related_cat->slug}}">#{{$related_cat->name}}</a></p>
                                            @endforeach
                                        @endif
                                        <hr>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </article>

            <aside class="sidebar">
                <div class="side-info">
                    <p class="side-blog-heading">Kategori</p>

                    @forelse($all_categories as $all_cat)
                        @if(count($all_cat->CategoriesPost))
                            @foreach($all_cat->CategoriesPost->sortBy('name')->slice(0,1) as $cat)
                                <div class="pages-info"><a href="{{url('/kategori')}}/{{$all_cat->slug}}">{{$all_cat->name}}</a> <span class="cat-count">{{$all_cat->CategoriesPost->count()}}</span></div>
                            @endforeach
                        @endif
                        @empty
                        <p>Nothing found!</p>
                    @endforelse
                </div>
            </aside>
        </div>
    </div>

@endsection