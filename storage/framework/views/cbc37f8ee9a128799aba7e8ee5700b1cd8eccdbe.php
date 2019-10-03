  <script src="<?php echo e(asset('assets/js/jquery-1.11.1.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/bootstrap-table.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/image-preview.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/dropzone.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/tinymce/js/tinymce/tinymce.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/select2.min.js')); ?>"></script>
  
<script type="text/javascript">

  $(document).ready(function(){ //

    var editor_config = {
      path_absolute : "/",
      selector: "textarea.my-editor",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      relative_urls: false,
      file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
          file : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no"
        });
      }
    };

    tinymce.init(editor_config);

    //
    !function ($) {
      $(document).on("click","ul.nav li.parent > a > span.icon", function(){      
        $(this).find('em:first').toggleClass("glyphicon-minus");    
      }); 
      $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function () {
      if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
      if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })

    //
    $.uploadPreview({
      input_field: "#image-upload",
      preview_box: "#image-preview",
      label_field: "#image-label"
    });

    //
    Dropzone.options.addImage = {
      paramName: "featured",
      acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif',
      init: function() {
            this.on("success", function(file, response) {
                $('.img-galleries').append("<div><div class='img-gallery-overlay'><img src='/photos/galleries/thumb/"+response.featured+"'><div class='img-gallery-action'><a href='' data-toggle='modal' data-target='#"+response.id+"'>Delete</a></div></div></div>");
            })
        }
    };

    //    
    $(window).load(function() {
      // Animate loader off screen
      $("#loader").fadeOut("slow");
     });

    $(".sub-item.active").closest(".parent-item").removeClass("collapsed");
    $(".sub-item.active").closest(".sub-item-id").addClass("in");

    //
    $('#open_accordion').click(function(){
    $('.panel_accordion').slideToggle();
    $('.panel_list').slideToggle();
      if ($('#open_accordion').text() == '- Tutup') {
          $('#open_accordion').text('+ Tambah');
      }
      else {
          $('#open_accordion').text('- Tutup');
      }
    });

    //
    $('.click-and-remove ').click(function(){
        $('.close-and-remove ').remove();
    });
    
    //    
    $(".close-and-remove").fadeIn("slow");
    $(".close-and-remove").addClass("show-notif");
      setTimeout(function() {
        $(".notif").fadeOut(300);
      },4700);
      setTimeout(function() {
        $(".close-and-remove").removeClass("show-notif").addClass("hide-notif");
      },5000);

    //
    $(".selected").select2({
      placeholder: "Select category"
    });


$('#addCat').click(function(){            
  $.ajax({
      url: '/admin/tambah-kategori-sukses',
      type: "POST",
      data: {'name':$('input[name=name]').val(), '_token': $('input[name=_token]').val()},

        success: function(data)
            {
              if(data.errors){
                 //Notification
                 $('#ajax_error').removeClass('hide-ajax').addClass('show-ajax').html('<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> Oops something wrong!<a href="#" class="pull-right"><span class="click-and-remove glyphicon glyphicon-remove"></span></a>');
                    setTimeout(function() {
                      $('#ajax_error').removeClass('show-ajax').addClass('hide-ajax');
                  },2800);
              }
              else{
                 $('#ajax_response').removeClass('hide-ajax').addClass('show-ajax').html('<svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Successfully added!<a href="#" class="pull-right"><span class="click-and-remove glyphicon glyphicon-remove"></span></a>');
                    setTimeout(function() {
                      $('#ajax_response').removeClass('show-ajax').addClass('hide-ajax');
                  },2800);

                  $('#category_id').append("<option title='"+data.name+"' value='"+data.id+"' class='o-multiple'>"+data.name+"</option>");

                  $('#category_list').append("<li class='todo-list-item' id='todo_list"+data.id+"'><label>"+data.name+"</label><div class='pull-right action-buttons'><a href='#' data-toggle='modal' id='EditCat' data-target='#EditcategoryModal' data-item-id='"+data.id+"' data-id='"+data.name+"'><svg class='small-icon glyph stroked pencil'><use xmlns:xlink='http://www.w3.org/1999/xlink' xlink:href='#stroked-pencil'></use></svg></a> <button class='destroyCat btn-hidden' value='"+data.id+"'><svg class='small-icon glyph stroked trash'><use xmlns:xlink='http://www.w3.org/1999/xlink' xlink:href='#stroked-trash'></use></svg></button></div></li>");
              }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
               $('#ajax_error').removeClass('hide-ajax').addClass('show-ajax').html('<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> Oops something wrong!<a href="#" class="pull-right"><span class="click-and-remove glyphicon glyphicon-remove"></span></a>');
                    setTimeout(function() {
                      $('#ajax_error').removeClass('show-ajax').addClass('hide-ajax');
                  },2800);
            }
    });      
  }); 

