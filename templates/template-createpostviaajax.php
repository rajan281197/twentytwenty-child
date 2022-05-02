<?php
/**
 * Template Name: Create Post Using Ajax Template
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
        <h2 class="text-center">Post Create Form (Ajax)</h2>
        <?php
                         
       ?>
        <?php
        
       ?>
        <form method="post" id="submitform" action="" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleFormControlSelect1">Id Number</label>
                <select class="form-control" name="post_id_ajax" id="exampleFormControlSelect1">
                    <option value="none" selected>Select an Id</option>
                    <?php 

                    $args = array('orderby' => 'display_name');
                    $wp_user_query = new WP_User_Query($args);
                    $authors = $wp_user_query->get_results();
                    if (!empty($authors)) {
                        echo '<ul>';
                        foreach ($authors as $author) {
                            $author_info = get_userdata($author->ID);
                            echo "<option id='$author_info->ID'>".$author_info->ID."</option>";
                        }
                        echo '</ul>';
                    } else {
                        echo 'No results';
                    } 

                            ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="exampleFormControlSelect2">Post type</label>
                <select class="form-control" name="post_type_ajax" id="exampleFormControlSelect2">
                    <option value="none" selected>Select an Post type</option>
                    <?php 


                    $posttypelist = get_post_types();
                    foreach ($posttypelist as $posttypelists) {
                            echo "<option id='$posttypelists'>".$posttypelists."</option>";
                    }

                            ?>
                </select>
            </div>

            <div class="form-group">
                <label for="post_title_ajax">Title:</label>
                <input type="text" class="form-control" id="post_title_ajax" placeholder="Enter Post title"
                    name="post_title_ajax">
            </div>
            <div class="form-group">
                <label for="post_content_ajax">Content:</label>
                <textarea name="post_content_ajax" class="form-control" id="post_content_ajax" rows="10" cols="10"
                    placeholder="Enter Content"></textarea>
            </div>
            <input type="hidden" name="submitted" id="submitted" value="true" /> 
            <input type="hidden" name="action" value="addpost">
            <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'form-nonce' );?>" />                      
            <input class="btn btn-primary btn-lg" type="submit" name="submit_ajax" value="Submit" />

        </form>

        
    </div>



</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>