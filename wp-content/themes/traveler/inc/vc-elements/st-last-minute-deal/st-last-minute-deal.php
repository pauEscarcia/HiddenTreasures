<?php
$list1 = ( STLocation::get_post_type_list_active() );

$list = array();
$list = array( __( '--Select--' , ST_TEXTDOMAIN ) => '' );
if(!empty( $list1 ) and is_array( $list1 )) {
    foreach( $list1 as $key => $value ) {
        if($value == 'st_cars') {
            $list[ __( 'Car' , ST_TEXTDOMAIN ) ] = $value;
        }
        if($value == 'st_tours') {
            $list[ __( 'Tour' , ST_TEXTDOMAIN ) ] = $value;
        }
        if($value == 'st_hotel') {
            $list[ __( 'Hotel' , ST_TEXTDOMAIN ) ] = $value;
        }
        if($value == 'st_rental') {
            $list[ __( 'Rental' , ST_TEXTDOMAIN ) ] = $value;
        }
        if($value == 'st_activity') {
            $list[ __( 'Activity' , ST_TEXTDOMAIN ) ] = $value;
        }
    }
}
if(function_exists( 'vc_map' )) {
    vc_map( array(
        "name"            => __( "ST Last Minute Deal" , ST_TEXTDOMAIN ) ,
        "base"            => "st_last_minute_deal" ,
        "content_element" => true ,
        "icon"            => "icon-st" ,
        "category"        => "Shinetheme" ,
        "params"          => array(
            array(
                "type"        => "dropdown" ,
                "holder"      => "div" ,
                "heading"     => __( "Post type" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_post_type" ,
                "description" => "" ,
                'value'       => $list ,
            ) ,
        )
    ) );
}
if(!function_exists( 'st_vc_last_minute_deal' )) {
    function st_vc_last_minute_deal( $attr , $content = false )
    {
        $data = shortcode_atts(
            array(
                'st_post_type' => 'st_hotel' ,
            ) , $attr , 'st_last_minute_deal' );
        extract( $data );
        $html = "";
        global $wpdb;
        $query = null;
        switch($st_post_type){
            case "st_hotel":
                $query = "SELECT {$wpdb->posts}.ID as room_id, st_meta1.meta_value , st_meta2.meta_value as hotel_id
                            FROM {$wpdb->posts}
                            INNER JOIN {$wpdb->postmeta} as st_meta1 ON ( {$wpdb->posts}.ID = st_meta1.post_id ) AND st_meta1.meta_key = 'sale_price_from'
                            INNER JOIN {$wpdb->postmeta} as st_meta2 ON ( {$wpdb->posts}.ID = st_meta2.post_id ) AND st_meta2.meta_key = 'room_parent'
                            INNER JOIN {$wpdb->postmeta} as st_meta3 ON ( {$wpdb->posts}.ID = st_meta3.post_id ) AND st_meta3.meta_key = 'is_sale_schedule'
                            WHERE 1=1
                            AND st_meta3.meta_value= 'on'
                            AND {$wpdb->posts}.post_type = 'hotel_room'
                            ORDER BY st_meta1.meta_value DESC
                            LIMIT 0,1";


                break;
            case "st_rental":
            case "st_cars":
            case "st_tours":
            case "st_activity":
                $query = "
                    SELECT {$wpdb->posts}.ID as object_id
                    FROM {$wpdb->posts}
                    INNER JOIN {$wpdb->postmeta} as st_meta1 ON ( {$wpdb->posts}.ID = st_meta1.post_id ) AND st_meta1.meta_key = 'sale_price_from'
                    INNER JOIN {$wpdb->postmeta} as st_meta2 ON ( {$wpdb->posts}.ID = st_meta2.post_id ) AND st_meta2.meta_key = 'is_sale_schedule'
                    WHERE 1=1
                    AND st_meta2.meta_value= 'on'
                    AND {$wpdb->posts}.post_type = '{$st_post_type}'
                    ORDER BY st_meta1.meta_value DESC
                    LIMIT 0,1
                ";
                break;
        }
        $rs = $wpdb->get_row($query);
        if(!empty($rs)){
            $data['rs'] = $rs;
            $html =  st()->load_template('vc-elements/st-last-minute-deal/html',$st_post_type, $data);
        }
        return $html;
    }
}
st_reg_shortcode( 'st_last_minute_deal' , 'st_vc_last_minute_deal' );