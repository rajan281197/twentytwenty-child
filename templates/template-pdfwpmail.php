<?php
/**
 * Template Name: Generate & Send PDf Wp_Mail Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <br><br><br><br><br><br><br>
    <form action="" method="POST">
        <div class="container">


            <div class="mb-3">
                <td>Roll No</td>
                <td><input type="text" class="form-control" placeholder="rollno" name="rollno"></td>
            </div>

            <div class="mb-3">
                <td>First Name</td>
                <td><input type="text" class="form-control" placeholder="First Name" name="fname"></td>
            </div>

            <div class="mb-3">
                <td>Sex: </td>
                <td><input type="radio" name="sex" value="Male" />Male
                    <input type="radio" name="sex" value="Female" />Female
                </td>
            </div>


            <div class="mb-3">
                <td>Interested On: </td>
                <td>
                    <input type="checkbox" name="sport_game" value="Cricket">Cricket<br>
                    <input type="checkbox" name="sport_game" value="Football">Football<br>
                    <input type="checkbox" name="sport_game" value="Hockey">Hockey<br>
                    <input type="checkbox" name="sport_game" value="Badminton">Badminton <br>
                </td>
            </div>

            <div class="mb-3">
                <td>Age Group: </td>
                <td>
                    <select name="age_group">
                        <option value="" selected>Select An option</option>
                        <option value="0-15">Child(0-15)</option>
                        <option value="15-30">Youngstor(15-30)</option>
                        <option value="30-45">Mid-Age(30-45)</option>
                        <option value="45+">Older(45+)</option>
                    </select>
                </td>
            </div>

            <div class="mb-3">
                <td>Last Name</td>
                <td><input type="text" class="form-control" placeholder="Last Name" name="lname"></td>
            </div>

            <div class="mb-3">
                <td>Email Address</td>
                <td><input type="email" class="form-control" placeholder="Email Address" name="email"></td>
            </div>

            <div class="mt-5">
                <input class="btn btn-primary btn-block" type="submit" id="button" name="submit">
            </div>

        </div>
    </form>

    <?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

    <?php get_footer(); ?>