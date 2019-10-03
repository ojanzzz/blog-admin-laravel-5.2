<style>
	a:link {
color:#fff;
text-decoration:none;
}

a:hover {
color:#fff;
text-decoration:none;
}

a:visited {
color:#fff;
text-decoration:none;
}

input[type=texts] {
  width: 100%;
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
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kritik Dan Saran</h4>
		 
        </div>
        <div class="modal-body">
            <?php if(Session::has('status')): ?>
                <div class="alert alert-success"><?php echo e(Session::get('status')); ?></div>
                <?php endif; ?>

                <form action="" method="post">

                    <?php echo e(csrf_field()); ?>


                    <label for="name">Nama</label>
                    <input class="form-control" type="texts" name="name" placeholder="Nama Anda" />
                    
					
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" placeholder="Email Anda" />
                    
                    <label for="message">Pesan</label>
                    <textarea class="form-control" name="message" id="" placeholder="Pesan Anda" cols="20" rows="10"></textarea>

                    <br><br>

                    <button class="btn btn-success btn-block">Send</button>
                <form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  </div>
  </div>