<?php
/**
 * Template Name: Custom Signup Template
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

<?php if ( is_user_logged_in() ) { 

$current_user = wp_get_current_user();
echo "<form style='border:2px solid;padding: 20px;margin-left:200px;width:1500px;'>";
echo "<h2 class='form-signin-heading'>User Details</h2>";
echo "<div class='form-control'>Username: <b>". $current_user->user_login .'</b></div><br>';
echo "<div class='form-control'>User email: <b>". $current_user->user_email .'</b></div><br>';
echo "<div class='form-control'>User first name: <b>". $current_user->user_firstname .'</b></div><br>';
echo "<div class='form-control'>User last name: <b>". $current_user->user_lastname .'</b></div><br>';
echo "<div class='form-control'>User display name: <b>". $current_user->display_name .'</b></div><br>';
echo "<div class='form-control'>User ID: <b>". $current_user->ID .'</b></div><br>';
echo "</form>";
 } ?>
<?php if ( !is_user_logged_in() ) { ?>
   <style type="text/css" >
  .errorMsg{border:1px solid red; }
  .message{color: red; font-weight:bold; }
 </style>
<div class="register_container">
    <form style="border:2px solid;padding: 20px;margin-left:200px;width:1500px;" class="form-signin" method="post" id="register-form">
        <h2 class="form-signin-heading">User Registration Form</h2>
        <hr />
        <div id="error">
        </div><?php if (isset($errorMsg)) { echo "<p class='message'>" .$errorMsg. "</p>" ;} ?>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" name="user_login" id="user_login" />
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Display Name" name="display_name" id="display_name" />
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Nick Name" name="nickname" id="nickname" />
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" />
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" />
        </div>
        <div class="form-group">
            <input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" />
            <span id="check-e"></span>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="user_pass" id="user_pass" />
        </div>
        <div class="form-group" >
        <select name="user_role" class="form-control">
            <option value="administrator">Administrator</option>
            <option value="editor">Editor</option>
            <option value="author">Author</option>
            <option value="contributor">Contributor</option>
            <option value="subscriber">Subscriber</option>
        </select>
        </div>
        <hr />
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="insert_user" id="btn-submit">
                <span class="glyphicon glyphicon-log-in"></span> Create Account
            </button>
        </div>
    </form>
    <?php } ?>
    <?php if ( !is_user_logged_in() ) { ?>
    <form style="border:2px solid;padding: 20px;margin-left:200px;margin-top:25px;width:1500px;" class="form-signon" method="post" id="login-form">
        <h2 class="form-signon-heading">User Login Form</h2>
        <hr />
        <div id="error">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" name="user_login" id="user_login" />
        </div>
        
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="user_pass" id="user_pass" />
        </div>
        
        <hr />
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="login_user" id="btn-submit">
                <span class="glyphicon glyphicon-log-in"></span> Login
            </button>
        </div>
    </form>
    <?php } ?>
</div>


<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>