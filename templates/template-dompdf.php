<?php
/**
 * Template Name: Dom PDf With Mail Wp_Mail Template
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
        <h2 class="form-signin-heading">Generate PDF using Dom PDF html to pdf</h2>
        <hr />

            <div class="form-group mb-3">
                <td>Roll No</td>
                <td><input type="text" class="form-control" placeholder="rollno" name="rollno"></td>
            </div>

            <div class="form-group mb-3">
                <td>First Name</td>
                <td><input type="text" class="form-control" placeholder="First Name" name="fname"></td>
            </div>

            <div class="form-group mb-3">
                <td>Sex: </td>
                <td><input type="radio" name="sex" value="Male" />Male
                    <input type="radio" name="sex" value="Female" />Female
                </td>
            </div>


            <div class="form-group mb-3">
                <td>Interested On: </td>
                <td>
                    <input type="checkbox" name="sport_game" value="Cricket">Cricket<br>
                    <input type="checkbox" name="sport_game" value="Football">Football<br>
                    <input type="checkbox" name="sport_game" value="Hockey">Hockey<br>
                    <input type="checkbox" name="sport_game" value="Badminton">Badminton <br>
                </td>
            </div>

            <div class="form-group mb-3">
                <td>Age Group: </td>
                <td>
                    <select class="form-control" name="age_group">
                        <option value="" selected>Select An option</option>
                        <option value="0-15">Child(0-15)</option>
                        <option value="15-30">Youngstor(15-30)</option>
                        <option value="30-45">Mid-Age(30-45)</option>
                        <option value="45+">Older(45+)</option>
                    </select>
                </td>
            </div>

            <div class="form-group mb-3">
                <td>Last Name</td>
                <td><input type="text" class="form-control" placeholder="Last Name" name="lname"></td>
            </div>

            <div class="form-group mb-3">
                <td>Email Address</td>
                <td><input type="email" class="form-control" placeholder="Email Address" name="email"></td>
            </div>

            <div class="form-group mb-3">
                <td>Saving Amount</td>
                <td><input type="text" class="form-control" placeholder="Saving Amount" name="saving_amount"></td>
            </div>

            <div class="form-group mb-3">
                <td>Retirement Getting Amount</td>
                <td><input type="text" class="form-control" placeholder="Retirement Getting Amount" name="retirement_getting_amount"></td>
            </div>

            <div class="form-group mb-3">
                <td>Retirement Monthly Amount</td>
                <td><input type="text" class="form-control" placeholder="Retirement Monthly Amount" name="retirement_monthly_amount"></td>
            </div>

            <div class="form-group mb-3">
                <td>Currency</td>
                <td><input type="text" class="form-control" placeholder="Currency" name="currency"></td>
            </div>

            <div class="form-group mb-3">
                <td>Current Age</td>
                <td><input type="text" class="form-control" placeholder="Current Age" name="current_age"></td>
            </div>

            <div class="form-group mb-3">
                <td>Desired Retirement Age</td>
                <td><input type="text" class="form-control" placeholder="Desired Retirement Age" name="desired_retirement_age"></td>
            </div>

            <div class="form-group mb-3">
                <td>Current Retirement Savings</td>
                <td><input type="text" class="form-control" placeholder="Current Retirement Savings" name="Current_Retirement_Savings"></td>
            </div>

            <div class="form-group mb-3">
                <td>Monthly Contribution</td>
                <td><input type="text" class="form-control" placeholder="Monthly Contribution" name="Monthly_Contribution"></td>
            </div>

            <div class="form-group mb-3">
                <td>First Year of Retirement Expenses</td>
                <td><input type="text" class="form-control" placeholder="First Year of Retirement Expenses" name="First_Year_of_Retirement_Expenses"></td>
            </div>

            <div class="form-group mb-3">
                <td>Expected Annual Inflation Rate</td>
                <td><input type="text" class="form-control" placeholder="Expected Annual Inflation Rate" name="Expected_Annual_Inflation_Rate"></td>
            </div>

            <div class="form-group mb-3">
                <td>Pre-Retirement Estimated Annual Rate of Return</td>
                <td><input type="text" class="form-control" placeholder="Pre-Retirement Estimated Annual Rate of Return" name="PreRetirement_Estimated_Annual_Rate_of_Return"></td>
            </div>

            <div class="form-group mb-3">
                <td>Post Retirement Estimated Annual Rate of Return</td>
                <td><input type="text" class="form-control" placeholder="Post Retirement Estimated Annual Rate of Return" name="Post_Retirement_Estimated_Annual_Rate_of_Return"></td>
            </div>

            <div class="mt-5">
                <input class="btn btn-primary btn-block" type="submit" id="button_dom" name="submit_dom">
            </div>

        </div>
    </form>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>