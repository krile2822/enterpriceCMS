<?php

/*******************************************************************************
   config file that contains the properties of the revolution slider plugin
*******************************************************************************/

return [
  'db_table' => 'slider_revolution_slides',
  'db_items_table' => 'slider_revolution_items',
  'banner_type_options' => [
    '0' => 'top',
    '1' => 'side',
  ],
  'size' => [
    'width' => 1400,
    'height' => 337,
    'marker' => '_lg'
  ],
  'slide_images' => [
    'huge' => [
      'width' => 1960,
      'height' => 600,
      'action' => 'resize',
      'marker' => '_huge',
      'rimg_x' => '1x'
    ]
  ],
  'transition_options' =>[
    'slideup' => 'Slide To Top',
    'slidedown' => 'Slide To Bottom',
    'slideright' => 'Slide To Right',
    'slideleft' => 'Slide To Left',
    'slidehorizontal' => 'Slide Horizontal (depends on Next/Previous)',
    'slidevertical' => 'Slide Vertical (depends on Next/Previous)',
    'boxslide' => 'Slide boxes',
    'slotslide-horizontal' => 'Slide Slots Horizontal',
    'slotslide-vertical' => 'Slide Slots Vertical',
    'boxfade' => 'Face Boxes',
    'slotfade-horizontal' => 'Fade Slots Horizontal',
    'slotfade-vertical' => 'Fade Slots Vertical',
    'fadefromright' => 'Fade and Slide from Right',
    'fadefromleft' => 'Fade and Slide from Left',
    'fadefromtop' => 'Fade and Slide from Top',
    'fadefrombottom'        => 'Fade and Slide from Bottom',
    'fadetoleftfadefromright' => 'Fade To Left and Fade From Right',
    'fadetorightfadefromleft' => 'Fade To Right and Fade From Left',
    'fadetotopfadefrombottom' => 'Fade To Top and Fade From Bottom',
    'fadetobottomfadefromtop' => 'Fade To Bottom and Fade From Top',
    'parallaxtoright' => 'Parallax to Right',
    'parallaxtoleft' => 'Parallax to Left',
    'parallaxtotop' => 'Parallax to Top',
    'parallaxtobottom' => 'Parallax to Bottom',
    'scaledownfromright' => 'Zoom Out and Fade From Right',
    'scaledownfromleft' => 'Zoom Out and Fade From Left',
    'scaledownfromtop' => 'Zoom Out and Fade From Top',
    'scaledownfrombottom' => 'Zoom Out and Fade From Bottom',
    'zoomout' => 'ZoomOut',
    'zoomin' => 'ZoomIn',
    'slotzoom-horizontal' => 'Zoom Slots Horizontal',
    'slotzoom-vertical' => 'Zoom Slots Vertical',
    'fade' => 'Fade',
    'random-static' => 'Random Flat',
    'random' => 'Random Flat and Premium',
    'premium-random' => 'premium-random',
  ],
  'splitin_options' => [
    "words" => "words",
    "chars" => "chars",
    "lines" => "lines"
  ],
  'slideshow_div_classes' => [
    ''=> '',
    'very_big_white' => 'very_big_white',
    'high_title' => 'high_title',
    'high_title2' => 'high_title2',
    'light_title' => 'light_title',
    'mini_title' => 'mini_title'
  ],
  'slideshow_easing_options' => [
    'Bounce.easeIn' => 'Bounce.easeIn',
    'easeInOutBack' => 'easeInOutBack',
    'easeOutElastic' => 'easeOutElastic',
    'easeInOutCubic' => 'easeInOutCubic',
    'Linear.easeNone' => 'Linear.easeNone',
    'Power0.easeIn' => 'Power0.easeIn (linear)',
    'Power0.easeInOut' => 'Power0.easeInOut (linear)',
    'Power1.easeIn' => 'Power1.easeIn',
    'Power1.easeInOut' => 'Power1.easeInOut',
    'Power4.easeOut' => 'Power4.easeOut'
  ],
  'slideshow_endeasing_options' => [
    'Power4.easeIn' => 'Power4.easeIN'
  ]
];
