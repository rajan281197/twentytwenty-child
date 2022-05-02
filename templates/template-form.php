<?php
/**
 * Template Name: Front Form Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content" role="main">

    <div class="container">
        <h2 class="text-center">Post Form</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="post_title">Title:</label>
                <input type="text" class="form-control" id="post_title" placeholder="Enter Post title"
                    name="post_title">
            </div>
            <div class="form-group">
                <label for="post_content">Content:</label>
                <textarea name="post_content" class="form-control" id="post_content" rows="10" cols="10"
                    placeholder="Enter Content"></textarea>
            </div>

            <div class="form-group">
                <label for="feture_image">Featured Image:</label>
                <input type="file" name="feture_image" class="form-control">
            </div>

            <input class="btn btn-primary btn-lg" type="submit" name="submit" value="Submit"/>

        </form>
    </div>



</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>