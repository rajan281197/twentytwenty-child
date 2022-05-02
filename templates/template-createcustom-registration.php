<?php
/**
 * Template Name: Custom Woo Registration Template
 * Template Post Type: post, page
 *  php version 7.2.10
 * @category page
 * @author Rajan Panchal <rajan.panchal@creolestudios.com>
 * @license https://developer.wordpress.org/reference/functions/wp_insert_user/
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 * @link
 */

get_header();
?>
<main id="site-content" role="main">

<div class="container">
    <form style="border:2px solid;padding: 20px;"  id="create_user_woo_info" action="" method="POST">

        <h5 class="text-center">Woo Custom User Registration</h5>
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

             <div class="mx-auto text-center">
             <button type="submit" name="submit_user_woo" class="btn btn-lg btn-primary">Create User</button>
             </div>
             <span id="geeks1_space"><?php echo $errorMsg; ?></span>
             <h1 id="geeks1_space_no_space"></h1>
         </form>
    </div>



</main>
<?php get_template_part('template-parts/footer-menus-widgets');?>

<?php get_footer();?>