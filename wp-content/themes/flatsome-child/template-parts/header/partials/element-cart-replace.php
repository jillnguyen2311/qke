<?php
/**
 * Cart replace element.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.19.8
 */

if(flatsome_option('catalog_mode_header')) echo '<li class="html cart-replace">'.do_shortcode(flatsome_option('catalog_mode_header')).'</li>';
