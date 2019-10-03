<?php $__env->startSection('title'); ?>
    <?php echo e($post->post_title); ?>

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
    <?php if($post->featured_images !=''): ?>
    <section id="heading-post-title" style="background: url('<?php echo e(url('/photos/contents')); ?>/<?php echo e($post->featured_images); ?>') no-repeat center center fixed;">
    <?php else: ?>
    <section id="heading-post-title" style="background: url('<?php echo e(url('/assets/landing')); ?>/../landing/kuliner-bima.jpeg') no-repeat center center fixed;">
    <?php endif; ?>
        <div class="heading-title-cover">
            <div class="heading-title-text">
                <br><br>
                <p class="header-text-start"><?php echo e($post->post_title); ?></p><br><br>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="single-container">
            <article id="Post_<?php echo e($post->id); ?>" class="single-content card-1">
                <div class="container">
                    <h1 class="title-content"><?php echo e($post->post_title); ?></h1>
                    <span class="info-content">di publish oleh: <?php echo e($post->author); ?></span>,
                    <span class="info-content">pada tanggal: <?php echo e(date('j F Y', strtotime($post->created_at))); ?></span><br>
                    <?php if(count($post->PostCategory)): ?>
                        <span class="info-content">Kategori: </span>
                        <?php foreach($post->PostCategory as $categories): ?>
                            <span class="info-content">#<?php echo e($categories->name); ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <hr>

                    <img class="img-responsive" style="width:400px;height:400px;display:block;margin-left:auto;margin-right:auto;" src="<?php echo e(url('/photos/contents/medium')); ?>/<?php echo e($post->featured_images); ?>" >
                    <br>
                    <?php echo $post->post_content; ?>


                    <br>
                    <br>
                    <br>
                    <hr>
                    <h3>Artikel Terkait</h3>
                    <div class="flexibel-blog-grid-2">
                        <?php if(count($related)): ?>
                            <?php foreach($related as $related_post): ?>
                                <div class="grid-3-1 card-1">
                                    <div class="grid-break">
                                        <?php if($related_post->featured_images !=''): ?>
                                            <img class="img-responsive" src="<?php echo e(url('/photos/contents/medium')); ?>/<?php echo e($related_post->featured_images); ?>" alt="<?php echo e($related_post->post_title); ?>">
                                        <?php else: ?>
                                            <img class="img-responsive" src="../assets/landing/no-thumb-500x500.png" alt="<?php echo e($related_post->post_title); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="grid-content">
                                        <h3 class="grid-blog-title"><a href="<?php echo e(url('/mbojo')); ?>/<?php echo e($related_post->post_title); ?>"><?php echo e($related_post->post_title); ?></a></h3>
                                        <span class="info-content"><?php echo e($related_post->author); ?></span>,
                                        <span class="info-content"><?php echo e(date('j F Y', strtotime($related_post->created_at))); ?></span>
                                        <?php if(count($related_post->PostCategory)): ?>
                                            <?php foreach($related_post->PostCategory->slice(0,1) as $related_cat): ?>
                                                <p class="info-content"><a href="<?php echo e(url('/mbojo')); ?>/<?php echo e($related_cat->slug); ?>">#<?php echo e($related_cat->name); ?></a></p>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <hr>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </article>

            <aside class="sidebar">
                <div class="side-info">
                    <p class="side-blog-heading">Kategori</p>

                    <?php $__empty_1 = true; foreach($all_categories as $all_cat): $__empty_1 = false; ?>
                        <?php if(count($all_cat->CategoriesPost)): ?>
                            <?php foreach($all_cat->CategoriesPost->sortBy('name')->slice(0,1) as $cat): ?>
                                <div class="pages-info"><a href="<?php echo e(url('/kategori')); ?>/<?php echo e($all_cat->slug); ?>"><?php echo e($all_cat->name); ?></a> <span class="cat-count"><?php echo e($all_cat->CategoriesPost->count()); ?></span></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php endforeach; if ($__empty_1): ?>
                        <p>Nothing found!</p>
                    <?php endif; ?>
                </div>
            </aside>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>