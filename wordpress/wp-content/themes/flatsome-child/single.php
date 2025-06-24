<?php
/* Template for displaying single post */
get_header(); ?>

<main class="single-post">
    <div class="container-970 pt-100 pb-100">
        
        <!-- Ngày đăng bài -->
        <div class="post-date">
            <?php echo get_the_date('d.m.Y'); ?>
        </div>
        
        <!-- Tên bài viết -->
        <h1 class="post-title">
            <?php the_title(); ?>
        </h1>
        
        <!-- Ảnh Featured -->
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-featured-image">
            <?php the_post_thumbnail('full', ['alt' => get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)]); ?>
            </div>
        <?php endif; ?>
        
        <!-- Nội dung bài viết -->
        <div class="post-content">
            <?php
            while (have_posts()) : the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
