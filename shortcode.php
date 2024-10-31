<?php		
//Lets register our shortcode 
function slc_shortcode_content_func($attrs){
	extract( shortcode_atts( array(
		'id' => null,
	), $attrs ) ); ob_start(); ?>

<?php
    $id = (int) esc_html($id);
    $lc_meta = get_post_meta( $id, 'ba_', true );

    $data = $lc_meta['re_'] ?? [];

    $dimension      = $lc_meta['image_width'];
    $padding        = $lc_meta['padding'];
    $boarder_size   = $lc_meta['boarder_size'];
    $boarder_color  = $lc_meta['boarder_color'];
    $bg_color       = $lc_meta['bg_color'];
    $speed          = $lc_meta['speed'];
    $mouse_direction= $lc_meta['mouse_direction'];
    $behavior       = $lc_meta['behavior'];

    $height = $dimension['height'] == '0' ? 'auto' : $dimension['height'].$dimension['unit'];
    $width = $dimension['width'] == '0' ? 'auto' : $dimension['width'].$dimension['unit'];
?>

<div id="marqueediv" style="background-color:<?php echo esc_attr($bg_color); ?>">                                                   
    <div id="mycarouse<?php echo esc_attr($id); ?>">
        <?php
        // check if image empty 
        if(empty($data)){echo "<h2>OOps ! You forgot to add images in the carousel.</h2>";}
    
        foreach ($data as $arr){
            foreach($arr as $img){
                ?>
                <img src="<?php echo esc_url($img['url']) ?>" width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>" style="margin-left:<?php echo esc_attr($padding); ?>px; border:<?php echo esc_attr($boarder_size); ?>px solid; border-color: <?php echo esc_attr($boarder_color); ?>;">
                <?php 	
            }
        }
        ?>
    </div>
</div>

		<script>
              marqueeInit({
                    uniqueid: 'mycarouse<?php echo esc_html($id); ?>',
                    style: {},
					moveatleast: <?php echo (int) esc_html($speed) ?>,
                    savedirection: "<?php echo (boolean) esc_html($mouse_direction); ?>",
					mouse: "<?php echo esc_html($behavior) ?>",
                    inc: <?php echo (int) esc_html($speed) ?>,
                    neutral: 150,
                    random: true
                });

        </script>
<?php  $output = ob_get_clean(); return $output;//print $output; // debug ?>
<?php
}
add_shortcode('carousel','slc_shortcode_content_func');