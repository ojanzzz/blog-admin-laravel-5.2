<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
    <style>


input[type=text] {
  width: 130px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
  background-image: url('searchicon.png');
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
  width: 220px;
}


</style>
        <title>@yield('title')</title>

        @yield('link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		
        <link href="{{asset('assets/landing/logo.ico')}}" rel="icon">
        <link href="{{asset('assets/css/layout.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/swiper.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/ionicons.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/image-preview.css')}}" rel="stylesheet">
        

        
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="brand">
                    <h1><a href="{{url('/')}}"style="text-decoration:none"><img src="{{asset('assets/landing/logo_bima.png')}}" alt="home" style="width: 120px"></a></h1>
                </div>
                <div class="nav-right">
                    <div class="hamburger-menu">
                        <i class="ion-navicon"></i>
                    </div>
                    <nav>
                        <ul class="header-nav">
						
 
						<li class="dropdown" data-toggle="modal" data-target="#myModal" style="color:black">Kritik Saran</li>
                       
						
                            <li class="dropdown"><a href="{{url('/')}}"style="text-decoration:none">Beranda</a></li>
                            <li class="dropdown"><a href="{{url('/tentang')}}"style="text-decoration:none">About</a></li>
                       
					  			 <li class="dropdown">
		
					 
 </li>
   <form action="{{ url('query') }}" method="GET">
   
          <div class="input-field col s12">
            <input type="text" class="validate" name="q" placeholder="Cari">
            <button type="submit" class="btn btn-flat pink accent-3 waves-effect waves-light white-text right"> <i class="material-icons right">search</i></button>
          </div>
           
  
 </form>
						
		

				<ul>
						
                    </nav>
                </div>
            </div>
        </div>
    </header>   
	
    @include('kritik-modal')
    @yield('content')

    <footer>  
        <div class="about-developer">
            <p>Copyright &copy; <script type="text/javascript">var creditsyear = new Date();document.write(creditsyear.getFullYear())</script>. <a href="/">Mbojo</a>. All Rights Reserved</p>
        </div>
    </footer>
    
    <script src="{{asset('assets/js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{asset('assets/js/default.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/swiper.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(window).load(function() {
        $("#load").fadeOut("slow");
    });

    </script>
    
    
    @yield('script')
    
</body>
</html>

