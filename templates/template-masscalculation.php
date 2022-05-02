<?php
/**
 * Template Name: Mass Calculation Template
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



<style>
.card.Even {
    background-color: orange;
    margin-bottom: 50px;
    width: 60%;
}

.card.ODD {
    background-color: aquamarine;
    width: 75%;
    margin-bottom: 100px;
}

.card.noone {
    background-color: bisque;
    width: 50%;
    margin-bottom: 25px;
}
</style>
<div class="register_container">
    <form style="border:2px solid;padding: 20px;margin-left:200px;width:1500px;" class="day_count_by_date" method="post"
        action="" id="day_count_by_date">
        <h2 class="form-signin-heading">Mass Calculation</h2>
        <hr />

        <div class="form-group">
            <label for="source_weight_selector" class="form-label">Select Source Weight: </label>
            <select id="source_weight_selector" name="source_weight_selector" class="form-control">
                <option value="" selected>Select An option</option>
                <option value="tonne">tonne</option>
                <option value="Kilogram">Kilogram</option>
                <option value="Gram">Gram</option>
                <option value="Milligram">Milligram</option>
                <option value="Microgram">Microgram</option>
                <option value="Imperial ton">Imperial ton</option>
                <option value="US ton">US ton</option>
                <option value="Stone">Stone</option>
                <option value="Pound">Pound</option>
                <option value="Ounce">Ounce</option>
            </select>
        </div>
        <hr />

        <div class="form-group">
            <label for="weight_amount">Weight Amount :</label>
            <input type="text" class="form-group" name="weight_amount" id="weight_amount" placeholder="Weight Amount">
        </div>
        <hr />

        <div class="form-group">
            <label for="destination_weight_selector" class="form-label">Select Destination Weight: </label>
            <select id="destination_weight_selector" name="destination_weight_selector" class="form-control">
                <option value="" selected>Select An option</option>
                <option value="tonne">tonne</option>
                <option value="Kilogram">Kilogram</option>
                <option value="Gram">Gram</option>
                <option value="Milligram">Milligram</option>
                <option value="Microgram">Microgram</option>
                <option value="Imperial ton">Imperial ton</option>
                <option value="US ton">US ton</option>
                <option value="Stone">Stone</option>
                <option value="Pound">Pound</option>
                <option value="Ounce">Ounce</option>
            </select>
        </div>
        <hr />
        <div class="form-group">

            <button type="submit" class="btn btn-default" id="retrieve_mass_calculation"
                name="retrieve_mass_calculation" id="btn-submit">
                <span class="glyphicon glyphicon-log-in"></span> Count Weight
            </button>
        </div>

        <?php

        $source_weight_selector = $_POST['source_weight_selector'];
        $weight_amount = $_POST['weight_amount'];
        $destination_weight_selector = $_POST['destination_weight_selector'];

        if (isset($_POST['retrieve_mass_calculation'])) {          

           /*  echo "<pre>";
            print_r($source_weight_selector);
            echo "<br>";
            print_r($weight_amount);
            echo "<br>";
            print_r($destination_weight_selector);
            echo "</pre>"; */
           /*  if ($_POST['source_weight_selector'] == 'tonne' && $_POST['destination_weight_selector'] == 'tonne') {
                $gettingvalue = $_POST['weight_amount'] * 100000;
            } */
            if ($_POST['source_weight_selector'] == 'tonne' && $_POST['destination_weight_selector'] == 'Kilogram') {
                $gettingvalue = $_POST['weight_amount'] * 1000;
            }
            elseif ($_POST['source_weight_selector'] == 'tonne' && $_POST['destination_weight_selector'] == 'Gram') {
              $gettingvalue = $_POST['weight_amount'] * 1e+6;
            }
            elseif ($_POST['source_weight_selector'] == 'tonne' && $_POST['destination_weight_selector'] == 'Milligram') {
                $gettingvalue = $_POST['weight_amount'] * 1e+9;
            }
            elseif ($_POST['source_weight_selector'] == 'tonne' && $_POST['destination_weight_selector'] == 'Microgram') {
                $gettingvalue = $_POST['weight_amount'] * 1e+12;
            }
            elseif ($_POST['source_weight_selector'] == 'tonne' && $_POST['destination_weight_selector'] == 'Imperial ton') {
                $gettingvalue = $_POST['weight_amount'] / 1.016;
            }
            elseif ($_POST['source_weight_selector'] == 'tonne' && $_POST['destination_weight_selector'] == 'US ton') {
                $gettingvalue = $_POST['weight_amount'] / 1.102;
            }
            elseif ($_POST['source_weight_selector'] == 'tonne' && $_POST['destination_weight_selector'] == 'Stone') {
                $gettingvalue = $_POST['weight_amount'] * 157;
            }
            elseif ($_POST['source_weight_selector'] == 'tonne' && $_POST['destination_weight_selector'] == 'Pound') {
                $gettingvalue = $_POST['weight_amount'] * 2205;
            }
            elseif ($_POST['source_weight_selector'] == 'tonne' && $_POST['destination_weight_selector'] == 'Ounce') {
                $gettingvalue = $_POST['weight_amount'] * 35274;
            }

            /* End Tonne to other */

            elseif ($_POST['source_weight_selector'] == 'Kilogram' && $_POST['destination_weight_selector'] == 'tonne') {
                $gettingvalue = $_POST['weight_amount'] / 1000;
            }
          /*   elseif ($_POST['source_weight_selector'] == 'tonne' && $_POST['destination_weight_selector'] == 'Kilogram') {
                $gettingvalue = $_POST['weight_amount'] * 100000;
            } */
            elseif ($_POST['source_weight_selector'] == 'Kilogram' && $_POST['destination_weight_selector'] == 'Gram') {
              $gettingvalue = $_POST['weight_amount'] * 1000;
            }
            elseif ($_POST['source_weight_selector'] == 'Kilogram' && $_POST['destination_weight_selector'] == 'Milligram') {
                $gettingvalue = $_POST['weight_amount'] * 1e+6;
            }
            elseif ($_POST['source_weight_selector'] == 'Kilogram' && $_POST['destination_weight_selector'] == 'Microgram') {
                $gettingvalue = $_POST['weight_amount'] * 1e+9;
            }
            elseif ($_POST['source_weight_selector'] == 'Kilogram' && $_POST['destination_weight_selector'] == 'Imperial ton') {
                $gettingvalue = $_POST['weight_amount'] / 1016;
            }
            elseif ($_POST['source_weight_selector'] == 'Kilogram' && $_POST['destination_weight_selector'] == 'US ton') {
                $gettingvalue = $_POST['weight_amount'] / 907;
            }
            elseif ($_POST['source_weight_selector'] == 'Kilogram' && $_POST['destination_weight_selector'] == 'Stone') {
                $gettingvalue = $_POST['weight_amount'] / 6.35;
            }
            elseif ($_POST['source_weight_selector'] == 'Kilogram' && $_POST['destination_weight_selector'] == 'Pound') {
                $gettingvalue = $_POST['weight_amount'] * 2.205;
            }
            elseif ($_POST['source_weight_selector'] == 'Kilogram' && $_POST['destination_weight_selector'] == 'Ounce') {
                $gettingvalue = $_POST['weight_amount'] * 35.274;
            }

            /* End Kilogram to OTher */

            elseif ($_POST['source_weight_selector'] == 'Gram' && $_POST['destination_weight_selector'] == 'tonne') {
                $gettingvalue = $_POST['weight_amount'] / 1e+6;
            }
            elseif ($_POST['source_weight_selector'] == 'Gram' && $_POST['destination_weight_selector'] == 'Kilogram') {
                $gettingvalue = $_POST['weight_amount'] / 100000;
            }
            /* elseif ($_POST['source_weight_selector'] == 'tonne' && $_POST['destination_weight_selector'] == 'Gram') {
              $gettingvalue = $_POST['weight_amount'] * 1000;
            } */
            elseif ($_POST['source_weight_selector'] == 'Gram' && $_POST['destination_weight_selector'] == 'Milligram') {
                $gettingvalue = $_POST['weight_amount'] * 1000;
            }
            elseif ($_POST['source_weight_selector'] == 'Gram' && $_POST['destination_weight_selector'] == 'Microgram') {
                $gettingvalue = $_POST['weight_amount'] * 1e+6;
            }
            elseif ($_POST['source_weight_selector'] == 'Gram' && $_POST['destination_weight_selector'] == 'Imperial ton') {
                $gettingvalue = $_POST['weight_amount'] / 1.016e+6;
            }
            elseif ($_POST['source_weight_selector'] == 'Gram' && $_POST['destination_weight_selector'] == 'US ton') {
                $gettingvalue = $_POST['weight_amount'] / 907185;
            }
            elseif ($_POST['source_weight_selector'] == 'Gram' && $_POST['destination_weight_selector'] == 'Stone') {
                $gettingvalue = $_POST['weight_amount'] / 6350;
            }
            elseif ($_POST['source_weight_selector'] == 'Gram' && $_POST['destination_weight_selector'] == 'Pound') {
                $gettingvalue = $_POST['weight_amount'] / 454;
            }
            elseif ($_POST['source_weight_selector'] == 'Gram' && $_POST['destination_weight_selector'] == 'Ounce') {
                $gettingvalue = $_POST['weight_amount'] / 28.35;
            }

            /* End Gram to Other */

            elseif ($_POST['source_weight_selector'] == 'Milligram' && $_POST['destination_weight_selector'] == 'tonne') {
                $gettingvalue = $_POST['weight_amount'] / 1e+9;
            }
            elseif ($_POST['source_weight_selector'] == 'Milligram' && $_POST['destination_weight_selector'] == 'Kilogram') {
                $gettingvalue = $_POST['weight_amount'] / 1e+6;
            }
            elseif ($_POST['source_weight_selector'] == 'Milligram' && $_POST['destination_weight_selector'] == 'Gram') {
              $gettingvalue = $_POST['weight_amount'] / 1000;
            }
            /* elseif ($_POST['source_weight_selector'] == 'tonne' && $_POST['destination_weight_selector'] == 'Milligram') {
                $gettingvalue = $_POST['weight_amount'] * 1000;
            } */
            elseif ($_POST['source_weight_selector'] == 'Milligram' && $_POST['destination_weight_selector'] == 'Microgram') {
                $gettingvalue = $_POST['weight_amount'] * 1000;
            }
            elseif ($_POST['source_weight_selector'] == 'Milligram' && $_POST['destination_weight_selector'] == 'Imperial ton') {
                $gettingvalue = $_POST['weight_amount'] / 1.016e+9;
            }
            elseif ($_POST['source_weight_selector'] == 'Milligram' && $_POST['destination_weight_selector'] == 'US ton') {
                $gettingvalue = $_POST['weight_amount'] / 9.072e+8;
            }
            elseif ($_POST['source_weight_selector'] == 'Milligram' && $_POST['destination_weight_selector'] == 'Stone') {
                $gettingvalue = $_POST['weight_amount'] / 6.35e+6;
            }
            elseif ($_POST['source_weight_selector'] == 'Milligram' && $_POST['destination_weight_selector'] == 'Pound') {
                $gettingvalue = $_POST['weight_amount'] / 453592;
            }
            elseif ($_POST['source_weight_selector'] == 'Milligram' && $_POST['destination_weight_selector'] == 'Ounce') {
                $gettingvalue = $_POST['weight_amount'] / 28350;
            }

            /* End Milligram to Other */

            elseif ($_POST['source_weight_selector'] == 'Microgram' && $_POST['destination_weight_selector'] == 'tonne') {
                $gettingvalue = $_POST['weight_amount'] / 1e+12;
            }
            elseif ($_POST['source_weight_selector'] == 'Microgram' && $_POST['destination_weight_selector'] == 'Kilogram') {
                $gettingvalue = $_POST['weight_amount'] / 1e+9;
            }
            elseif ($_POST['source_weight_selector'] == 'Microgram' && $_POST['destination_weight_selector'] == 'Gram') {
              $gettingvalue = $_POST['weight_amount'] / 1e+6;
            }
            elseif ($_POST['source_weight_selector'] == 'Microgram' && $_POST['destination_weight_selector'] == 'Milligram') {
                $gettingvalue = $_POST['weight_amount'] / 1000;
            }
           /*  elseif ($_POST['source_weight_selector'] == 'tonne' && $_POST['destination_weight_selector'] == 'Microgram') {
                $gettingvalue = $_POST['weight_amount'] * 1000;
            } */
            elseif ($_POST['source_weight_selector'] == 'Microgram' && $_POST['destination_weight_selector'] == 'Imperial ton') {
                $gettingvalue = $_POST['weight_amount'] / 1.016e+12;
            }
            elseif ($_POST['source_weight_selector'] == 'Microgram' && $_POST['destination_weight_selector'] == 'US ton') {
                $gettingvalue = $_POST['weight_amount'] / 9.072e+11;   
            }
            elseif ($_POST['source_weight_selector'] == 'Microgram' && $_POST['destination_weight_selector'] == 'Stone') {
                $gettingvalue = $_POST['weight_amount'] / 6.35e+9;
            }
            elseif ($_POST['source_weight_selector'] == 'Microgram' && $_POST['destination_weight_selector'] == 'Pound') {
                $gettingvalue = $_POST['weight_amount'] / 4.536e+8;
            }
            elseif ($_POST['source_weight_selector'] == 'Microgram' && $_POST['destination_weight_selector'] == 'Ounce') {
                $gettingvalue = $_POST['weight_amount'] / 2.835e+7;
            }

            /* End MicroGram to Other */

            elseif ($_POST['source_weight_selector'] == 'Imperial ton' && $_POST['destination_weight_selector'] == 'tonne') {
                $gettingvalue = $_POST['weight_amount'] * 1.016;   
            }
            elseif ($_POST['source_weight_selector'] == 'Imperial ton' && $_POST['destination_weight_selector'] == 'Kilogram') {
                $gettingvalue = $_POST['weight_amount'] * 1016;
            }
            elseif ($_POST['source_weight_selector'] == 'Imperial ton' && $_POST['destination_weight_selector'] == 'Gram') {
              $gettingvalue = $_POST['weight_amount'] * 1.016e+6;
            }
            elseif ($_POST['source_weight_selector'] == 'Imperial ton' && $_POST['destination_weight_selector'] == 'Milligram') {
                $gettingvalue = $_POST['weight_amount'] * 1.016e+9;
            }
            elseif ($_POST['source_weight_selector'] == 'Imperial ton' && $_POST['destination_weight_selector'] == 'Microgram') {
                $gettingvalue = $_POST['weight_amount'] * 1.016e+12;
            }
            /* elseif ($_POST['source_weight_selector'] == 'tonne' && $_POST['destination_weight_selector'] == 'Imperial ton') {
                $gettingvalue = $_POST['weight_amount'] * 1000;
            } */
            elseif ($_POST['source_weight_selector'] == 'Imperial ton' && $_POST['destination_weight_selector'] == 'US ton') {
                $gettingvalue = $_POST['weight_amount'] * 1.12;
            }
            elseif ($_POST['source_weight_selector'] == 'Imperial ton' && $_POST['destination_weight_selector'] == 'Stone') {
                $gettingvalue = $_POST['weight_amount'] * 160;
            }
            elseif ($_POST['source_weight_selector'] == 'Imperial ton' && $_POST['destination_weight_selector'] == 'Pound') {
                $gettingvalue = $_POST['weight_amount'] * 2240;
            }
            elseif ($_POST['source_weight_selector'] == 'Imperial ton' && $_POST['destination_weight_selector'] == 'Ounce') {
                $gettingvalue = $_POST['weight_amount'] * 35840;
            }

            /* End Imprerial Ton to Other */

            elseif ($_POST['source_weight_selector'] == 'US ton' && $_POST['destination_weight_selector'] == 'tonne') {
                $gettingvalue = $_POST['weight_amount'] / 1.102;
            }
            elseif ($_POST['source_weight_selector'] == 'US ton' && $_POST['destination_weight_selector'] == 'Kilogram') {
                $gettingvalue = $_POST['weight_amount'] * 907;
            }
            elseif ($_POST['source_weight_selector'] == 'US ton' && $_POST['destination_weight_selector'] == 'Gram') {
              $gettingvalue = $_POST['weight_amount'] * 907185;
            }
            elseif ($_POST['source_weight_selector'] == 'US ton' && $_POST['destination_weight_selector'] == 'Milligram') {
                $gettingvalue = $_POST['weight_amount'] * 9.072e+8;
            }
            elseif ($_POST['source_weight_selector'] == 'US ton' && $_POST['destination_weight_selector'] == 'Microgram') {
                $gettingvalue = $_POST['weight_amount'] * 9.072e+11;
            }
            elseif ($_POST['source_weight_selector'] == 'US ton' && $_POST['destination_weight_selector'] == 'Imperial ton') {
                $gettingvalue = $_POST['weight_amount'] / 1.12;
            }
           /*  elseif ($_POST['source_weight_selector'] == 'tonne' && $_POST['destination_weight_selector'] == 'US ton') {
                $gettingvalue = $_POST['weight_amount'] * 1000;
            } */
            elseif ($_POST['source_weight_selector'] == 'US ton' && $_POST['destination_weight_selector'] == 'Stone') {
                $gettingvalue = $_POST['weight_amount'] * 143;
            }
            elseif ($_POST['source_weight_selector'] == 'US ton' && $_POST['destination_weight_selector'] == 'Pound') {
                $gettingvalue = $_POST['weight_amount'] * 2000;
            }
            elseif ($_POST['source_weight_selector'] == 'US ton' && $_POST['destination_weight_selector'] == 'Ounce') {
                $gettingvalue = $_POST['weight_amount'] * 32000;
            }

            /* End US Ton to Other */

            elseif ($_POST['source_weight_selector'] == 'Stone' && $_POST['destination_weight_selector'] == 'tonne') {
                $gettingvalue = $_POST['weight_amount'] / 157;
            }
            elseif ($_POST['source_weight_selector'] == 'Stone' && $_POST['destination_weight_selector'] == 'Kilogram') {
                $gettingvalue = $_POST['weight_amount'] * 6.35;
            }
            elseif ($_POST['source_weight_selector'] == 'Stone' && $_POST['destination_weight_selector'] == 'Gram') {
              $gettingvalue = $_POST['weight_amount'] * 6350;
            }
            elseif ($_POST['source_weight_selector'] == 'Stone' && $_POST['destination_weight_selector'] == 'Milligram') {
                $gettingvalue = $_POST['weight_amount'] *  6.35e+6;
            }
            elseif ($_POST['source_weight_selector'] == 'Stone' && $_POST['destination_weight_selector'] == 'Microgram') {
                $gettingvalue = $_POST['weight_amount'] * 6.35e+9;
            }
            elseif ($_POST['source_weight_selector'] == 'Stone' && $_POST['destination_weight_selector'] == 'Imperial ton') {
                $gettingvalue = $_POST['weight_amount'] / 160;
            }
            elseif ($_POST['source_weight_selector'] == 'Stone' && $_POST['destination_weight_selector'] == 'US ton') {
                $gettingvalue = $_POST['weight_amount'] / 143;
            }
 /*            elseif ($_POST['source_weight_selector'] == 'tonne' && $_POST['destination_weight_selector'] == 'Stone') {
                $gettingvalue = $_POST['weight_amount'] * 1000;
            } */
            elseif ($_POST['source_weight_selector'] == 'Stone' && $_POST['destination_weight_selector'] == 'Pound') {
                $gettingvalue = $_POST['weight_amount'] * 14;
            }
            elseif ($_POST['source_weight_selector'] == 'Stone' && $_POST['destination_weight_selector'] == 'Ounce') {
                $gettingvalue = $_POST['weight_amount'] * 224;
            }

            /* End Stone to Other */

            elseif ($_POST['source_weight_selector'] == 'Pound' && $_POST['destination_weight_selector'] == 'tonne') {
                $gettingvalue = $_POST['weight_amount'] / 2205;
            }
            elseif ($_POST['source_weight_selector'] == 'Pound' && $_POST['destination_weight_selector'] == 'Kilogram') {
                $gettingvalue = $_POST['weight_amount'] / 2.205;
            }
            elseif ($_POST['source_weight_selector'] == 'Pound' && $_POST['destination_weight_selector'] == 'Gram') {
              $gettingvalue = $_POST['weight_amount'] * 454;
            }
            elseif ($_POST['source_weight_selector'] == 'Pound' && $_POST['destination_weight_selector'] == 'Milligram') {
                $gettingvalue = $_POST['weight_amount'] * 453592;
            }
            elseif ($_POST['source_weight_selector'] == 'Pound' && $_POST['destination_weight_selector'] == 'Microgram') {
                $gettingvalue = $_POST['weight_amount'] * 4.536e+8;
            }
            elseif ($_POST['source_weight_selector'] == 'Pound' && $_POST['destination_weight_selector'] == 'Imperial ton') {
                $gettingvalue = $_POST['weight_amount'] / 2240;
            }
            elseif ($_POST['source_weight_selector'] == 'Pound' && $_POST['destination_weight_selector'] == 'US ton') {
                $gettingvalue = $_POST['weight_amount'] / 2000;
            }
            elseif ($_POST['source_weight_selector'] == 'Pound' && $_POST['destination_weight_selector'] == 'Stone') {
                $gettingvalue = $_POST['weight_amount'] / 14;
            }
         /*    elseif ($_POST['source_weight_selector'] == 'tonne' && $_POST['destination_weight_selector'] == 'Pound') {
                $gettingvalue = $_POST['weight_amount'] * 1000;
            } */
            elseif ($_POST['source_weight_selector'] == 'Pound' && $_POST['destination_weight_selector'] == 'Ounce') {
                $gettingvalue = $_POST['weight_amount'] * 16;
            }

            /* End Pound to Other */

            elseif ($_POST['source_weight_selector'] == 'Ounce' && $_POST['destination_weight_selector'] == 'tonne') {
                $gettingvalue = $_POST['weight_amount'] / 35274;
         }
            elseif ($_POST['source_weight_selector'] == 'Ounce' && $_POST['destination_weight_selector'] == 'Kilogram') {
                $gettingvalue = $_POST['weight_amount'] / 35.274;
            }
            elseif ($_POST['source_weight_selector'] == 'Ounce' && $_POST['destination_weight_selector'] == 'Gram') {
              $gettingvalue = $_POST['weight_amount'] * 28.35;
            }
            elseif ($_POST['source_weight_selector'] == 'Ounce' && $_POST['destination_weight_selector'] == 'Milligram') {
                $gettingvalue = $_POST['weight_amount'] * 28350;
            }
            elseif ($_POST['source_weight_selector'] == 'Ounce' && $_POST['destination_weight_selector'] == 'Microgram') {
                $gettingvalue = $_POST['weight_amount'] * 2.835e+7;
            }
            elseif ($_POST['source_weight_selector'] == 'Ounce' && $_POST['destination_weight_selector'] == 'Imperial ton') {
                $gettingvalue = $_POST['weight_amount'] / 35840;
            }
            elseif ($_POST['source_weight_selector'] == 'Ounce' && $_POST['destination_weight_selector'] == 'US ton') {
                $gettingvalue = $_POST['weight_amount'] / 32000;
            }
            elseif ($_POST['source_weight_selector'] == 'Ounce' && $_POST['destination_weight_selector'] == 'Stone') {
                $gettingvalue = $_POST['weight_amount'] / 224;
            }
            elseif ($_POST['source_weight_selector'] == 'Ounce' && $_POST['destination_weight_selector'] == 'Pound') {
                $gettingvalue = $_POST['weight_amount'] / 16;
            }

            else  {
                $gettingvalue = 0;
              }

         /* End Ounch to Other */
        }
        ?>
        <hr />
        <div class="">
            <label for="weight_amount">Weight :</label>

            <input type="text" class="form-group" disabled value="<?php echo $gettingvalue ? $_POST['source_weight_selector'] .' to '. $_POST['destination_weight_selector'] .' Result is : '. $gettingvalue .' '. $_POST['destination_weight_selector']  : 'Not Measured Yet'; ?>">
        </div>
    </form>

</div>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>