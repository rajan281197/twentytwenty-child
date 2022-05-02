<?php
/**
 * Template Name: ShowPostBetweenDate Template
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
    <form style="border:2px solid;padding: 20px;margin-left:200px;width:1500px;" class="form-post_between_date_form"
        method="post" action="" id="post_between_date_form">
        <h2 class="form-signin-heading">POST RETRIEVE BETWEEN DATE</h2>

        <div>
            <label for="user_login">Starting Date :</label>
            <input type="date" class="form-group" name="starting_date" id="starting_date"
                placeholder="Enter Starting Date">
        </div>
        <hr />

        <div class="">
            <label for="display_name">Ending Date :</label>
            <input type="date" class="form-group" name="ending_date" id="ending_date" placeholder="Enter Ending Date">
        </div>

        <hr />
        <div class="form-group">
            <input type="hidden" name="action" value="show_post_between_date_action">
            <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'form-nonce' );?>" />  
            <button type="submit" class="btn btn-default" id="retrieve_post_between_date" name="retrieve_post_between_date" id="btn-submit">
                <span class="glyphicon glyphicon-log-in"></span> Get Post Between Date
            </button>
        </div>
    </form>
    <?php
    
if (isset($_POST['retrieve_post_between_date'])) {

    $starting_date = date('F j, Y',strtotime($_POST['starting_date']));
    $ending_date = date('F j, Y',strtotime($_POST['ending_date']));

    $args = array(
		'post_type'   => 'book',
		'posts_per_page'      => -1,
		'orderby'        => 'rand',
		'order'   => 'DESC',
        'post_status' => 'any',
        'date_query' => array(
            array(
                'after'     => $starting_date,
                'before'    => $ending_date,
                'inclusive' => true,
            ),
        ),
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
        echo "<h2 class='form-signin-heading text-center text-danger'>No Post Found Between $starting_date And $ending_date.</h2>";
	}
	wp_reset_postdata();
}
    ?>
</div>
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>