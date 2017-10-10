<?php
/*
Plugin Name: Custom Schirm Zubehör
Plugin URI: https://github.com/agcty
Description: Have your custom zubehör shown on the single product page
Author: Alex Gogl
Author URI: https://gogl.io
Version: 0.1.1
Text Domain: schirm-zubehoer
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if (!defined('ABSPATH')) {
    exit;
}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    function show_cross_sell_in_single_product()
    {
        global $product;
        $crosssells = $product->get_cross_sell_ids();
    
        if (empty($crosssells)) {
            return;
        }

        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 4,
            'post__in' => $crosssells,
            /**
             * If you're not paginating, this skips MYSQL_CALC statments
             */
            'no_found_rows' => true,

            /**
             * Skips updating meta cache
             */
            'update_post_meta_cache' => false,

            /**
             * Skips updating term cache.
             */
            'update_post_term_cache' => false
        );

        $products = new WP_Query($args);
        //check if products has posts, otherwise always true
        if ($products->have_posts()): ?>

        <section class="related products">

          <h2><?php esc_html_e('Passend dazu', 'woocommerce'); ?></h2>

          <?php woocommerce_product_loop_start(); ?>

          <?php
            while ($products->have_posts()): $products->the_post();
                wc_get_template_part('content', 'product');
            endwhile; // end of the loop.  ?>

          <?php woocommerce_product_loop_end(); ?>

        </section>

      <?php endif;

        wp_reset_postdata();

    }

    add_action('woocommerce_after_single_product_summary', 'show_cross_sell_in_single_product', 10, 2);
    /* todo removeaction woocommerce_after_single_product_summary, show_related */
}
