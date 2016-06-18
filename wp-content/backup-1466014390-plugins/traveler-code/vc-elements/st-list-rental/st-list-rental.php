<?php
vc_map( array(
    "name" => __("ST List Rental", STP_TEXTDOMAIN),
    "base" => "st_list_rental",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>"Shinetheme",
    "params" => array(

        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Number", STP_TEXTDOMAIN),
            "param_name" => "number",
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
                    __('Sale',STP_TEXTDOMAIN) => 'sale' ,
                    __('Featured',STP_TEXTDOMAIN) => 'featured' ,
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
            "param_name" => "number_of_row",
            'edit_field_class'=>'vc_col-sm-12',
            "description" =>__('',STP_TEXTDOMAIN),
            "value" => array(
                __('Four',STP_TEXTDOMAIN)=>'4',
                __('Three',STP_TEXTDOMAIN)=>'3',
                __('Two',STP_TEXTDOMAIN)=>'2',
            ),
        ),
    )
) );

Class st_list_rental extends STBasedShortcode{

    function __construct()
    {
        parent::__construct();
    }


    function content($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'taxonomy'=>'',
                'number' =>0,
                'st_order'=>'',
                'st_orderby'=>'',
                'number_of_row'=>4,
            ), $attr, 'st_list_rental' );
        extract($data);


        $query=array(
            'post_type' => 'st_rental',
            'posts_per_page'=>$number,
            'order'=>$st_order,
            'orderby'=>$st_orderby
        );

        if($st_orderby == 'sale'){
            $query['meta_key']='price';
            $query['orderby']='meta_value';
        }
        if($st_orderby == 'featured'){
            $query['meta_key']='cars_set_as_featured';
            $query['orderby']='meta_value';
        }

        query_posts($query);
        $txt = '';
        while(have_posts()){
            the_post();
            $txt .= st()->load_template('vc-elements/st-list-rental/loop','list',array('attr'=>$attr,'data'=>$data));;
        }
        wp_reset_query();
        return '<div class="row row-wrap">'.$txt.'</div>';
    }
}

new st_list_rental();