<?php
vc_map( array(
    "name" => __("ST List Tour", STP_TEXTDOMAIN),
    "base" => "st_list_tour",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>"Shinetheme",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Number tour", STP_TEXTDOMAIN),
            "param_name" => "st_number_tour",
            "description" =>"",
            'value'=>4,
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Order By", STP_TEXTDOMAIN),
            "param_name" => "st_orderby",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-6',
            'value'=>function_exists('st_get_list_order_by')?st_get_list_order_by(
                array(
                    __('Price',STP_TEXTDOMAIN) => 'sale' ,
                    __('Rate',STP_TEXTDOMAIN) => 'rate',
                    __('Discount',STP_TEXTDOMAIN)=>'discount',
                    __('Last Minute Deal',STP_TEXTDOMAIN)=>'last_minute_deal',
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
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Style hotel", STP_TEXTDOMAIN),
            "param_name" => "st_style",
            "description" =>"",
            'value'=>array(
                __('Style 1',STP_TEXTDOMAIN)=>'style_1',
                __('Style 2',STP_TEXTDOMAIN)=>'style_2',
                __('Style 3',STP_TEXTDOMAIN)=>'style_3',
                __('Style 4',STP_TEXTDOMAIN)=>'style_4',
            ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Number tour of row", STP_TEXTDOMAIN),
            "param_name" => "st_tour_of_row",
            'edit_field_class'=>'vc_col-sm-12',
            "value" => array(
                __('Four',STP_TEXTDOMAIN)=>'4',
                __('Three',STP_TEXTDOMAIN)=>'3',
                __('Two',STP_TEXTDOMAIN)=>'2',
            ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Only in Featured Location", STP_TEXTDOMAIN),
            "param_name" => "only_featured_location",
            'edit_field_class'=>'vc_col-sm-12',
            "value" => array(
                __('No',STP_TEXTDOMAIN)=>'no',
                __('Yes',STP_TEXTDOMAIN)=>'yes',
            ),
        ),
    )
) );

Class st_list_tour extends STBasedShortcode{

    function __construct()
    {
        parent::__construct();
    }


    function content($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_number_tour' =>0,
                'st_order'=>'',
                'st_orderby'=>'',
                'st_tour_of_row'=>'',
                'st_style'=>'',
                'only_featured_location'=>'',
            ), $attr, 'st_list_tour' );
        extract($data);

        $page=STInput::request('paged');
        if(!$page)
        {
            $page=get_query_var('paged');
        }
        $query=array(
            'post_type' => 'st_tours',
            'posts_per_page'=>$st_number_tour,
            'paged'=> $page ,
            'order'=>$st_order,
            'orderby'=>$st_orderby
        );

        if($st_orderby == 'sale'){
            $query['meta_key']='price';
            $query['orderby']='meta_value';
        }
        if($st_orderby == 'rate'){
            $query['meta_key']='rate_review';
            $query['orderby']='meta_value';
        }
        if($st_orderby == 'discount'){
            $query['meta_key']='discount';
            $query['orderby']='meta_value';
        }
        if($st_orderby == 'last_minute_deal'){

            /*$query['meta_key']='discount';
            $query['orderby']='meta_value';
            $query['order']='DESC';*/
            $query['meta_query'][]=array(
                'key'=>'is_sale_schedule',
                'value'=>'on',
                'compare'=>"="
            );

        }

        if($only_featured_location=='yes'){

            $STLocation=new STLocation();
            $featured=$STLocation->get_featured_ids();

            $query['meta_query'][]=array(
                'key'=>'id_location',
                'value'=>$featured,
                'compare'=>"IN"
            );
        }
        query_posts($query);

        if($st_style == 'style_1'){
            $r="<div class='list_tours'>".st()->load_template('vc-elements/st-list-tour/loop','',$data)."</div>";
        }
        if($st_style == 'style_2'){
            $r="<div class='list_tours'>".st()->load_template('vc-elements/st-list-tour/loop2','',$data)."</div>";
        }
        if($st_style == 'style_3'){
            $r="<div class='list_tours'>".st()->load_template('vc-elements/st-list-tour/loop3','',$data)."</div>";
        }
        if($st_style == 'style_4'){
            $r="<div class='list_tours'>".st()->load_template('vc-elements/st-list-tour/loop4','',$data)."</div>";
        }
        /*TravelHelper::paging();*/
        wp_reset_query();

        return $r;
    }
}

new st_list_tour();