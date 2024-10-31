<?php

function eov_import_meta()
{

    $docs = new WP_Query([
        'post_type' => 'scrollingcarousel',
        'post_status' => 'any',
        'posts_per_page' => -1
    ]);

    while ($docs->have_posts()): $docs->the_post();
        $id = get_the_ID();

        $width = get_post_meta($id, 'ba_width', true);
        $height = get_post_meta($id, 'ba_height', true);

        $ba_re_ = get_post_meta($id, 'ba_re_', true);
        $ba_width = $width;
        $ba_height = $height;
        $ba_speed = get_post_meta($id, 'ba_speed', true);
        $ba_behavior = get_post_meta($id, 'ba_behavior', true);
        $ba_mouse_direction = get_post_meta($id, 'ba_mouse_direction', true);
        $ba_padding = get_post_meta($id, 'ba_padding', true);
        $ba_boarder_size = get_post_meta($id, 'ba_boarder_size', true);
        $ba_boarder_color = get_post_meta($id, 'ba_boarder_color', true);
        $ba_bg_color = get_post_meta($id, 'ba_bg_color', true);

        $images = [];

        foreach($ba_re_ as $image){
            $images[]['image_field_id'] = $image['ba_image_field_id'];
        }

        if($ba_mouse_direction === 'on'){
            $ba_mouse_direction = '1';
        }

        $newData = array(
            're_' => $images,
            'image_width' => [
                'width' => $ba_width,
                'height' => $ba_height,
                'unit' => 'px',
            ],
            'speed' => $ba_speed,
            'behavior' => $ba_behavior,
            'mouse_direction' => $ba_mouse_direction,
            'padding' => $ba_padding,
            'boarder_size' => $ba_boarder_size,
            'boarder_color' => $ba_boarder_color,
            'bg_color' => $ba_bg_color,
        );

        if (false == metadata_exists('post', $id, 'ba_')) {
            update_post_meta($id, 'ba_', $newData);
        }
       
    endwhile;

}


?>