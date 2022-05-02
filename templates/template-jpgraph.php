<?php
/**
 * Template Name: JpGraph Template
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
        <h2 class="form-signin-heading">Generate Graph of Image using JPGRAPH</h2>
        <hr />

            <div class="form-group mb-3">
                <td>Value 1 Max</td>
                <td><input type="text" class="form-control"  name="value_1_max"></td>
            </div>

            <div class="form-group mb-3">
                <td>Value 1 Min</td>
                <td><input type="text" class="form-control"  name="value_1_min"></td>
            </div>

            <div class="form-group mb-3">
                <td>Value 2 Max</td>
                <td><input type="text" class="form-control"  name="value_2_max"></td>
            </div>

            <div class="form-group mb-3">
                <td>Value 2 Min</td>
                <td><input type="text" class="form-control" name="value_2_min"></td>
            </div>

            <div class="form-group mb-3">
                <td>Value 3 Max</td>
                <td><input type="text" class="form-control"  name="value_3_max"></td>
            </div>

            <div class="form-group mb-3">
                <td>Value 3 Min</td>
                <td><input type="text" class="form-control"  name="value_3_min"></td>
            </div>

            <div class="form-group mb-3">
                <td>Value 4 Max</td>
                <td><input type="text" class="form-control"  name="value_4_max"></td>
            </div>

            <div class="form-group mb-3">
                <td>Value 4 Min</td>
                <td><input type="text" class="form-control"  name="value_4_min"></td>
            </div>

            <div class="form-group mb-3">
                <td>Value 5 Max</td>
                <td><input type="text" class="form-control"  name="value_5_max"></td>
            </div>

            <div class="form-group mb-3">
                <td>Value 5 Min</td>
                <td><input type="text" class="form-control"  name="value_5_min"></td>
            </div>

          
            <div class="mt-5">
                <input class="btn btn-primary btn-block" type="submit" id="button_jpgraph" name="submit_jpgraph">
            </div>

        </div>
    </form>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>