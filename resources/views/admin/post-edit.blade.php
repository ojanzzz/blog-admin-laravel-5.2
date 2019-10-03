<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel Adminstrator</title>
  <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet">
  @include('admin.admin-css')
</head>

<body>
  @include('admin.admin-header')

  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">     
    <div class="row">
      <ol class="breadcrumb">
        <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
        <li>Mbojo</li>
        <li class="active">Edit</li>
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

    @if (Session::has('update_message'))
      <div class="notif">
        <div class="notification">
          <div class="close-and-remove alert bg-success" role="alert">
            <svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> 
            {{ Session::get('update_message') }}
            <a href="#" class="pull-right"><span class="click-and-remove glyphicon glyphicon-remove"></span></a>
          </div>
        </div>
      </div>
    @endif
    
    <div class="row">
      <div class="col-lg-12 down-animation">
        <div class="panel panel-default card-1">
          <div class="panel-heading"><svg class="glyph stroked blank document"><use xlink:href="#stroked-blank-document"/></svg> Edit Mbojo</div>
          <div class="content-break">
            <div class="panel-body">
              <form class="form-horizontal" method="POST" action="/admin/mbojo-edit-sukses" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="id" value="{{$edit->id}}">
                <input type="hidden" name="author" value="{{$role->name}}">
                <fieldset>          
                  <div class="form-group">
                    <label class="col-md-2 control-label">Nama :</label>
                    <div class="col-md-9">
                      <input name="post_title" type="text" value="{{$edit->post_title}}" class="form-control" required="required">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Gambar :</label>
                    <div class="col-md-9 choose-file">
                      <!-- Image Preview -->
                      @if($edit->featured_images !='')
                        <div id="image-preview" style="background-image: url('{{url('/photos/contents/thumb')}}/{{$edit->featured_images}}'); background-repeat:no-repeat;background-size:contain;background-position:center;"/>
                          <label for="image-upload" id="image-label">Ganti Gambar Makanan</label>
                          <input class="hidden" type="file" id="image-upload" name="featured_images" class="form-control">
                        </div>
                      @else
                        <div id="image-preview">
                          <label for="image-upload" id="image-label">Pilih Gambar Makanan</label>
                          <input type="file" id="image-upload" class="form-control" name="featured_images" accept="image/*"/>
                        </div>
                      @endif
                      <!-- Image Preview -->
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label class="col-md-2 control-label">Keterangan :</label>
                    <div class="col-md-9">
                      <textarea class="form-control my-editor" value="{{$edit->post_content}}" name="post_content" rows="5">{{$edit->post_content}}</textarea>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-2 control-label">Lokasi :</label>
                      <div class="col-md-9">
                          <input name="location" type="text" value="{{$edit->location}}" class="form-control" required="required">
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Jenis Makanan :</label>
                    <div class="col-md-9">
                      <select class="selected form-control" multiple="multiple" name="category_id[]" id="category_id" required="required">
                        @foreach($has_categories as $has_category)
                          @foreach($has_category->CategoriesPost as $cat)
                            @if($cat->pivot->post_id == $edit->id)
                              <option title="{{$has_category->name}}" id="inputCat{{$has_category->id}}" value="{{$has_category->id}}" class="o-multiple" {{($has_category->name == $has_category->name) ? 'selected=selected' : ''}}> {{ $has_category->name }} </option>
                            @endif

                            @if($cat->pivot->post_id !== $edit->id)
                              <option title="{{$has_category->name}}" id="inputCat{{$has_category->id}}" value="{{$has_category->id}}" class="o-multiple"> {{$has_category->name}} </option>
                            @endif
                          @endforeach
                        @endforeach
                      </select>

                      <!-- Trigger the modal with a button -->
                      <a class="add-new-category" href="" data-toggle="modal" data-target="#categoryModal">Tambah kategori baru</a>
                    </div>
                  </div>
                
                  <!-- Form actions -->
                  <div class="form-group">
                    <div class="col-md-11 widget-right">
                      <button type="submit" class="btn btn-default btn-md pull-right">Simpan</button>
                    </div>
                  </div>
                </fieldset>
              </form>

              @include('admin.admin-modal')
            
            </div>
          </div>
        </div>
      </div>
    </div><!--/.row-->                
  </div><!--/.col-->

  @include('admin.admin-js')

</body>
</html>
