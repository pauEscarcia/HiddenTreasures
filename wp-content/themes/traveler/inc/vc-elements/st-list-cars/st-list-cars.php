<?php
if(!st_check_service_available( 'st_cars' )) {
    return;
}
if(function_exists( 'vc_map' ) and class_exists( 'TravelerObject' )) {
    $list_taxonomy = st_list_taxonomy( 'st_cars' );
    $list_taxonomy = array_merge( array( "---Select---" => "" ) , $list_taxonomy );

    $list_location                                              = TravelerObject::get_list_location();
    $list_location_data[ __( '-- Select --' , ST_TEXTDOMAIN ) ] = '';
    if(!empty( $list_location )) {
        foreach( $list_location as $k => $v ) {
            $list_location_data[ $v[ 'title' ] ] = $v[ 'id' ];
        }
    }

    $param = array(
        array(
            "type"        => "textfield" ,
            "holder"      => "div" ,
            "heading"     => __( "List ID in Car" , ST_TEXTDOMAIN ) ,
            "param_name"  => "st_ids" ,
            "description" => __( "Ids separated by commas" , ST_TEXTDOMAIN ) ,
            'value'       => "" ,
        ) ,
        //        array(
        //            "type"        => "dropdown" ,
        //            "holder"      => "div" ,
        //            "heading"     => __( "Select Taxonomy" , ST_TEXTDOMAIN ) ,
        //            "param_name"  => "taxonomy" ,
        //            "description" => "" ,
        //            "value"       => st_list_taxonomy( 'st_cars' ) ,
        //        ) ,
        array(
            "type"        => "textfield" ,
            "holder"      => "div" ,
            "heading"     => __( "Number cars" , ST_TEXTDOMAIN ) ,
            "param_name"  => "st_number_cars" ,
            "description" => "" ,
            'value'       => 4 ,
        ) ,
        array(
            "type"             => "dropdown" ,
            "holder"           => "div" ,
            "heading"          => __( "Order By" , ST_TEXTDOMAIN ) ,
            "param_name"       => "st_orderby" ,
            "description"      => "" ,
            'edit_field_class' => 'vc_col-sm-6' ,
            'value'            => function_exists( 'st_get_list_order_by' ) ? st_get_list_order_by(
                array(
                    __( 'Sale' , ST_TEXTDOMAIN )     => 'sale' ,
                    __( 'Featured' , ST_TEXTDOMAIN ) => 'featured' ,
                )
            ) : array() ,
        ) ,
        array(
            "type"             => "dropdown" ,
            "holder"           => "div" ,
            "heading"          => __( "Order" , ST_TEXTDOMAIN ) ,
            "param_name"       => "st_order" ,
            'value'            => array(
                __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                __( 'Asc' , ST_TEXTDOMAIN )        => 'asc' ,
                __( 'Desc' , ST_TEXTDOMAIN )       => 'desc'
            ) ,
            'edit_field_class' => 'vc_col-sm-6' ,
        ) ,
        array(
            "type"             => "dropdown" ,
            "holder"           => "div" ,
            "heading"          => __( "Items per row" , ST_TEXTDOMAIN ) ,
            "param_name"       => "st_cars_of_row" ,
            'edit_field_class' => 'vc_col-sm-12' ,
            "value"            => array(
                __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                __( 'Four' , ST_TEXTDOMAIN )       => 4 ,
                __( 'Three' , ST_TEXTDOMAIN )      => 3 ,
                __( 'Two' , ST_TEXTDOMAIN )        => 2 ,
            ) ,
        ) ,
        array(
            "type"        => "dropdown" ,
            "holder"      => "div" ,
            "heading"     => __( "Sort By Taxonomy" , ST_TEXTDOMAIN ) ,
            "param_name"  => "sort_taxonomy" ,
            "description" => "" ,
            "value"       => $list_taxonomy ,
        ) ,
        array(
            "type"        => "dropdown" ,
            "holder"      => "div" ,
            "heading"     => __( "Location" , ST_TEXTDOMAIN ) ,
            "param_name"  => "st_location" ,
            "description" => __( "Location" , ST_TEXTDOMAIN ) ,
            'value'       => $list_location_data ,
        ) ,
    );

    $data_vc = STCars::get_taxonomy_and_id_term_car();
    $param   = array_merge( $param , $data_vc[ 'list_vc' ] );
    vc_map( array(
        "name"            => __( "ST List of Cars" , ST_TEXTDOMAIN ) ,
        "base"            => "st_list_cars" ,
        "content_element" => true ,
        "icon"            => "icon-st" ,
        "category"        => "Shinetheme" ,
        "params"          => $param
    ) );
}
if(!function_exists( 'st_vc_list_cars' )) {
    function st_vc_list_cars( $attr , $content = false )
    {
        $data_vc = STCars::get_taxonomy_and_id_term_car();
        $param   = array(
            'st_ids'         => '' ,
            'taxonomy'       => '' ,
            'st_number_cars' => 4 ,
            'st_order'       => '' ,
            'st_orderby'     => '' ,
            'st_cars_of_row' => 4 ,
            'sort_taxonomy'  => '' ,
            'st_location'    => '' ,
            'only_featured_location'    => 'no' ,
        );
        $param   = array_merge( $param , $data_vc[ 'list_id_vc' ] );
        $data    = wp_parse_args( $attr , $param );
        extract( $data );
        $query = array(
            'post_type'      => 'st_cars' ,
            'posts_per_page' => $st_number_cars ,
            'order'          => $st_order ,
            'orderby'        => $st_orderby
        );
        if(!empty( $st_ids )) {
            $query[ 'post__in' ] = explode( ',' , $st_ids );
            $query[ 'orderby' ]  = 'post__in';
        }
        if($st_orderby == 'sale') {
            $query[ 'meta_key' ] = 'cars_price';
            $query[ 'orderby' ]  = 'meta_value';
        }
        if($st_orderby == 'featured') {
            $query[ 'meta_key' ] = 'is_featured';
            $query[ 'orderby' ]  = 'meta_value';
        }
        if(!empty( $sort_taxonomy )) {
            if(isset( $attr[ "id_term_" . $sort_taxonomy ] )) {
                $id_term              = $attr[ "id_term_" . $sort_taxonomy ];
                $query[ 'tax_query' ] = array(
                    array(
                        'taxonomy' => $sort_taxonomy ,
                        'field'    => 'id' ,
                        'terms'    => explode( ',' , $id_term )
                    ) ,
                );
            }
        }

        $_SESSION[ 'el_only_featured_location' ] = $only_featured_location;
        $_SESSION[ 'st_st_location' ]            = $st_location;
        $_SESSION[ 'el_featured' ]               = array();
        if($only_featured_location == 'yes') {
            $STLocation                = new STLocation();
            $featured                  = $STLocation->get_featured_ids(array('posts_per_page'=>100));
            $_SESSION[ 'el_featured' ] = $featured;
        }
        $st_list_car = new st_list_car();
        if($only_featured_location == 'yes' || !empty( $st_location )) {
            add_filter( 'posts_where' , array( $st_list_car , '_get_query_where' ) );
            add_filter( 'posts_join' , array( $st_list_car , '_get_query_join' ) );
        }

        $query[ 'meta_query' ][ ] = array(
            'key'     => 'number_car' ,
            'value'   => 0 ,
            'compare' => ">",
            'type ' => "NUMERIC",
        );
        query_posts( $query );
        global $wp_query;
        $txt = '';
        while( have_posts() ) {
            the_post();
            $txt .= st()->load_template( 'vc-elements/st-list-cars/loop' , 'list' , array(
                'attr'  => $attr ,
                'data_' => $data
            ) );;
        }
        remove_filter( 'posts_where' , array( $st_list_car , '_get_query_where' ) );
        remove_filter( 'posts_join' , array( $st_list_car , '_get_query_join' ) );
        unset( $_SESSION[ 'el_only_featured_location' ] );
        unset( $_SESSION[ 'st_st_location' ] );
        unset( $_SESSION[ 'el_featured' ] );

        wp_reset_query();
        return '<div class="row row-wrap">' . $txt . '</div>';
    }
}
if(st_check_service_available( 'st_cars' )) {
    st_reg_shortcode( 'st_list_cars' , 'st_vc_list_cars' );
}

