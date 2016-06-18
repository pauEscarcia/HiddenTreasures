<?php
vc_map( array(
    "name" => __("ST List Activity", STP_TEXTDOMAIN),
    "base" => "st_list_activity",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>"Shinetheme",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Number", STP_TEXTDOMAIN),
            "param_name" => "st_number",
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
                    __('Discount',STP_TEXTDOMAIN)=>'discount'
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
            "heading" => __("Number of row", STP_TEXTDOMAIN),
            "param_name" => "st_of_row",
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

Class st_list_activity extends STBasedShortcode{

    function __construct()
    {
        parent::__construct();
    }


    function content($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_number' =>0,
                'st_order'=>'',
                'st_orderby'=>'',
                'st_of_row'=>'',
                'only_featured_location'=>'',
            ), $attr, 'st_list_activity' );
        extract($data);

        $page=STInput::request('paged');
        if(!$page)
        {
            $page=get_query_var('paged');
        }
        $query=array(
            'post_type' => 'st_activity',
            'posts_per_page'=>$st_number,
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

        $r="<div class='list_tours'>".st()->load_template('vc-elements/st-list-activity/loop','',$data)."</div>";


        /*TravelHelper::paging();*/
        wp_reset_query();

        return $r;
    }
}

new st_list_activity();