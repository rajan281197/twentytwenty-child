<?php
/**
 * Template Name: Count Day Betweeen Two Dates Template
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
    <form style="border:2px solid;padding: 20px;margin-left:200px;width:1500px;" class="day_count_by_date" method="post"
        action="" id="day_count_by_date">
        <h2 class="form-signin-heading">DAYS RETRIEVE BETWEEN 2 DATES</h2>
        <hr />

        <div class="">
            <label for="starting_date">Starting Date :</label>
            <input type="date" class="form-group" name="starting_date" id="starting_date" placeholder="Please select Starting Date">
        </div>
        <hr />

        <div class="">
            <label for="ending_date">Ending Date :</label>
            <input type="date" class="form-group" name="ending_date" id="ending_date" placeholder="Please select Ending Date">
        </div>
        <hr />
        <div class="form-group">

            <button type="submit" class="btn btn-default" id="retrieve_days_between_two_dates" name="retrieve_days_between_two_dates" id="btn-submit">
                <span class="glyphicon glyphicon-log-in"></span> Get Days Count
            </button>
        </div>

        <?php

$starting_date = strtotime($_POST['starting_date']);
$ending_date = strtotime($_POST['ending_date']);

        if (isset($_POST['retrieve_days_between_two_dates'])) {          

            $datediff = $ending_date - $starting_date;
            $daycounttotal =  round($datediff / (60 * 60 * 24));
            $dasfield = "Days";
        }
        ?>
        <hr />
        <div class="">
            <label for="unit_value">Count :</label>
            
            <input type="text" class="form-group" disabled value="<?php echo $daycounttotal ? $daycounttotal .' '. $dasfield   : '0';?>">
        </div>
    </form>

</div>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>