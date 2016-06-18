<?php 
/**
*@since 1.1.9
**/
/*   Shortcode for customer infomation */
if(!function_exists( 'st_email_booking_booker_name' )) {
    function st_email_booking_booker_name(){
        global $order_id;
        if($order_id){
            $booker_id = intval(get_post_meta($order_id,'id_user',true));
            $user_info = get_userdata($booker_id);
            if($user_info){
                return $user_info->first_name. ' '.$user_info->last_name;
            }else{
                return __('Admin', ST_TEXTDOMAIN);
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_booker_name' , 'st_email_booking_booker_name' );

if(!function_exists( 'st_email_booking_first_name' )) {
    function st_email_booking_first_name(){
        global $order_id;
        if($order_id){
            $first_name = get_post_meta($order_id,'st_first_name',true);
            return $first_name;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_first_name' , 'st_email_booking_first_name' );

if(!function_exists( 'st_email_booking_last_name' )) {
    function st_email_booking_last_name(){
        global $order_id;
        if($order_id){
            $last_name = get_post_meta($order_id,'st_last_name',true);

            return $last_name;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_last_name' , 'st_email_booking_last_name' );

if(!function_exists( 'st_email_booking_email' )) {
    function st_email_booking_email(){
        global $order_id;
        if($order_id){
            return get_post_meta($order_id,'st_email',true);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_email' , 'st_email_booking_email' );

if(!function_exists( 'st_email_booking_phone' )) {
    function st_email_booking_phone(){
        global $order_id;
        if($order_id){
            return get_post_meta($order_id,'st_phone',true);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_phone' , 'st_email_booking_phone' );

if(!function_exists( 'st_email_booking_address' )) {
    function st_email_booking_address(){
        global $order_id;
        if($order_id){
            return get_post_meta($order_id,'st_address',true);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_address' , 'st_email_booking_address' );

if(!function_exists( 'st_email_booking_city' )) {
    function st_email_booking_city(){
        global $order_id;
        if($order_id){
            return get_post_meta($order_id,'st_city',true);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_city' , 'st_email_booking_city' );

if(!function_exists( 'st_email_booking_province' )) {
    function st_email_booking_province(){
        global $order_id;
        if($order_id){
            return get_post_meta($order_id,'st_province',true);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_province' , 'st_email_booking_province' );

if(!function_exists( 'st_email_booking_zip_code' )) {
    function st_email_booking_zip_code(){
        global $order_id;
        if($order_id){
            return get_post_meta($order_id,'st_zip_code',true);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_zip_code' , 'st_email_booking_zip_code' );

if(!function_exists( 'st_email_booking_country' )) {
    function st_email_booking_country(){
        global $order_id;
        if($order_id){
            return get_post_meta($order_id,'st_country',true);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_country' , 'st_email_booking_country' );

/*  .End Shortcode for customer infomation */
if(!function_exists( 'st_email_booking_thumbnail' )) {
    function st_email_booking_thumbnail(){
        global $order_id;
        if($order_id){
            $item_id = get_post_meta($order_id, 'item_id', true);
            $image = wp_get_attachment_url(get_post_thumbnail_id($item_id));
            if($image){
                return '<a href="'.get_the_permalink($item_id).'" target="_blank"><img src="'.$image.'" style="display : block; width: 100%; height: auto; max-width: 100%;"></a>';
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_thumbnail' , 'st_email_booking_thumbnail' );

if(!function_exists( 'st_email_booking_id' )) {
    function st_email_booking_id(){
        global $order_id;
        if($order_id){
            return $order_id;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_id' , 'st_email_booking_id' );

if(!function_exists( 'st_email_booking_date' )) {
    function st_email_booking_date(){
        global $order_id;
        if($order_id){
            return get_the_time(TravelHelper::getDateFormat(),$order_id);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_date' , 'st_email_booking_date' );

if(!function_exists( 'st_email_booking_note' )) {
    function st_email_booking_note(){
        global $order_id;
        if($order_id){
            return get_post_meta($order_id, 'st_note', true);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_note' , 'st_email_booking_note' );

if(!function_exists( 'st_email_booking_payment_method' )) {
    function st_email_booking_payment_method(){
        global $order_id;
        if($order_id){
            return STPaymentGateways::get_gatewayname(get_post_meta($order_id,'payment_method',true));
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_payment_method' , 'st_email_booking_payment_method' );

if(!function_exists( 'st_email_booking_item_name' )) {
    function st_email_booking_item_name(){
        global $order_id;
        if($order_id){
            $item_id = get_post_meta($order_id,'item_id',true);
            return get_the_title($item_id);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_item_name' , 'st_email_booking_item_name' );

if(!function_exists( 'st_email_booking_item_link' )) {
    function st_email_booking_item_link(){
        global $order_id;
        if($order_id){
            $item_id = get_post_meta($order_id,'item_id',true);
            return '<a href="'.get_the_permalink($item_id).'" title="">'.get_the_title($item_id).'</a>';
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_item_link' , 'st_email_booking_item_link' );

if(!function_exists( 'st_email_booking_number_item' )) {
    function st_email_booking_number_item($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts(array(
                'title' => __('Number of Item', ST_TEXTDOMAIN),
            ), $atts);
            $post_id = trim(get_post_meta($order_id, 'item_id', true));
            $post_type = get_post_type($post_id );
            $number = intval(get_post_meta($order_id, 'item_number', true));
            if($post_type && $post_type == 'st_hotel'){
                $html = '
                <table width="100%">
                    <tr>
                        <td style="padding-left: 10px; border-bottom: 1px dashed #CCC;">'.$data['title'].'</td>
                        <td style="text-align: right; border-bottom: 1px dashed #CCC; padding-right: 10px;">'.$number.' item(s)</td>
                    </tr>
                </table>
                ';
                return $html;
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_number_item' , 'st_email_booking_number_item' );
if(!function_exists('st_email_booking_posttype')){
    function st_email_booking_posttype(){
        global $order_id;
        if($order_id){
            $post_id = trim(get_post_meta($order_id, 'item_id', true));
            $post_type = get_post_type($post_id );
            $name = '';
            switch ($post_type) {
                case 'st_hotel':
                    $name = __('Hotel', ST_TEXTDOMAIN);
                    break;
                case 'st_rental':
                    $name = __('Rental', ST_TEXTDOMAIN);
                    break;
                case 'st_cars':
                    $name = __('Car', ST_TEXTDOMAIN);
                    break;  
                case 'st_tours':
                    $name = __('Tour', ST_TEXTDOMAIN);
                    break;
                case 'st_activity':
                    $name = __('Activity', ST_TEXTDOMAIN);
                    break;         
                default:
                    $name = '';
                    break;
            }
            return $name;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_posttype' , 'st_email_booking_posttype' );
if(!function_exists( 'st_email_booking_check_in' )) {
    function st_email_booking_check_in(){
        global $order_id;
        if($order_id){
            return date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_in',true)));
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_check_in' , 'st_email_booking_check_in' );

if(!function_exists( 'st_email_booking_check_out' )) {
    function st_email_booking_check_out(){
        global $order_id;
        if($order_id){
            
            return date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_out',true)));
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_check_out' , 'st_email_booking_check_out' );

if(!function_exists( 'st_email_booking_check_in_out_time' )) {
    function st_email_booking_check_in_out_time($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts(array(
                'title' => __('Time', ST_TEXTDOMAIN),
            ), $atts);
            $post_id = trim(get_post_meta($order_id, 'item_id', true));
            $post_type = get_post_type($post_id );
            $check_in_time = get_post_meta($order_id, 'check_in_timestamp', true);
            $check_out_time = get_post_meta($order_id, 'check_out_timestamp', true);
            $number = intval(get_post_meta($order_id, 'item_number'));
            if($post_type && $post_type == 'st_cars' && $check_in_time && $check_out_time){
                $html = '
                <table width="100%">
                    <tr>
                        <td style="padding-left: 10px; border-bottom: 1px dashed #CCC;">'.$data['title'].'</td>
                        <td style="text-align: right; border-bottom: 1px dashed #CCC; padding-right: 10px;"><strong>'.date('H:i:s A',$check_in_time).' - '.date('H:i:s A',$check_out_time).'</strong></td>
                    </tr>
                </table>
                ';
                return $html;
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_check_in_out_time' , 'st_email_booking_check_in_out_time' );
// pickup 
// drop off
// driver
if (!function_exists('st_email_pick_up_from')){
    function st_email_pick_up_from($atts=array()){
        global $order_id;
        if (!$order_id) return "";        
        $post_type = get_post_meta($order_id , 'st_booking_post_type' ,true);
        if ($post_type =='st_cars'){
            $pick_up = get_post_meta($order_id , 'pick_up' , true); 
            return $pick_up;
        }
    }
}
st_reg_shortcode ( 'st_email_pick_up_from', 'st_email_pick_up_from');

if (!function_exists('st_email_drop_off_to')){
    function st_email_drop_off_to($atts=array()){
        global $order_id;
        if (!$order_id) return "";        
        $post_type = get_post_meta($order_id , 'st_booking_post_type' ,true);
        if ($post_type =='st_cars'){
            $drop_off = get_post_meta($order_id , 'drop_off' , true); 
            return $drop_off;
        }
    }
}
st_reg_shortcode ( 'st_email_drop_off_to', 'st_email_drop_off_to');

if (!function_exists('st_email_car_driver')){
    function st_email_car_driver($atts=array()){
        global $order_id;
        if (!$order_id) return "";        
        $post_type = get_post_meta($order_id , 'st_booking_post_type' ,true);
        if ($post_type =='st_cars'){
            $driver_name = get_post_meta($order_id , 'driver_name' , true );
            $driver_age = get_post_meta($order_id , 'driver_age' , true );
            $return =  __("Driver name" , ST_TEXTDOMAIN).": ".$driver_name."<br/>";
            $return .=  __("Driver age" , ST_TEXTDOMAIN).": ".$driver_age;
            return $return ; 
        }
    }
}
st_reg_shortcode ( 'st_email_car_driver', 'st_email_car_driver');


if (!function_exists('st_check_in_out_title')) {
    function st_check_in_out_title($atts = array()){
        global $order_id;
        if (!$order_id) return "";        
        $post_id = trim(get_post_meta($order_id, 'item_id', true));
        $post_type = get_post_type($post_id );
        if ($post_type == 'st_hotel' or $post_type == 'st_rental') return __("Check in - out: " , ST_TEXTDOMAIN);
        if ($post_type == 'st_cars') return __("Pick-up from - Drop-off to: " , ST_TEXTDOMAIN) ; 
        if ($post_type == 'st_tours') {
            $tour_type = get_post_meta($order_id , 'type_tour',  true);
            if (!empty($tour_type) and $tour_type == 'daily_tour') {
                return __("Depature date: " , ST_TEXTDOMAIN);
            }
            return __("Depature date - Arrive date: " , ST_TEXTDOMAIN);
            
        }
        if($post_type == 'st_activity'){
            $activity_type = get_post_meta($order_id , 'type_activity',  true);
            if (!empty($activity_type) and $activity_type == 'daily_activity') {
                return __("From: " , ST_TEXTDOMAIN);
            }
            return __("From - To: " , ST_TEXTDOMAIN);
        }
    }
}
st_reg_shortcode( 'st_check_in_out_title' , 'st_check_in_out_title' );
if (!function_exists('st_check_in_out_value')) {
    function st_check_in_out_value(){
        global $order_id;
        if (!$order_id) return "";
        $post_id = trim(get_post_meta($order_id, 'item_id', true));
        $post_type = get_post_type($post_id );
        $return = "";
        if($order_id){ 
            if($post_type == 'st_tours'){
                $tour_type = get_post_meta($order_id, 'type_tour', true);
                $duration_unit = get_post_meta($post_id, 'duration_unit', true);
                if($tour_type == 'daily_tour'){
                    $return.= date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_in',true)));
                    $return.="<br/>";
                    $return.=__("Duration: " , ST_TEXTDOMAIN) .get_post_meta($order_id , 'duration' , true).' '.$duration_unit.'(s)';
                }else{
                    
                    $return.= date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_in',true)));
                    $return.= " - ";
                    $return.= date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_out',true)));
                }
            }
            if($post_type == 'st_activity'){
                $activity_type = get_post_meta($order_id, 'type_activity', true);
                if($activity_type == 'daily_activity'){
                    $return.= date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_in',true)));
                    $return.="<br/>";
                    $return.=__("Duration: " , ST_TEXTDOMAIN) .get_post_meta($order_id , 'duration' , true);
                }
            }
            if ($post_type =='st_hotel' or $post_type =='st_rental' or $post_type =='st_cars'){    
                $day = '';
                $check_in = get_post_meta($order_id,'check_in',true);
                $check_out = get_post_meta($order_id,'check_out',true);

                $diff = TravelHelper::dateDiff($check_in, $check_out);
                $day .= ($diff >= 2)? ' ('.$diff.' '.__("days", ST_TEXTDOMAIN).')' : '('.$diff.' '.__("day", ST_TEXTDOMAIN).')';
                
                $return.= date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_in',true)))." ".get_post_meta($order_id,'check_in_time',true); 
                $return.= " - ";
                $return.= date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_out',true)))." ".get_post_meta($order_id,'check_in_time',true).$day;

            }
        } 
        return $return ; 
        
    }
}
st_reg_shortcode('st_check_in_out_value', 'st_check_in_out_value'); 
if(!function_exists( 'st_email_booking_item_price' )) {
    function st_email_booking_item_price($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts(array(
                'title' => __('Item Price', ST_TEXTDOMAIN),
            ), $atts);

            $post_id = trim(get_post_meta($order_id, 'item_id', true));
            $post_type = get_post_type($post_id );

            if($post_type && ($post_type != 'st_tours' && $post_type != 'st_activity')){
                $currency = get_post_meta($order_id, 'currency', true);
                $rate = floatval(get_post_meta($order_id,'currency_rate', true));
                $item_price = floatval(get_post_meta($order_id,'item_price',true));
                $html = '
                <table width="100%">
                    <tr>
                        <td style="padding-left: 10px; border-bottom: 1px dashed #CCC;">'.$data['title'].'</td>
                        <td style="text-align: right; border-bottom: 1px dashed #CCC; padding-right: 10px;">'.TravelHelper::format_money_from_db($item_price, $currency, $rate).'</td>
                    </tr>
                </table>
                ';
                return $html;
            }else{
                return '';
            }
            
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_item_price' , 'st_email_booking_item_price' );

if(!function_exists( 'st_email_booking_origin_price' )) {
    function st_email_booking_origin_price(){
        global $order_id;
        if($order_id){
            $currency = get_post_meta($order_id, 'currency', true);
            $rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $data_price = get_post_meta($order_id, 'data_prices', true);
            if(!$data_price) $data_price = array();
            $origin_price = isset($data_price['origin_price']) ? floatval($data_price['origin_price']) : 0;
            return TravelHelper::format_money_from_db($origin_price, $currency, $rate);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_origin_price' , 'st_email_booking_origin_price' );

if(!function_exists( 'st_email_booking_sale_price' )) {
    function st_email_booking_sale_price(){
        global $order_id;
        if($order_id){
            $currency = get_post_meta($order_id, 'currency', true);
            $rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $data_price = get_post_meta($order_id, 'data_prices', true);
            if(!$data_price) $data_price = array();
            $sale_price = isset($data_price['sale_price']) ? floatval($data_price['sale_price']) : 0;
            return TravelHelper::format_money_from_db($sale_price, $currency, $rate);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_sale_price' , 'st_email_booking_sale_price' );

if(!function_exists( 'st_email_booking_tax' )) {
    function st_email_booking_tax(){
        global $order_id;
        if($order_id){
            $tax = intval(get_post_meta($order_id, 'st_tax_percent', true));
            return $tax.' %';
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_tax' , 'st_email_booking_tax' );

if(!function_exists( 'st_email_booking_price_with_tax' )) {
    function st_email_booking_price_with_tax(){
        global $order_id;
        if($order_id){
            $currency = get_post_meta($order_id, 'currency', true);
            $rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $data_price = get_post_meta($order_id, 'data_prices', true);
            if(!$data_price) $data_price = array();
            $price_with_tax = isset($data_price['price_with_tax']) ? $data_price['price_with_tax'] : 0;
            return TravelHelper::format_money_from_db($price_with_tax, $currency, $rate);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_price_with_tax' , 'st_email_booking_price_with_tax' );

if(!function_exists( 'st_email_booking_deposit_price' )) {
    function st_email_booking_deposit_price($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts(array(
                'title' => __('Deposit Price', ST_TEXTDOMAIN),
            ), $atts);

            $currency = get_post_meta($order_id, 'currency', true);
            $rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $data_price = get_post_meta($order_id, 'data_prices', true);
            if(!$data_price) $data_price = array();
            $deposit_price = isset($data_price['deposit_price']) ? $data_price['deposit_price'] : 0;
            $deposit_status = get_post_meta($order_id, 'deposit_money', true);
            if(is_array($deposit_status) && !empty($deposit_status['type'])){
                $html = "
                <table width='100%'>
                    <tr>
                        <td width='50%'><strong>{$data['title']}</strong></td>
                        <td width='50%'>".TravelHelper::format_money_from_db($deposit_price, $currency, $rate)."</td>
                    </tr>
                </table>
                ";
                return $html;
            }
            else {
                return '';
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_deposit_price' , 'st_email_booking_deposit_price' );

if(!function_exists( 'st_email_booking_total_price' )) {
    function st_email_booking_total_price(){
        global $order_id;
        if($order_id){
            $currency = get_post_meta($order_id, 'currency', true);
            $rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $data_price = get_post_meta($order_id, 'data_prices', true);
            if(!$data_price) $data_price = array();
            $total_price = isset($data_price['total_price']) ? $data_price['total_price'] : 0 ;
            return TravelHelper::format_money_from_db($total_price, $currency, $rate);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_total_price' , 'st_email_booking_total_price' );



/* Hotel */
if(!function_exists( 'st_email_booking_room_name' )) {
    function st_email_booking_room_name($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts( array(
                'tag' => '',
                'display' => 'inline-block',
                'title' => __('Room Name', ST_TEXTDOMAIN),
            ),$atts);
            $room_id = get_post_meta($order_id,'room_id',true);
            if($room_id){
                if(!empty($data['tag'])){
                    return "<{$data['tag']} style='display: {$data['display']}'>".$data['title']."</{$data['tag']}>".' '.get_the_title($room_id);
                }else{
                    return $data['title'].'<a href="'.get_the_permalink($room_id).'" target="_bank">'.get_the_title($room_id).'</a>';
                }
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_room_name' , 'st_email_booking_room_name' );

if(!function_exists( 'st_email_booking_extra_items' )) {
    function st_email_booking_extra_items($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts( array(
                'tag' => '',
                'display' => 'inline-block',
                'title' => __('Extra Items', ST_TEXTDOMAIN),
            ),$atts);

            $currency = get_post_meta($order_id, 'currency', true);
            $rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $extras = get_post_meta($order_id, 'extras', true);
            $html = '';
            $extra_price = floatval(get_post_meta($order_id, 'extra_price', true));
            if(isset($extras['value']) && is_array($extras['value']) && count($extras['value']) && $extra_price > 0):
                if(!empty($data['tag'])){
                    $html .= "<{$data['tag']} style='display : {$data['display']}'>".$data['title']."</{$data['tag']}>";
                }else{
                    $html .= $data['title'];
                }
                $html .= '<ul>';
                       
                    foreach($extras['value'] as $name => $number):
                        $price_item = floatval($extras['price'][$name]);
                        if($price_item <= 0) $price_item = 0;
                        $number_item = intval($extras['value'][$name]);
                        if($number_item <= 0) $number_item = 0;
                        if($number_item > 0){
                            $html .='<li>
                            <span>'.$extras['title'][$name].'</span>
                            <span style="float: right; margin-right: 10px;">'.$number_item.' '.__('item(s)', ST_TEXTDOMAIN).' x '.TravelHelper::format_money_from_db($price_item, $currency, $rate).'</span>
                            </li>';
                        }
                    
                endforeach;
                $html .= '</ul>';
            endif;

            return $html;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_extra_items' , 'st_email_booking_extra_items' );

if(!function_exists( 'st_email_booking_extra_price' )) {
    function st_email_booking_extra_price($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts(array(
                'title' => __('Extra Price', ST_TEXTDOMAIN),
            ), $atts);
            $currency = get_post_meta($order_id, 'currency', true);
            $rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $extras = get_post_meta($order_id, 'extras', true);
            $extra_price = floatval(get_post_meta($order_id, 'extra_price', true));
            if(isset($extras['value']) && is_array($extras['value']) && count($extras['value']) && $extra_price > 0){
                $html = "
                <table width='100%'><tr>
                    <td width='50%''>
                        <strong>{$data['title']}</strong>
                    </td>
                    <td width='50%'>".TravelHelper::format_money_from_db($extra_price, $currency, $rate)."</td>
                </tr></table";

                return $html;
            }else{
                return '';
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_extra_price' , 'st_email_booking_extra_price' );

/*  Use for Car */

if(!function_exists( 'st_email_booking_equipments' )) {
    function st_email_booking_equipments($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts( array(
                'tag' => '',
                'display' => 'inline-block',
                'title' => __('Equipments', ST_TEXTDOMAIN),
            ),$atts);

            $currency = get_post_meta($order_id, 'currency', true);
            $rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $equipment = get_post_meta($order_id, 'data_equipment', true);
            $html = '';
            if(is_array($equipment) && count($equipment)):
                if(!empty($data['tag'])){
                    $html .= "<{$data['tag']} style='display : {$data['display']}; border-bottom: 1px dashed #CCC'>".$data['title']."</{$data['tag']}>";
                }else{
                    $html .= '<p style="border-bottom: 1px dashed #CCC">'.$data['title'].'</p>';
                }
                $html .= '<ul>';
                       
                    foreach($equipment as $key => $value):
                        $price = floatval($value->price);
                        if($price < 0) $price = 0;

                $html .='<li style="border-bottom: 1px dashed #CCC">
                        <span>'.$value->title.'</span>
                        <span style="float: right; margin-right: 10px;">'.TravelHelper::format_money_from_db($price, $currency, $rate).'</span>
                    </li>';
                    
                endforeach;
                $html .= '</ul>';
            endif;

            return $html;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_equipments' , 'st_email_booking_equipments' );

if(!function_exists( 'st_email_booking_equipment_price' )) {
    function st_email_booking_equipment_price($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts(array(
                'title' => __('Equipments Price', ST_TEXTDOMAIN),
            ), $atts);
            $currency = get_post_meta($order_id, 'currency', true);
            $rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $equipment = get_post_meta($order_id, 'data_equipment', true);
            $equipment_price = floatval(get_post_meta($order_id, 'price_equipment', true));
            if(is_array($equipment) && count($equipment)){
                $html = "
                <table width='100%'><tr>
                    <td width='50%''>
                        <strong>{$data['title']}</strong>
                    </td>
                    <td width='50%'>".TravelHelper::format_money_from_db($equipment_price, $currency, $rate)."</td>
                </tr></table";

                return $html;
            }else{
                return '';
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_equipment_price' , 'st_email_booking_equipment_price' );

/*  Tour - Activity */
if(!function_exists( 'st_email_booking_adult_info' )) {
    function st_email_booking_adult_info($atts = array()){
        global $order_id;
        if($order_id){
            $post_id = trim(get_post_meta($order_id, 'item_id', true));
            $post_type = get_post_type($post_id );
            if($post_type == 'st_tours' || $post_type == 'st_activity'){
                $data = shortcode_atts(array(
                    'title' => 'No. Adults',
                ), $atts);
                $adult = intval(get_post_meta($order_id, 'adult_number', true));

                $currency = get_post_meta($order_id, 'currency', true);
                $rate = floatval(get_post_meta($order_id,'currency_rate', true));
                $adult_price = floatval(get_post_meta($order_id, 'adult_price', true));
                $html = '
                <table width="100%">
                    <tr>
                        <td style="padding-left: 10px; border-bottom: 1px dashed #CCC;">'.$data['title'].'</td>
                        <td style="text-align: right; border-bottom: 1px dashed #CCC; padding-right: 10px;"><p>'.$adult.' '.__('Adult(s)', ST_TEXTDOMAIN).' x '.TravelHelper::format_money_from_db($adult_price, $currency, $rate).'</p></td>
                    </tr>
                </table>
                ';
                return $html;
            }else{
                return '';
            }   
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_adult_info' , 'st_email_booking_adult_info' );


if(!function_exists( 'st_email_booking_children_info' )) {
    function st_email_booking_children_info($atts = array()){
        global $order_id;
        if($order_id){
            $post_id = trim(get_post_meta($order_id, 'item_id', true));
            $post_type = get_post_type($post_id );
            if($post_type == 'st_tours' || $post_type == 'st_activity'){
                $data = shortcode_atts(array(
                    'title' => 'No. Children',
                ), $atts);
                $children = intval(get_post_meta($order_id, 'child_number', true));

                $currency = get_post_meta($order_id, 'currency', true);
                $rate = floatval(get_post_meta($order_id,'currency_rate', true));
                $child_price = floatval(get_post_meta($order_id, 'child_price', true));

                $html = '
                <table width="100%">
                    <tr>
                        <td style="padding-left: 10px; border-bottom: 1px dashed #CCC;">'.$data['title'].'</td>
                        <td style="text-align: right; border-bottom: 1px dashed #CCC; padding-right: 10px;"><p>'.$children.' '.__('children', ST_TEXTDOMAIN).' x '.TravelHelper::format_money_from_db($child_price, $currency, $rate).'</p></td>
                    </tr>
                </table>
                ';
                return $html;
            }else{
                return '';
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_children_info' , 'st_email_booking_children_info' );

if(!function_exists( 'st_email_booking_infant_info' )) {
    function st_email_booking_infant_info($atts = array()){
        global $order_id;
        if($order_id){
            $post_id = trim(get_post_meta($order_id, 'item_id', true));
            $post_type = get_post_type($post_id );
            if($post_type == 'st_tours' || $post_type == 'st_activity'){
                $data = shortcode_atts(array(
                    'title' => 'No. Infant',
                ), $atts);
                $infant = intval(get_post_meta($order_id, 'infant_number', true));

                $currency = get_post_meta($order_id, 'currency', true);
                $rate = floatval(get_post_meta($order_id,'currency_rate', true));
                $infant_price = floatval(get_post_meta($order_id, 'infant_price', true));

                $html = '
                <table width="100%">
                    <tr>
                        <td style="padding-left: 10px; border-bottom: 1px dashed #CCC;">'.$data['title'].'</td>
                        <td style="text-align: right; border-bottom: 1px dashed #CCC; padding-right: 10px;"><p>'.$infant.' '.__('infant', ST_TEXTDOMAIN).' x '.TravelHelper::format_money_from_db($infant_price, $currency, $rate).'</p></td>
                    </tr>
                </table>
                ';
                return $html;
            }else{
                return '';
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_infant_info' , 'st_email_booking_infant_info' );

/* Email for confirm*/
if(!function_exists('st_email_confirm_link')){
    function st_email_confirm_link(){
        global $confirm_link;
        if($confirm_link){
            return $confirm_link;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_confirm_link' , 'st_email_confirm_link' );

/*  Approved email */
if(!function_exists('st_approved_email_item_type')){
    function st_approved_email_item_type(){
        global $author_approved, $post_approved;

        $post_type = '';
        if(!empty($post_approved)){
            switch (get_post_type($post_approved->ID)) {
                case 'st_hotel':
                    $post_type = __('Hotel', ST_TEXTDOMAIN);
                    break;
                case 'st_rental':
                    $post_type = __('Rental', ST_TEXTDOMAIN);
                    break;
                case 'st_tours':
                    $post_type = __('Tour', ST_TEXTDOMAIN);
                    break;
                case 'st_activity':
                    $post_type = __('Activity', ST_TEXTDOMAIN);
                    break;
                case 'st_cars':
                    $post_type = __('Car', ST_TEXTDOMAIN);
                case 'hotel_room':
                    $post_type = __('Hotel Room', ST_TEXTDOMAIN); 
                case 'rental_room':
                    $post_type = __('Rental Room', ST_TEXTDOMAIN);       
                    break;
            }
        }
        return $post_type;
    }
}
st_reg_shortcode( 'st_approved_email_item_type' , 'st_approved_email_item_type' );

if(!function_exists('st_approved_email_item_name')){
    function st_approved_email_item_name(){
        global $author_approved, $post_approved;

        if(!empty($post_approved->post_title)){
            return $post_approved->post_title;
        }
    }
}
st_reg_shortcode( 'st_approved_email_item_name' , 'st_approved_email_item_name' );

if(!function_exists('st_approved_email_admin_name')){
    function st_approved_email_admin_name(){
        global $author_approved, $post_approved;
        $user_info = get_userdata($author_approved);
        if(!empty($user_info->user_login)){
            return $user_info->user_login;
        }
    }
}
st_reg_shortcode( 'st_approved_email_admin_name' , 'st_approved_email_admin_name' );

if(!function_exists('st_approved_email_date')){
    function st_approved_email_date(){
        global $author_approved, $post_approved;
        $date = get_post_modified_time( TravelHelper::getDateFormat(), true, $post_approved->ID);
        return $date;
    }
}
st_reg_shortcode( 'st_approved_email_date' , 'st_approved_email_date' );

if(!function_exists('st_approved_email_item_link')){
    function st_approved_email_item_link(){
        global $author_approved, $post_approved;
        if(!empty($post_approved->ID)){
            return get_the_permalink($post_approved->ID);
        }
    }
}
st_reg_shortcode( 'st_approved_email_item_link' , 'st_approved_email_item_link' );

if(!function_exists('st_approved_email_item_name')){
    function st_approved_email_item_name(){
        global $author_approved, $post_approved;
        if(!empty($post_approved->post_title)){
            return $post_approved->post_title;
        }
    }
}
st_reg_shortcode( 'st_approved_email_item_name' , 'st_approved_email_item_name' );

///////////////////////////////////////////
///// for email template  default /////////
///////////////////////////////////////////
 
if(!function_exists('st_default_email_template_admin')){
    function st_default_email_template_admin(){
        $logo = st()->get_option('logo',get_template_directory_uri().'/img/logo-invert.png');
        $footer_menu = '<ul style="list-style: none; text-align: center;">
            <li style="display: inline-block;"><a href="#">'.__("About us", ST_TEXTDOMAIN) .'</a> |</li>
            <li style="display: inline-block;"><a href="#">'.__("Contact us", ST_TEXTDOMAIN) .'</a> |</li>
            <li style="display: inline-block;"><a href="#">'.__("News", ST_TEXTDOMAIN) .'</a> |</li>
            </ul>';
        $social_icon = '<a href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/eb_face.png" alt="eb_face" width="35" height="35" /></a> 
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/eb_yo.png" alt="" width="35" height="35" /></a> 
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/eb_tw.png" alt="" width="35" height="35" /></a> 
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6293" src="'.get_template_directory_uri().'/img/email/eb_p.png" alt="" width="35" height="34" /></a> 
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6294" src="'.get_template_directory_uri().'/img/email/eb_in.png" alt="" width="35" height="35" /></a>';

        return '
        <table id="header" class="wrapper" border="0" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr bgcolor="#FFF">
            <td style="padding: 20px 10px;" width="20%"><a href="'.site_url().'">
                <img class="alignnone wp-image-7442 size-full" src="'.$logo.'" alt="logo" width="110" height="40" /></a></td>
            <td style="padding: 20px 10px;">
            <h3 style="text-align: right;">'.get_bloginfo('title').'</h3>
            <p style="text-align: right;">'.get_bloginfo('description').'</p>
            </td>
            </tr>
            </tbody>
            </table>
            <table id="booking-infomation" class="wrapper" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 20px 10px; background: #ED8323;">
            <h1 style="text-align: left; color: #fff;">'.__("Booking Information" , ST_TEXTDOMAIN).'</h1>
            </td>
            </tr>
            </tbody>
            </table>
            <table id="booking-content" class="wrapper" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr id="title">
            <td style="padding: 10px;">
            <h3>Hi Administrator,</h3>
            <h4>[st_email_booking_first_name] [st_email_booking_last_name] '.__("booked your system" , ST_TEXTDOMAIN).'.</h4>
            <h4>'.__("Below are customer\'s booking details:" , ST_TEXTDOMAIN).'</h4>
            <h3><strong>'.__("Booking Code: " , ST_TEXTDOMAIN).'</strong>[st_email_booking_id]</h3>
            </td>
            </tr>
            <tr>
            <td>
            <table width="100%" cellspacing="0">
            <tbody>
            <tr>
            <td style="padding: 0 5px;">
            <div style="width: 66.6666%; float: left;">
            <table style="border-right: 1px solid #CCC;" width="95%">
            <tbody>
            <tr>
            <td>
            <h3><strong>'.__("Customer Information" , ST_TEXTDOMAIN).'</strong></h3>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("First name:" , ST_TEXTDOMAIN).'</strong> [st_email_booking_first_name]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("Last name:" , ST_TEXTDOMAIN).'</strong> [st_email_booking_last_name]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("Email:" , ST_TEXTDOMAIN).'</strong> [st_email_booking_email]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("Phone: " , ST_TEXTDOMAIN).'</strong>[st_email_booking_phone]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("City:" , ST_TEXTDOMAIN).'</strong> [st_email_booking_city]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("Address line 1:" , ST_TEXTDOMAIN).'</strong> [st_email_booking_address]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("Country:" , ST_TEXTDOMAIN).'</strong> [st_email_booking_country]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("Special Requirements:" , ST_TEXTDOMAIN).'</strong></p>
            <p>[st_email_booking_note]</p>
            </td>
            </tr>
            </tbody>
            </table>
            </div>
            <div style="width: 33.3334%; float: left;">
            <table width="100%" cellspacing="0">
            <tbody>
            <tr>
            <td>
            <h3><strong>'.__("Shipped to:" , ST_TEXTDOMAIN).'</strong></h3>
            </td>
            </tr>
            <tr>
            <td>
            <p>[st_email_booking_first_name] [st_email_booking_last_name]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p>[st_email_booking_address]</p>
            </td>
            </tr>
            <tr>
            <td>
            <h3><strong>'.__("Date: " , ST_TEXTDOMAIN).'</strong> [st_email_booking_date]</h3>
            </td>
            </tr>
            </tbody>
            </table>
            </div>
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            <tr>
            <td style="padding: 30px 5px 10px 5px;">
            <table id="item" style="-webkit-border-radius: 3px 3px 0 0; -moz-border-radius: 3px 3px 0 0; -ms-border-radius: 3px 3px 0 0; -o-border-radius: 3px 3px 0 0; border-radius: 3px 3px 0 0; border: 1px solid #CCC;" width="100%" cellspacing="0">
            <tbody>
            <tr>
            <th style="padding: 10px 5px; background: #EFEFEF;" align="left">'.__("Item" , ST_TEXTDOMAIN).'</th>
            </tr>
            <tr style="background: #FFF;">
            <td>
            <table width="100%" cellspacing="0">
            <tbody>
            <tr>
            <td style="padding-left: 10px; padding-top: 10px; padding-bottom: 15px;" width="50%">
            <h3>[st_email_booking_item_link]</h3>
            <p>&nbsp;</p>
            <p>[st_email_booking_thumbnail]</p>
            </td>
            <td style="padding: 10px 0; text-align: right; padding-right: 10px;" width="50%"> </td>
            </tr>
            <tr>
            <td style="padding-left: 10px; border-bottom: 1px dashed #CCC;" colspan="2">
            <p>[st_email_booking_room_name tag="" title="'.__("Room Name: " , ST_TEXTDOMAIN).'"]</p>
            </td>
            </tr>
            <tr>
            <td colspan="2">[st_email_booking_number_item]</td>
            </tr>
            <tr>
            <td colspan="2">[st_email_booking_item_price] [st_email_booking_adult_info] [st_email_booking_children_info] [st_email_booking_infant_info]</td>
            </tr>
            <tr>
            <td class="" style="padding-left: 10px;">[st_check_in_out_title]</td>
            <td class="" style="text-align: right; padding-right: 10px;">[st_check_in_out_value]</td>
            </tr>
            <tr>
            <td colspan="2"> </td>
            </tr>
            <tr>
            <td class="" style="padding-left: 10px;" colspan="2">[st_email_booking_extra_items title="'.__("Custom title" , ST_TEXTDOMAIN).'"] [st_email_booking_equipments title="'.__("Equipments" , ST_TEXTDOMAIN).'"]</td>
            </tr>
            <tr>
            <td style="border-top: 2px solid #CCC; padding-left: 10px;"> </td>
            <td style="border-top: 2px solid #CCC; text-align: right; padding-right: 10px;">
            <table width="100%">
            <tbody>
            <tr>
            <td width="50%"><strong>'.__("Origin Price" , ST_TEXTDOMAIN).'</strong></td>
            <td width="50%">[st_email_booking_origin_price]</td>
            </tr>
            <tr>
            <td width="50%"><strong>'.__("Sale Price" , ST_TEXTDOMAIN).'</strong></td>
            <td width="50%">[st_email_booking_sale_price]</td>
            </tr>
            <tr>
            <td colspan="2">[st_email_booking_extra_price] [st_email_booking_equipment_price]</td>
            </tr>
            <tr>
            <td width="50%"><strong>'.__("Tax" , ST_TEXTDOMAIN).'</strong></td>
            <td width="50%">[st_email_booking_tax]</td>
            </tr>
            <tr>
            <td width="50%">
            <p><strong>Total Price <em>'.__("(with tax)" , ST_TEXTDOMAIN).'</em></strong></p>
            </td>
            <td width="50%">[st_email_booking_price_with_tax]</td>
            </tr>
            <tr>
            <td colspan="2">[st_email_booking_deposit_price]</td>
            </tr>
            <tr>
            <td width="50%"><strong>'.__("Pay Amount" , ST_TEXTDOMAIN).'</strong></td>
            <td width="50%">[st_email_booking_total_price]</td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            </tbody>
            </table>
            <table width="100%" cellspacing="0">
            <tbody>
            <tr>
            <td style="padding-top: 30px;" align="center">
            <a href="'.site_url().'"><img class="alignnone wp-image-7442 size-full" src="'.$logo.'" alt="" width="110" height="40" /></a>
            </td>
            </tr>
            <tr>
            <td style="padding-bottom: 30px; border-bottom: 1px solid #CCC;" align="center">'.$social_icon.'</td>
            </tr>
            <tr>
            <td style="padding-top: 20px;" align="center">
            <p>'.get_bloginfo('title').' | '.get_bloginfo('description').'</p>
            <p>Booking, reviews and advices on hotels, resorts, flights, vacation rentals, travel packages, and lots more!</p>
            '.$footer_menu.'
            </td>
            </tr>
            </tbody>
            </table>
        ';
    }
}
if(!function_exists('st_default_email_template_partner')){
    function st_default_email_template_partner(){
        $logo = st()->get_option('logo',get_template_directory_uri().'/img/logo-invert.png');
        $footer_menu = '<ul style="list-style: none; text-align: center;">
            <li style="display: inline-block;"><a href="#">'.__("About us", ST_TEXTDOMAIN) .'</a> |</li>
            <li style="display: inline-block;"><a href="#">'.__("Contact us", ST_TEXTDOMAIN) .'</a> |</li>
            <li style="display: inline-block;"><a href="#">'.__("News", ST_TEXTDOMAIN) .'</a> |</li>
            </ul>';
        $social_icon = '<a href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/eb_face.png" alt="eb_face" width="35" height="35" /></a> 
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/eb_yo.png" alt="" width="35" height="35" /></a> 
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/eb_tw.png" alt="" width="35" height="35" /></a> 
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6293" src="'.get_template_directory_uri().'/img/email/eb_p.png" alt="" width="35" height="34" /></a> 
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6294" src="'.get_template_directory_uri().'/img/email/eb_in.png" alt="" width="35" height="35" /></a>';

        return '
         <table id="header" class="wrapper" border="0" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr bgcolor="#FFF">
            <td style="padding: 20px 10px;" width="20%"><a href="'.site_url().'">
                <img class="alignnone wp-image-7442 size-full" src="'.$logo.'" alt="logo" width="110" height="40" /></a></td>
            <td style="padding: 20px 10px;">
            <h3 style="text-align: right;">'.get_bloginfo('title').'</h3>
            <p style="text-align: right;">'.get_bloginfo('description').'</p>
            </td>
            </tr>
            </tbody>
            </table>
            <table id="booking-infomation" class="wrapper" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 20px 10px; background: #ED8323;">
            <h1 style="text-align: left; color: #fff;">'.__("Booking Information" , ST_TEXTDOMAIN).'</h1>
            </td>
            </tr>
            </tbody>
            </table>
            <table id="booking-content" class="wrapper" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr id="title">
            <td style="padding: 10px;">
            <h3>Hi Partner,</h3>
            <h4>[st_email_booking_first_name] [st_email_booking_last_name] '.__("booked your " , ST_TEXTDOMAIN).'[st_email_booking_posttype].</h4>
            <h4>'.__("Below are customer\'s booking details:" , ST_TEXTDOMAIN).'</h4>
            <h3><strong>'.__("Booking Code: " , ST_TEXTDOMAIN).'</strong>[st_email_booking_id]</h3>
            </td>
            </tr>
            <tr>
            <td>
            <table width="100%" cellspacing="0">
            <tbody>
            <tr>
            <td style="padding: 0 5px;">
            <div style="width: 66.6666%; float: left;">
            <table style="border-right: 1px solid #CCC;" width="95%">
            <tbody>
            <tr>
            <td>
            <h3><strong>'.__("Customer Infomation" , ST_TEXTDOMAIN).'</strong></h3>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("First name:" , ST_TEXTDOMAIN).'</strong> [st_email_booking_first_name]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("Last name:" , ST_TEXTDOMAIN).'</strong> [st_email_booking_last_name]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("Email:" , ST_TEXTDOMAIN).'</strong> [st_email_booking_email]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("Phone: " , ST_TEXTDOMAIN).'</strong>[st_email_booking_phone]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("City:" , ST_TEXTDOMAIN).'</strong> [st_email_booking_city]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("Address line 1:" , ST_TEXTDOMAIN).'</strong> [st_email_booking_address]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("Country:" , ST_TEXTDOMAIN).'</strong> [st_email_booking_country]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("Special Requirements:" , ST_TEXTDOMAIN).'</strong></p>
            <p>[st_email_booking_note]</p>
            </td>
            </tr>
            </tbody>
            </table>
            </div>
            <div style="width: 33.3334%; float: left;">
            <table width="100%" cellspacing="0">
            <tbody>
            <tr>
            <td>
            <h3><strong>'.__("Shipped to:" , ST_TEXTDOMAIN).'</strong></h3>
            </td>
            </tr>
            <tr>
            <td>
            <p>[st_email_booking_first_name] [st_email_booking_last_name]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p>[st_email_booking_address]</p>
            </td>
            </tr>
            <tr>
            <td>
            <h3><strong>Date: </strong> [st_email_booking_date]</h3>
            </td>
            </tr>
            </tbody>
            </table>
            </div>
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            <tr>
            <td style="padding: 30px 5px 10px 5px;">
            <table id="item" style="-webkit-border-radius: 3px 3px 0 0; -moz-border-radius: 3px 3px 0 0; -ms-border-radius: 3px 3px 0 0; -o-border-radius: 3px 3px 0 0; border-radius: 3px 3px 0 0; border: 1px solid #CCC;" width="100%" cellspacing="0">
            <tbody>
            <tr>
            <th style="padding: 10px 5px; background: #EFEFEF;" align="left">Item</th>
            </tr>
            <tr style="background: #FFF;">
            <td>
            <table width="100%" cellspacing="0">
            <tbody>
            <tr>
            <td style="padding-left: 10px; padding-top: 10px; padding-bottom: 15px;" width="50%">
            <h3>[st_email_booking_item_link]</h3>
            <p>&nbsp;</p>
            <p>[st_email_booking_thumbnail]</p>
            </td>
            <td style="padding: 10px 0; text-align: right; padding-right: 10px;" width="50%"> </td>
            </tr>
            <tr>
            <td style="padding-left: 10px; border-bottom: 1px dashed #CCC;" colspan="2">
            <p>[st_email_booking_room_name tag="" title="Room Name: "]</p>
            </td>
            </tr>
            <tr>
            <td colspan="2">[st_email_booking_number_item]</td>
            </tr>
            <tr>
            <td colspan="2">[st_email_booking_item_price] [st_email_booking_adult_info] [st_email_booking_children_info] [st_email_booking_infant_info]</td>
            </tr>
            <tr>
            <td class="" style="padding-left: 10px;">[st_check_in_out_title]</td>
            <td class="" style="text-align: right; padding-right: 10px;">[st_check_in_out_value]</td>
            </tr>
            <tr>
            <td colspan="2"> </td>
            </tr>
            <tr>
            <td class="" style="padding-left: 10px;" colspan="2">[st_email_booking_extra_items title="Custom title"] [st_email_booking_equipments title="'.__("Equipments" , ST_TEXTDOMAIN).'"]</td>
            </tr>
            <tr>
            <td style="border-top: 2px solid #CCC; padding-left: 10px;"> </td>
            <td style="border-top: 2px solid #CCC; text-align: right; padding-right: 10px;">
            <table width="100%">
            <tbody>
            <tr>
            <td width="50%"><strong>'.__("Origin Price" , ST_TEXTDOMAIN).'</strong></td>
            <td width="50%">[st_email_booking_origin_price]</td>
            </tr>
            <tr>
            <td width="50%"><strong>'.__("Sale Price" , ST_TEXTDOMAIN).'</strong></td>
            <td width="50%">[st_email_booking_sale_price]</td>
            </tr>
            <tr>
            <td colspan="2">[st_email_booking_extra_price] [st_email_booking_equipment_price]</td>
            </tr>
            <tr>
            <td width="50%"><strong>'.__("Tax" , ST_TEXTDOMAIN).'</strong></td>
            <td width="50%">[st_email_booking_tax]</td>
            </tr>
            <tr>
            <td width="50%">
            <p><strong>Total Price <em>'.__("(with tax)" , ST_TEXTDOMAIN).'</em></strong></p>
            </td>
            <td width="50%">[st_email_booking_price_with_tax]</td>
            </tr>
            <tr>
            <td colspan="2">[st_email_booking_deposit_price]</td>
            </tr>
            <tr>
            <td width="50%"><strong>'.__("Pay Amount" , ST_TEXTDOMAIN).'</strong></td>
            <td width="50%">[st_email_booking_total_price]</td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            </tbody>
            </table>
            <table width="100%" cellspacing="0">
            <tbody>
            <tr>
            <td style="padding-top: 30px;" align="center">
            <a href="'.site_url().'"><img class="alignnone wp-image-7442 size-full" src="'.$logo.'" alt="" width="110" height="40" /></a>
            </td>
            </tr>
            <tr>
            <td style="padding-bottom: 30px; border-bottom: 1px solid #CCC;" align="center">'.$social_icon.'</td>
            </tr>
            <tr>
            <td style="padding-top: 20px;" align="center">
            <p>'.get_bloginfo('title').' | '.get_bloginfo('description').'</p>
            <p>Booking, reviews and advices on hotels, resorts, flights, vacation rentals, travel packages, and lots more!</p>
            '.$footer_menu.'
            </td>
            </tr>
            </tbody>
            </table>
        ';
    }
}
if(!function_exists('st_default_email_template_customer')){
    function st_default_email_template_customer(){
        $logo = st()->get_option('logo',get_template_directory_uri().'/img/logo-invert.png');
        $footer_menu = '<ul style="list-style: none; text-align: center;">
            <li style="display: inline-block;"><a href="#">'.__("About us", ST_TEXTDOMAIN) .'</a> |</li>
            <li style="display: inline-block;"><a href="#">'.__("Contact us", ST_TEXTDOMAIN) .'</a> |</li>
            <li style="display: inline-block;"><a href="#">'.__("News", ST_TEXTDOMAIN) .'</a> |</li>
            </ul>';
        $social_icon = '<a href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/eb_face.png" alt="eb_face" width="35" height="35" /></a> 
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/eb_yo.png" alt="" width="35" height="35" /></a> 
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/eb_tw.png" alt="" width="35" height="35" /></a> 
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6293" src="'.get_template_directory_uri().'/img/email/eb_p.png" alt="" width="35" height="34" /></a> 
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6294" src="'.get_template_directory_uri().'/img/email/eb_in.png" alt="" width="35" height="35" /></a>';

        return '
        <table id="header" class="wrapper" border="0" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr bgcolor="#FFF">
            <td style="padding: 20px 10px;" width="20%"><a href="'.site_url().'">
                <img class="alignnone wp-image-7442 size-full" src="'.$logo.'" alt="logo" width="110" height="40" /></a></td>
            <td style="padding: 20px 10px;">
            <h3 style="text-align: right;">'.get_bloginfo('title').'</h3>
            <p style="text-align: right;">'.get_bloginfo('description').'</p>
            </td>
            </tr>
            </tbody>
            </table>
        <table id="booking-infomation" class="wrapper" width="90%" cellspacing="0" align="center">
        <tbody>
        <tr>
        <td style="padding: 20px 10px; background: #ED8323;">
        <h1 style="text-align: left; color: #fff;">'.__("Booking Information" , ST_TEXTDOMAIN).'</h1>
        </td>
        </tr>
        </tbody>
        </table>
        <table id="booking-content" class="wrapper" width="90%" cellspacing="0" align="center">
        <tbody>
        <tr id="title">
        <td style="padding: 10px;">
        <h3>Hi [st_email_booking_first_name] [st_email_booking_last_name],</h3>
        <h4>Thank you for booking with us. Below are your booking details:</h4>
        <h3><strong>Booking Code: </strong>[st_email_booking_id]</h3>
        </td>
        </tr>
        <tr>
        <td>
        <table width="100%" cellspacing="0">
        <tbody>
        <tr>
        <td style="padding: 0 5px;">
        <div style="width: 66.6666%; float: left;">
        <table style="border-right: 1px solid #CCC;" width="95%">
        <tbody>
        <tr>
        <td>
        <h3><strong>Customer Infomation</strong></h3>
        </td>
        </tr>
        <tr>
        <td>
        <p><strong>First name:</strong> [st_email_booking_first_name]</p>
        </td>
        </tr>
        <tr>
        <td>
        <p><strong>Last name:</strong> [st_email_booking_last_name]</p>
        </td>
        </tr>
        <tr>
        <td>
        <p><strong>Email:</strong> [st_email_booking_email]</p>
        </td>
        </tr>
        <tr>
        <td>
        <p><strong>Phone: </strong>[st_email_booking_phone]</p>
        </td>
        </tr>
        <tr>
        <td>
        <p><strong>City:</strong> [st_email_booking_city]</p>
        </td>
        </tr>
        <tr>
        <td>
        <p><strong>Address line 1:</strong> [st_email_booking_address]</p>
        </td>
        </tr>
        <tr>
        <td>
        <p><strong>Country:</strong> [st_email_booking_country]</p>
        </td>
        </tr>
        <tr>
        <td>
        <p><strong>'.__("Special Requirements:" , ST_TEXTDOMAIN).' </strong></p>
        <table width="95%">
        <tbody>
        <tr>
        <td>[st_email_booking_note]</td>
        </tr>
        </tbody>
        </table>
        <p>&nbsp;</p>
        </td>
        </tr>
        </tbody>
        </table>
        </div>
        <div style="width: 33.3334%; float: left;">
        <table width="100%" cellspacing="0">
        <tbody>
        <tr>
        <td>
        <h3><strong>'.__("Shipped to:" , ST_TEXTDOMAIN).'</strong></h3>
        </td>
        </tr>
        <tr>
        <td>
        <p>[st_email_booking_first_name] [st_email_booking_last_name]</p>
        </td>
        </tr>
        <tr>
        <td>
        <p>[st_email_booking_address]</p>
        </td>
        </tr>
        <tr>
        <td>
        <h3><strong>'.__("Date: " , ST_TEXTDOMAIN).'</strong> [st_email_booking_date]</h3>
        </td>
        </tr>
        </tbody>
        </table>
        </div>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        <tr>
        <td style="padding: 30px 5px 10px 5px;">
        <table id="item" style="-webkit-border-radius: 3px 3px 0 0; -moz-border-radius: 3px 3px 0 0; -ms-border-radius: 3px 3px 0 0; -o-border-radius: 3px 3px 0 0; border-radius: 3px 3px 0 0; border: 1px solid #CCC;" width="100%" cellspacing="0">
        <tbody>
        <tr>
        <th style="padding: 10px 5px; background: #EFEFEF;" align="left">'.__("Item" , ST_TEXTDOMAIN).'</th>
        </tr>
        <tr style="background: #FFF;">
        <td>
        <table width="100%" cellspacing="0">
        <tbody>
        <tr>
        <td style="padding-left: 10px; padding-top: 10px; padding-bottom: 15px;" width="50%">
        <h3>[st_email_booking_item_link]</h3>
        <p>&nbsp;</p>
        <p>[st_email_booking_thumbnail]</p>
        </td>
        <td style="padding: 10px 0; text-align: right; padding-right: 10px;" width="50%"> </td>
        </tr>
        <tr>
        <td style="padding-left: 10px; border-bottom: 1px dashed #CCC;" colspan="2">
        <p>[st_email_booking_room_name tag="" title="'.__("Room Name:" , ST_TEXTDOMAIN).' "]</p>
        </td>
        </tr>
        <tr>
        <td colspan="2">[st_email_booking_number_item]</td>
        </tr>
        <tr>
        <td colspan="2">[st_email_booking_item_price] [st_email_booking_adult_info] [st_email_booking_children_info] [st_email_booking_infant_info]</td>
        </tr>
        <tr>
        <td class="" style="padding-left: 10px;">[st_check_in_out_title]</td>
        <td class="" style="text-align: right; padding-right: 10px;">[st_check_in_out_value]</td>
        </tr>
        <tr>
        <td colspan="2"> </td>
        </tr>
        <tr>
        <td class="" style="padding-left: 10px;" colspan="2">[st_email_booking_extra_items title="Custom title"] [st_email_booking_equipments title="'.__("Equipments" , ST_TEXTDOMAIN).'"]</td>
        </tr>
        <tr>
        <td style="border-top: 2px solid #CCC; padding-left: 10px;"> </td>
        <td style="border-top: 2px solid #CCC; text-align: right; padding-right: 10px;">
        <table width="100%">
        <tbody>
        <tr>
        <td width="50%"><strong>'.__("Origin Price" , ST_TEXTDOMAIN).'</strong></td>
        <td width="50%">[st_email_booking_origin_price]</td>
        </tr>
        <tr>
        <td width="50%"><strong>'.__("Sale Price" , ST_TEXTDOMAIN).'</strong></td>
        <td width="50%">[st_email_booking_sale_price]</td>
        </tr>
        <tr>
        <td colspan="2">[st_email_booking_extra_price] [st_email_booking_equipment_price]</td>
        </tr>
        <tr>
        <td width="50%"><strong>'.__("Tax" , ST_TEXTDOMAIN).'</strong></td>
        <td width="50%">[st_email_booking_tax]</td>
        </tr>
        <tr>
        <td width="50%">
        <p><strong>Total Price <em>'.__("(with tax)" , ST_TEXTDOMAIN).'</em></strong></p>
        </td>
        <td width="50%">[st_email_booking_price_with_tax]</td>
        </tr>
        <tr>
        <td colspan="2">[st_email_booking_deposit_price]</td>
        </tr>
        <tr>
        <td width="50%"><strong>'.__("Pay Amount" , ST_TEXTDOMAIN).'</strong></td>
        <td width="50%">[st_email_booking_total_price]</td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        <table width="100%" cellspacing="0">
        <tbody>
        <tr>
        <td style="padding-top: 30px;" align="center">
        <a href="'.site_url().'"><img class="alignnone wp-image-7442 size-full" src="'.$logo.'" alt="" width="110" height="40" /></a>
        </td>
        </tr>
        <tr>
        <td style="padding-bottom: 30px; border-bottom: 1px solid #CCC;" align="center">'.$social_icon.'</td>
        </tr>
        <tr>
        <td style="padding-top: 20px;" align="center">
        <p>'.get_bloginfo('title').' | '.get_bloginfo('description').'</p>
        <p>Booking, reviews and advices on hotels, resorts, flights, vacation rentals, travel packages, and lots more!</p>
        '.$footer_menu.'
        </td>
        </tr>
        </tbody>
        </table>
        ';
    }
}
if(!function_exists('get_email_confirm_template')){
    function get_email_confirm_template(){
        return '
            <table id="booking-infomation" class="wrapper" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 20px 10px; background: #ED8323;">
            <h1 style="text-align: left; color: #fff;">Information</h1>
            </td>
            </tr>
            </tbody>
            </table>
            <table id="booking-content" class="wrapper" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr id="title">
            <td style="padding: 10px; border-top: 1px solid #CCC;">
            <h3 style="text-align: center;"><strong>Hi,</strong></h3>
            <p style="text-align: center;">You added an email address to your account <br /> Click "confirm" to import the bookings you\'ve made with that address <br /><br /> <a class="btn btn-primary" style="text-decoration: none; color: white; background: #ED8323; font-size: 30px; padding: 14px 30px 14px 30px;" href="[st_email_confirm_link]" target="_blank">Confirm</a><br /><br /> Can\'t see the button? Try this link: <a href="[st_email_confirm_link]" target="_blank">[st_email_confirm_link]</a></p>
            </td>
            </tr>
            </tbody>
            </table>
            <table width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding-top: 30px; border-top: 1px solid #CCC;" align="center"><a href="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/logo.png"><img class="alignnone size-full wp-image-7442" src="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/logo.png" alt="logo" width="110" height="40" /></a></td>
            </tr>
            <tr>
            <td style="padding-bottom: 30px; border-bottom: 1px solid #CCC;" align="center"><a style="margin: 5px;" href="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/eb_yo1.png"> <img class="alignnone wp-image-6292" src="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/eb_yo1.png" alt="eb_face" width="35" height="35" /> </a> <a style="margin: 5px;" href="http://localhost/traveler/wp-content/uploads/st_uploadfont/eb_yo1.png"><img class="alignnone wp-image-6296" src="http://localhost/traveler/wp-content/uploads/st_uploadfont/eb_yo1.png" alt="" width="35" height="35" /></a> <a style="margin: 5px;" href="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/eb_tw1.png"><img class="alignnone wp-image-6295" src="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/eb_tw1.png" alt="" width="35" height="35" /></a> <a style="margin: 5px;" href="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/eb_p1.png"><img class="alignnone wp-image-6293" src="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/eb_p1.png" alt="" width="35" height="34" /></a> <a style="margin: 5px;" href="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/eb_face1.png"><img class="alignnone wp-image-6294" src="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/eb_face1.png" alt="" width="35" height="35" /></a></td>
            </tr>
            <tr>
            <td style="padding-top: 20px;" align="center">
            <p>Traveler demo - Shinetheme | Just another WordPress site</p>
            <p>Booking, reviews and advices on hotels, resorts, flights, vacation rentals, travel packages, and lots more!</p>
            <ul style="list-style: none; text-align: center;">
            <li style="display: inline-block;"><a href="#">About us</a> |</li>
            <li style="display: inline-block;"><a href="#">About us</a> |</li>
            <li style="display: inline-block;"><a href="#">About us</a> |</li>
            <li style="display: inline-block;"><a href="#">About us</a> |</li>
            </ul>
            </td>
            </tr>
            </tbody>
            </table>
        ';
    }
}
if(!function_exists('get_email_approved_template')){
    function get_email_approved_template(){
        return '
            <table id="header" class="wrapper" border="0" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr bgcolor="#FFF">
            <td style="padding: 20px 10px;" width="20%"><a href="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/logo.png"><img class="alignnone size-full wp-image-7442" src="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/logo.png" alt="logo" width="110" height="40" /></a></td>
            <td style="padding: 20px 10px;">
            <h3 style="text-align: right;">Traveler demo - Shinetheme</h3>
            <p style="text-align: right;">Just another WordPress site</p>
            </td>
            </tr>
            </tbody>
            </table>
            <table id="booking-infomation" class="wrapper" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 20px 10px; background: #ED8323;">
            <h1 style="text-align: left; color: #fff;">Information</h1>
            </td>
            </tr>
            </tbody>
            </table>
            <table id="booking-content" class="wrapper" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr id="title">
            <td style="padding: 10px; border-top: 1px solid #CCC;">
            <h3 style="text-align: center;"><strong>Hello Partner,</strong></h3>
            <p style="text-align: center;"><strong>[st_approved_email_admin_name]</strong> published your [st_approved_email_item_type] with <strong>[st_approved_email_item_name] </strong>title on <strong>[st_approved_email_date]</strong>.</p>
            <p>&nbsp;</p>
            <p style="text-align: center;"><a class="btn btn-primary" style="text-decoration: none; color: white; background: #ED8323; font-size: 20px; padding: 10px 20px 10px 20px;" href="[st_approved_email_item_link]" target="_blank">Check</a></p>
            <p style="text-align: center;"> </p>
            <p style="text-align: center;">Can\'t see the button? Try this link: <a href="[st_approved_email_item_link]" target="_blank">[st_approved_email_item_name]</a></p>
            </td>
            </tr>
            </tbody>
            </table>
            <table width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding-top: 30px; border-top: 1px solid #CCC;" align="center"><a href="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/logo.png"><img class="alignnone size-full wp-image-7442" src="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/logo.png" alt="logo" width="110" height="40" /></a></td>
            </tr>
            <tr>
            <td style="padding-bottom: 30px; border-bottom: 1px solid #CCC;" align="center"><a style="margin: 5px;" href="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/eb_yo1.png"> <img class="alignnone wp-image-6292" src="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/eb_yo1.png" alt="eb_face" width="35" height="35" /> </a> <a style="margin: 5px;" href="http://localhost/traveler/wp-content/uploads/st_uploadfont/eb_yo1.png"><img class="alignnone wp-image-6296" src="http://localhost/traveler/wp-content/uploads/st_uploadfont/eb_yo1.png" alt="" width="35" height="35" /></a> <a style="margin: 5px;" href="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/eb_tw1.png"><img class="alignnone wp-image-6295" src="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/eb_tw1.png" alt="" width="35" height="35" /></a> <a style="margin: 5px;" href="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/eb_p1.png"><img class="alignnone wp-image-6293" src="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/eb_p1.png" alt="" width="35" height="34" /></a> <a style="margin: 5px;" href="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/eb_face1.png"><img class="alignnone wp-image-6294" src="http://shinetheme.com/demosd/traveler/wp-content/uploads/st_uploadfont/eb_face1.png" alt="" width="35" height="35" /></a></td>
            </tr>
            <tr>
            <td style="padding-top: 20px;" align="center">
            <p>Traveler demo - Shinetheme | Just another WordPress site</p>
            <p>Booking, reviews and advices on hotels, resorts, flights, vacation rentals, travel packages, and lots more!</p>
            <ul style="list-style: none; text-align: center;">
            <li style="display: inline-block;"><a href="#">About us</a> |</li>
            <li style="display: inline-block;"><a href="#">About us</a> |</li>
            <li style="display: inline-block;"><a href="#">About us</a> |</li>
            <li style="display: inline-block;"><a href="#">About us</a> |</li>
            </ul>
            </td>
            </tr>
            </tbody>
            </table>
        ';
    }
}


/*   Shortcode for Partner infomation */

if(!function_exists( '_st_info_full_name' )) {
    function _st_info_full_name(){
        global $st_user_id;
        if($st_user_id){
            $user_data = get_userdata( $st_user_id );
            return $user_data->display_name;
        }
        return '';
    }
}
st_reg_shortcode( 'st_info_full_name' , '_st_info_full_name' );

if(!function_exists( '_st_info_user_name' )) {
    function _st_info_user_name(){
        global $st_user_id;
        if($st_user_id){
            $user_data = get_userdata( $st_user_id );
            return $user_data->nickname;
        }
        return '';
    }
}
st_reg_shortcode( 'st_info_user_name' , '_st_info_user_name' );

if(!function_exists( '_st_info_user_email' )) {
    function _st_info_user_email(){
        global $st_user_id;
        if($st_user_id){
            $user_data = get_userdata( $st_user_id );
            return $user_data->user_email;
        }
        return '';
    }
}
st_reg_shortcode( 'st_info_user_email' , '_st_info_user_email' );

if(!function_exists( '_st_info_user_date_create' )) {
    function _st_info_user_date_create(){
        global $st_user_id;
        if($st_user_id){
            $user_data = get_userdata( $st_user_id );
            return date_i18n("d/m/Y",strtotime($user_data->user_registered));
        }
        return '';
    }
}
st_reg_shortcode( 'st_info_user_date_create' , '_st_info_user_date_create' );

if(!function_exists( '_st_info_user_certificates' )) {
    function _st_info_user_certificates(){
        global $st_user_id;
        if($st_user_id){
            $html ="";
            $data = get_user_meta($st_user_id , "st_certificates" ,  true);
            if(!empty($data)){
                $html .= '<table style="width:60%;color:#666">';
                $i = 1;
                foreach($data as $k=>$v){
                    if($i == 1 or $i == 3 or $i == 5){
                        $html .= "<tr>";
                    }
                    $html .= '<td><img src="'.get_template_directory_uri().'/img/email/check.png" > '.$v['name'].'</td>';
                    $i++;
                }
                $html .= "</table>";
            }
            return balanceTags($html);
        }
        return '';
    }
}
st_reg_shortcode( 'st_info_user_certificates' , '_st_info_user_certificates' );

if(!function_exists( '_st_url_info_user' )) {
    function _st_url_info_user(){
        global $st_user_id;
        if($st_user_id){
            $url = admin_url("user-edit.php?user_id=".$st_user_id);
            return $url;
        }
        return '';
    }
}
st_reg_shortcode( 'st_url_info_user' , '_st_url_info_user' );


if(!function_exists( '_st_url_list_user_partner' )) {
    function _st_url_list_user_partner(){
        $url = admin_url("users.php?page=st-users-partner-menu");
        return $url;
    }
}
st_reg_shortcode( 'st_url_list_user_partner' , '_st_url_list_user_partner' );

if(!function_exists( '_st_url_update_certificates' )) {
    function _st_url_update_certificates(){
        global $st_user_id;
        if($st_user_id){
            $page_id = st()->get_option('page_my_account_dashboard');
            if(!empty($page_id)){
                $url = add_query_arg(array('sc'=>'certificate'),get_the_permalink($page_id));
                return $url;
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_url_update_certificates' , '_st_url_update_certificates' );


if(!function_exists( '_st_url_partner_dashboard' )) {
    function _st_url_partner_dashboard(){
        $page_id = st()->get_option('page_my_account_dashboard');
        if(!empty($page_id)){
            $url = get_the_permalink($page_id);
            return $url;
        }
        return '';
    }
}
st_reg_shortcode( 'st_url_partner_dashboard' , '_st_url_partner_dashboard' );

if(!function_exists('st_default_email_template_for_admin_partner')){
    function st_default_email_template_for_admin_partner(){
        $logo = st()->get_option('logo',get_template_directory_uri().'/img/logo-invert.png');
        $footer_menu = '<ul style="list-style: none; text-align: center;">
            <li style="display: inline-block;"><a href="#" style="color: #818181; text-decoration:none ;">'.__("About us", ST_TEXTDOMAIN) .'</a> |</li>
            <li style="display: inline-block;"><a href="#" style="color: #818181 ; text-decoration:none ;">'.__("Contact us", ST_TEXTDOMAIN) .'</a> |</li>
            <li style="display: inline-block;"><a href="#" style="color: #818181;text-decoration:none ;">'.__("News", ST_TEXTDOMAIN) .'</a></li>
            </ul>';
        $social_icon = '
            <a href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/fa.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/tw.png" alt="" width="35" height="35" /></a>
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/gg.png" alt="" width="35" height="35" /></a>
            ';
        return '
            <table id="booking-infomation" class="wrapper" width="90%" cellspacing="0" align="center" style="width:800px" >
            <tbody>
            <tr>
            <td style="padding: 20px 10px; background: #ED8323;" width="20%">
               <a href="'.site_url().'">
                    <img class="alignnone wp-image-7442 size-full" src="'.$logo.'" alt="logo" width="110" height="40" />
                </a>
            </td>
            <td style="background: #ed8323 none repeat scroll 0 0;color: #fff;font-size: 17px;padding: 21px 45px;text-align: right;" width="80%">
                 <a href="#" style="color: #fff; padding-left: 12px; text-decoration:none ;" >Hotel</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;" >Rental</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;">Car</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;">Tour</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;">Activity</a>
            </td>
            </tr>
            </tbody>
            </table>


            <table id="" class="wrapper" width="90%" cellspacing="0" align="center"  style=" padding-top: 70px; width:800px ; color:#666" >
            <tbody>
            <tr>


            <td style="padding-bottom: 20px; font-size: 20px;">
            Hello <strong style="font-size: 25px;">Administrator</strong>,


            </td>
            </tr>
            <tr>
            <td>
                Have a new user register as <strong style="color:#ed8323">Partner</strong>. Please check info below:
            </td>
            </tr>
            <tr>
            <td style="padding-top: 40px; font-size: 40px; font-weight: 600;">
                Partner Information
            </td>
            </tr>

            <tr>
            <td style="padding-top: 30px;">
                <table style="width: 100%; border-collapse: collapse; color:#666" border="1">
                    <tr>
                        <td style="padding: 20px 30px;">
                        Full Name:
                        </td>
                        <td style="padding: 20px 30px; color:#ed8323 ;border-color:#000">
                        [st_info_full_name]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Username:
                        </td>
                        <td style="padding: 20px 30px; color:#ed8323 ">
                        [st_info_user_name]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Email:
                        </td>
                        <td style="padding: 20px 30px; ">
                        [st_info_user_email]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Register Date:
                        </td>
                        <td style="padding: 20px 30px; ">
                        [st_info_user_date_create]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px; position: relative;">
                            <span  style="position: absolute; top: 20px;" >Services Registration:</span>
                        </td>
                        <td style="padding: 20px 30px; ">
                             [st_info_user_certificates]
                        </td>
                    </tr>
                </table>
            </td>
            </tr>

            <tr>
            <td  style="padding-bottom: 20px; font-size: 20px; padding-top: 50px; text-align: center;">
                 <a href="[st_url_info_user]" target="_blank"  style="
                        background-color: #ed8323;
    border-radius: 5px;
    color: #fff;
    font-family: tahoma;
    font-size: 14px;
    font-weight: 700;
    margin-left: 10px;
    padding: 10px 30px;
    text-decoration: none;" >
                    CHECK NOW
                 </a>
                  <a href="[st_url_list_user_partner]" target="_blank"  style="
                  background-color: #ed8323;
    border-radius: 5px;
    color: #fff;
    font-family: tahoma;
    font-size: 14px;
    font-weight: 700;
    margin-left: 10px;
    padding: 10px 30px;
    text-decoration: none;" >
                    VIEW ALL REQUEST
                 </a>

            </td>
            </tr>

            </tbody>
            </table>

            <table width="100%" cellspacing="0" align="center" style="color: #818181 ; width:800px">
            <tbody>
            <tr>
            <td style="padding-top: 30px; padding-bottom: 20px;" align="center">
               <hr style="color: #ddd">
            </td>
            </tr>
            <tr>
            <td style="" align="center" >'.$social_icon.'</td>
            </tr>
            <tr>
            <td style="padding-top: 20px;" align="center">

            <p>Booking, reviews and advices on hotels, resorts, flights, vacation rentals, travel packages, and lots more!</p>
            '.$footer_menu.'
            </td>
            </tr>
            </tbody>
            </table>
        ';
    }
}

if(!function_exists('st_default_email_template_for_resend_admin_partner')){
    function st_default_email_template_for_resend_admin_partner(){
        $logo = st()->get_option('logo',get_template_directory_uri().'/img/logo-invert.png');
        $footer_menu = '<ul style="list-style: none; text-align: center;">
            <li style="display: inline-block;"><a href="#" style="color: #818181; text-decoration:none ;">'.__("About us", ST_TEXTDOMAIN) .'</a> |</li>
            <li style="display: inline-block;"><a href="#" style="color: #818181 ; text-decoration:none ;">'.__("Contact us", ST_TEXTDOMAIN) .'</a> |</li>
            <li style="display: inline-block;"><a href="#" style="color: #818181;text-decoration:none ;">'.__("News", ST_TEXTDOMAIN) .'</a></li>
            </ul>';
        $social_icon = '
            <a href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/fa.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/tw.png" alt="" width="35" height="35" /></a>
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/gg.png" alt="" width="35" height="35" /></a>
            ';
        return '
            <table id="booking-infomation" class="wrapper" width="90%" cellspacing="0" align="center" style="width:800px" >
            <tbody>
            <tr>
            <td style="padding: 20px 10px; background: #ED8323;" width="20%">
               <a href="'.site_url().'">
                    <img class="alignnone wp-image-7442 size-full" src="'.$logo.'" alt="logo" width="110" height="40" />
                </a>
            </td>
            <td style="background: #ed8323 none repeat scroll 0 0;color: #fff;font-size: 17px;padding: 21px 45px;text-align: right;" width="80%">
                 <a href="#" style="color: #fff; padding-left: 12px; text-decoration:none ;" >Hotel</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;" >Rental</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;">Car</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;">Tour</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;">Activity</a>
            </td>
            </tr>
            </tbody>
            </table>


            <table id="" class="wrapper" width="90%" cellspacing="0" align="center"  style=" padding-top: 70px; width:800px ; color:#666" >
            <tbody>
            <tr>


            <td style="padding-bottom: 20px; font-size: 20px;">
            Hello <strong style="font-size: 25px;">Administrator</strong>,


            </td>
            </tr>
            <tr>
            <td>
                Have one user register as partner has been updated information , please check for approve
            </td>
            </tr>
            <tr>
            <td style="padding-top: 40px; font-size: 40px; font-weight: 600;">
                Partner Information
            </td>
            </tr>

            <tr>
            <td style="padding-top: 30px;">
                <table style="width: 100%; border-collapse: collapse; color:#666" border="1">
                    <tr>
                        <td style="padding: 20px 30px;">
                        Full Name:
                        </td>
                        <td style="padding: 20px 30px; color:#ed8323 ;border-color:#000">
                        [st_info_full_name]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Username:
                        </td>
                        <td style="padding: 20px 30px; color:#ed8323 ">
                        [st_info_user_name]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Email:
                        </td>
                        <td style="padding: 20px 30px; ">
                        [st_info_user_email]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Register Date:
                        </td>
                        <td style="padding: 20px 30px; ">
                        [st_info_user_date_create]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px; position: relative;">
                            <span  style="position: absolute; top: 20px;" >Services Registration:</span>
                        </td>
                        <td style="padding: 20px 30px; ">
                             [st_info_user_certificates]
                        </td>
                    </tr>
                </table>
            </td>
            </tr>

            <tr>
            <td  style="padding-bottom: 20px; font-size: 20px; padding-top: 50px; text-align: center;">
                 <a href="[st_url_info_user]" target="_blank" style="
                        background-color: #ed8323;
    border-radius: 5px;
    color: #fff;
    font-family: tahoma;
    font-size: 14px;
    font-weight: 700;
    margin-left: 10px;
    padding: 10px 30px;
    text-decoration: none;" >
                    CHECK NOW
                 </a>
            </td>
            </tr>

            </tbody>
            </table>

            <table width="100%" cellspacing="0" align="center" style="color: #818181 ; width:800px">
            <tbody>
            <tr>
            <td style="padding-top: 30px; padding-bottom: 20px;" align="center">
               <hr style="color: #ddd">
            </td>
            </tr>
            <tr>
            <td style="" align="center" >'.$social_icon.'</td>
            </tr>
            <tr>
            <td style="padding-top: 20px;" align="center">

            <p>Booking, reviews and advices on hotels, resorts, flights, vacation rentals, travel packages, and lots more!</p>
            '.$footer_menu.'
            </td>
            </tr>
            </tbody>
            </table>
        ';
    }
}

if(!function_exists('st_default_email_template_for_customer_partner')){
    function st_default_email_template_for_customer_partner(){
        $logo = st()->get_option('logo',get_template_directory_uri().'/img/logo-invert.png');
        $footer_menu = '<ul style="list-style: none; text-align: center;">
            <li style="display: inline-block;"><a href="#" style="color: #818181; text-decoration:none ;">'.__("About us", ST_TEXTDOMAIN) .'</a> |</li>
            <li style="display: inline-block;"><a href="#" style="color: #818181 ; text-decoration:none ;">'.__("Contact us", ST_TEXTDOMAIN) .'</a> |</li>
            <li style="display: inline-block;"><a href="#" style="color: #818181;text-decoration:none ;">'.__("News", ST_TEXTDOMAIN) .'</a></li>
            </ul>';
        $social_icon = '
            <a href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/fa.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/tw.png" alt="" width="35" height="35" /></a>
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/gg.png" alt="" width="35" height="35" /></a>
            ';
        return '
            <table id="booking-infomation" class="wrapper" width="90%" cellspacing="0" align="center" style="width:800px" >
            <tbody>
            <tr>
            <td style="padding: 20px 10px; background: #ED8323;" width="20%">
               <a href="'.site_url().'">
                    <img class="alignnone wp-image-7442 size-full" src="'.$logo.'" alt="logo" width="110" height="40" />
                </a>
            </td>
            <td style="background: #ed8323 none repeat scroll 0 0;color: #fff;font-size: 17px;padding: 21px 45px;text-align: right;" width="80%">
                 <a href="#" style="color: #fff; padding-left: 12px; text-decoration:none ;" >Hotel</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;" >Rental</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;">Car</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;">Tour</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;">Activity</a>
            </td>
            </tr>
            </tbody>
            </table>


            <table id="" class="wrapper" width="90%" cellspacing="0" align="center"  style=" padding-top: 70px; width:800px ; color:#666" >
            <tbody>
            <tr>


            <td style="padding-bottom: 20px; font-size: 20px;">
            Hello <strong style="font-size: 25px;">[st_info_full_name]</strong>,


            </td>
            </tr>
            <tr>
            <td>
                Thanh you for your registing as <strong style="color:#ed8323">Partner</strong>. Please check info below:
            </td>
            </tr>
            <tr>
            <td style="padding-top: 40px; font-size: 40px; font-weight: 600;">
                Partner Information
            </td>
            </tr>

            <tr>
            <td style="padding-top: 30px;">
                <table style="width: 100%; border-collapse: collapse; color:#666" border="1">
                    <tr>
                        <td style="padding: 20px 30px;">
                        Full Name:
                        </td>
                        <td style="padding: 20px 30px; color:#ed8323 ;border-color:#000">
                        [st_info_full_name]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Username:
                        </td>
                        <td style="padding: 20px 30px; color:#ed8323 ">
                        [st_info_user_name]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Email:
                        </td>
                        <td style="padding: 20px 30px; ">
                        [st_info_user_email]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Register Date:
                        </td>
                        <td style="padding: 20px 30px; ">
                        [st_info_user_date_create]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px; position: relative;">
                            <span  style="position: absolute; top: 20px;" >Services Registration:</span>
                        </td>
                        <td style="padding: 20px 30px; ">
                             [st_info_user_certificates]
                        </td>
                    </tr>
                </table>
            </td>

            <tr>
            <td  style="padding-bottom: 20px; padding-top: 19px; font-size: 16px;">
                 Please wait until the administrator <strong>approved</strong> your account !

            </td>
            </tr>

            </tbody>
            </table>

            <table width="100%" cellspacing="0" align="center" style="color: #818181 ; width:800px">
            <tbody>
            <tr>
            <td style="padding-top: 30px; padding-bottom: 20px;" align="center">
               <hr style="color: #ddd">
            </td>
            </tr>
            <tr>
            <td style="" align="center" >'.$social_icon.'</td>
            </tr>
            <tr>
            <td style="padding-top: 20px;" align="center">

            <p>Booking, reviews and advices on hotels, resorts, flights, vacation rentals, travel packages, and lots more!</p>
            '.$footer_menu.'
            </td>
            </tr>
            </tbody>
            </table>
        ';
    }
}


if(!function_exists('st_default_email_template_for_customer_approved_partner')){
    function st_default_email_template_for_customer_approved_partner(){
        $logo = st()->get_option('logo',get_template_directory_uri().'/img/logo-invert.png');
        $footer_menu = '<ul style="list-style: none; text-align: center;">
            <li style="display: inline-block;"><a href="#" style="color: #818181; text-decoration:none ;">'.__("About us", ST_TEXTDOMAIN) .'</a> |</li>
            <li style="display: inline-block;"><a href="#" style="color: #818181 ; text-decoration:none ;">'.__("Contact us", ST_TEXTDOMAIN) .'</a> |</li>
            <li style="display: inline-block;"><a href="#" style="color: #818181;text-decoration:none ;">'.__("News", ST_TEXTDOMAIN) .'</a></li>
            </ul>';
        $social_icon = '
            <a href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/fa.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/tw.png" alt="" width="35" height="35" /></a>
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/gg.png" alt="" width="35" height="35" /></a>
            ';
        return '
            <table id="booking-infomation" class="wrapper" width="90%" cellspacing="0" align="center" style="width:800px" >
            <tbody>
            <tr>
            <td style="padding: 20px 10px; background: #ED8323;" width="20%">
               <a href="'.site_url().'">
                    <img class="alignnone wp-image-7442 size-full" src="'.$logo.'" alt="logo" width="110" height="40" />
                </a>
            </td>
            <td style="background: #ed8323 none repeat scroll 0 0;color: #fff;font-size: 17px;padding: 21px 45px;text-align: right;" width="80%">
                 <a href="#" style="color: #fff; padding-left: 12px; text-decoration:none ;" >Hotel</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;" >Rental</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;">Car</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;">Tour</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;">Activity</a>
            </td>
            </tr>
            </tbody>
            </table>


            <table id="" class="wrapper" width="90%" cellspacing="0" align="center"  style=" padding-top: 70px; width:800px ; color:#666" >
            <tbody>
            <tr>


            <td style="padding-bottom: 20px; font-size: 20px;">
            Hello <strong style="font-size: 25px;">[st_info_full_name]</strong>,


            </td>
            </tr>
            <tr>
            <td>
                Congraturation! Your account ready approved as Partner. You can upload content as service register
            </td>
            </tr>



            <tr>
            <td  style="padding-bottom: 20px; padding-top: 19px; font-size: 16px;">
                <a href="#">
                     IF YOU NEED ANY HELP PLEASE CONTACT WITH US HERE
                </a>
            </td>
            </tr>
             <tr>
            <td  style="padding-bottom: 20px; font-size: 20px; padding-top: 50px; ;">
                 <a href="[st_url_partner_dashboard]" target="_blank" style="
                        background-color: #ed8323;
    border-radius: 5px;
    color: #fff;
    font-family: tahoma;
    font-size: 14px;
    font-weight: 700;
    padding: 10px 30px;
    text-decoration: none;" >
                    STARTING NOW
                 </a>


            </td>
            </tr>

            </tbody>
            </table>

            <table width="100%" cellspacing="0" align="center" style="color: #818181 ; width:800px">
            <tbody>
            <tr>
            <td style="padding-top: 30px; padding-bottom: 20px;" align="center">
               <hr style="color: #ddd">
            </td>
            </tr>
            <tr>
            <td style="" align="center" >'.$social_icon.'</td>
            </tr>
            <tr>
            <td style="padding-top: 20px;" align="center">

            <p>Booking, reviews and advices on hotels, resorts, flights, vacation rentals, travel packages, and lots more!</p>
            '.$footer_menu.'
            </td>
            </tr>
            </tbody>
            </table>
        ';
    }
}

if(!function_exists('st_default_email_template_for_customer_cancel_partner')){
    function st_default_email_template_for_customer_cancel_partner(){
        $logo = st()->get_option('logo',get_template_directory_uri().'/img/logo-invert.png');
        $footer_menu = '<ul style="list-style: none; text-align: center;">
            <li style="display: inline-block;"><a href="#" style="color: #818181; text-decoration:none ;">'.__("About us", ST_TEXTDOMAIN) .'</a> |</li>
            <li style="display: inline-block;"><a href="#" style="color: #818181 ; text-decoration:none ;">'.__("Contact us", ST_TEXTDOMAIN) .'</a> |</li>
            <li style="display: inline-block;"><a href="#" style="color: #818181;text-decoration:none ;">'.__("News", ST_TEXTDOMAIN) .'</a></li>
            </ul>';
        $social_icon = '
            <a href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/fa.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/tw.png" alt="" width="35" height="35" /></a>
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/gg.png" alt="" width="35" height="35" /></a>
            ';
        return '
            <table id="booking-infomation" class="wrapper" width="90%" cellspacing="0" align="center" style="width:800px" >
            <tbody>
            <tr>
            <td style="padding: 20px 10px; background: #ED8323;" width="20%">
               <a href="'.site_url().'">
                    <img class="alignnone wp-image-7442 size-full" src="'.$logo.'" alt="logo" width="110" height="40" />
                </a>
            </td>
            <td style="background: #ed8323 none repeat scroll 0 0;color: #fff;font-size: 17px;padding: 21px 45px;text-align: right;" width="80%">
                 <a href="#" style="color: #fff; padding-left: 12px; text-decoration:none ;" >Hotel</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;" >Rental</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;">Car</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;">Tour</a>
                 <a href="#" style="color: #fff; padding-left: 20px; text-decoration:none ;">Activity</a>
            </td>
            </tr>
            </tbody>
            </table>


            <table id="" class="wrapper" width="90%" cellspacing="0" align="center"  style=" padding-top: 70px; width:800px ; color:#666" >
            <tbody>
            <tr>


            <td style="padding-bottom: 20px; font-size: 20px;">
            Hello <strong style="font-size: 25px;">[st_info_full_name]</strong>,


            </td>
            </tr>
            <tr>
            <td>
                Sorry! Your account is <strong>not</strong> ready approved as Partner. You should update your information again for match with our requirement
            </td>
            </tr>
            <tr>
            <td  style="padding-bottom: 20px; padding-top: 19px; font-size: 16px;">
                <a href="#">
                     IF YOU NEED ANY HELP PLEASE CONTACT WITH US HERE
                </a>
            </td>
            </tr>
             <tr>
            <td  style="padding-bottom: 20px; font-size: 20px; padding-top: 50px; ;">
                  <a href="[st_url_update_certificates]" target="_blank" style="
                        background-color: #ed8323;
    border-radius: 5px;
    color: #fff;
    font-family: tahoma;
    font-size: 14px;
    font-weight: 700;
    padding: 10px 30px;
    text-decoration: none;" >
                    UPDATE NOW
                 </a>


            </td>
            </tr>

            </tbody>
            </table>

            <table width="100%" cellspacing="0" align="center" style="color: #818181 ; width:800px">
            <tbody>
            <tr>
            <td style="padding-top: 30px; padding-bottom: 20px;" align="center">
               <hr style="color: #ddd">
            </td>
            </tr>
            <tr>
            <td style="" align="center" >'.$social_icon.'</td>
            </tr>
            <tr>
            <td style="padding-top: 20px;" align="center">

            <p>Booking, reviews and advices on hotels, resorts, flights, vacation rentals, travel packages, and lots more!</p>
            '.$footer_menu.'
            </td>
            </tr>
            </tbody>
            </table>
        ';
    }
}
