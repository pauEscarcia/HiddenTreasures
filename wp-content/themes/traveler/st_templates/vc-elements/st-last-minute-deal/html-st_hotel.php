<?php
$room_id = $rs->room_id;
$hotel_id = $rs->hotel_id;
$date  = date_i18n('l d M',strtotime(get_post_meta($room_id,'sale_price_from' ,true)))." - ".date_i18n('l d M',strtotime(get_post_meta($room_id ,'sale_price_to' ,true)));
$price     = get_post_meta( $room_id , 'price' , true );
$discount         = get_post_meta( $room_id , 'discount_rate' , true );
if($discount) {
    if($discount > 100)
        $discount = 100;
    $price = $price - ( $price / 100 ) * $discount;
}
$price = TravelHelper::format_money($price);
$view_star_review = st()->get_option('view_star_review', 'review');
if($view_star_review == 'review') :
    $html_review.=' <ul class="icon-list list-inline-block mb0 last-minute-rating">
                            '.TravelHelper::rate_to_string(STReview::get_avg_rate($hotel_id)).'
                        </ul>';
elseif($view_star_review == 'star'):
    $html_review.='<ul class="icon-list list-inline-block mb0 last-minute-rating">';
    $star = STHotel::getStar($hotel_id);
    $html_review.=TravelHelper::rate_to_string($star);
    $html_review.='</ul>';
endif;
?>
<div class="text-center text-white">
    <h2 class="text-uc mb20"><?php _e("Last Minute Deal",ST_TEXTDOMAIN) ?></h2>
    <?php echo balanceTags($html_review) ?>
    <h5 class="last-minute-title"><?php echo get_the_title($hotel_id) ?> - <?php echo get_the_title($room_id) ?> </h5>
    <p class="last-minute-date"><?php echo esc_html($date) ?></p>
    <p class="mb20">
        <b><?php echo esc_html($price) ?></b> / <?php _e("night",ST_TEXTDOMAIN) ?>
    </p>
    <a class="btn btn-lg btn-white btn-ghost" href="<?php echo get_the_permalink($hotel_id) ?>">
        <?php _e("Book now",ST_TEXTDOMAIN) ?>
        <i class="fa fa-angle-right"></i>
    </a>
</div>