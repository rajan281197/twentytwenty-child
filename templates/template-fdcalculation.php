<?php
/**
 * Template Name: FD calculation Template
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
        <h2 class="form-signin-heading">Generate PDF using Dom PDF By calculating FD Calculations</h2>
        <hr />

            <div class="form-group mb-3">
                <td>Customer Name</td>
                <td><input type="text" class="form-control" placeholder="exp.. Rajan Panchal" name="customer_name"></td>
            </div>

            <div class="form-group mb-3">
                <td>Email ID</td>
                <td><input type="text" class="form-control"  name="customer_email"></td>
            </div>

            <div class="form-group mb-3">
                <td>Deposite Amount</td>
                <td><input type="text" class="form-control" placeholder="exp.. 100000 INR" name="deposite_amount"></td>
            </div>

            <div class="form-group mb-3">
                <td>Deposite Periods (In Months exp.12)</td>
                <td><input type="text" class="form-control" placeholder="deposite_periods" name="deposite_periods"></td>
            </div>

            <div class="form-group mb-3">
                <td>Account Opening Date</td>
                <input type="date"  class="form-control" placeholder="Account_Opening_Date" id="birthday" name="account_Opening_Date">
            </td>
            </div>

            <div class="form-group mb-3">
                <td>Rate of Interest</td>
                <td><input type="text" class="form-control" placeholder="rate_of_interest" name="rate_of_interest"></td>
            </div>

            <div class="form-group mb-3">
                <td>Subject</td>
                <td> <select class="form-control" name="opt">
                        <option disabled="disabled" selected="selected">Choose option</option>
                        <option>year</option>
                        <option>days</option>
                        <option>month</option>
                    </select>
                <div class="select-dropdown"></div></td>
            </div>
           
           <div class="mt-5">
                <input class="btn btn-primary btn-block" type="submit" id="button_submit_new_fd" name="button_submit_new_fd">
            </div>

        </div>
    </form>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>