if(!class_exists( 'st_list_car' )) {
    class st_list_car
    {
        static function _get_query_where( $where )
        {
            if(!TravelHelper::checkTableDuplicate( 'st_cars' ))
                return $where;
            global $wpdb;

            $only_featured_location = $_SESSION[ 'el_only_featured_location' ];
            $st_location            = $_SESSION[ 'st_st_location' ];
            $featured               = $_SESSION[ 'el_featured' ];
            if($only_featured_location == 'yes') {
                if(is_array( $featured ) && count( $featured )) {
                    $where .= " AND (";
                    $where_tmp = "";
                    foreach( $featured as $item ) {
                        if(empty( $where_tmp )) {
                            $where_tmp .= " tb.multi_location LIKE '%_{$item}_%'";
                        } else {
                            $where_tmp .= " OR tb.multi_location LIKE '%_{$item}_%'";
                        }
                    }
                    $featured = implode( ',' , $featured );
                    $where_tmp .= " OR tb.id_location IN ({$featured})";
                    $where .= $where_tmp . ")";
                }
            } else {
                if(!empty( $st_location )) {
                    $where = TravelHelper::_st_get_where_location($st_location,array('st_cars'),$where);
                }
            }
            return $where;
        }

        static function _get_query_join( $join )
        {
            if(!TravelHelper::checkTableDuplicate( 'st_cars' ))
                return $join;
            global $wpdb;

            $table = $wpdb->prefix . 'st_cars';

            $join .= " INNER JOIN {$table} as tb ON {$wpdb->prefix}posts.ID = tb.post_id";

            return $join;
        }
    }
}