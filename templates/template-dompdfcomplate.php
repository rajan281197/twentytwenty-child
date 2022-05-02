<?php
/**
 * Template Name: Dom PDf With Custom Graph generation
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

<body>
    <br><br>
    <form action="" method="POST" style="border:2px solid;padding: 20px;margin-left:200px;width:1500px;">
        <div class="container">
        <h2 class="form-signin-heading">Generate PDF using Dom PDF html to pdf with graph generate</h2>
        <hr />

            <div class="form-group mb-3">
                <td>Name</td>
                <td><input type="text" class="form-control" placeholder="name" name="name"></td>
            </div>

            <div class="form-group mb-3">
                <td>currency</td>
                <td><input type="text" class="form-control" placeholder="currency" name="currency"></td>
            </div>

            <div class="form-group mb-3">
                <td>current_age</td>
                <td><input type="text" class="form-control" placeholder="current_age" name="current_age"></td>
            </div>

            <div class="form-group mb-3">
                <td>desired_age</td>
                <td><input type="text" class="form-control" placeholder="desired_age" name="desired_age"></td>
            </div>

            <div class="form-group mb-3">
                <td>current_saving</td>
                <td><input type="text" class="form-control" placeholder="current_saving" name="current_saving"></td>
            </div>

            <div class="form-group mb-3">
                <td>monthly_contribution</td>
                <td><input type="text" class="form-control" placeholder="monthly_contribution" name="monthly_contribution"></td>
            </div>

            <div class="form-group mb-3">
                <td>first_year_expenses</td>
                <td><input type="text" class="form-control" placeholder="first_year_expenses" name="first_year_expenses"></td>
            </div>

            <div class="form-group mb-3">
                <td>expected_inflation_rate</td>
                <td><input type="text" class="form-control" placeholder="expected_inflation_rate" name="expected_inflation_rate"></td>
            </div>

            <div class="form-group mb-3">
                <td>pre_rate_of_return</td>
                <td><input type="text" class="form-control" placeholder="pre_rate_of_return" name="pre_rate_of_return"></td>
            </div>

            <div class="form-group mb-3">
                <td>post_rate_of_return</td>
                <td><input type="text" class="form-control" placeholder="post_rate_of_return" name="post_rate_of_return"></td>
            </div>

           <div class="mt-5">
                <input class="btn btn-primary btn-block" type="submit" id="button_dom_with_pdf" name="button_dom_with_pdf">
            </div>

        </div>
    </form>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>