<?php
/**
 * Template Name: Unit Converter Template
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

</head>

<body>
    <div class="register_container">
        <form style="border:2px solid;padding: 20px;margin-left:200px;width:1500px;" class="form_unit_converter"
            method="post" action="" id="form_unit_converter">
            <h2 class="form-signin-heading">Unit Converter By Length</h2>
            <?php
            $text = get_option( 'option_2' );

            ?>
            <h2><?php echo esc_attr( $text ); ?></h2>
            <h2><?php var_dump($text); ?></h2>
            <hr />

            <div class="form-group">
                <label for="source_unit_selector" class="form-label">Select Source Unit: </label>
                <select id="source_unit_selector" name="source_unit_selector" class="form-control">
                    <option value="" selected>Select An option</option>
                    <option value="kilometre" >kilometre</option>
                    <option value="Meter" >Meter</option>
                    <option value="Centimeter" >Centimeter</option>
                    <option value="Millimetre" >Millimetre</option>
                    <option value="micrometres" >micrometres</option>
                    <option value="Nanometre">Nanometre</option>
                    <option value="Mile" >Mile</option>
                    <option value="Yard" >Yard</option>
                    <option value="Foot" >Foot</option>
                    <option value="Inch">Inch</option>
                    <option value="Nautical mile" >Nautical mile</option>
                </select>
            </div>
            <hr />
            <div class="">
                <label for="unit_value">Unit Value :</label>
                <input type="text" class="form-group" name="unit_value" id="unit_value" placeholder="Enter Unit Value">
            </div>
            <hr />
            <div class="form-group">
                <label for="destination_unit_selector" class="form-label">Select Destination Unit: </label>
                <select id="destination_unit_selector" name="destination_unit_selector" class="form-control">
                    <option value="" selected>Select An option</option>
                    <option value="kilometre" >kilometre</option>
                    <option value="Meter">Meter</option>
                    <option value="Centimeter">Centimeter</option>
                    <option value="Millimetre">Millimetre</option>
                    <option value="micrometres">micrometres</option>
                    <option value="Nanometre">Nanometre</option>
                    <option value="Mile">Mile</option>
                    <option value="Yard">Yard</option>
                    <option value="Foot">Foot</option>
                    <option value="Inch">Inch</option>
                    <option value="Nautical mile">Nautical mile</option>
                </select>
            </div>


            <hr />
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="retrieve_unit_measurement_value"
                    name="retrieve_unit_measurement_value" id="btn-submit">
                    <span class="glyphicon glyphicon-log-in"></span> Get Unit Value
                </button>
            </div>
        

        <?php
        
        $source_unit_selector = $_POST['source_unit_selector'];
        $unit_value = $_POST['unit_value'];
        $destination_unit_selector = $_POST['destination_unit_selector'];

        if (isset($_POST['retrieve_unit_measurement_value'])) {

          if ($_POST['source_unit_selector'] == 'kilometre' && $_POST['destination_unit_selector'] == 'Centimeter') {
              $gettingvalue = $_POST['unit_value'] * 100000;
          }
          elseif ($_POST['source_unit_selector'] == 'kilometre' && $_POST['destination_unit_selector'] == 'Meter') {
            $gettingvalue = $_POST['unit_value'] * 1000;
          }
          elseif ($_POST['source_unit_selector'] == 'kilometre' && $_POST['destination_unit_selector'] == 'Millimetre') {
            $gettingvalue = $_POST['unit_value'] * 1000000;
          }
          elseif ($_POST['source_unit_selector'] == 'kilometre' && $_POST['destination_unit_selector'] == 'micrometres') {
            $gettingvalue = $_POST['unit_value'] * 1000000000;
          }
          elseif ($_POST['source_unit_selector'] == 'kilometre' && $_POST['destination_unit_selector'] == 'Nanometre') {
            $gettingvalue = $_POST['unit_value'] * 1e+12;
          }
          elseif ($_POST['source_unit_selector'] == 'kilometre' && $_POST['destination_unit_selector'] == 'Mile') {
            $gettingvalue = $_POST['unit_value'] / 1.609;
          }
          elseif ($_POST['source_unit_selector'] == 'kilometre' && $_POST['destination_unit_selector'] == 'Yard') {
            $gettingvalue = $_POST['unit_value'] * 1094;
          }
          elseif ($_POST['source_unit_selector'] == 'kilometre' && $_POST['destination_unit_selector'] == 'Foot') {
            $gettingvalue = $_POST['unit_value'] * 3281;
          }
          elseif ($_POST['source_unit_selector'] == 'kilometre' && $_POST['destination_unit_selector'] == 'Inch') {
            $gettingvalue = $_POST['unit_value'] * 39370;
          }
          elseif ($_POST['source_unit_selector'] == 'kilometre' && $_POST['destination_unit_selector'] == 'Nautical mile') {
            $gettingvalue = $_POST['unit_value'] / 1.852;
          }
/* End KM to other */


          elseif ($_POST['source_unit_selector'] == 'Meter' && $_POST['destination_unit_selector'] == 'kilometre') {
            $gettingvalue = $_POST['unit_value'] / 1000;
          }
          elseif ($_POST['source_unit_selector'] == 'Meter' && $_POST['destination_unit_selector'] == 'Centimeter') {
            $gettingvalue = $_POST['unit_value'] * 100;
          }
          elseif ($_POST['source_unit_selector'] == 'Meter' && $_POST['destination_unit_selector'] == 'Millimetre') {
            $gettingvalue = $_POST['unit_value'] * 1000;
          }
          elseif ($_POST['source_unit_selector'] == 'Meter' && $_POST['destination_unit_selector'] == 'micrometres') {
            $gettingvalue = $_POST['unit_value'] * 1e+6;
          }
          elseif ($_POST['source_unit_selector'] == 'Meter' && $_POST['destination_unit_selector'] == 'Nanometre') {
            $gettingvalue = $_POST['unit_value'] * 1e+9;
          }
          elseif ($_POST['source_unit_selector'] == 'Meter' && $_POST['destination_unit_selector'] == 'Mile') {
            $gettingvalue = $_POST['unit_value'] / 1609;
          }
          elseif ($_POST['source_unit_selector'] == 'Meter' && $_POST['destination_unit_selector'] == 'Yard') {
            $gettingvalue = $_POST['unit_value'] * 1.094;
          }
          elseif ($_POST['source_unit_selector'] == 'Meter' && $_POST['destination_unit_selector'] == 'Foot') {
            $gettingvalue = $_POST['unit_value'] * 3.281;
          }
          elseif ($_POST['source_unit_selector'] == 'Meter' && $_POST['destination_unit_selector'] == 'Inch') {
            $gettingvalue = $_POST['unit_value'] * 39.37;
          }
          elseif ($_POST['source_unit_selector'] == 'Meter' && $_POST['destination_unit_selector'] == 'Nautical mile') {
            $gettingvalue = $_POST['unit_value'] / 1852;
          }

          /* End Meter to other */

          elseif ($_POST['source_unit_selector'] == 'Centimeter' && $_POST['destination_unit_selector'] == 'kilometre') {
            $gettingvalue = $_POST['unit_value'] / 100000;
          }
          elseif ($_POST['source_unit_selector'] == 'Centimeter' && $_POST['destination_unit_selector'] == 'Meter') {
            $gettingvalue = $_POST['unit_value'] / 100;
          }
          elseif ($_POST['source_unit_selector'] == 'Centimeter' && $_POST['destination_unit_selector'] == 'Millimetre') {
            $gettingvalue = $_POST['unit_value'] * 10;
          }
          elseif ($_POST['source_unit_selector'] == 'Centimeter' && $_POST['destination_unit_selector'] == 'micrometres') {
            $gettingvalue = $_POST['unit_value'] * 10000;
          }
          elseif ($_POST['source_unit_selector'] == 'Centimeter' && $_POST['destination_unit_selector'] == 'Nanometre') {
            $gettingvalue = $_POST['unit_value'] * 1e+7;
          }
          elseif ($_POST['source_unit_selector'] == 'Centimeter' && $_POST['destination_unit_selector'] == 'Mile') {
            $gettingvalue = $_POST['unit_value'] / 160934;
          }
          elseif ($_POST['source_unit_selector'] == 'Centimeter' && $_POST['destination_unit_selector'] == 'Yard') {
            $gettingvalue = $_POST['unit_value'] / 91.44;
          }
          elseif ($_POST['source_unit_selector'] == 'Centimeter' && $_POST['destination_unit_selector'] == 'Foot') {
            $gettingvalue = $_POST['unit_value'] / 30.48;
          }
          elseif ($_POST['source_unit_selector'] == 'Centimeter' && $_POST['destination_unit_selector'] == 'Inch') {
            $gettingvalue = $_POST['unit_value'] / 2.54;
          }
          elseif ($_POST['source_unit_selector'] == 'Centimeter' && $_POST['destination_unit_selector'] == 'Nautical mile') {
            $gettingvalue = $_POST['unit_value'] / 185200;
          }

          /* End to Centimeter to others */


          elseif ($_POST['source_unit_selector'] == 'Millimetre' && $_POST['destination_unit_selector'] == 'kilometre') {
            $gettingvalue = $_POST['unit_value'] / 1e+6;
          }
          elseif ($_POST['source_unit_selector'] == 'Millimetre' && $_POST['destination_unit_selector'] == 'Meter') {
            $gettingvalue = $_POST['unit_value'] / 1000;
          }
          elseif ($_POST['source_unit_selector'] == 'Millimetre' && $_POST['destination_unit_selector'] == 'Centimeter') {
            $gettingvalue = $_POST['unit_value'] / 10;
          }
          elseif ($_POST['source_unit_selector'] == 'Millimetre' && $_POST['destination_unit_selector'] == 'micrometres') {
            $gettingvalue = $_POST['unit_value'] * 1000;
          }
          elseif ($_POST['source_unit_selector'] == 'Millimetre' && $_POST['destination_unit_selector'] == 'Nanometre') {
            $gettingvalue = $_POST['unit_value'] * 1e+6;
          }
          elseif ($_POST['source_unit_selector'] == 'Millimetre' && $_POST['destination_unit_selector'] == 'Mile') {
            $gettingvalue = $_POST['unit_value'] / 1.609e+6;
          }
          elseif ($_POST['source_unit_selector'] == 'Millimetre' && $_POST['destination_unit_selector'] == 'Yard') {
            $gettingvalue = $_POST['unit_value'] / 914;
          }
          elseif ($_POST['source_unit_selector'] == 'Millimetre' && $_POST['destination_unit_selector'] == 'Foot') {
            $gettingvalue = $_POST['unit_value'] / 305;
          }
          elseif ($_POST['source_unit_selector'] == 'Millimetre' && $_POST['destination_unit_selector'] == 'Inch') {
            $gettingvalue = $_POST['unit_value'] / 25.4;
          }
          elseif ($_POST['source_unit_selector'] == 'Millimetre' && $_POST['destination_unit_selector'] == 'Nautical mile') {
            $gettingvalue = $_POST['unit_value'] / 1.852e+6;
          }

