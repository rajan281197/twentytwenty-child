<?php
/**
 * Template Name: Push Pop Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
/* Update Value */
if(isset($_POST['submit_push_pop_third'])){
    global $wpdb;
    $table_name='pa_push_pop_data';

    $post_id = $wpdb->get_results("SELECT first_value FROM $table_name WHERE (id = '55')");
 

$page_title = '55';
$park = $wpdb->get_row("SELECT * FROM pa_push_pop_data WHERE id='".$page_title."'");  
if($park)
{
   $dbdefault_value = $park->first_value; 
   $data_array = array(
    'first_value' => $dbdefault_value-($_POST['third_value']),
    );

}

    $data_where = array('id' =>'55');
    $wpdb->update($table_name,$data_array,$data_where);
    // wp_redirect( 'http://localhost/postapproval/?page_id=177' );
    exit;
}

/* Insert Value */
if ( isset( $_POST['submit_push_pop_second'] ) ){

    global $wpdb;
    $tablename = $wpdb->prefix.'push_pop_data';

   $wpdb->insert( $tablename, array(
       'first_value' => $_POST['first_value'],
    ),
       array( '%s' ) 
   );
   exit;
}



?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<main id="site-content" role="main">

    <div class="container">

        <!-- <form style="border:2px solid;padding: 20px;" id="create_push_info" action="" method="POST">

            <h2 class="text-center">Push-POP Functionality</h2>
            <div>
                <label for="push_value">Value :</label>
                <input type="text" class="form-group" name="push_value" id="push_value" placeholder="Enter Value">
            </div>

            <div class="mt-4">
                <input type="hidden" name="action" value="insert_push_value_via_ajax">
                <button type="submit" name="submit_push_pop" id="submit_push_value_ajax">Insert Value</button>
            </div>
            <span id="geeks1_space"></span>
            <h1 id="geeks1_space_no_space"></h1>
        </form> -->


        <form style="border:2px solid;padding: 20px;" id="create_push_info" action="" id="postjob" method="post">
            <h2 class="text-center">Push-POP Functionality</h2>
            <table>
                <tr>
                    <td><label for="organizationname">Organization Name:</label></td>
                    <td><input type="text" name="organizationname" id="organizationname" value="" /></td>
                </tr>
                <tr>
                    <td><label for="post">Post:</label></td>
                    <td><input type="text" name="post" id="post" value="" /></td>
                </tr>
                <tr>
                    <td><label for="publishfrom">Publish From:</label></td>
                    <td><input type="text" name="publishfrom" id="publishfrom" /></td>
                </tr>
                <tr>
                    <td><label for="publishupto">Publish Upto:</label></td>
                    <td><input type="text" name="publishupto" id="publishupto" /></td>
                </tr>
                <tr>
                    <td><label for="qualification">Qualification:</label></td>
                    <td><input type="text" name="qualification1" id="qualification1" /></td>
                    <td><input type="text" name="qualification2" id="qualification2" /></td>
                    <td><input type="text" name="qualification3" id="qualification3" /></td>
                    <td><input type="text" name="qualification4" id="qualification4" /></td>
                </tr>
                <tr>
                    <td><label for="experience">Experience:</label></td>
                    <td><input type="text" name="experience1" id="experience1" /></td>
                    <td><input type="text" name="experience2" id="experience2" /></td>
                    <td><input type="text" name="experience3" id="experience3" /></td>
                </tr>
                <tr>
                    <td><label for="training">Training:</label></td>
                    <td><input type="text" name="training1" id="training1" /></td>
                    <td><input type="text" name="training2" id="training2" /></td>
                    <td><input type="text" name="training3" id="training3" /></td>
                    <td><input type="text" name="training4" id="training4" /></td>
                    <td><input type="text" name="training5" id="training5" /></td>
                </tr>
                <tr>
                    <td><input type="hidden" name="action" value="insert_push_value_via_ajax"></td>
                    <td><button type="submit" id="submit_push_value_ajax" name="submit_push_pop">Submit</button></td>
                </tr>
                <span id="geeks1_space"></span>
                <h1 id="geeks1_space_no_space"></h1>
            </table>
        </form>

        <form style="border:2px solid;padding: 20px;" id="create_push_info_second" action="" id="postjob_second"
            method="post">
            <h2 class="text-center">Push-POP Functionality Second</h2>
            <table>
                <tr>
                    <td><label for="organizationname">Push Value:</label></td>
                    <td><input type="text" name="first_value" id="first_value" /></td>
                    
                </tr>

                <tr>
                    <td><input type="hidden" name="action" value="insert_push_value_via_ajax_second"></td>
                    <td><button type="submit" id="submit_push_value_ajax_second"
                            name="submit_push_pop_second">Push Value</button></td>
                </tr>
                <?php
                    $table_name = 'pa_push_pop_data';

                    $results = $wpdb->get_results( "SELECT * FROM $table_name");
                    if(!empty($results))                       
                    {    
                        echo "<table width='100%' border='0'>"; 
                        echo "<tbody>";      
                        foreach($results as $row){   
                        echo "<tr>";                           
                        echo "<th>ID</th>" . "<td>" . $row->id . "</td>";
                        echo "<th>Push Value</th>" . "<td>" . $row->first_value . "</td>";
                        echo "</tr>";                    
                        }
                        echo "</tbody>";
                        echo "</table>"; 

                    }
                    ?>
                <span id="geeks1_space_second"></span>
                <h1 id="geeks1_space_no_space_second"></h1>
            </table>
        </form>

        <form style="border:2px solid;padding: 20px;" id="create_push_info_third" action="" id="postjob_third"
            method="post">
            <h2 class="text-center">Push-POP Functionality Third</h2>
            <?php
            ?>
            <table>
                <tr>
                    <td><label for="organizationname">POP Value:</label></td>
                    <td><input type="text" name="third_value" id="first_value" /></td>
                </tr>

                <tr>
                    <td><input type="hidden" name="action" value="insert_push_value_via_ajax_third"></td>
                    <td><button type="submit" id="submit_push_value_ajax_third"
                            name="submit_push_pop_third">Pop Value</button></td>
                </tr>
                <span id="geeks1_space_third"></span>
                <h1 id="geeks1_space_no_space_third"></h1>
            </table>
        </form>
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>