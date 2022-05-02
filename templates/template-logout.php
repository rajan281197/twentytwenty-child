<?php
/**
 * Template Name: Logout User Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>
<?php
if ( is_user_logged_in() ) { ?>
<a href="<?php echo wp_logout_url( get_permalink() ); ?>">Logout</a>
<?php } ?>
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>