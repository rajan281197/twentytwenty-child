<?php
/**
 * Template Name: Show Post By Status Template
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
<div class="register_container">
    <form style="border:2px solid;padding: 20px;margin-left:200px;width:1500px;" class="form-post_status" method="post"
        action="" id="post_status_form">
        <h2 class="form-signin-heading">POST RETRIEVE BY POST STATUS</h2>
        <hr />

        <div class="form-group">
            <label for="wp_post_status" class="form-label">Select Post Status: </label>
            <select id="wp_post_status" name="wp_post_status" class="form-control">
                <option value="publish">Publish</option>
                <option value="" selected>Select Post Status</option>
                <option value="pending">Pending</option>
                <option value="draft">Draft</option>
                <option value="future">Future</option>
                <option value="trash">Trash</option>
                <option value="any">Any</option>
            </select>
        </div>
        <hr />
        <div class="form-group">
            <input type="hidden" name="action" value="show_post_via_ajax">
            <button type="submit" class="btn btn-default" id="retrieve_post_by_status" name="retrieve_post_by_status"
                id="btn-submit">
                <span class="glyphicon glyphicon-log-in"></span> Get Post By Post Status
            </button>
        </div>
    </form>
    <?php
    
if (isset($_POST['retrieve_post_by_status'])) {
	$args = array(
		'post_type'   => 'book',
		'posts_per_page'      => -1,
		'orderby'        => 'rand',
		'order'   => 'DESC',
		'post_status' => $_POST['wp_post_status']
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

                    <h5 class="card-title"><?php echo get_the_ID(); ?><br><?php echo get_the_title(); ?></h5>
                    <p class="card-text"><?php echo the_content(); ?></p>
                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" width="300" height="300">
                    <p><?php echo get_post_status(); ?></p>


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
}
    ?>
</div>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>