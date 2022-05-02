<?php
/**
 * Template Name: Custom Post Layout Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<style>
.card.Even {
    background-color: orange;
    margin-bottom: 50px;
    width: 60%;
}

.card.ODD {
    background-color: aquamarine;
    width: 75%;
    margin-bottom: 100px;
}

.card.noone {
    background-color: bisque;
    width: 50%;
    margin-bottom: 25px;
}
</style>
<?php
$args = array(
    'post_type'   => 'book',
    'posts_per_page'      => -1,
    'orderby'        => 'rand',
    'order'   => 'DESC'/* ,
    'post_status' => array('pending', 'draft', 'publish','pending') */
);
$query = new WP_Query( $args );

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        ?>
<?php 
        $id = get_the_ID();        
        ?>
<div class="container">
    <div class="col-sm-12">
        <div
            class="card <?php if ($id % 3 == 0) { echo "ODD";} elseif ($id % 4 == 0) {echo "Even";} else{ echo "noone";} ?>">
            <div class="card-body">
                <?php if (get_post_status() == 'publish') {

                ?>
                <h5 class="card-title"><?php echo get_the_ID(); ?><br><?php echo get_the_title(); ?></h5>
                <p class="card-text"><?php echo the_content(); ?></p>
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" width="300" height="300">
                <p><?php echo get_post_status(); ?></p>
                <?php
                }
               ?>

            </div>
        </div>
    </div>


</div>

<?php
    }
    ?>
<?php
} else {
    echo "no posts found";
}
wp_reset_postdata();
?>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>