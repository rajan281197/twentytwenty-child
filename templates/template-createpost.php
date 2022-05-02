<?php
/**
 * Template Name: Create Post Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>
<?php 
$result = "";
class calculator
{
    var $a;
    var $b;

    function checkopration($oprator)
    {
        switch($oprator)
        {
            case '+':
            return $this->a + $this->b;
            break;

            case '-':
            return $this->a - $this->b;
            break;

            case '*':
            return $this->a * $this->b;
            break;

            case '/':
            return $this->a / $this->b;
            break;

            default:
            return "Sorry No command found";
        }   
    }
    function getresult($a, $b, $c)
    {
        $this->a = $a;
        $this->b = $b;
        return $this->checkopration($c);
    }
}

$cal = new calculator();
if(isset($_POST['submit']))
{   
    $result = $cal->getresult($_POST['n1'],$_POST['n2'],$_POST['op']);
}
?>

<form method="post">
<table align="center">
    <tr>
        <td><strong><?php echo $result; ?><strong></td>
    </tr>
    <tr>
        <td>Enter 1st Number</td>
        <td><input type="text" name="n1"></td>
    </tr>

    <tr>
        <td>Enter 2nd Number</td>
        <td><input type="text" name="n2"></td>
    </tr>

    <tr>
        <td>Select Oprator</td>
        <td><select name="op">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select></td>
    </tr>

    <tr>
        <td></td>
        <td><input type="submit" name="submit" value="                =                "></td>
    </tr>

</table>
</form>
<main id="site-content" role="main">

    <div class="container">
        <h2 class="text-center">Post Create Form</h2>
       
        <form method="post" action="" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleFormControlSelect1">Id Number</label>
                <select class="form-control" name="post_id_edit" id="exampleFormControlSelect1">
                    <option value="none" selected>Select an Id</option>
                    <?php 
                    $query = new WP_Query( array( 'post_type' => 'post' ) );
                    $posts = $query->posts;

                    foreach($posts as $post) {
                        // Do your stuff, e.g.
                        echo "<option id='$post->ID'>".$post->ID."</option>";
                    }
                            ?>
                </select>
            </div>

            <div class="form-group">
                <label for="post_title_edit">Title:</label>
                <input type="text" class="form-control" id="post_title_edit" placeholder="Enter Post title"
                    name="post_title_edit">
            </div>
            <div class="form-group">
                <label for="post_content_edit">Content:</label>
                <textarea name="post_content_edit" class="form-control" id="post_content_edit" rows="10" cols="10"
                    placeholder="Enter Content"></textarea>
            </div>

            <input class="btn btn-primary btn-lg" type="submit" name="submit_edit" value="Submit" />
                
        </form>
    </div>



</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>