// $('.edit-modal').on('click','#EditSave', function(){
$('#EditSave').click(function(){         
    $.ajax({
      url: '/admin/kategori-edit-sukses',
      type: "POST",
      data: {'id':$('input[name=id].edits').val(), 'name':$('input[name=name].edits').val(), '_token': $('input[name=_token].edits').val()},

        success: function(data)
            {
              if(data.errors){
                 //Notification
                 $('#ajax_edit_error').removeClass('hide-ajax').addClass('show-ajax').html('<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> Oops something wrong!<a href="#" class="pull-right"><span class="click-and-remove glyphicon glyphicon-remove"></span></a>');
                    setTimeout(function() {
                      $('#ajax_edit_error').removeClass('show-ajax').addClass('hide-ajax');
                  },2800);
              }
              else{
                 $('#ajax_edit').removeClass('hide-ajax').addClass('show-ajax').html('<svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Successfully added!<a href="#" class="pull-right"><span class="click-and-remove glyphicon glyphicon-remove"></span></a>');
                    setTimeout(function() {
                      $('#ajax_edit').removeClass('show-ajax').addClass('hide-ajax');
                  },2800);

                  $('#todo_list'+data.id).remove();
                  $("#category_id option[value='"+data.id+"']").remove();

                  $('#category_id').append("<option title='"+data.name+"' value='"+data.id+"' class='o-multiple'>"+data.name+"</option>");

                  $('#category_list').append("<li class='todo-list-item' id='todo_list"+data.id+"'><label>"+data.name+"</label><div class='pull-right action-buttons'><a href='#' data-toggle='modal' id='EditCat' data-target='#EditcategoryModal' data-item-id='"+data.id+"' data-id='"+data.name+"'><svg class='small-icon glyph stroked pencil'><use xmlns:xlink='http://www.w3.org/1999/xlink' xlink:href='#stroked-pencil'></use></svg></a> <button class='destroyCat btn-hidden' value='"+data.id+"'><svg class='small-icon glyph stroked trash'><use xmlns:xlink='http://www.w3.org/1999/xlink' xlink:href='#stroked-trash'></use></svg></button></div></li>");
              }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
               $('#ajax_edit_error').removeClass('hide-ajax').addClass('show-ajax').html('<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> Oops something wrong!<a href="#" class="pull-right"><span class="click-and-remove glyphicon glyphicon-remove"></span></a>');
                    setTimeout(function() {
                      $('#ajax_edit_error').removeClass('show-ajax').addClass('hide-ajax');
                  },2800);
            }
    });      
  }); 

// $('.destroyCat').click(function(){ 
$('#category_list').on('click','.destroyCat', function(){  
  var action = $(this).val();
    $.ajax({
      url: '/admin/kategori-hapus/'+action,
      type: "DELETE",

        success: function(data)
            {
              if(data.errors){
                  //Notification
                  $('#ajax_error').removeClass('hide-ajax').addClass('show-ajax').html('<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> Oops something wrong!<a href="#" class="pull-right"><span class="click-and-remove glyphicon glyphicon-remove"></span></a>');
                    setTimeout(function() {
                      $('#ajax_error').removeClass('show-ajax').addClass('hide-ajax');
                  },2800);

              }
              else{
                
                 $('#ajax_error').removeClass('hide-ajax').addClass('show-ajax').html('<svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Successfully deleted!<a href="#" class="pull-right"><span class="click-and-remove glyphicon glyphicon-remove"></span></a>');
                    setTimeout(function() {
                      $('#ajax_error').removeClass('show-ajax').addClass('hide-ajax');
                  },2800);

                  $('#todo_list'+data.id).remove();
                  $("#category_id option[value='"+data.id+"']").remove();
              }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                $('#ajax_error').removeClass('hide-ajax').addClass('show-ajax').html('<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> Oops something wrong!<a href="#" class="pull-right"><span class="click-and-remove glyphicon glyphicon-remove"></span></a>');
                    setTimeout(function() {
                      $('#ajax_error').removeClass('show-ajax').addClass('hide-ajax');
                },2800);
            }
    });      
  }); 

  //
  $.ajaxSetup({
     headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
  });

  //
  $(document).on("click", "#EditCat", function () {
     
     var Item = $(this).data('itemId')
     var Category = $(this).data('id');
     $(".edit-modal #id").val(Item);
     $(".edit-modal #name").val(Category);

  });

});

</script>

<div id="loader"></div>