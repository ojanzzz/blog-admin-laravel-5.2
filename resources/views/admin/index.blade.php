<!DOCTYPE html>
<html lang="en">
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
        <li class="active">Dashboard</li>
      </ol>
    </div><!--/.row-->

    @if (Session::has('admin_welcome'))
      <div class="notif">
        <div class="notification">
          <div class="close-and-remove alert bg-primary" role="alert">
            <svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg>
            {{ Session::get('admin_welcome') }} {{$role->name}}
            <a href="#" class="pull-right"><span class="click-and-remove glyphicon glyphicon-remove"></span></a>
          </div>
        </div>
      </div>
    @endif

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

    @if (Session::has('destroy_message'))
      <div class="notif">
        <div class="notification">
          <div class="close-and-remove alert bg-danger" role="alert">
            <svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> 
            {{ Session::get('destroy_message') }}
            <a href="#" class="pull-right"><span class="click-and-remove glyphicon glyphicon-remove"></span></a>
          </div>
        </div>
      </div>
    @endif

    <div class="panel-heading">
      <div id="open_accordion">+ Tambah</div>
    </div>

    <!-- Accordion -->
    <div class="panel_accordion">
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default card-1">
            <div class="panel-heading">Form Mbojo</div>
            <div class="content-break">
              <div class="panel-body">
                <form class="form-horizontal" method="POST" action="/admin/tambah-mbojo-sukses" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  <input type="hidden" name="post_id" value="{{$role->id}}">
                  <input type="hidden" name="author" value="{{$role->name}}">
                  <fieldset>
                    <div class="form-group">
                      <label class="col-md-2 control-label">Nama :</label>
                      <div class="col-md-9">
                        <input name="post_title" type="text" placeholder="Masukan nama makanan" class="form-control" required="required">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label" for="featured_images">Gambar :</label>
                      <div class="col-md-9 choose-file">
                        <!-- Image Preview -->
                        <div id="image-preview">
                          <label for="image-upload" id="image-label">Pilih Gambar Makanan</label>
                          <input type="file" id="image-upload" class="form-control" name="featured_images" accept="image/*"/>
                        </div>
                        <!-- Image Preview -->
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-md-2 control-label">Keterangan :</label>
                      <div class="col-md-9">
                        <textarea class="form-control my-editor" name="post_content" placeholder="Isi keterangan makanan..." rows="5"></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Lokasi :</label>
                      <div class="col-md-9">
                        <input name="location" type="text" placeholder="Masukan lokasi" class="form-control" required="required">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Jenis Makanan :</label>
                      <div class="col-md-9">
                        <select class="selected form-control" multiple="multiple" name="category_id[]" id="category_id" required="required">
                          @foreach($categories as $category)
                            <option title="{{$category->name}}" id="inputCat{{$category->id}}" value="{{$category->id}}" class="o-multiple">{{$category->name}}</option>
                            <li role="treeitem" aria-live="assertive" class="select2-results__option"></li>
                          @endforeach
                        </select>

                        <!-- Trigger the modal with a button -->
                        <a class="add-new-category" href="" data-toggle="modal" data-target="#categoryModal">Tambah Jenis Makanan Baru</a>
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
    </div><!--/ Panel Accordion-->
    <!-- Accordion -->

    <div class="row panel_list">
      <div class="col-lg-12 down-animation">
        <div class="panel panel-default card-1">
          <div class="panel-heading">Mbojo</div>
          <div class="panel-body">
            <table data-toggle="table" data-url="{{url('admin/data-mbojo')}}"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
              <thead>
                <tr>
                  <th data-field="" data-checkbox="true"></th>
                  <th data-field="id" data-sortable="true">ID</th>
                  <th data-field="post_title" data-sortable="true">Nama</th>
                  <th data-field="featured_images"  data-sortable="true">Gambar</th>
                  <th data-field="post_content" data-sortable="true">Keterangan</th>
                  <th data-field="location" data-sortable="true">Lokasi</th>
                  <th data-field="author"  data-sortable="true">Penulis</th>
                  <th data-formatter="Posts">Aksi</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div><!--/.row-->  
  </div>  <!--/.main-->

  @include('admin.admin-js')

</body>
</html>
