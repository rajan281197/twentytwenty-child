<?php
/**
 * Template Name: Submit to pdf Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<main id="site-content" role="main">

    <div class="container">
        
        <form style="border:2px solid;padding: 20px;" id="form_data_info" action="" method="POST">
        
        <h2 class="text-center">Post with cron</h2>
            <div>
            <label for="Post_title">Title :</label>
            <input type="text" class="form-group" name="post_title_cron" id="post_title_cron" placeholder="Enter Post title">
            </div>

            <div class="mt-4">
            <label for="Post_title">Content :</label>
            <input type="text" class="form-group" name="post_content_cron" id="post_content_cron" placeholder="Enter Post Content">
            </div>

            <div class="mt-4">
            <input type="hidden" name="action" value="insert_post_via_cron">
            <button type="submit" name="submit_post" id="submit_post_cron">Publish Post</button>
            </div>
        </form>
        
        
    </div>
    



</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>