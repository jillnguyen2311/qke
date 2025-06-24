<?php

define('THEME_URL', get_stylesheet_directory_uri());

function kodi_vn_scripts() {
    wp_enqueue_style('my-style', THEME_URL . 'style.css', array(), '1.0.0', 'all');
}
