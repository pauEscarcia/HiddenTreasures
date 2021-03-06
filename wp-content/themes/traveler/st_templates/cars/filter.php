<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars filter
 *
 * Created by ShineTheme
 *
 */
if(!isset($instance)) $instance=array();
$default=array(
    'title'=>st_get_language('car_filter_by').':',
    'st_search_fields'=>'',
    'st_style'=>''
);

extract(wp_parse_args($instance,$default));

$all_fields=json_decode($st_search_fields);

if($st_style =='dark' ){
    $class_side_bar = 'booking-filters text-white';
}else{
    $class_side_bar = 'booking-filters booking-filters-white ';
}
?>
<aside class="cars-filters <?php echo esc_attr($class_side_bar) ?> <?php if($st_style=='dark') echo 'text-white'; else echo 'booking-filters-white';?>">
    <h3><?php echo apply_filters( 'widget_title' , $title)?></h3>
    <ul class="list booking-filters-list">
        <?php 
        if (is_array($all_fields) and !empty($all_fields)) {
        foreach($all_fields as $k=>$v): ?>
            <?php if($v->field == 'taxonomy'){
                $all_attribute=get_terms($v->taxonomy);
                if(!is_wp_error($all_attribute)){
                ?>
                <li>
                    <h5 class="booking-filters-title"><?php echo apply_filters('widget_title',$v->title) ?></h5>
                    <?php
                    $key   = $v->taxonomy;
                    echo '<div>';
                    foreach( $all_attribute as $key2 => $value2 ) :

                        $current = STInput::get( 'taxonomy' );

                        if(isset( $current[ $key ] ))
                            $current = $current[ $key ];
                        else $current = '';

                        $checked = TravelHelper::checked_array( explode( ',' , $current ) , $value2->term_id );

                        if($checked) {
                            $link = TravelHelper::build_url_array( 'taxonomy' , $key , $value2->term_id , false );
                        } else {
                            $link = TravelHelper::build_url_array( 'taxonomy' , $key , $value2->term_id );
                        }
                        ?>
                        <div class="checkbox">
                            <label>
                                <input <?php if($checked) echo "checked" ?> value="<?php echo esc_attr( $value2->term_id )?>" name="star_rate" data-url="<?php echo esc_url( $link ) ?>" class="i-check" type="checkbox"/> <?php echo esc_html( $value2->name )?>
                            </label>
                        </div>
                    <?php endforeach; echo '</div>';?>
                </li>
            <?php } }; ?>
            <?php if($v->field == 'price'){ ?>
                <li>
                    <h5 class="booking-filters-title"><?php st_the_language('car_price') ?></h5>
                    <?php  echo st()->load_template('cars/filter_price'); ?>
                </li>
            <?php }; ?>
        <?php endforeach; 
    }?>
    </ul>
</aside>
<script>
    jQuery(document).ready(function($){
        $('.cars-filters input[type=checkbox]').on('ifClicked', function(event){
            var url=$(this).attr('data-url');
            if(url){
                window.location.href=url;
            }
        });
    });
</script>