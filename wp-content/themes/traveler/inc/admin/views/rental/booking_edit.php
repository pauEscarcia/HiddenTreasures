<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Admin rental booking edit
 *
 * Created by ShineTheme
 *
 */

$item_id = isset($_GET['order_item_id']) ? $_GET['order_item_id']:false;

$order_item_id = get_post_meta($item_id,'item_id',true);

$section = isset($_GET['section']) ? $_GET['section'] : false;

if(!isset($page_title))
{
    $page_title=__('Edit Rental Booking',ST_TEXTDOMAIN);
}
$currency = get_post_meta($item_id, 'currency', true);
$rate = floatval(get_post_meta($item_id,'currency_rate', true));
?>
<div class="wrap">
    <?php echo '<h2>'.$page_title.'<a href="'.admin_url('edit.php?post_type=st_rental&page=strental_booking&section=add_booking').'" class="add-new-h2">'.__('Add New',ST_TEXTDOMAIN).'</a></h2>';?>
    <?php STAdmin::message() ?>
    <div id="post-body" class="columns-2">
        <div id="post-body-content">
            <div class="postbox-container">
                <form method="post" action="" id="form-booking-admin">
                    <?php wp_nonce_field('shb_action','shb_field') ?>
                    <div id="poststuff">
                        <div class="postbox">
                            <div class="handlediv" title="<?php _e('Click to toggle',ST_TEXTDOMAIN)?>"><br></div>
                            <h3 class="hndle ui-sortable-handle"><span><?php _e('Order Information',ST_TEXTDOMAIN)?></span></h3>

                            <div class="inside">
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e('Customer ID',ST_TEXTDOMAIN)?></label>
                                    <div class="controls">
                                        <?php
                                        $id_user='';
                                        $pl_name='';
                                        if($item_id){
                                            $id_user = get_post_meta($item_id,'id_user',true);

                                            if($id_user){
                                                $user = get_userdata($id_user);
                                                if($user){
                                                    $pl_name = $user->ID.' - '.$user->user_email;
                                                }
                                            }
                                        }else{
                                            $id_user = get_current_user_id();
                                            if($id_user){
                                                $user = get_userdata($id_user);
                                                if($user){
                                                    $pl_name = $user->ID.' - '.$user->user_email;
                                                }
                                            }
                                        }
                                        ?>
                                        <input readonly type="text" name="id_user" value="<?php echo esc_attr($pl_name); ?>" class="form-control form-control-admin">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e('Customer First Name',ST_TEXTDOMAIN)?><span class="require"> (*)</span></label>
                                    <div class="controls">
                                    <?php 
                                        $st_first_name = isset($_POST['st_first_name']) ? $_POST['st_first_name'] : get_post_meta($item_id,'st_first_name',true);
                                    ?>
                                        <input type="text" name="st_first_name" value="<?php echo $st_first_name; ?>" class="form-control form-control-admin">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e('Customer Last Name',ST_TEXTDOMAIN)?><span class="require"> (*)</span></label>
                                    <div class="controls">
                                    <?php 
                                        $st_last_name = isset($_POST['st_last_name']) ? $_POST['st_last_name'] : get_post_meta($item_id,'st_last_name',true);
                                    ?>
                                        <input type="text" name="st_last_name" value="<?php echo $st_last_name; ?>" class="form-control form-control-admin">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e('Customer Email',ST_TEXTDOMAIN)?><span class="require"> (*)</span></label>
                                    <div class="controls">
                                    <?php 
                                        $st_email = isset($_POST['st_email']) ? $_POST['st_email'] : get_post_meta($item_id,'st_email',true);
                                    ?>
                                        <input type="text" name="st_email" value="<?php echo $st_email; ?>" class="form-control form-control-admin">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e('Customer Phone',ST_TEXTDOMAIN)?><span class="require"> (*)</span></label>
                                    <div class="controls">
                                    <?php 
                                        $st_phone = isset($_POST['st_phone']) ? $_POST['st_phone'] : get_post_meta($item_id,'st_phone',true);
                                    ?>
                                        <input type="text" name="st_phone" value="<?php echo $st_phone; ?>" class="form-control form-control-admin">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e('Customer Address line 1',ST_TEXTDOMAIN)?></label>
                                    <div class="controls">
                                    <?php 
                                        $st_address = isset($_POST['st_address']) ? $_POST['st_address'] : get_post_meta($item_id,'st_address',true);
                                    ?>
                                        <input type="text" name="st_address" value="<?php echo $st_address; ?>" class="form-control form-control-admin">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e('Customer Address line 2',ST_TEXTDOMAIN)?></label>
                                    <div class="controls">
                                    <?php 
                                        $st_address2 = isset($_POST['st_address2']) ? $_POST['st_address2'] : get_post_meta($item_id,'st_address2',true);
                                    ?>
                                        <input type="text" name="st_address2" value="<?php echo $st_address2; ?>" class="form-control form-control-admin">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e('Customer City',ST_TEXTDOMAIN)?></label>
                                    <div class="controls">
                                    <?php 
                                        $st_city = isset($_POST['st_city']) ? $_POST['st_city'] : get_post_meta($item_id,'st_city',true);
                                    ?>
                                        <input type="text" name="st_city" value="<?php echo $st_city; ?>" class="form-control form-control-admin">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e('State/Province/Region',ST_TEXTDOMAIN)?></label>
                                    <div class="controls">
                                    <?php 
                                        $st_province = isset($_POST['st_province']) ? $_POST['st_province'] : get_post_meta($item_id,'st_province',true);
                                    ?>
                                        <input type="text" name="st_province" value="<?php echo $st_province; ?>" class="form-control form-control-admin">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e('ZIP code/Postal code',ST_TEXTDOMAIN)?></label>
                                    <div class="controls">
                                    <?php 
                                        $st_zip_code = isset($_POST['st_zip_code']) ? $_POST['st_zip_code'] : get_post_meta($item_id,'st_zip_code',true);
                                    ?>
                                        <input type="text" name="st_zip_code" value="<?php echo $st_zip_code; ?>" class="form-control form-control-admin">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e('Country',ST_TEXTDOMAIN)?></label>
                                    <div class="controls">
                                    <?php 
                                        $st_country = isset($_POST['st_country']) ? $_POST['st_country'] : get_post_meta($item_id,'st_country',true);
                                    ?>
                                        <input type="text" name="st_country" value="<?php echo $st_country; ?>" class="form-control form-control-admin">
                                    </div>
                                </div>


                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e('Rental',ST_TEXTDOMAIN)?><span class="require"> (*)</span></label>
                                    <div class="controls">
                                    <?php 

                                        $rental_id = intval(get_post_meta($item_id,'item_id',true));
                                        if(get_post_type($rental_id) == 'st_rental' && $section == 'edit_order_item'):
                                    ?>
                                        <select name="item_id" id="item_id" class="form-control form-control-admin">
                                            <option value="<?php echo $rental_id ?>"><?php echo get_the_title($rental_id); ?></option>
                                        </select>
                                    <?php endif; ?>
                                    <?php 
                                        $rental_id = isset($_POST['item_id']) ? intval($_POST['item_id']) : '';
                                        $hotel_name = (get_post_type($rental_id) == 'st_rental') ? get_the_title($rental_id) : '';
                                        if($section == 'add_booking'):
                                    ?>
                                        <input id="item_id" type="hidden" name="item_id" value="<?php echo $rental_id; ?>" data-post-type="st_rental" class="form-control form-control-admin st_post_select_ajax " data-pl-name="<?php echo $hotel_name; ?>">
                                    <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e('Price',ST_TEXTDOMAIN)?></label>
                                    <div class="controls">
                                    <?php 
                                        $item_price = floatval(get_post_meta($item_id,'item_price',true));

                                        if($section == 'edit_order_item'):
                                    ?>
                                        <input readonly class="form-control form-control-admin" type="text" name="item_price" id="item_price" value="<?php echo TravelHelper::format_money_from_db($item_price, $currency, $rate); ?>">
                                    <?php else:
                                        $item_price = isset($_POST['item_price']) ? $_POST['item_price'] : TravelHelper::format_money(0);
                                    ?>
                                        <input id="item_price" readonly type="text" name="item_price" value="<?php echo $item_price; ?>" class="form-control form-control-admin">
                                        <span class="spinner item_price"></span>
                                    <?php endif; ?>   
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e('No. Adults',ST_TEXTDOMAIN)?><span class="require"> (*)</span></label>
                                    <div class="controls">
                                    <?php 
                                        $adult_number = isset($_POST['adult_number']) ? $_POST['adult_number'] : get_post_meta($item_id,'adult_number',true);
                                    ?>
                                        <input type="text" name="adult_number" value="<?php echo $adult_number; ?>" class="form-control form-control-admin  " >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e('No. Children',ST_TEXTDOMAIN)?><span class="require"> (*)</span></label>
                                    <div class="controls">
                                    <?php 
                                        $child_number = isset($_POST['child_number']) ? $_POST['child_number'] : get_post_meta($item_id,'child_number',true);
                                    ?>
                                        <input type="text" name="child_number" value="<?php echo $child_number; ?>"  class="form-control form-control-admin " >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for="check_in"><?php _e('Check in',ST_TEXTDOMAIN)?><span class="require"> (*)</span></label>
                                    <div class="controls">
                                    <?php 
                                        $check_in = isset($_POST['check_in']) ? $_POST['check_in'] : get_post_meta($item_id,'check_in',true);
                                        if(!empty($check_in)){
                                            $check_in = date('m/d/Y',strtotime($check_in));
                                        }
                                    ?>
                                        <input readonly id="check_in" placeholder="mm/dd/yyyy" type="text" name="check_in" value="<?php echo $check_in; ?>" class="form-control form-control-admin st_datepicker ">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for="check_out"><?php _e('Check out',ST_TEXTDOMAIN)?><span class="require"> (*)</span></label>
                                    <div class="controls">
                                    <?php 
                                        $check_out = isset($_POST['check_out']) ? $_POST['check_out'] : get_post_meta($item_id,'check_out',true);
                                        if(!empty($check_out)){
                                            $check_out = date('m/d/Y',strtotime($check_out));
                                        }
                                    ?>
                                        <input readonly id="check_out" placeholder="mm/dd/yyyy" type="text" name="check_out" value="<?php echo  $check_out; ?>" class="form-control form-control-admin st_datepicker">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for="extra"><?php _e('Extra',ST_TEXTDOMAIN)?></label>
                                    <div class="controls">
                                        <?php 
                                            if($section == 'edit_order_item' && get_post_type($order_item_id) == 'st_rental'):
                                                $extra_price = get_post_meta($order_item_id, 'extra_price', true);
                                                $extras = get_post_meta($item_id, 'extras', true);
                                                $data_item = array(); $data_number = array();
                                                if(isset($extras['value']) && is_array($extras['value']) && count($extras['value'])){
                                                    foreach($extras['value'] as $name => $number){
                                                        $data_item[] = $name;
                                                        $data_number[$name] = $extras['value'][$name]; 
                                                    }
                                                }
                                        ?>
                                            <?php if(is_array($extra_price) && count($extra_price)): ?>
                                            <table class="table">
                                                <?php foreach($extra_price as $key => $val): ?>
                                                <tr>
                                                    <td width="80%">
                                                        <label for="<?php echo $val['extra_name']; ?>" class="ml20">
                                                        <input id="<?php echo $val['extra_name']; ?>" type="checkbox" class="i-check" name="extra_price[name][]" value="<?php echo $val['extra_name']; ?>" <?php if(in_array($val['extra_name'], $data_item)) echo 'checked="checked"'; ?>><?php echo $val['title'].'('.TravelHelper::format_money_from_db($val['extra_price'], $currency, $rate).')'; ?></label>
                                                        <input type="hidden" name="extra_price[price][<?php echo $val['extra_name']; ?>]" value="<?php echo $val['extra_price']; ?>">
                                                        <input type="hidden" name="extra_price[title][<?php echo $val['extra_name']; ?>]" value="<?php echo $val['title']; ?>">
                                                    </td>
                                                    <td width="20%">
                                                        <select style="width: 100px" class="form-control" name="extra_price[value][<?php echo $val['extra_name']; ?>]" id="">
                                                        <?php 
                                                            $max_item = intval($val['extra_max_number']);
                                                            if($max_item <= 0) $max_item = 1;
                                                            for($i = 0; $i <= $max_item; $i++):
                                                        ?>
                                                            <option value="<?php echo $i; ?>" <?php if(isset($data_number[$val['extra_name']]) && $i == $data_number[$val['extra_name']]) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </table>
                                            <?php endif; ?>
                                        <?php endif;?>
                                       <div id="extra-price-wrapper">
                                           
                                       </div> 
                                       <span class="spinner extra_price"></span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e('Total',ST_TEXTDOMAIN)?></label>
                                    <div class="controls">
                                    <?php 
                                        $total_price = floatval(get_post_meta($item_id, 'total_price', true));
                                        
                                    ?>
                                        <input name="total_price" type="text" readonly value="<?php echo TravelHelper::format_money_from_db($total_price, $currency, $rate); ?>" class="form-control form-control-admin ">
                                        <br /> <span><em><?php echo __('Auto Calculate when saving', ST_TEXTDOMAIN); ?></em></span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for="st_note"><?php _e('Special Requirements',ST_TEXTDOMAIN)?></label>
                                    <div class="controls">
                                    <?php 
                                        $st_note = isset($_POST['st_note']) ? $_POST['st_note'] : get_post_meta($item_id,'st_note',true);
                                    ?>
                                        <textarea name="st_note" rows="6" class="form-control-admin"><?php echo $st_note; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for="status"><?php _e('Status',ST_TEXTDOMAIN)?></label>
                                    <div class="controls">
                                        <select data-block="" class="form-control" name="status">
                                            <?php $status=get_post_meta($item_id,'status',true); ?>

                                            <option value="pending" <?php selected($status,'pending') ?> ><?php _e('Pending',ST_TEXTDOMAIN)?></option>
                                            <option value="complete" <?php selected($status,'complete') ?> ><?php _e('Complete',ST_TEXTDOMAIN)?></option>
                                            <option value="canceled" <?php selected($status,'canceled') ?> ><?php _e('Canceled',ST_TEXTDOMAIN)?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="controls">
                                        <label class="form-label" for="" >&nbsp;</label>
                                        <input type="submit" name="submit" value="<?php echo __('Save',ST_TEXTDOMAIN)?>" class="button button-primary ">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>