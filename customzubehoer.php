<?php
/*
Plugin Name: Custom Schirm Zubehör
Plugin URI: https://github.com/agcty
Description: Have your custom zubehör shown on the single product page
Author: Alex Gogl
Author URI: https://gogl.io
Version: 0.1
Text Domain: schirm-zubehoer
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

function show_cross_sell_in_single_product(){
    $crosssells = get_post_meta( get_the_ID(), '_crosssell_ids',true);
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 4,
        'post__in' => $crosssells
        );
    $products = new WP_Query( $args );
		//check if products has posts, otherwise always true
    if ( $products->have_posts() ) : ?>

        <section class="related products">

          <h2><?php esc_html_e( 'Passend dazu', 'woocommerce' ); ?></h2>

          <?php woocommerce_product_loop_start(); ?>

          <?php while ( $products->have_posts() ) : $products->the_post();
              wc_get_template_part( 'content', 'product' );
          endwhile; // end of the loop. ?>

          <?php woocommerce_product_loop_end(); ?>

        </section>

      <?php endif;

    wp_reset_postdata();

}

add_action('woocommerce_after_single_product_summary', 'show_cross_sell_in_single_product', 10, 2);
/* todo removeaction woocommerce_after_single_product_summary, show_related */
}