/* End Millimeter to Others */


          elseif ($_POST['source_unit_selector'] == 'micrometres' && $_POST['destination_unit_selector'] == 'kilometre') {
            $gettingvalue = $_POST['unit_value'] / 1e+9;
          }
          elseif ($_POST['source_unit_selector'] == 'micrometres' && $_POST['destination_unit_selector'] == 'Meter') {
            $gettingvalue = $_POST['unit_value'] / 1e+6;
          }
          elseif ($_POST['source_unit_selector'] == 'micrometres' && $_POST['destination_unit_selector'] == 'Centimeter') {
            $gettingvalue = $_POST['unit_value'] / 10000;
          }
          elseif ($_POST['source_unit_selector'] == 'micrometres' && $_POST['destination_unit_selector'] == 'Millimetre') {
            $gettingvalue = $_POST['unit_value'] / 1000;
          }
          elseif ($_POST['source_unit_selector'] == 'micrometres' && $_POST['destination_unit_selector'] == 'Nanometre') {
            $gettingvalue = $_POST['unit_value'] * 1000;
          }
          elseif ($_POST['source_unit_selector'] == 'micrometres' && $_POST['destination_unit_selector'] == 'Mile') {
            $gettingvalue = $_POST['unit_value'] / 1.609e+9;
          }
          elseif ($_POST['source_unit_selector'] == 'micrometres' && $_POST['destination_unit_selector'] == 'Yard') {
            $gettingvalue = $_POST['unit_value'] / 914400;
          }
          elseif ($_POST['source_unit_selector'] == 'micrometres' && $_POST['destination_unit_selector'] == 'Foot') {
            $gettingvalue = $_POST['unit_value'] / 304800;
          }
          elseif ($_POST['source_unit_selector'] == 'micrometres' && $_POST['destination_unit_selector'] == 'Inch') {
            $gettingvalue = $_POST['unit_value'] / 25400;
          }
          elseif ($_POST['source_unit_selector'] == 'micrometres' && $_POST['destination_unit_selector'] == 'Nautical mile') {
            $gettingvalue = $_POST['unit_value'] / 1.852e+9;
          }
         

          /* End Micro Meter to Others */


          elseif ($_POST['source_unit_selector'] == 'Nanometre' && $_POST['destination_unit_selector'] == 'kilometre') {
            $gettingvalue = $_POST['unit_value'] / 1e+12;
          }
          elseif ($_POST['source_unit_selector'] == 'Nanometre' && $_POST['destination_unit_selector'] == 'Meter') {
            $gettingvalue = $_POST['unit_value'] / 1e+9;
          }
          elseif ($_POST['source_unit_selector'] == 'Nanometre' && $_POST['destination_unit_selector'] == 'Centimeter') {
            $gettingvalue = $_POST['unit_value'] / 1e+7;
          }
          elseif ($_POST['source_unit_selector'] == 'Nanometre' && $_POST['destination_unit_selector'] == 'Millimetre') {
            $gettingvalue = $_POST['unit_value'] / 1e+6;
          }
          elseif ($_POST['source_unit_selector'] == 'Nanometre' && $_POST['destination_unit_selector'] == 'micrometres') {
            $gettingvalue = $_POST['unit_value'] / 1000;
          }
          elseif ($_POST['source_unit_selector'] == 'Nanometre' && $_POST['destination_unit_selector'] == 'Mile') {
            $gettingvalue = $_POST['unit_value'] / 1.609e+12;
          }
          elseif ($_POST['source_unit_selector'] == 'Nanometre' && $_POST['destination_unit_selector'] == 'Yard') {
            $gettingvalue = $_POST['unit_value'] / 9.144e+8;
          }
          elseif ($_POST['source_unit_selector'] == 'Nanometre' && $_POST['destination_unit_selector'] == 'Foot') {
            $gettingvalue = $_POST['unit_value'] / 3.048e+8;
          }
          elseif ($_POST['source_unit_selector'] == 'Nanometre' && $_POST['destination_unit_selector'] == 'Inch') {
            $gettingvalue = $_POST['unit_value'] / 2.54e+7;
          }
          elseif ($_POST['source_unit_selector'] == 'Nanometre' && $_POST['destination_unit_selector'] == 'Nautical mile') {
            $gettingvalue = $_POST['unit_value'] / 1.852e+12;
          }

          /* End nanometer to Others */

          elseif ($_POST['source_unit_selector'] == 'Mile' && $_POST['destination_unit_selector'] == 'kilometre') {
            $gettingvalue = $_POST['unit_value'] * 1.609;
          }
          elseif ($_POST['source_unit_selector'] == 'Mile' && $_POST['destination_unit_selector'] == 'Meter') {
            $gettingvalue = $_POST['unit_value'] * 1609;
          }
          elseif ($_POST['source_unit_selector'] == 'Mile' && $_POST['destination_unit_selector'] == 'Centimeter') {
            $gettingvalue = $_POST['unit_value'] * 160934;
          }
          elseif ($_POST['source_unit_selector'] == 'Mile' && $_POST['destination_unit_selector'] == 'Millimetre') {
            $gettingvalue = $_POST['unit_value'] * 1.609e+6;
          }
          elseif ($_POST['source_unit_selector'] == 'Mile' && $_POST['destination_unit_selector'] == 'micrometres') {
            $gettingvalue = $_POST['unit_value'] * 1.609e+9;
          }
          elseif ($_POST['source_unit_selector'] == 'Mile' && $_POST['destination_unit_selector'] == 'Nanometre') {
            $gettingvalue = $_POST['unit_value'] * 1.609e+12;
          }
          elseif ($_POST['source_unit_selector'] == 'Mile' && $_POST['destination_unit_selector'] == 'Yard') {
            $gettingvalue = $_POST['unit_value'] * 1760;
          }
          elseif ($_POST['source_unit_selector'] == 'Mile' && $_POST['destination_unit_selector'] == 'Foot') {
            $gettingvalue = $_POST['unit_value'] * 5280;
          }
          elseif ($_POST['source_unit_selector'] == 'Mile' && $_POST['destination_unit_selector'] == 'Inch') {
            $gettingvalue = $_POST['unit_value'] * 63360;
          }
          elseif ($_POST['source_unit_selector'] == 'Mile' && $_POST['destination_unit_selector'] == 'Nautical mile') {
            $gettingvalue = $_POST['unit_value'] / 1.151;
          }

          /* End of Mile to Others */

          elseif ($_POST['source_unit_selector'] == 'Yard' && $_POST['destination_unit_selector'] == 'kilometre') {
            $gettingvalue = $_POST['unit_value'] / 1094;
          }
          elseif ($_POST['source_unit_selector'] == 'Yard' && $_POST['destination_unit_selector'] == 'Meter') {
            $gettingvalue = $_POST['unit_value'] / 1.094;
          }
          elseif ($_POST['source_unit_selector'] == 'Yard' && $_POST['destination_unit_selector'] == 'Centimeter') {
            $gettingvalue = $_POST['unit_value'] * 91.44;
          }
          elseif ($_POST['source_unit_selector'] == 'Yard' && $_POST['destination_unit_selector'] == 'Millimetre') {
            $gettingvalue = $_POST['unit_value'] * 914;
          }
          elseif ($_POST['source_unit_selector'] == 'Yard' && $_POST['destination_unit_selector'] == 'micrometres') {
            $gettingvalue = $_POST['unit_value'] * 914400;
          }
          elseif ($_POST['source_unit_selector'] == 'Yard' && $_POST['destination_unit_selector'] == 'Nanometre') {
            $gettingvalue = $_POST['unit_value'] * 9.144e+8;
          }
          elseif ($_POST['source_unit_selector'] == 'Yard' && $_POST['destination_unit_selector'] == 'Mile') {
            $gettingvalue = $_POST['unit_value'] / 1760;
          }
          elseif ($_POST['source_unit_selector'] == 'Yard' && $_POST['destination_unit_selector'] == 'Foot') {
            $gettingvalue = $_POST['unit_value'] * 3;
          }
          elseif ($_POST['source_unit_selector'] == 'Yard' && $_POST['destination_unit_selector'] == 'Inch') {
            $gettingvalue = $_POST['unit_value'] * 36;
          }
          elseif ($_POST['source_unit_selector'] == 'Yard' && $_POST['destination_unit_selector'] == 'Nautical mile') {
            $gettingvalue = $_POST['unit_value'] / 2025;
          }

          /* End of Yard to others */


          elseif ($_POST['source_unit_selector'] == 'Foot' && $_POST['destination_unit_selector'] == 'kilometre') {
            $gettingvalue = $_POST['unit_value'] / 3281;
          }
          elseif ($_POST['source_unit_selector'] == 'Foot' && $_POST['destination_unit_selector'] == 'Meter') {
            $gettingvalue = $_POST['unit_value'] / 3.281;
          }
          elseif ($_POST['source_unit_selector'] == 'Foot' && $_POST['destination_unit_selector'] == 'Centimeter') {
            $gettingvalue = $_POST['unit_value'] * 30.48;
          }
          elseif ($_POST['source_unit_selector'] == 'Foot' && $_POST['destination_unit_selector'] == 'Millimetre') {
            $gettingvalue = $_POST['unit_value'] * 305;
          }
          elseif ($_POST['source_unit_selector'] == 'Foot' && $_POST['destination_unit_selector'] == 'micrometres') {
            $gettingvalue = $_POST['unit_value'] * 304800;
          }
          elseif ($_POST['source_unit_selector'] == 'Foot' && $_POST['destination_unit_selector'] == 'Nanometre') {
            $gettingvalue = $_POST['unit_value'] * 3.048e+8;
          }
          elseif ($_POST['source_unit_selector'] == 'Foot' && $_POST['destination_unit_selector'] == 'Mile') {
            $gettingvalue = $_POST['unit_value'] / 5280;
          }
          elseif ($_POST['source_unit_selector'] == 'Foot' && $_POST['destination_unit_selector'] == 'Yard') {
            $gettingvalue = $_POST['unit_value'] / 3;
          }
          elseif ($_POST['source_unit_selector'] == 'Foot' && $_POST['destination_unit_selector'] == 'Inch') {
            $gettingvalue = $_POST['unit_value'] * 12;
          }
          elseif ($_POST['source_unit_selector'] == 'Foot' && $_POST['destination_unit_selector'] == 'Nautical mile') {
            $gettingvalue = $_POST['unit_value'] / 6076;
          }

          /* End Foot to Others */


          elseif ($_POST['source_unit_selector'] == 'Inch' && $_POST['destination_unit_selector'] == 'kilometre') {
            $gettingvalue = $_POST['unit_value'] / 39370;
          }
          elseif ($_POST['source_unit_selector'] == 'Inch' && $_POST['destination_unit_selector'] == 'Meter') {
            $gettingvalue = $_POST['unit_value'] / 39.37;
          }
          elseif ($_POST['source_unit_selector'] == 'Inch' && $_POST['destination_unit_selector'] == 'Centimeter') {
            $gettingvalue = $_POST['unit_value'] * 2.54;
          }
          elseif ($_POST['source_unit_selector'] == 'Inch' && $_POST['destination_unit_selector'] == 'Millimetre') {
            $gettingvalue = $_POST['unit_value'] * 25.4;
          }
          elseif ($_POST['source_unit_selector'] == 'Inch' && $_POST['destination_unit_selector'] == 'micrometres') {
            $gettingvalue = $_POST['unit_value'] * 25400;
          }
          elseif ($_POST['source_unit_selector'] == 'Inch' && $_POST['destination_unit_selector'] == 'Nanometre') {
            $gettingvalue = $_POST['unit_value'] * 2.54e+7;
          }
          elseif ($_POST['source_unit_selector'] == 'Inch' && $_POST['destination_unit_selector'] == 'Mile') {
            $gettingvalue = $_POST['unit_value'] / 63360;
          }
          elseif ($_POST['source_unit_selector'] == 'Inch' && $_POST['destination_unit_selector'] == 'Yard') {
            $gettingvalue = $_POST['unit_value'] / 36;
          }
          elseif ($_POST['source_unit_selector'] == 'Inch' && $_POST['destination_unit_selector'] == 'Foot') {
            $gettingvalue = $_POST['unit_value'] / 12;
          }
          elseif ($_POST['source_unit_selector'] == 'Inch' && $_POST['destination_unit_selector'] == 'Nautical mile') {
            $gettingvalue = $_POST['unit_value'] / 72913;
          }

          /* End of Inch to others */

          elseif ($_POST['source_unit_selector'] == 'Nautical mile' && $_POST['destination_unit_selector'] == 'kilometre') {
            $gettingvalue = $_POST['unit_value'] * 1.852;
          }
          elseif ($_POST['source_unit_selector'] == 'Nautical mile' && $_POST['destination_unit_selector'] == 'Meter') {
            $gettingvalue = $_POST['unit_value'] * 1852;
          }
          elseif ($_POST['source_unit_selector'] == 'Nautical mile' && $_POST['destination_unit_selector'] == 'Centimeter') {
            $gettingvalue = $_POST['unit_value'] * 185200;
          }
          elseif ($_POST['source_unit_selector'] == 'Nautical mile' && $_POST['destination_unit_selector'] == 'Millimetre') {
            $gettingvalue = $_POST['unit_value'] * 1.852e+6;
          }
          elseif ($_POST['source_unit_selector'] == 'Nautical mile' && $_POST['destination_unit_selector'] == 'micrometres') {
            $gettingvalue = $_POST['unit_value'] * 1.852e+9;
          }
          elseif ($_POST['source_unit_selector'] == 'Nautical mile' && $_POST['destination_unit_selector'] == 'Nanometre') {
            $gettingvalue = $_POST['unit_value'] * 1.852e+12;
          }
          elseif ($_POST['source_unit_selector'] == 'Nautical mile' && $_POST['destination_unit_selector'] == 'Mile') {
            $gettingvalue = $_POST['unit_value'] * 1.151;
          }
          elseif ($_POST['source_unit_selector'] == 'Nautical mile' && $_POST['destination_unit_selector'] == 'Yard') {
            $gettingvalue = $_POST['unit_value'] * 2025;
          }
          elseif ($_POST['source_unit_selector'] == 'Nautical mile' && $_POST['destination_unit_selector'] == 'Foot') {
            $gettingvalue = $_POST['unit_value'] * 6076;
          }
          elseif ($_POST['source_unit_selector'] == 'Nautical mile' && $_POST['destination_unit_selector'] == 'Inch') {
            $gettingvalue = $_POST['unit_value'] * 72913;
          }

          else  {
            $gettingvalue = 0;
          }


          
            
            // print_r($destination_unit_selector);
            
        }

        ?>
         <hr />
            <div class="">
                <label for="unit_value">OutPut :</label>

                <input type="text" class="form-group" disabled value="<?php echo $gettingvalue ? $gettingvalue : 'Not Measured Yet'; ?>">
            </div>
        </form>
    </div>

    <?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

    <?php get_footer(); ?>