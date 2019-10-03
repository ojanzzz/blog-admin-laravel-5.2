<?php $__env->startSection('title'); ?>
    Mbojo
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                <?php $__empty_1 = true; foreach($post as $globalpost): $__empty_1 = false; ?>
                <div class="flexibel-post-grid-mobile grid-3 card-1">
                    <?php if($globalpost->featured_images !=''): ?>
                    <div class="flexibel-post-grid-mobile-img">
                        <img class="img-responsive" src="<?php echo e(url('/photos/contents/medium')); ?>/<?php echo e($globalpost->featured_images); ?>" alt="<?php echo e($globalpost->post_title); ?>">
                    </div>
                    <?php else: ?>
                    <div class="flexibel-post-grid-mobile-img">
                        <img class="img-responsive" src="assets/landing/no-thumb-500x500.png" alt="<?php echo e($globalpost->post_title); ?>">
                    </div>
                    <?php endif; ?>
                    <div class="flexibel-post-grid-mobile-content">
                        <div class="grid-content"  id="posT">
                            <h3 class="grid-blog-title"><a href="<?php echo e(url('/mbojo')); ?>/<?php echo e($globalpost->post_title); ?>"><?php echo e($globalpost->post_title); ?></a></h3><hr>
                            <p class="info-content"><?php echo e($globalpost->author); ?> / <?php echo e(date('j F Y', strtotime($globalpost->created_at))); ?></p>
                            <hr>
							<div class="info-content-mobile">
                              
                                   
									
                               
								
                            </div>
<?php if(count($globalpost->PostCategory)): ?>
                                    <?php foreach($globalpost->PostCategory as $cat): ?>
                                        <span class="info-content"><a href="<?php echo e(url('/kategori')); ?>/<?php echo e(($cat->slug)); ?>">#<?php echo e($cat->name); ?></a></span>
                                    <?php endforeach; ?>
									 <?php endif; ?>
							</div>
                    </div>
                </div>
                <?php endforeach; if ($__empty_1): ?>
                    <p>Post is empty</p>
                <?php endif; ?>
            </div>
            <div style="padding-left:40%">
                <a class="btn-action" href="<?php echo e(url('/mbojo')); ?>" style="color:green; background-color:white;">Mbojo lainnya</a>
            </div>
        </div>    
    </section>

<?php $__env->stopSection(); ?>

<!-- Initialize Swiper -->
<?php $__env->startSection('script'); ?>
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
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>