<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Footer
 *
 * Created by ShineTheme
 *
 */
?>
</div> <!-- end shinetheme -->

</div>
<!--    End #Wrap-->
<?php

    $footer_template = TravelHelper::st_get_template_footer(get_the_ID());
    if($footer_template){
        $vc_content = STTemplate::get_vc_pagecontent($footer_template); 
        if ($vc_content){            
            echo '<footer id="main-footer">'; 
            echo STTemplate::get_vc_pagecontent($footer_template); 
            echo ' </footer>';
        }
    }else
    {
?>
<!--        Default Footer -->
    <footer id="main-footer">
        <div class="container text-center">
            <p><?php _e('Copy &copy; 2014 Shinetheme. All Rights Reserved',ST_TEXTDOMAIN)?> Shared by <!-- Please Do Not Remove Shared Credits Link --><a href='http://www.themes24x7.com/' id="sd">Themes24x7</a><!-- Please Do Not Remove Shared Credits Link --> </p>
        </div>

    </footer>
<?php }?>

<!-- Gotop -->
<div id="gotop" title="<?php _e('Go to top',ST_TEXTDOMAIN)?>">
    <i class="fa fa-chevron-up"></i>
</div>
<!-- End Gotop -->
<?php wp_footer(); ?>
</body>
</html>
