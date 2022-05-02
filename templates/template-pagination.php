<?php
/**
 * Template Name: Pagination Custom Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<form style="border:2px solid;padding: 20px;margin-left:200px;width:1500px;" class="day_count_by_date" method="post" action="" id="post_filter_form_wp">
        <h2 class="form-signin-heading">Post Pagination</h2>
        <hr />
    <?php 
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $args = array(
        'post_type'=>'movie', // Your post type name
        'posts_per_page' => 3,
        'paged' => $paged,
    );
    
    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) {
        while ( $loop->have_posts() ) : $loop->the_post();
    
         the_title();
         ?><br><?php
    
        endwhile;
    
        $total_pages = $loop->max_num_pages;
    
        if ($total_pages > 1){
    
            $current_page = max(1, get_query_var('paged'));
    
            echo paginate_links(array(
                'base' => get_pagenum_link(1) . '%_%',
                'format' => '/page/%#%',
                'current' => $current_page,
                'total' => $total_pages,
                'prev_text'    => __('« prev'),
                'next_text'    => __('next »'),
            ));
        }    
    }
    wp_reset_postdata();
    ?>        
        
</form>
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>