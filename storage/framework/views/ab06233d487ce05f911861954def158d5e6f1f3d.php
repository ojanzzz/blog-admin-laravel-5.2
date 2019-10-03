<?php $__env->startSection('title', 'Mbojo'); ?>

<?php $__env->startSection('content'); ?>

    <section id="heading-post-title" style="background: url('<?php echo e(url('/assets/landing')); ?>/../landing/kuliner-bima.jpeg') no-repeat center center fixed;">
        <div class="heading-title-cover">
            <div class="heading-title-text-category">
                <br><br>
                <p class="header-text-start">Mbojo</p><br><br>
            </div>
        </div>
    </section>

    <div class="heading"></div>

    <article>
        <div class="container">
            <div class="flexibel-post-grid">
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
                            <div class="grid-content">
                                <h3 class="grid-blog-title"><a href="<?php echo e(url('/mbojo')); ?>/<?php echo e($globalpost->post_title); ?>"><?php echo e($globalpost->post_title); ?></a></h3><hr>
                                <p class="info-content"><?php echo e($globalpost->author); ?> / <?php echo e(date('j F Y', strtotime($globalpost->created_at))); ?></p>
                                <div class="info-content-mobile">
                                    <?php if(count($globalpost->PostCategory)): ?>
                                        <?php foreach($globalpost->PostCategory->slice(0,1) as $cat): ?>
                                            <span class="info-content">#<?php echo e($cat->name); ?></span>
                                        <?php endforeach; ?>
                                        <hr>
                                    <?php endif; ?>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <?php endforeach; if ($__empty_1): ?>
                    <p>Post is empty</p>
                <?php endif; ?>
            </div>
        </div>
    </article>

    <div class="container">
        <div class="pager">
            <?php echo $post->links(); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>