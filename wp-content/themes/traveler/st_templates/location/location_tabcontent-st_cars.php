<?php 
    $st_location_style = "list";
    if (st()->get_option('location_posts_per_page')){$st_location_num = st()->get_option('location_posts_per_page') ; }
    if (st()->get_option('location_order')){$st_location_order = st()->get_option('location_order') ; }
    if (st()->get_option('location_order_by')){$st_location_orderby = st()->get_option('location_order_by') ; }
    
    global $wp_query, $st_search_query;
    $location_id = get_the_ID();
    $location_title = get_the_title();
    $post_type = "st_cars";
    $query=array(
        'post_type' => $post_type,
        'post_status'=>'publish',
        'posts_per_page'=>$st_location_num,
        'order'=>$st_location_order,
        'orderby'=>$st_location_orderby,
    );
    $return = "";  

    if (STInput::request('style')){$st_location_style = STInput::request('style');};

    if ($st_location_style =="list"){
        $return .='<ul class="booking-list loop-cars style_list">' ; 
    }else {
        $return .='<div class="row row-wrap">';
    }
    
    $cars = new STCars();

    add_filter('posts_join' , array($cars , '_get_join_query'));
    add_filter('posts_where' , array($cars , '_get_where_query_tab_location'));

    $query[ 'meta_query' ][ ] = array(
        'key'     => 'number_car' ,
        'value'   => 0 ,
        'compare' => ">",
        'type ' => "NUMERIC",
    );
    query_posts($query); 
    
    remove_filter('posts_join' , array($cars , '_get_join_query'));
    remove_filter('posts_where' , array($cars , '_get_where_query_tab_location'));
    
    if (have_posts()){
        while(have_posts()){
            the_post();
            if ($st_location_style =="list"){
                    $return .=st()->load_template('cars/elements/loop/loop-1');
                }else {
                    $return .=st()->load_template('cars/elements/loop/loop-2');
                }
        }
    }else {
        echo '<div class="col-xs-12"><div class="alert alert-warning">'.__("There are no available car for this location, time and/or date you selected.",ST_TEXTDOMAIN).'</div></div>';
    }
    
    

    if ($st_location_style =="list"){
        $return .='</ul>' ; 
    }else {
        $return .="</div>";
    } 

    $array = array(
        'post_type'=>$post_type,
        'location_title' =>$location_title,
        'location_id' =>$location_id,
        'post_type'=>$post_type
        );
    $return .= st()->load_template('location/result_string', null, $array);
    wp_reset_query();
echo "<div class='col-md-12 col-xs-12'>".balancetags($return)."</div>";