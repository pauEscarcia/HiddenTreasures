<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * hotel payment item row
 *
 * Created by ShineTheme
 *
 */
$order_token_code = STInput::get('order_token_code');

if($order_token_code){
    $order_code = STOrder::get_order_id_by_token($order_token_code);
}

$hotel_id = $key;

$object_id = $key;
$total = 0;

$room_id = $data['data']['room_id']; 

$check_in = $data['data']['check_in'];

$check_out = $data['data']['check_out'];

$number_room = intval($data['number']);

$price = floatval(get_post_meta($room_id, 'price', true));

$hotel_link='';
if(isset($hotel_id) and $hotel_id){
    $hotel_link = get_permalink($hotel_id);
}
?>
<tr>
    <td><?php echo esc_html($i) ?></td>
    <td>
        <a href="<?php echo esc_url($hotel_link)?>" target="_blank">

        <?php echo get_the_post_thumbnail($key,array(360,270,'bfi_thumb'=>true),array('style'=>'max-width:100%;height:auto'))?>
        </a>
    </td>
    <td>
        <?php if(isset($hotel_id) and $hotel_id):?>
            <p style="margin-top:10px;"><strong> <?php st_the_language('hotel') ?>:</strong> <a href="<?php echo esc_url($hotel_link)?>" target="_blank"><?php echo strtoupper( get_the_title($hotel_id))?> </a></p>
            <p><strong><?php st_the_language('booking_address') ?></strong> <?php echo get_post_meta($hotel_id,'address',true)?> </p>
            <p><strong><?php st_the_language('booking_email') ?></strong> <?php echo get_post_meta($hotel_id,'email',true)?> </p>
            <p><strong><?php st_the_language('booking_phone') ?></strong> <?php echo get_post_meta($hotel_id,'phone',true)?> </p>

        <?php endif;?>

        <p><strong><?php st_the_language('booking_room') ?></strong> <?php  echo get_the_title($room_id)?></p>
        <p><strong><?php _e('Number of rooms',ST_TEXTDOMAIN) ?></strong> <?php echo esc_html($number_room)?></p>
        <p><strong><?php st_the_language('booking_price') ?></strong> <?php
            echo TravelHelper::format_money($price);
            ?></p>
        <p><strong><?php st_the_language('booking_check_in') ?></strong> <?php echo date(TravelHelper::getDateFormat(), strtotime($check_in)); ?></p>
        <p><strong><?php st_the_language('booking_check_out') ?></strong> <?php echo date(TravelHelper::getDateFormat(), strtotime($check_out)); ?></p>
        <?php 
            $extras = get_post_meta($order_code, 'extras', true); 
            if(isset($extras['value']) && is_array($extras['value']) && count($extras['value'])):
        ?>
        <p>
            <strong><?php echo __('Extra:' , ST_TEXTDOMAIN) ;  ?></strong>
        </p>
        <p>    
        <?php        
            foreach($extras['value'] as $name => $number):
                $price_item = floatval($extras['price'][$name]);
                if($price_item <= 0) $price_item = 0;
                $number_item = intval($extras['value'][$name]);
                if($number_item <= 0) $number_item = 0;
                if($number_item > 0){
        ?>
            <span>
                <?php echo $extras['title'][$name].' ('.TravelHelper::format_money($price_item).') x '.$number_item.' '.__('Item(s)', ST_TEXTDOMAIN); ?>
            </span> <br />
            
        <?php } endforeach; ?>
        </p>
        <?php endif; ?>
        
    </td>
</tr>