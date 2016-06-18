<?php  
  $zoom = get_post_meta(get_the_ID(),'map_zoom' , true );
  if (empty($zoom) or !$zoom) {$zoom = 15;}
  $default = array(
    'tab_icon_' =>'fa fa-map-marker',
    'map_height'  => 500 , 
    'map_spots' => 99,
    'map_location_style'  =>'normal',
    'tab_item_key'  => "location_map",
    'show_circle' => ''
    );
  $data = extract(wp_parse_args( $default, $value ));
  $st_type = array();
  if ($is_hotel  = st_check_service_available( 'st_hotel' )){ $st_type[]= 'st_hotel' ;}
  if ($is_cars = st_check_service_available('st_cars')) {$st_type[] = 'st_cars'; }
  if ($st_tours = st_check_service_available('st_tours')) {$st_type[] = 'st_tours'; }
  if ($st_rental = st_check_service_available('st_rental')) {$st_type[] = 'st_rental'; }
  if ($st_activity = st_check_service_available('st_activity')) {$st_type[] = 'st_activity'; }
  $st_type = implode($st_type, ',');
  ?> <div class='col-xs-12'><?php
  echo do_shortcode('
    [st_list_map_new st_list_location="'.get_the_ID().'" st_type="st_hotel,st_cars,st_tours,st_rental,st_activity" number="'.$map_spots.'" zoom="'.$zoom.'" height="'.$map_height.'"  " style_map="'.$map_location_style.'"]'
    );
    ?> </div>
