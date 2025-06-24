<?php
/* 
Template Name: Chi tiết sản phẩm Template
Template Post Type: page
*/
get_header(); ?>

<!-- Banner -->
<?php
$gallery = get_field('banner');
if ($gallery) : ?>
    <section class="custom-banner-gallery">
        <?php foreach ($gallery as $image) : ?>
            <div class="custom-banner-item">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            </div>
        <?php endforeach; ?>
    </section>
<?php endif; ?>

<!-- Thông tin chi tiết -->
<section class="custom-product-detail">
    <img class="bg-layer" src="/wp-content/uploads/2025/01/bg-layer-4-1.webp" alt="background-layer"/>
    <div class="container-1170 pt-100 pb-70">
        <!-- Cột thông tin -->
        <div class="custom-col-info">
            <h1><?php the_title(); ?></h1>
            <div class="custom-content">
                <?php
                while (have_posts()) : the_post();
                    the_content();
                endwhile;
                ?>
            </div>
        </div>

        <!-- Accordion thông số kỹ thuật -->
        <div class="custom-col-parameters">
            <p class="h1"><?php the_title(); ?></p>
            <div class="custom-product-accordion">

                <?php
                // Accordion 1: Thông số kỹ thuật
                if (have_rows('thong_so_chung')) :
                    ?>
                    <div class="custom-accordion-item">
                        <h2 class="custom-accordion-title"><span><?php echo pll__('Thông số kỹ thuật'); ?></span></h2>
                        <div class="custom-accordion-content">
                            <?php
                            while (have_rows('thong_so_chung')) : the_row();
                                if (have_rows('thong_so_1')) :
                                    echo '<table class="custom-info-table">';
                                    while (have_rows('thong_so_1')) : the_row();
                                        $title = get_sub_field('row_title');
                                        $value = get_sub_field('row_value');
                                        echo "<tr><td>$title</td><td>$value</td></tr>";
                                    endwhile;
                                    echo '</table>';
                                endif;
                            endwhile;
                            ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                // Accordion 2: Động cơ
                if (have_rows('thong_so_chung')) :
                    ?>
                    <div class="custom-accordion-item">
                        <h2 class="custom-accordion-title"><span><?php echo pll__('Động Cơ'); ?></span></h2>
                        <div class="custom-accordion-content">
                            <?php
                            while (have_rows('thong_so_chung')) : the_row();
                                if (have_rows('dong_co')) :
                                    echo '<table class="custom-info-table">';
                                    while (have_rows('dong_co')) : the_row();
                                        $title = get_sub_field('row_title');
                                        $value = get_sub_field('row_value');
                                        echo "<tr><td>$title</td><td>$value</td></tr>";
                                    endwhile;
                                    echo '</table>';
                                endif;
                            endwhile;
                            ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
// Accordion 3: Thông số kỹ thuật nhóm 2
if (have_rows('thong_so_chung')) :
    ?>
    <div class="custom-accordion-item">
        <h2 class="custom-accordion-title"><span><?php echo pll__('Thiết Bị'); ?></span></h2>
        <div class="custom-accordion-content">
            <?php
            // Lặp qua `thong_so_chung`
            while (have_rows('thong_so_chung')) : the_row();
                if (have_rows('thong_so_2')) :
                    // Lặp qua `thong_so_2`
                    while (have_rows('thong_so_2')) : the_row();

                        // Field 1: Thiết bị tiêu chuẩn
                        if (have_rows('thiet_bi_tieu_chuan')) :
                            echo '<h3><span>' . pll__('Thiết bị tiêu chuẩn') . '</span></h3>';
                            echo '<table class="custom-info-table">';
                            while (have_rows('thiet_bi_tieu_chuan')) : the_row();
                                $value = get_sub_field('value'); // Lấy giá trị từ subfield
                                echo "<tr><td>$value</td></tr>";
                            endwhile;
                            echo '</table>';
                        endif;

                        // Field 2: Thiết bị hàng hải
                        if (have_rows('thiet_bi_hang_hai')) :
                            echo '<h3><span>' . pll__('Thiết bị hàng hải') . '</span></h3>';
                            echo '<table class="custom-info-table">';
                            while (have_rows('thiet_bi_hang_hai')) : the_row();
                                $value = get_sub_field('value'); // Lấy giá trị từ subfield
                                echo "<tr><td>$value</td></tr>";
                            endwhile;
                            echo '</table>';
                        endif;

                        // Field 3: Tùy chọn thêm
                        if (have_rows('tuy_chon_them')) :
                            
                           echo '<h3><span>' . pll__('Tùy chọn thêm') . '</span></h3>';
                            echo '<table class="custom-info-table">';
                            while (have_rows('tuy_chon_them')) : the_row();
                                $value = get_sub_field('value'); // Lấy giá trị từ subfield
                                echo "<tr><td>$value</td></tr>";
                            endwhile;
                            echo '</table>';
                        endif;

                    endwhile;
                endif;
            endwhile;
            ?>
        </div>
    </div>
<?php endif; ?>


            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
