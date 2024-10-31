<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access directly.

//
// Metabox of the PAGE
// Set a unique slug-like ID
//
$prefix = 'ba_';

//
// Create a metabox
//
CSF::createMetabox( $prefix, array(
  'title'        => 'Carousel Setup',
  'post_type'    => 'scrollingcarousel',
  'show_restore' => true,
) );


//
// Create a section
//
CSF::createSection( $prefix, array(
  'fields' => array(

    array(
      'id'     => 're_',
      'type'   => 'repeater',
      'title'  => 'Carousel Logos / Images',
      'button_title'    => 'Click to add logo / image',
      'fields' => array(
    
        array(
          'id'    => 'image_field_id',
          'type'  => 'media',
          'title' => 'Upload Logo / Image',
        ),
    
      ),
    ),
    array(
      'id'        => 'image_width',
      'type'      => 'dimensions',
      'title'     => 'Carousel Image Dimensions.',
      'subtitle'  => esc_html__('Set the image width and height', 'logo-carousel'),
      'desc'      => esc_html__('Only numerical value. Leave 0 if you want the actual width of the image', 'logo-carousel'),
      'units'     => array('px', '%'),
    ),
    array(
      'id'        => 'speed',
      'type'      => 'spinner',
      'title'     => 'Carousel Speed',
      'subtitle'  => esc_html__('Set the Carousel Speed', 'logo-carousel'),
      'desc'      => esc_html__('Default value 5. Change the speed of the carousel.', 'logo-carousel'),
      'default'   => 5,
    ),
    array(
      'id'        => 'behavior',
      'type'      => 'radio',
      'title'     => 'Mouseover Behavior',
      'subtitle'      => esc_html__('Choose Mouse Behaviour.', 'logo-carousel'),
      'options'   => array(
        'pause'   => 'Pause',
        'cursor_driven' => 'Cursor Driven',
      ),
      'default'    => 'cursor_driven',
    ),
    array(
      'id'        => 'mouse_direction',
      'type'      => 'checkbox',
      'title'     => 'Save Direction',
      'desc'  => esc_html__('Check if you want direction will be changed with mouse pointer provided direction.', 'logo-carousel'),
    ),
    array(
      'id'        => 'padding',
      'type'      => 'spinner',
      'title'     => 'Padding',
      'desc'      => esc_html__('Only Numarical value ! change the distance between two image.', 'logo-carousel'),
      'default'   => 5,
    ),
    array(
      'id'        => 'boarder_size',
      'type'      => 'spinner',
      'title'     => 'Border Size',
      'desc'      => esc_html__('Example: enter 3 if you want a 3 pixel border for each image item.', 'logo-carousel'),
      'default'   => 0,
    ),
    array(
      'id'        => 'boarder_color',
      'type'      => 'color',
      'title'     => 'Border Color',
      'desc'      => esc_html__('Choose the border color for image item.', 'logo-carousel'),
    ),
    array(
      'id'        => 'bg_color',
      'type'      => 'color',
      'title'     => 'Background Color',
      'desc'      => esc_html__('Change background color of the carousel area.', 'logo-carousel'),
      'default' => 'transparent'
    ),

  )
) );
