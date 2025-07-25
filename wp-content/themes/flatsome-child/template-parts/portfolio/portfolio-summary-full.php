<?php
/**
 * Portfolio full summary.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.19.8
 */

?>
<div class="row">
	<?php if ( ! get_theme_mod( 'portfolio_title' ) ) { ?>
		<div class="large-4 col col-divided pb-0">

			<div class="featured_item_cats breadcrumbs pt-0">
				<?php echo get_the_term_list( get_the_ID(), 'featured_item_category', '', '<span class="divider">|</span>', '' ); ?>
			</div>
			<h1 class="entry-title is-xlarge uppercase"><?php the_title(); ?></h1>
			<?php if ( get_theme_mod( 'portfolio_share', 1 ) ) : ?>
				<div class="portfolio-share is-small">
					<?php echo flatsome_apply_shortcode( 'share', array( 'style' => 'small' ) ); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php } ?>
	<div class="col col-fit pb-0">
		<?php the_excerpt(); ?>

		<?php if ( get_the_term_list( get_the_ID(), 'featured_item_tag' ) ) { ?>
			<div class="item-tags is-small uppercase bt pb-half pt-half">
				<strong><?php esc_html_e( 'Tags', 'flatsome' ); ?>:</strong>
				<?php echo strip_tags( get_the_term_list( get_the_ID(), 'featured_item_tag', '', ' / ', '' ) ); ?>
			</div>
		<?php } ?>
		<?php if ( get_theme_mod( 'portfolio_title' ) == 'featured' ) { ?>
			<div class="portfolio-share">
				<?php echo flatsome_apply_shortcode( 'share' ); ?>
			</div>
		<?php } ?>
	</div>
</div>
