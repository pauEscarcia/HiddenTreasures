<?php
vc_map( array(
    "name" => __("ST List Location", STP_TEXTDOMAIN),
    "base" => "st_list_location",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>"Shinetheme",
    "params" => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Type", STP_TEXTDOMAIN),
            "param_name" => "st_type",
            "description" =>"",
            'value'=>array(
                __('Hotel',STP_TEXTDOMAIN)=>'st_hotel',
                __('Car',STP_TEXTDOMAIN)=>'st_cars',
                __('Tour',STP_TEXTDOMAIN)=>'st_tours',
                __('Rental',STP_TEXTDOMAIN)=>'st_rental',
                __('Activities',STP_TEXTDOMAIN)=>'st_activity',
//                __('Cruise',STP_TEXTDOMAIN)=>'cruise',
            ),
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Number Location", STP_TEXTDOMAIN),
            "param_name" => "st_number",
            "description" =>"",
            'value'=>4,
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Items per row", STP_TEXTDOMAIN),
            "param_name" => "st_col",
            "description" =>"",
            "value" => array(
                __('Four',STP_TEXTDOMAIN)=>'4',
                __('Three',STP_TEXTDOMAIN)=>'3',
                __('Two',STP_TEXTDOMAIN)=>'2',
            ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Style location",STP_TEXTDOMAIN),
            "param_name" => "st_style",
            "value" => array(
                __('Normal',STP_TEXTDOMAIN)=>'normal',
                __('Curved',STP_TEXTDOMAIN)=>'curved',
            ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Show Logo",STP_TEXTDOMAIN),
            "param_name" => "st_show_logo",
            'edit_field_class'=>'vc_col-sm-6',
            "value" => array(
                __('Yes',STP_TEXTDOMAIN)=>'yes',
                __('No',STP_TEXTDOMAIN)=>'no',
            ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Logo Position",STP_TEXTDOMAIN),
            "param_name" => "st_logo_position",
            'edit_field_class'=>'vc_col-sm-6',
            "value" => array(
                __('Left',STP_TEXTDOMAIN)=>'left',
                __('Right',STP_TEXTDOMAIN)=>'right',
            ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Order By", STP_TEXTDOMAIN),
            "param_name" => "st_orderby",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-6',
            'value'=>function_exists('st_get_list_order_by')? st_get_list_order_by(
                array(
                    __('Sale',STP_TEXTDOMAIN) => 'sale' ,
                    __('Rate',STP_TEXTDOMAIN) => 'rate',
                    __('Min Price',STP_TEXTDOMAIN) => 'price',
                )
            ):array(),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Order",STP_TEXTDOMAIN),
            "param_name" => "st_order",
            'value'=>array(
                __('Asc',STP_TEXTDOMAIN)=>'asc',
                __('Desc',STP_TEXTDOMAIN)=>'desc'
            ),
            'edit_field_class'=>'vc_col-sm-6',
            "description" => __("",STP_TEXTDOMAIN)
        ),
    )
) );

Class st_list_location extends STBasedShortcode{

    function __construct()
    {
        parent::__construct();
    }


    function content($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_type'=>'st_hotel',
                'st_number' =>0,
                'st_col'=>4,
                'st_style'=>'',
                'st_show_logo'=>'',
                'st_logo_position'=>'',
                'st_orderby'=>'',
                'st_order'=>'',
            ), $attr, 'st_list_location' );
        extract($data);
        $query=array(
            'post_type' => 'location',
            'posts_per_page'=>$st_number,
            'order'=>$st_order,
            'orderby'=>$st_orderby
        );

        if($st_orderby == 'price'){
            $query['meta_key']='min_price_'.$st_type.'';
            $query['orderby']='meta_value';
        }
        if($st_orderby == 'sale'){
            $query['meta_key']='total_sale_number';
            $query['orderby']='meta_value';
        }
        if($st_orderby == 'rate'){
            $query['meta_key']='review_'.$st_type.'';
           $query['orderby']='meta_value';
        }
        query_posts($query);
        $r =  st()->load_template('vc-elements/st-list-location/loop',$st_style,$data); ;
        wp_reset_query();
        return $r;
    }
}

new st_list_location();