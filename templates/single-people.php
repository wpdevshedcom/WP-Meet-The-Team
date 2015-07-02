<?php
/**
 * The Template for displaying all single people.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-people.php
 *
 * @author 		WPDev
 * @package 	Meet The Team/Templates
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_meet_the_team_template_part( 'content', 'single-people' ); ?>

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>