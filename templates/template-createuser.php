<?php
/**
 * Template Name: Create User Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<main id="site-content" role="main">

    <div class="container">
        
        <form style="border:2px solid;padding: 20px;" id="create_user_info" action="" method="POST">
        
       <h2 class="text-center">User Create with Password Validation</h2>
            <div>
            <label for="user_login">User Name :</label>
            <input type="text" class="form-group" name="user_login" id="user_login" placeholder="Enter User Name">
            </div>

            <div class="mt-4">
            <label for="display_name">Display Name :</label>
            <input type="text" class="form-group" name="display_name" id="display_name" placeholder="Enter Display Name">
            </div>

            <div class="mt-4">
            <label for="user_email">Email :</label>
            <input type="text" class="form-group" name="user_email" id="user_email" placeholder="Enter Email ID">
            </div>

            <div class="mt-4">
            <label for="user_pass">Password :</label>
            <input type="password" class="form-group" name="user_pass" id="user_pass" placeholder="Enter User Password">
            </div>

            <div class="mt-4">
            <label for="first_name">First Name :</label>
            <input type="text" class="form-group" name="first_name" id="first_name" placeholder="Enter First Name">
            </div>

            <div class="mt-4">
            <label for="last_name">Last Name :</label>
            <input type="text" class="form-group" name="last_name" id="last_name" placeholder="Enter Last Name">
            </div>

            <div class="mt-4">
            <input type="hidden" name="action" value="insert_user_via_ajax">
            <button type="submit" name="submit_user" id="submit_user_ajax">Create User</button>
            </div>
            
            <span id="geeks1_space"></span>
            <h1 id="geeks1_space_no_space"></h1>
        </form>
        
        
    </div>
    



</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>