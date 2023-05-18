<?php
/**
* Template Name: Page with modules
*
* @package Ravnostitcuprija
*/

get_header();
$modules = get_field( 'modules' );

?>

<main class="main">
    <?php 
    if ( $modules ) {
        foreach ( $modules as $module ) {
            $template_name = 'templates/modules/' . str_replace( '_', '-', $module['acf_fc_layout'] );
            get_template_part( $template_name, '', $module );
        }
    }
    ?>
</main>
<?php

get_footer();
