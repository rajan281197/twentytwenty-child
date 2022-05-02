<?php
/**
 * Template Name: Time Calculation Template
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
        <h2 class="form-signin-heading">Time Calculation</h2>
        <hr />

        <div class="form-group">
            <label for="source__time" class="form-label">Select Source Time: </label>
            <select id="source__time" name="source__time" class="form-control">
                <option value="" selected>Select An option</option>
                <option value="Nanosecond">Nanosecond</option>
                <option value="Microsecond">Microsecond</option>
                <option value="Millisecond">Millisecond</option>
                <option value="Second">Second</option>
                <option value="Minute">Minute</option>
                <option value="Hour">Hour</option>
                <option value="Day">Day</option>
                <option value="Week">Week</option>
                <option value="Month">Month</option>
                <option value="Calendar year">Calendar year</option>
                <option value="Decade">Decade</option>
                <option value="Century">Century</option>
            </select>
        </div>
        <hr />

        <div class="form-group">
            <label for="time_amount">Time Amount :</label>
            <input type="text" class="form-group" name="time_amount" id="time_amount" placeholder="Weight Amount">
        </div>
        <hr />

        <div class="form-group">
            <label for="destination__time" class="form-label">Select Destination Time: </label>
            <select id="destination__time" name="destination__time" class="form-control">
                <option value="" selected>Select An option</option>
                <option value="Nanosecond">Nanosecond</option>
                <option value="Microsecond">Microsecond</option>
                <option value="Millisecond">Millisecond</option>
                <option value="Second">Second</option>
                <option value="Minute">Minute</option>
                <option value="Hour">Hour</option>
                <option value="Day">Day</option>
                <option value="Week">Week</option>
                <option value="Month">Month</option>
                <option value="Calendar year">Calendar year</option>
                <option value="Decade">Decade</option>
                <option value="Century">Century</option>
            </select>
        </div>
        <hr />
        <div class="form-group">

            <button type="submit" class="btn btn-default" id="retrieve_time_calculation"
                name="retrieve_time_calculation" id="btn-submit">
                <span class="glyphicon glyphicon-log-in"></span> Convert Time
            </button>
        </div>

        <?php

        $source__time = $_POST['source__time'];
        $time_amount = $_POST['time_amount'];
        $destination__time = $_POST['destination__time'];

        if (isset($_POST['retrieve_time_calculation'])) {          

           /*  if ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Nanosecond') {
                $gettingvalue = $_POST['time_amount'] * 100000;
            } */
            if ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Microsecond') {
                $gettingvalue = $_POST['time_amount'] / 1000;
            }
            elseif ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Millisecond') {
              $gettingvalue = $_POST['time_amount'] / 1e+6;
            }
            elseif ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Second') {
                $gettingvalue = $_POST['time_amount'] / 1e+9;
            }
            elseif ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Minute') {
                $gettingvalue = $_POST['time_amount'] / 6e+10;
            }
            elseif ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Hour') {
                $gettingvalue = $_POST['time_amount'] / 3.6e+12;
            }
            elseif ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Day') {
                $gettingvalue = $_POST['time_amount'] / 8.64e+13;
            }
            elseif ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Week') {
                $gettingvalue = $_POST['time_amount'] / 6.048e+14;
            }
            elseif ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Month') {
                $gettingvalue = $_POST['time_amount'] / 2.628e+15;
            }
            elseif ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Calendar year') {
                $gettingvalue = $_POST['time_amount'] / 3.154e+16;
            }
            elseif ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Decade') {
                $gettingvalue = $_POST['time_amount'] / 3.154e+17;
            }
            elseif ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Century') {
                $gettingvalue = $_POST['time_amount'] / 3.154e+18;
            }

            /* End Nanosecond to other */

            elseif ($_POST['source__time'] == 'Microsecond' && $_POST['destination__time'] == 'Nanosecond') {
                $gettingvalue = $_POST['time_amount'] * 1000;
            }
          /*   elseif ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Microsecond') {
                $gettingvalue = $_POST['time_amount'] * 100000;
            } */
            elseif ($_POST['source__time'] == 'Microsecond' && $_POST['destination__time'] == 'Millisecond') {
                $gettingvalue = $_POST['time_amount'] / 1000;
              }
            elseif ($_POST['source__time'] == 'Microsecond' && $_POST['destination__time'] == 'Second') {
              $gettingvalue = $_POST['time_amount'] / 1e+6;
            }
            elseif ($_POST['source__time'] == 'Microsecond' && $_POST['destination__time'] == 'Minute') {
                $gettingvalue = $_POST['time_amount'] / 6e+7;
            }
            elseif ($_POST['source__time'] == 'Microsecond' && $_POST['destination__time'] == 'Hour') {
                $gettingvalue = $_POST['time_amount'] / 3.6e+9;
            }
            elseif ($_POST['source__time'] == 'Microsecond' && $_POST['destination__time'] == 'Day') {
                $gettingvalue = $_POST['time_amount'] / 8.64e+10;
            }
            elseif ($_POST['source__time'] == 'Microsecond' && $_POST['destination__time'] == 'Week') {
                $gettingvalue = $_POST['time_amount'] / 6.048e+11;
            }
            elseif ($_POST['source__time'] == 'Microsecond' && $_POST['destination__time'] == 'Month') {
                $gettingvalue = $_POST['time_amount'] / 2.628e+12;
            }
            elseif ($_POST['source__time'] == 'Microsecond' && $_POST['destination__time'] == 'Calendar year') {
                $gettingvalue = $_POST['time_amount'] / 3.154e+13;
            }
            elseif ($_POST['source__time'] == 'Microsecond' && $_POST['destination__time'] == 'Decade') {
                $gettingvalue = $_POST['time_amount'] / 3.154e+14;
            }
            elseif ($_POST['source__time'] == 'Microsecond' && $_POST['destination__time'] == 'Century') {
                $gettingvalue = $_POST['time_amount'] / 3.154e+15;
            }

            /* End Microsecond to OTher */

            elseif ($_POST['source__time'] == 'Millisecond' && $_POST['destination__time'] == 'Nanosecond') {
                $gettingvalue = $_POST['time_amount'] * 1e+6;
            }
            elseif ($_POST['source__time'] == 'Millisecond' && $_POST['destination__time'] == 'Microsecond') {
                $gettingvalue = $_POST['time_amount'] * 1000;
            }
            /* elseif ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Gram') {
              $gettingvalue = $_POST['time_amount'] * 1000;
            } */
            elseif ($_POST['source__time'] == 'Millisecond' && $_POST['destination__time'] == 'Second') {
                $gettingvalue = $_POST['time_amount'] / 1000;
            }
            elseif ($_POST['source__time'] == 'Millisecond' && $_POST['destination__time'] == 'Minute') {
                $gettingvalue = $_POST['time_amount'] / 60000;
            }
            elseif ($_POST['source__time'] == 'Millisecond' && $_POST['destination__time'] == 'Hour') {
                $gettingvalue = $_POST['time_amount'] / 3.6e+6;
            }
            elseif ($_POST['source__time'] == 'Millisecond' && $_POST['destination__time'] == 'Day') {
                $gettingvalue = $_POST['time_amount'] / 8.64e+7;
            }
            elseif ($_POST['source__time'] == 'Millisecond' && $_POST['destination__time'] == 'Week') {
                $gettingvalue = $_POST['time_amount'] / 6.048e+8;
            }
            elseif ($_POST['source__time'] == 'Millisecond' && $_POST['destination__time'] == 'Month') {
                $gettingvalue = $_POST['time_amount'] / 2.628e+9;
            }
            elseif ($_POST['source__time'] == 'Millisecond' && $_POST['destination__time'] == 'Calendar year') {
                $gettingvalue = $_POST['time_amount'] / 3.154e+10;
            }
            elseif ($_POST['source__time'] == 'Millisecond' && $_POST['destination__time'] == 'Decade') {
                $gettingvalue = $_POST['time_amount'] / 3.154e+11;
            }
            elseif ($_POST['source__time'] == 'Millisecond' && $_POST['destination__time'] == 'Century') {
                $gettingvalue = $_POST['time_amount'] / 3.154e+12;
            }

            /* End Gram to Other */

            elseif ($_POST['source__time'] == 'Second' && $_POST['destination__time'] == 'Nanosecond') {
                $gettingvalue = $_POST['time_amount'] * 1e+9;
            }
            elseif ($_POST['source__time'] == 'Second' && $_POST['destination__time'] == 'Microsecond') {
                $gettingvalue = $_POST['time_amount'] * 1e+6;
            }
            elseif ($_POST['source__time'] == 'Second' && $_POST['destination__time'] == 'Millisecond') {
              $gettingvalue = $_POST['time_amount'] * 1000;
            }
            /* elseif ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Second') {
                $gettingvalue = $_POST['time_amount'] * 1000;
            } */

            elseif ($_POST['source__time'] == 'Second' && $_POST['destination__time'] == 'Minute') {
                $gettingvalue = $_POST['time_amount'] / 60;
            }
            elseif ($_POST['source__time'] == 'Second' && $_POST['destination__time'] == 'Hour') {
                $gettingvalue = $_POST['time_amount'] / 3600;
            }
            elseif ($_POST['source__time'] == 'Second' && $_POST['destination__time'] == 'Day') {
                $gettingvalue = $_POST['time_amount'] / 86400;
            }
            elseif ($_POST['source__time'] == 'Second' && $_POST['destination__time'] == 'Week') {
                $gettingvalue = $_POST['time_amount'] / 604800;
            }
            elseif ($_POST['source__time'] == 'Second' && $_POST['destination__time'] == 'Month') {
                $gettingvalue = $_POST['time_amount'] / 2.628e+6;
            }
            elseif ($_POST['source__time'] == 'Second' && $_POST['destination__time'] == 'Calendar year') {
                $gettingvalue = $_POST['time_amount'] / 3.154e+7;
            }
            elseif ($_POST['source__time'] == 'Second' && $_POST['destination__time'] == 'Decade') {
                $gettingvalue = $_POST['time_amount'] / 3.154e+8;
            }
            elseif ($_POST['source__time'] == 'Second' && $_POST['destination__time'] == 'Century') {
                $gettingvalue = $_POST['time_amount'] / 3.154e+9;
            }


            /* End MilliMillisecond to Other */

            elseif ($_POST['source__time'] == 'Minute' && $_POST['destination__time'] == 'Nanosecond') {
                $gettingvalue = $_POST['time_amount'] * 6e+10;
            }
            elseif ($_POST['source__time'] == 'Minute' && $_POST['destination__time'] == 'Microsecond') {
                $gettingvalue = $_POST['time_amount'] * 6e+7;
            }
            elseif ($_POST['source__time'] == 'Minute' && $_POST['destination__time'] == 'Millisecond') {
              $gettingvalue = $_POST['time_amount'] * 60000;
            }
            elseif ($_POST['source__time'] == 'Minute' && $_POST['destination__time'] == 'Second') {
                $gettingvalue = $_POST['time_amount'] * 60;
            }
           /*  elseif ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Microgram') {
                $gettingvalue = $_POST['time_amount'] * 1000;
            } */
          /*   elseif ($_POST['source__time'] == 'Minute' && $_POST['destination__time'] == 'Minute') {
                $gettingvalue = $_POST['time_amount'] / 1.016e+12;
            } */
            elseif ($_POST['source__time'] == 'Minute' && $_POST['destination__time'] == 'Hour') {
                $gettingvalue = $_POST['time_amount'] / 60;   
            }
            elseif ($_POST['source__time'] == 'Minute' && $_POST['destination__time'] == 'Day') {
                $gettingvalue = $_POST['time_amount'] / 1440;
            }
            elseif ($_POST['source__time'] == 'Minute' && $_POST['destination__time'] == 'Week') {
                $gettingvalue = $_POST['time_amount'] / 10080;
            }
            elseif ($_POST['source__time'] == 'Minute' && $_POST['destination__time'] == 'Month') {
                $gettingvalue = $_POST['time_amount'] / 43800;
            }
            elseif ($_POST['source__time'] == 'Minute' && $_POST['destination__time'] == 'Calendar year') {
                $gettingvalue = $_POST['time_amount'] / 525600;
            }
            elseif ($_POST['source__time'] == 'Minute' && $_POST['destination__time'] == 'Decade') {
                $gettingvalue = $_POST['time_amount'] / 5.256e+6;
            }
            elseif ($_POST['source__time'] == 'Minute' && $_POST['destination__time'] == 'Century') {
                $gettingvalue = $_POST['time_amount'] / 5.256e+7;
            }
            
            /* End MicroGram to Other */

            elseif ($_POST['source__time'] == 'Hour' && $_POST['destination__time'] == 'Nanosecond') {
                $gettingvalue = $_POST['time_amount'] * 3.6e+12;   
            }
            elseif ($_POST['source__time'] == 'Hour' && $_POST['destination__time'] == 'Microsecond') {
                $gettingvalue = $_POST['time_amount'] * 3.6e+9;
            }
            elseif ($_POST['source__time'] == 'Hour' && $_POST['destination__time'] == 'Millisecond') {
              $gettingvalue = $_POST['time_amount'] * 3.6e+6;
            }
            elseif ($_POST['source__time'] == 'Hour' && $_POST['destination__time'] == 'Second') {
                $gettingvalue = $_POST['time_amount'] * 3600;
            }
            elseif ($_POST['source__time'] == 'Hour' && $_POST['destination__time'] == 'Minute') {
                $gettingvalue = $_POST['time_amount'] * 60;
            }
            /* elseif ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Hour') {
                $gettingvalue = $_POST['time_amount'] * 1000;
            } */
            elseif ($_POST['source__time'] == 'Hour' && $_POST['destination__time'] == 'Day') {
                $gettingvalue = $_POST['time_amount'] / 24;
            }
            elseif ($_POST['source__time'] == 'Hour' && $_POST['destination__time'] == 'Week') {
                $gettingvalue = $_POST['time_amount'] / 168;
            }
            elseif ($_POST['source__time'] == 'Hour' && $_POST['destination__time'] == 'Month') {
                $gettingvalue = $_POST['time_amount'] / 730;
            }
            elseif ($_POST['source__time'] == 'Hour' && $_POST['destination__time'] == 'Calendar year') {
                $gettingvalue = $_POST['time_amount'] / 8760;
            }
            elseif ($_POST['source__time'] == 'Hour' && $_POST['destination__time'] == 'Decade') {
                $gettingvalue = $_POST['time_amount'] / 87600;
            }
            elseif ($_POST['source__time'] == 'Hour' && $_POST['destination__time'] == 'Century') {
                $gettingvalue = $_POST['time_amount'] / 876000;
            }
            /* End Imprerial Ton to Other */

            elseif ($_POST['source__time'] == 'Day' && $_POST['destination__time'] == 'Nanosecond') {
                $gettingvalue = $_POST['time_amount'] * 8.64e+13;
            }
            elseif ($_POST['source__time'] == 'Day' && $_POST['destination__time'] == 'Microsecond') {
                $gettingvalue = $_POST['time_amount'] * 8.64e+10;
            }
            elseif ($_POST['source__time'] == 'Day' && $_POST['destination__time'] == 'Millisecond') {
              $gettingvalue = $_POST['time_amount'] * 8.64e+7;
            }
            elseif ($_POST['source__time'] == 'Day' && $_POST['destination__time'] == 'Second') {
                $gettingvalue = $_POST['time_amount'] * 86400;
            }
            elseif ($_POST['source__time'] == 'Day' && $_POST['destination__time'] == 'Minute') {
                $gettingvalue = $_POST['time_amount'] * 1440;
            }
            elseif ($_POST['source__time'] == 'Day' && $_POST['destination__time'] == 'Hour') {
                $gettingvalue = $_POST['time_amount'] * 24;
            }
           /*  elseif ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Day') {
                $gettingvalue = $_POST['time_amount'] * 1000;
            } */
            elseif ($_POST['source__time'] == 'Day' && $_POST['destination__time'] == 'Week') {
                $gettingvalue = $_POST['time_amount'] / 7;
            }
            elseif ($_POST['source__time'] == 'Day' && $_POST['destination__time'] == 'Month') {
                $gettingvalue = $_POST['time_amount'] / 30.417;
            }
            elseif ($_POST['source__time'] == 'Day' && $_POST['destination__time'] == 'Calendar year') {
                $gettingvalue = $_POST['time_amount'] / 365;
            }
            elseif ($_POST['source__time'] == 'Day' && $_POST['destination__time'] == 'Decade') {
                $gettingvalue = $_POST['time_amount'] / 3650;
            }
            elseif ($_POST['source__time'] == 'Day' && $_POST['destination__time'] == 'Century') {
                $gettingvalue = $_POST['time_amount'] / 36500;
            }

            /* End US Ton to Other */

            elseif ($_POST['source__time'] == 'Week' && $_POST['destination__time'] == 'Nanosecond') {
                $gettingvalue = $_POST['time_amount'] * 6.048e+14;
            }
            elseif ($_POST['source__time'] == 'Week' && $_POST['destination__time'] == 'Microsecond') {
                $gettingvalue = $_POST['time_amount'] * 6.048e+11;
            }
            elseif ($_POST['source__time'] == 'Week' && $_POST['destination__time'] == 'Millisecond') {
              $gettingvalue = $_POST['time_amount'] * 6.048e+8;
            }
            elseif ($_POST['source__time'] == 'Week' && $_POST['destination__time'] == 'Second') {
                $gettingvalue = $_POST['time_amount'] *  604800;
            }
            elseif ($_POST['source__time'] == 'Week' && $_POST['destination__time'] == 'Minute') {
                $gettingvalue = $_POST['time_amount'] * 10080;
            }
            elseif ($_POST['source__time'] == 'Week' && $_POST['destination__time'] == 'Hour') {
                $gettingvalue = $_POST['time_amount'] / 168;
            }
            elseif ($_POST['source__time'] == 'Week' && $_POST['destination__time'] == 'Day') {
                $gettingvalue = $_POST['time_amount'] / 7;
            }
 /*            elseif ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Week') {
                $gettingvalue = $_POST['time_amount'] * 1000;
            } */
            elseif ($_POST['source__time'] == 'Week' && $_POST['destination__time'] == 'Month') {
                $gettingvalue = $_POST['time_amount'] / 4.345;
            }
            elseif ($_POST['source__time'] == 'Week' && $_POST['destination__time'] == 'Calendar year') {
                $gettingvalue = $_POST['time_amount'] / 52.143;
            }
            elseif ($_POST['source__time'] == 'Week' && $_POST['destination__time'] == 'Decade') {
                $gettingvalue = $_POST['time_amount'] / 521;
            }
            elseif ($_POST['source__time'] == 'Week' && $_POST['destination__time'] == 'Century') {
                $gettingvalue = $_POST['time_amount'] / 5214;
            }

            /* End Stone to Other */
            
            elseif ($_POST['source__time'] == 'Month' && $_POST['destination__time'] == 'Nanosecond') {
                $gettingvalue = $_POST['time_amount'] * 2.628e+15;
            }
            elseif ($_POST['source__time'] == 'Month' && $_POST['destination__time'] == 'Microsecond') {
                $gettingvalue = $_POST['time_amount'] * 2.628e+12;
            }
            elseif ($_POST['source__time'] == 'Month' && $_POST['destination__time'] == 'Millisecond') {
              $gettingvalue = $_POST['time_amount'] * 2.628e+9;
            }
            elseif ($_POST['source__time'] == 'Month' && $_POST['destination__time'] == 'Second') {
                $gettingvalue = $_POST['time_amount'] * 2.628e+6;
            }
            elseif ($_POST['source__time'] == 'Month' && $_POST['destination__time'] == 'Minute') {
                $gettingvalue = $_POST['time_amount'] * 43800;
            }
            elseif ($_POST['source__time'] == 'Month' && $_POST['destination__time'] == 'Hour') {
                $gettingvalue = $_POST['time_amount'] * 730;
            }
            elseif ($_POST['source__time'] == 'Month' && $_POST['destination__time'] == 'Day') {
                $gettingvalue = $_POST['time_amount'] * 30.417;
            }
            elseif ($_POST['source__time'] == 'Month' && $_POST['destination__time'] == 'Week') {
                $gettingvalue = $_POST['time_amount'] * 4.345;
            }
         /*    elseif ($_POST['source__time'] == 'Nanosecond' && $_POST['destination__time'] == 'Month') {
                $gettingvalue = $_POST['time_amount'] * 1000;
            } */
            elseif ($_POST['source__time'] == 'Month' && $_POST['destination__time'] == 'Calendar year') {
                $gettingvalue = $_POST['time_amount'] / 12;
            }
            elseif ($_POST['source__time'] == 'Month' && $_POST['destination__time'] == 'Decade') {
                $gettingvalue = $_POST['time_amount'] / 120;
            }
            elseif ($_POST['source__time'] == 'Month' && $_POST['destination__time'] == 'Century') {
                $gettingvalue = $_POST['time_amount'] / 1200;
            }

            /* End Pound to Other */

            elseif ($_POST['source__time'] == 'Calendar year' && $_POST['destination__time'] == 'Nanosecond') {
                $gettingvalue = $_POST['time_amount'] * 3.154e+16;
         }
            elseif ($_POST['source__time'] == 'Calendar year' && $_POST['destination__time'] == 'Microsecond') {
                $gettingvalue = $_POST['time_amount'] * 3.154e+13;
            }
            elseif ($_POST['source__time'] == 'Calendar year' && $_POST['destination__time'] == 'Millisecond') {
              $gettingvalue = $_POST['time_amount'] * 3.154e+10;
            }
            elseif ($_POST['source__time'] == 'Calendar year' && $_POST['destination__time'] == 'Second') {
                $gettingvalue = $_POST['time_amount'] * 3.154e+7;
            }
            elseif ($_POST['source__time'] == 'Calendar year' && $_POST['destination__time'] == 'Minute') {
                $gettingvalue = $_POST['time_amount'] * 525600;
            }
            elseif ($_POST['source__time'] == 'Calendar year' && $_POST['destination__time'] == 'Hour') {
                $gettingvalue = $_POST['time_amount'] * 8760;
            }
            elseif ($_POST['source__time'] == 'Calendar year' && $_POST['destination__time'] == 'Day') {
                $gettingvalue = $_POST['time_amount'] * 365;
            }
            elseif ($_POST['source__time'] == 'Calendar year' && $_POST['destination__time'] == 'Week') {
                $gettingvalue = $_POST['time_amount'] * 52.143;
            }
            elseif ($_POST['source__time'] == 'Calendar year' && $_POST['destination__time'] == 'Month') {
                $gettingvalue = $_POST['time_amount'] * 12;
            }
            elseif ($_POST['source__time'] == 'Calendar year' && $_POST['destination__time'] == 'Decade') {
                $gettingvalue = $_POST['time_amount'] / 10;
            }
            elseif ($_POST['source__time'] == 'Calendar year' && $_POST['destination__time'] == 'Century') {
                $gettingvalue = $_POST['time_amount'] / 100;
            }

            /* End Calender Year to Other */

            elseif ($_POST['source__time'] == 'Decade' && $_POST['destination__time'] == 'Nanosecond') {
                $gettingvalue = $_POST['time_amount'] * 3.154e+17;
         }
            elseif ($_POST['source__time'] == 'Decade' && $_POST['destination__time'] == 'Microsecond') {
                $gettingvalue = $_POST['time_amount'] * 3.154e+14;
            }
            elseif ($_POST['source__time'] == 'Decade' && $_POST['destination__time'] == 'Millisecond') {
              $gettingvalue = $_POST['time_amount'] * 3.154e+11;
            }
            elseif ($_POST['source__time'] == 'Decade' && $_POST['destination__time'] == 'Second') {
                $gettingvalue = $_POST['time_amount'] * 3.154e+8;
            }
            elseif ($_POST['source__time'] == 'Decade' && $_POST['destination__time'] == 'Minute') {
                $gettingvalue = $_POST['time_amount'] * 5.256e+6;
            }
            elseif ($_POST['source__time'] == 'Decade' && $_POST['destination__time'] == 'Hour') {
                $gettingvalue = $_POST['time_amount'] * 87600;
            }
            elseif ($_POST['source__time'] == 'Decade' && $_POST['destination__time'] == 'Day') {
                $gettingvalue = $_POST['time_amount'] / 3650;
            }
            elseif ($_POST['source__time'] == 'Decade' && $_POST['destination__time'] == 'Week') {
                $gettingvalue = $_POST['time_amount'] * 521;
            }
            elseif ($_POST['source__time'] == 'Decade' && $_POST['destination__time'] == 'Month') {
                $gettingvalue = $_POST['time_amount'] * 120;
            }
            elseif ($_POST['source__time'] == 'Decade' && $_POST['destination__time'] == 'Calendar year') {
                $gettingvalue = $_POST['time_amount'] * 10;
            }
            elseif ($_POST['source__time'] == 'Decade' && $_POST['destination__time'] == 'Century') {
                $gettingvalue = $_POST['time_amount'] / 10;
            }

            /* End Decade to Others */

            elseif ($_POST['source__time'] == 'Century' && $_POST['destination__time'] == 'Nanosecond') {
                $gettingvalue = $_POST['time_amount'] * 3.154e+18;
         }
            elseif ($_POST['source__time'] == 'Century' && $_POST['destination__time'] == 'Microsecond') {
                $gettingvalue = $_POST['time_amount'] * 3.154e+15;
            }
            elseif ($_POST['source__time'] == 'Century' && $_POST['destination__time'] == 'Millisecond') {
              $gettingvalue = $_POST['time_amount'] * 3.154e+12;
            }
            elseif ($_POST['source__time'] == 'Century' && $_POST['destination__time'] == 'Second') {
                $gettingvalue = $_POST['time_amount'] * 3.154e+9;
            }
            elseif ($_POST['source__time'] == 'Century' && $_POST['destination__time'] == 'Minute') {
                $gettingvalue = $_POST['time_amount'] * 5.256e+7;
            }
            elseif ($_POST['source__time'] == 'Century' && $_POST['destination__time'] == 'Hour') {
                $gettingvalue = $_POST['time_amount'] * 876000;
            }
            elseif ($_POST['source__time'] == 'Century' && $_POST['destination__time'] == 'Day') {
                $gettingvalue = $_POST['time_amount'] * 36500;
            }
            elseif ($_POST['source__time'] == 'Century' && $_POST['destination__time'] == 'Week') {
                $gettingvalue = $_POST['time_amount'] * 5214;
            }
            elseif ($_POST['source__time'] == 'Century' && $_POST['destination__time'] == 'Month') {
                $gettingvalue = $_POST['time_amount'] * 1200;
            }
            elseif ($_POST['source__time'] == 'Century' && $_POST['destination__time'] == 'Calendar year') {
                $gettingvalue = $_POST['time_amount'] * 100;
            }
            elseif ($_POST['source__time'] == 'Century' && $_POST['destination__time'] == 'Decade') {
                $gettingvalue = $_POST['time_amount'] * 10;
            }


            else  {
                $gettingvalue = 0;
              }

         /* End Ounch to Other */
        }
        ?>
        <hr />
        <div class="">
            <label for="time_amount">Total Time Result :</label>

            <input type="text" class="form-group" disabled value="<?php echo $gettingvalue ? $_POST['source__time'] .' to '. $_POST['destination__time'] .' Result is : '. $gettingvalue .' '. $_POST['destination__time']  : 'Not Measured Yet'; ?>">
        </div>
    </form>

</div>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>