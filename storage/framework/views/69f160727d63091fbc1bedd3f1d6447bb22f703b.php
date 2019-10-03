<?php $__env->startSection('content'); ?>
       <div id="load">
        <div id="loader"></div>
    </div>
    <!-- Header Section -->
    <section id="header">
        <div class="header-hover">
            <div class="header-text">
                <p class="header-text-start">Hasil Pencarian</p>
                <h2><?php echo e($query); ?></h2>
                
            </div>
        </div>
    </section>
    <!-- Header Section -->

   
       
    </div>

   <section id="blog-and-contact">
        <div class="container">
            <div class="flexibel-blog-grid">
 
<div class="section">
<?php if(count($hasil)): ?>

    <?php foreach($hasil as $data): ?>
    <div class="row">
		<div class="container">
		<div class="flexibel-post-grid-mobile grid-3 card-1"><a href="<?php echo e(url('/mbojo')); ?>/<?php echo e($data->post_title); ?>">
			<h4><?php echo e($data->post_title); ?></a></h4>
			
<div class="flexibel-post-grid-mobile-img">
                        <img class="img-responsive" src="<?php echo e(url('/photos/contents/medium')); ?>/<?php echo e($data->featured_images); ?>" alt="<?php echo e($data->post_title); ?>">
                    </div>
            <div class="info-content-mobile">
                                <?php if(count($data->PostCategory)): ?>
                                    <?php foreach($data->PostCategory as $cat): ?>
                                        <span class="info-content"><a href="<?php echo e(url('/kategori')); ?>/<?php echo e(($cat->slug)); ?>">#<?php echo e($cat->name); ?></a></span>
                                    <?php endforeach; ?>
                                    <hr>
                                <?php endif; ?>    
                           
                            </div>  
          
		</div></a>
		</div>
	</div>
	<?php endforeach; ?>
<?php echo e($hasil->render()); ?>

	
<?php else: ?>
   <div class="card-panel red darken-3 white-text">Oops.. Data <b><?php echo e($query); ?></b> Tidak Ditemukan</div>
<?php endif; ?>
</div>
 </div>
        </div>    
    </section>


	



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>