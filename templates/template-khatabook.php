<?php
/**
 * Template Name: Khata Calculation Template
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
    <form action="" method="POST" style="border:2px solid;padding: 10px;margin-left:2%;margin-right:50%;width:1300px;">
        <div class="container">
        <h2 class="form-signin-heading">Khatabook Pay & Receive Demo</h2>
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
                <td>Amount</td>
                <td><input type="text" class="form-control" placeholder="exp.. 100000 INR" name="credit_debit_amount"></td>
            </div>

            <div class="form-group mb-3">
                <td>Total Balance</td>
                <td><input type="text" class="form-control" name="total_balance_credited"></td>
            </div>


            <div class="form-group mb-3">
                <td>Date</td>
                <input type="date"  class="form-control" placeholder="Account_Opening_Date" id="birthday" name="account_Opening_Date">
            </td>
            </div>

            <div class="form-group mb-3">
                <td>Amount Type</td>
                <td> <select class="form-control" name="opt-type">
                        <option disabled="disabled" selected="selected">Choose option</option>
                        <option>You have Given</option>
                        <option>You have Taken</option>
                    </select>
                <div class="select-dropdown"></div></td>
            </div>

          
           
           <div class="mt-5">
                <input class="btn btn-primary btn-block" type="submit" id="button_submit_new_fd" name="button_submit_new_khatabook">
            </div>

        </div>
    </form>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>