<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Check out
 *
 * Created by ShineTheme
 *
 */
?>
	<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'travel_order' ) ?>">
    <?php echo st()->load_template('hotel/booking_form',false,array(
        'field_coupon'=>false
    )); ?>
    <?php if(defined('ICL_LANGUAGE_CODE') and ICL_LANGUAGE_CODE ): ?>
        <input type="hidden" name="lang" value="<?php echo esc_attr(ICL_LANGUAGE_CODE) ?>">
    <?php endif;?>

    <?php do_action('st_booking_form_field')?>
	<div class="payment_gateways">
		<?php
		if(!isset($post_id)) $post_id = false;
		STPaymentGateways::get_payment_gateways_html($post_id) ?>
	</div>


	<div class="clearfix">
		<div class="row">
			<div class="col-sm-6">
				<?php if(st()->get_option('booking_enable_captcha','on')=='on'){
					$code=STCoolCaptcha::get_code();
					?>
					<div class="form-group captcha_box" >
						<label for="field-hotel-captcha"><?php st_the_language('captcha')?></label>
						<img src="<?php echo STCoolCaptcha::get_captcha_url($code) ?>" align="captcha code" class="captcha_img">
						<input id="field-hotel-captcha" type="text" name="<?php echo esc_attr($code) ?>" value="" class="form-control">
						<input type="hidden" name="st_security_key" value="<?php echo esc_attr($code) ?>">
					</div>
				<?php }?>
			</div>
		</div>
	</div>


	<?php if(st()->get_option('st_booking_hide_create_account')=='off'): ?>
    <div class="checkbox st_check_create_account">
        <label>
            <input class="i-check" value="1" name="create_account" type="checkbox" <?php if(empty($_POST) or STInput::post('create_account')==1) echo 'checked'; ?>/><?php printf(__('Create %s account ',ST_TEXTDOMAIN),get_bloginfo('title')) ?> <small><?php st_the_language('password_will_be_send_to_your_email')?></small>
        </label>
    </div>
	<?php endif;?>
    <div class="checkbox st_check_term_conditions">
        <label>
            <input class="i-check" value="1" name="term_condition" type="checkbox" <?php if(STInput::post('term_condition')==1) echo 'checked'; ?>/><?php echo  st_get_language('i_have_read_and_accept_the').'<a target="_blank" href="'.get_the_permalink(st()->get_option('page_terms_conditions')).'"> '.st_get_language('terms_and_conditions').'</a>';?>
        </label>
    </div>

<div class="alert form_alert hidden"></div>
<a href="#" onclick="return false" class="btn btn-primary btn-st-checkout-submit btn-st-big "><?php _e('Submit',ST_TEXTDOMAIN) ?> <i class="fa fa-spinner fa-spin"></i></a>

