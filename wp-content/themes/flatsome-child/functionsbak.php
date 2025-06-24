<?php

define('THEME_URL', get_stylesheet_directory_uri());

function kodi_vn_scripts() {
    // Import CSS
    wp_enqueue_style('slick-carousel-style', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1', 'all');
    wp_enqueue_style('slick-carousel-theme-style', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', array('slick-carousel-style'), '1.8.1', 'all');
    wp_enqueue_style('my-style', THEME_URL . 'style.css', array(), '1.0.0', 'all');
    wp_enqueue_style('post-style', THEME_URL . '/assets/css/post.css', array(), '1.0.0', 'all');

    // Import JS
    wp_enqueue_script('jquery-migrate-script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.5.2/jquery-migrate.min.js', array('jquery'), '3.5.2', true);
    wp_enqueue_script('jquery-waypoints-script', 'https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js', array('jquery'), '4.0.1', true);
    wp_enqueue_script('slick-carousel-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true);
    wp_enqueue_script('my-script', THEME_URL . '/assets/js/my-script.js', array('jquery'), '1.0.0', true);
 
    // Trang chủ
   if (is_page(31) || is_page(948)) {
    wp_enqueue_style('home-style', THEME_URL . '/assets/css/home.css', array(), '1.0.0', 'all');
    wp_enqueue_script('home-script', THEME_URL . '/assets/js/home.js', array('jquery'), '1.0.0', true);
}   
    // Trang giới thiệu
    if (is_page( 33 ) || is_page(969)) {
        wp_enqueue_style('introduce-style', THEME_URL . '/assets/css/introduce.css', array(), '1.0.0', 'all');
    }   
     // Trang lịch sử
     if (is_page( 35 ) || is_page(974)) {
        wp_enqueue_style('history-style', THEME_URL . '/assets/css/history.css', array(), '1.0.0', 'all');
    }   
      // Trang liên hệ
      if (is_page( 352 ) || is_page(984)) {
        wp_enqueue_style('contact-style', THEME_URL . '/assets/css/contact.css', array(), '1.0.0', 'all');
    }   
     // Áp dụng CSS cho các trang sử dụng Sub Product Template
     if (is_page_template('page-product-detail.php')) {
        // CSS
        wp_enqueue_style(
            'product-detail-css',
            THEME_URL . '/assets/css/product-detail.css',
            array(),
            filemtime( get_stylesheet_directory() . '/assets/css/product-detail.css' ), // Tự động cập nhật khi file thay đổi
            'all'
        );
         // JS
         wp_enqueue_script(
            'product-detail-js',
            THEME_URL . '/assets/js/product-detail.js',
            array('jquery'), // Phụ thuộc vào jQuery
            filemtime( get_stylesheet_directory() . '/assets/js/product-detail.js' ), // Tự động cập nhật khi file thay đổi
            true // Load ở footer
        );
    }
      // Áp dụng CSS cho các trang chi tiết bài viết (single.php)
    if (is_singular('post')) { // Kiểm tra nếu là bài post
        wp_enqueue_style(
            'post-detail-css',
            THEME_URL . '/assets/css/post-detail.css',
            array(),
            filemtime(get_stylesheet_directory() . '/assets/css/post-detail.css'), // Tự động cập nhật khi file thay đổi
            'all'
        );
    }
}
add_action('wp_enqueue_scripts', 'kodi_vn_scripts', 9999);

add_action('init', function () {
    // Gỡ bỏ shortcode gốc do Flatsome đăng ký
    remove_shortcode('blog_posts');
});

add_action('init', function () {
    add_shortcode('blog_posts', function ($atts, $content = null) {
        // Các tham số mặc định
        $atts = shortcode_atts(array(
            'posts' => '9',            // Số lượng bài viết
            'columns' => '3',          // Số cột hiển thị
            'excerpt_length' => 30,    // Độ dài đoạn trích
            'image_size' => '75%',  // Kích thước ảnh
        ), $atts);

        // Truy vấn bài viết
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $atts['posts'],
            'orderby' => 'date',
            'order' => 'DESC',
        );

        $query = new WP_Query($args);

        // Bắt đầu nội dung
        ob_start();

        if ($query->have_posts()) {
            echo '<div class="blog-posts-grid" >';

            while ($query->have_posts()) {
                $query->the_post();
                ?>
                <div class="blog-post-item" >
                    <!-- Ảnh bài viết -->
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="blog-post-thumbnail " >
                            <?php the_post_thumbnail($atts['image_size'] ); ?>
                        </a>
                    <?php endif; ?>

                    <!-- Ngày đăng -->
                    <div class="post-meta is-small" >
                        <?php echo get_the_date('d.m.Y'); ?>
                    </div>

                    <!-- Tiêu đề bài viết -->
                    <h5 class="post-title" >
                        <a href="<?php the_permalink(); ?>" style="text-decoration: none; color: #333;">
                            <?php the_title(); ?>
                        </a>
                    </h5>

                    <!-- Đoạn trích -->
                    <p class="post-excerpt" >
                        <?php echo wp_trim_words(get_the_excerpt(), $atts['excerpt_length'], '...'); ?>
                    </p>
                </div>
                <?php
            }

            echo '</div>';

            // Hiển thị phân trang nếu cần
            echo '<div class="pagination" style="margin-top: 20px; text-align: center;">';
            echo paginate_links(array(
                'total' => $query->max_num_pages,
            ));
            echo '</div>';
        }

        wp_reset_postdata();

        return ob_get_clean();
    });
});

function add_wow_and_animate() {
    // Thêm Animate.css
    wp_enqueue_style('animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', array(), '4.1.1');

    // Thêm WOW.js
    wp_enqueue_script('wow-js', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', array('jquery'), '1.1.2', true);

    // Khởi chạy WOW.js
    wp_add_inline_script('wow-js', 'new WOW().init();');
}
add_action('wp_enqueue_scripts', 'add_wow_and_animate');



// GG Tag Manager
// Thêm mã GTM vào <head>
add_action('wp_head', function () {
    ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5KJ3PMZF');</script>
    <!-- End Google Tag Manager -->
    <?php
});

// Thêm mã GTM vào sau thẻ <body>
add_action('wp_body_open', function () {
    ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5KJ3PMZF"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
});

if (function_exists('pll_register_string')) {
    pll_register_string('technical_specs', 'Thông số kỹ thuật', 'MyTheme');
	pll_register_string('engine', 'Động Cơ','MyTheme');
	pll_register_string('equipment', 'Thiết Bị', 'MyTheme');
	pll_register_string('standard_equipment', 'Thiết bị tiêu chuẩn', 'MyTheme');
	pll_register_string('additional_options', 'Tùy chọn thêm', 'MyTheme');
}








