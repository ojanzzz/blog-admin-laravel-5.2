<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Panel Administrator</title>

@include('admin.admin-css')

</head>

<body>

@include('admin.admin-header')
    
  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">     
    <div class="row">
      <ol class="breadcrumb">
        <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
        <li class="active">Password</li>
      </ol>
    </div><!--/.row-->

@if (count($errors) > 0)
<div class="notif">
@foreach ($errors->all() as $error)
<div class="notification">
<div class="close-and-remove alert bg-danger" role="alert">
<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> 
{{$error}} 
<a href="#" class="pull-right"><span class="click-and-remove glyphicon glyphicon-remove"></span></a>
</div>
</div>
@endforeach
</div>
@endif

@if (Session::has('passmessage'))
<div class="notif">
<div class="notification">
<div class="close-and-remove alert bg-success" role="alert">
<svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> 
{{ Session::get('passmessage') }}
<a href="#" class="pull-right"><span class="click-and-remove glyphicon glyphicon-remove"></span></a>
</div>
</div>
</div>
@endif
    
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">Ganti Password</div>
          
          <div class="content-break">
           <div class="panel-body">
            <form class="form-horizontal" method="POST" action="/admin/password/sukses">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <fieldset>

                <div class="form-group">
                <label class="col-md-3 control-label">Password Lama</label>
                <div class="col-md-8">
                    <input type="password" class="form-control" name="old_password">
                </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Password Baru</label>
                    <div class="col-md-8">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Ulangi Password</label>
                    <div class="col-md-8">
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-11 widget-right">
                        <button name="submit" type="submit" class="btn btn-default btn-md pull-right">Simpan</button>
                    </div>
                </div>
                <!-- Form actions -->

                </fieldset>
            </form>
           </div>
         </div>

        </div>
      </div>
    </div><!--/.row-->                
  </div><!--/.col-->
 </div><!--/.row-->
</div>  <!--/.main-->

@include('admin.admin-js')

</body>

</html>
