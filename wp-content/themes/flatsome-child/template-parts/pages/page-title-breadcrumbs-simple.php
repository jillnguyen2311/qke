<?php
/**
 * Page title with breadcrumbs simple.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.19.8
 */

?>
<div class="page-title <?php flatsome_header_title_classes() ?>">
	<div class="page-title-bg fill"><div class="page-title-bg-overlay"></div></div>

	<div class="page-title-inner container flex-row medium-flex-wrap medium-text-center">
	 	<div class="flex-col flex-grow">
	 		<?php flatsome_breadcrumb( 'page-breadcrumbs' ); ?>
	 	</div>
	</div>
</div>
