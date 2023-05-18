<?php
/**
 * Holds all classes.
 *
 * @package Ravnostitcuprija
 */

require get_template_directory() . '/includes/classes/class-loader.php';
require get_template_directory() . '/includes/classes/class-theme-setup.php';
require get_template_directory() . '/includes/classes/class-post-type-dog.php';
require get_template_directory() . '/includes/classes/class-post-type-faq.php';
require get_template_directory() . '/includes/classes/class-acf-groups-and-fields.php';
require get_template_directory() . '/includes/classes/class-search-form.php';
require get_template_directory() . '/includes/classes/class-dog-archive-filter.php';
require get_template_directory() . '/includes/classes/class-tiny-mce-editor.php';

( new Theme_Setup() )->init();
( new Post_Type_Dog() )->init();
( new Post_Type_FAQ() )->init();
( new ACF_Groups_And_Fields() )->init();
( new Search_Form() )->init();
( new Dog_Archive_Filter() )->init();
( new Tiny_Mce_Editor() )->init();
