<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Tours modal booking
 *
 * Created by ShineTheme
 *
 */
//Logged in User Info
global $firstname , $user_email;
get_currentuserinfo();
?>
<h3><?php printf(st_get_language('tour_you_are_booking_for_d'),get_the_title())?></h3>

<form id="booking_modal_<?php echo get_the_ID() ?>" class="booking_modal_form" action="" method="post" onsubmit="return false">
    <div>
        <?php echo st()->load_template('check_out/check_out',null,array('post_id'=>get_the_ID()))?>
    </div>
</form>