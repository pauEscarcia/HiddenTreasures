<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Single activity
 *
 * Created by ShineTheme
 *
 */
global $st_post_content;
if ( have_posts() ) {
    while (have_posts()) {
        the_post();
        ob_start();
        the_content( );
        $st_post_content=@ob_get_clean();
    }
}
get_header();

$detail_layout=apply_filters('st_activity_detail_layout',st()->get_option('activity_layout'));
if(get_post_meta($detail_layout , 'is_breadcrumb' , true) !=='off'){
    get_template_part('breadcrumb');
}
$layout_class = get_post_meta($detail_layout , 'layout_size' , true);
if (!$layout_class) $layout_class = "container";
?>
<div itemscope itemtype="http://schema.org/TouristAttraction">
	<div class="<?php echo balanceTags($layout_class) ; ?>">
		<div class="booking-item-details no-border-top">
			<header class="booking-item-header">
				<div class="row">
					<div class="col-md-9">
						<?php echo st()->load_template('activity/elements/header') ?>

					</div>
					<div class="col-md-3 text-right price_activity">
						<p class="booking-item-header-price">
						<?php

						 echo STActivity::get_price_html(get_the_ID(),false,'<br>');

						/*$info_price = STActivity::get_info_price();
						$price = $info_price['price'];
						$count_sale = $info_price['discount'];
						$show_price = st()->get_option('show_price_free');
						if(!empty($count_sale)){
							$price = $info_price['price'];
							$price_sale = $info_price['price_old'];
						}
						if($show_price == 'on' ||  $price): */?><!--
						<p class="booking-item-header-price">
							<small><?php /*st_the_language('activity_price') */?></small>
							<?php /*if(!empty($count_sale)){ */?>
								<span class=" onsale">
										  <?php /*echo TravelHelper::format_money( $price_sale )*/?>
										 </span>
								<i class="fa fa-long-arrow-right"></i>
							<?php /*} */?>
							<span class="text-lg">
								<?php /*echo TravelHelper::format_money($price) */?>
							</span>
						</p>
						--><?php /*endif; */?>
						</p>
					</div>
				</div>
			</header>

		</div>

	</div>
			<?php

			if($detail_layout)
			{
				$content=STTemplate::get_vc_pagecontent($detail_layout);
				echo balanceTags( $content);
			}else{
				echo st()->load_template('activity/single','default');
			}
			?>

	<!--Review Rich Snippets-->
	<div itemprop="aggregateRating" class="hidden" itemscope itemtype="http://schema.org/AggregateRating">
		<div><?php _e('Book rating:',ST_TEXTDOMAIN)?>
			<?php printf(__('%s out of %s with %s ratings',ST_TEXTDOMAIN),
			'<span itemprop="ratingValue">'.STReview::get_avg_rate().'</span>',
			'<span itemprop="bestRating">5</span>',
			'<span itemprop="ratingCount">'.get_comments_number().'</span>'
			); ?>
		</div>
	</div>
	<!--End Review Rich Snippets-->


</div>
<?php get_footer( ) ?>