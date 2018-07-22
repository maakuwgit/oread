<?php
if( have_rows( 'components' ) ) {
  //We're gonna dump it into a string, so let's define it
  $components = '';

  while( have_rows( 'components' ) ) {
    the_row();
    //var_dump(get_row_layout());
    switch( get_row_layout() ) {
      case 'hero' :
        //Pretty much every page
        $hero = array(
          'title'       => get_sub_field('hero_title'),
          'heading'     => get_sub_field('hero_heading'),
          'subheading'  => get_sub_field('hero_subheading'),
          'content'     => get_sub_field('hero_content'),
          'background'  => get_sub_field('hero_background'),
          'video'       => get_sub_field('hero_video'),
          'spotlight'   => get_sub_field('spotlight_strength')
        );

        $components .= ll_include_component(
          'hero-banner',
          $hero,
          array(),
          true
        );
      break;
      case 'hero_w_slider' :
        //Clear Braces
        $slides = array(
          'title'       => get_sub_field('hero_w_slider_title'),
          'spotlight'   => get_sub_field('spotlight_strength'),
          'slides'      => get_sub_field('hero_w_slider_slides')
        );

        $components .= ll_include_component(
          'hero-w-slider',
          $slides,
          array(),
          true
        );
      break;
      case 'cards' :
        //Home Page, “our services” section
        $cards = array(
          'title' => get_sub_field('cards_section_title'),
          'cards' => get_sub_field('cards_cards')
        );

        $components .= ll_include_component(
          'cards',
          $cards,
          array(),
          true
        );
      break;
      case 'cards_alt' :
        //Financing page, “financing options” section
        $cards = array(
          'title'       => get_sub_field('cards_alt_section_title'),
          'cards'       => get_sub_field('cards_alt_cards'),
          'background'  => get_sub_field('cards_alt_background_image'),
        );

        $components .= ll_include_component(
          'cards-alternate',
          $cards,
          array(),
          true
        );
      break;
      case 'lr_blocks' :
        //ITero Impressionless Scanner, Features section
        $block = array(
          'show_steps' => get_sub_field('lr_blocks_show_steps'),
          'content'    => get_sub_field('lr_blocks_content'),
          'background' => get_sub_field('lr_blocks_background_image'),
          'video'      => get_sub_field('lr_blocks_video')
        );

        $components .= ll_include_component(
          'lr-blocks',
          $block,
          array(),
          true
        );
      break;
      case 'lr_w_hover' :
        //Meet the Team, first section
        $block = array(
          'image'      => get_sub_field('lr_w_hover_image'),
          'hover'      => get_sub_field('lr_w_hover_hover_image'),
          'content'    => get_sub_field('lr_w_hover_content'),
          'layout'     => get_sub_field('lr_w_hover_layout')
        );

        $components .= ll_include_component(
          'lr-w-hover',
          $block,
          array(),
          true
        );
      break;
      case 'lr_w_video' :
        //Invisalign-Teen, “No goop. No gap. No worries” section
        $block = array(
          'image'      => get_sub_field('lr_w_video_image'),
          'video'      => get_sub_field('lr_w_video_video'),
          'content'    => get_sub_field('lr_w_video_content'),
          'layout'     => get_sub_field('lr_w_video_layout')
        );

        $components .= ll_include_component(
          'lr-w-video',
          $block,
          array(),
          true
        );
      break;
      case 'call_to_action' :
        //Bottom of most pages above the footer
        $cta = array(
          'show_logo' => get_sub_field('cta_show_logo'),
          'title' => get_sub_field('cta_section_title'),
          'content' => get_sub_field('cta_content')
        );

        $components .= ll_include_component(
          'call-to-action',
          $cta,
          array(),
          true
        );
      break;
      case 'fancy_slider' :
        //ITero Impressionless Scanner, “In case you needed something fun and pointless” section
        $slides = array(
          'slides' => get_sub_field('fancy_slider_slides')
        );

        $components .= ll_include_component(
          'fancy-slider',
          $slides,
          array(),
          true
        );
      break;
      case 'map' :
        //Locations, Map section
        $detail  = false;
        $location = [];
        $details = [];

        if( is_single() ) {

          $detail     = array(
            'title'   => get_the_title(),
            'address' => get_field('location_address'),
            'phone'   => get_field('location_phone'),
            'hours'   => get_field('location_hours')
          );

          $details = false;

          $location = get_field('location_map');

          $location = array(
            array(
              'title'   => get_the_title(),
              'address' => get_field('location_address'),
              'phone'   => get_field('location_phone'),
              'hours'   => get_field('location_hours'),
              'lng'     => ( $location ? $location['lng'] : false ),
              'lat'     => ( $location ? $location['lat'] : false )
            )
          );

        }else{

          $args = array(
              'post_type'     => 'location',
              'post_status'   => 'publish',
              'order'         => 'ASC',
              'showposts'     => -1
            );

          $locations = new WP_Query( $args );

          if( $locations->have_posts() ) {

            while( $locations->have_posts() ) {

              $locations->the_post();

              $has_map = get_field('location_map');

              if( $has_map ) {

                $location[] = array(
                  'title'   => get_the_title(),
                  'address' => get_field('location_address'),
                  'phone'   => get_field('location_phone'),
                  'hours'   => get_field('location_hours'),
                  'lng'     => $has_map['lng'],
                  'lat'     => $has_map['lat']
                );

              }

              $details[]  = array(
                'title'   => get_the_title(),
                'address' => get_field('location_address'),
                'phone'   => get_field('location_phone'),
                'hours'   => get_field('location_hours')
              );

            }

            wp_reset_postdata();

          }

        }

        $map = array(
          'locations' => $location,
          'address'   => $detail,
          'addresses' => $details
        );

        $components .= ll_include_component(
          'google-map',
          $map,
          array(),
          true
        );
      break;
      case 'image_slider' :
        //Clear Braces, “Before After Slider”
        $slides = array(
          'title_left'  => get_sub_field('image_slider_title_left'),
          'title_right' => get_sub_field('image_slider_title_right'),
          'slides'      => get_sub_field('image_slider_slides')
        );

        $components .= ll_include_component(
          'image-slider',
          $slides,
          array(),
          true
        );
      break;
      case 'interactive_image' :
        //Invisalign-Teen
        $images = array(
          'image_1' => get_sub_field('interactive_image_one'),
          'image_2' => get_sub_field('interactive_image_two'),
          'content' => get_sub_field('interactive_image_content')
        );

        $components .= ll_include_component(
          'interactive-image',
          $images,
          array(),
          true
        );
      break;
      case 'comparison_table' :
        //Invisalign-Teen
        $comparison_table = array(
          'title_left' => get_sub_field('comparison_table_left_title'),
          'items_left' => get_sub_field('comparison_table_left_items'),
          'title_right' => get_sub_field('comparison_table_right_title'),
          'items_right' => get_sub_field('comparison_table_left_items')
        );

        $components .= ll_include_component(
          'comparison-table',
          $comparison_table,
          array(),
          true
        );
      break;
      case 'item_grid' :
        //Meet the Team, “Meet the team section”
        $items = array(
          'title' => get_sub_field('item_grid_section_title'),
          'items' => get_sub_field('item_grid_items')
        );

        $components .= ll_include_component(
          'item-grid',
          $items,
          array(),
          true
        );
      break;
      case 'image_grid' :
        //Early Childhood “Preventative Orthodontic Treatment” section
        $images = array(
          'title'  => get_sub_field("image_grid_section_title"),
          'images' => get_sub_field('image_grid_images')
        );

        $components .= ll_include_component(
          'image-grid',
          $images,
          array(),
          true
        );
      break;
      case 'location_grid' :
        //Home Page, “Currently Located in 3 Cities” section
        $locations = array(
          'title'     => get_sub_field("location_grid_section_title"),
          'sub_title' => get_sub_field("location_grid_sub_title")
        );

        $components .= ll_include_component(
          'location-grid',
          $locations,
          array(),
          true
        );
      break;
      case 'three_column_content' :
        //Early Childhood “Preventative Orthodontic Treatment” section
        $columns = array(
          'title'  => get_sub_field("three_column_content__section_title"),
          'columns' => get_sub_field('three_column_content_columns')
        );

        $components .= ll_include_component(
          'three-col-content',
          $columns,
          array(),
          true
        );
      break;
      case 'two_col_block' :
        //Home Page, “Currently Located in 3 Cities” section
        $blocks = array(
          'l_title'     => get_sub_field("two_col_block_left_title"),
          'l_intro' => get_sub_field("two_col_block_left_intro_text"),
          'l_content' => get_sub_field("two_col_block_left_content"),
          'r_title'     => get_sub_field("two_col_block_right_title"),
          'r_intro' => get_sub_field("two_col_block_right_intro_text"),
          'r_content' => get_sub_field("two_col_block_right_content")
        );

        $components .= ll_include_component(
          'two-col-block',
          $blocks,
          array(),
          true
        );
      break;
      default:
        the_content();
      break;
    }
  }
  echo $components;
}
the_content();
?>
<?php // wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
