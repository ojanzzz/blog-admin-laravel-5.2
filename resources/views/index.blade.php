@extends('layout.master')

@section('title')
    Mbojo
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
    <div id="load">
        <div id="loader"></div>
    </div>
    <!-- Header Section -->
    <section id="header">
        <div class="header-hover">
            <div class="header-text">
                <p class="header-text-start">Selamat Datang di Situs Web Kami</p>
                <h2>MBOJO</h2>
                <p class="header-text-end">Kami hadir untuk memperkenalkan kuliner Bima</p>
                <a class="btn-circle" href="#"><i class="ion-ios-arrow-down"></i></a>
            </div>
        </div>
    </section>
    <!-- Header Section -->

    <div class="heading">
        <h2></h2>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet" />

       
    </div>

    <section id="blog-and-contact">
        <div class="container">
            <div class="flexibel-blog-grid">
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
                        <div class="grid-content"  id="posT">
                            <h3 class="grid-blog-title"><a href="{{url('/mbojo')}}/{{$globalpost->post_title}}">{{$globalpost->post_title}}</a></h3><hr>
                            <p class="info-content">{{$globalpost->author}} / {{date('j F Y', strtotime($globalpost->created_at))}}</p>
                            <hr>
							<div class="info-content-mobile">
                              
                                   
									
                               
								
                            </div>
@if(count($globalpost->PostCategory))
                                    @foreach($globalpost->PostCategory as $cat)
                                        <span class="info-content"><a href="{{url('/kategori')}}/{{($cat->slug)}}">#{{$cat->name}}</a></span>
                                    @endforeach
									 @endif
							</div>
                    </div>
                </div>
                @empty
                    <p>Post is empty</p>
                @endforelse
            </div>
            <div style="padding-left:40%">
                <a class="btn-action" href="{{url('/mbojo')}}" style="color:green; background-color:white;">Mbojo lainnya</a>
            </div>
        </div>    
    </section>

@endsection

<!-- Initialize Swiper -->
@section('script')
<script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#posT foreach").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>
    <script>
        var swiper = new Swiper('.product-row', {
            nextButton: '.right-row',
            prevButton: '.left-row',
            paginationClickable: true,
            slidesPerView: 5,
            spaceBetween: 0,
            breakpoints: {
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 0
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 0
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 0
                },
                320: {
                    slidesPerView: 1,
                    spaceBetween: 0
                }
            }
        });
    </script>
    
@endsection