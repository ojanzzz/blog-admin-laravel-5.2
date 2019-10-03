
@extends('layout.master')

@section('content')
       <div id="load">
        <div id="loader"></div>
    </div>
    <!-- Header Section -->
    <section id="header">
        <div class="header-hover">
            <div class="header-text">
                <p class="header-text-start">Hasil Pencarian</p>
                <h2>{{$query}}</h2>
                
            </div>
        </div>
    </section>
    <!-- Header Section -->

   
       
    </div>

   <section id="blog-and-contact">
        <div class="container">
            <div class="flexibel-blog-grid">
 
<div class="section">
@if (count($hasil))

    @foreach($hasil as $data)
    <div class="row">
		<div class="container">
		<div class="flexibel-post-grid-mobile grid-3 card-1"><a href="{{url('/mbojo')}}/{{$data->post_title}}">
			<h4>{{$data->post_title}}</a></h4>
			
<div class="flexibel-post-grid-mobile-img">
                        <img class="img-responsive" src="{{url('/photos/contents/medium')}}/{{$data->featured_images}}" alt="{{$data->post_title}}">
                    </div>
            <div class="info-content-mobile">
                                @if(count($data->PostCategory))
                                    @foreach($data->PostCategory as $cat)
                                        <span class="info-content"><a href="{{url('/kategori')}}/{{($cat->slug)}}">#{{$cat->name}}</a></span>
                                    @endforeach
                                    <hr>
                                @endif    
                           
                            </div>  
          
		</div></a>
		</div>
	</div>
	@endforeach
{{ $hasil->render() }}
	
@else
   <div class="card-panel red darken-3 white-text">Oops.. Data <b>{{$query}}</b> Tidak Ditemukan</div>
@endif
</div>
 </div>
        </div>    
    </section>


	



@endsection