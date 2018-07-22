<?php
/**
* cards alternate
* -----------------------------------------------------------------------------
*
* cards component
*/

$defaults = [
  'title'       => 'Lorem Ipsum',
  'cards'       => false,
  'background'  => false
];

$component_data = ll_parse_args( $component_data, $defaults );
?>

<?php
/**
 * Any additional classes to apply to the main component container.
 *
 * @var array
 * @see args['classes']
 */
$classes        = $component_args['classes'] ?: array();

/**
 * ID to apply to the main component container.
 *
 * @var array
 * @see args['id']
 */
$component_id   = $component_args['id'];
$title          = $component_data['title'];
$cards          = $component_data['cards'];
$bg             = $component_data['background'];

if( $bg ) {
  $bg = wp_get_attachment_url($bg);
}

if( $bg ) {
  $bg = ' style="background-image:url(' . $bg . ');"';
}else{
  $bg = '';
}
?>

<?php if ( ll_empty( $component_data ) ) return; ?>

<div class="ll-cards-alternate dark-bg<?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="cards-alternate"<?php echo $bg; ?>>

  <div class="container text-center">

  <?php if( $title ) : ?>
    <<?php echo $title['tag']; ?> class="ll-cards__title">
      <?php echo $title['text']; ?>
    </<?php echo $title['tag']; ?>>
  <?php endif; ?>
  <?php if( $cards ) : ?>
    <?php foreach( $cards as $card ) : ?>

      <div class="ll-cards__card">

      <?php if( $card['card_alt_title']) : ?>
        <div class="ll-cards__card__title">
          <?php echo $card['card_alt_title']; ?>
        </div>
        <!-- .ll-cards__card__title -->
      <?php endif; ?>

      <?php if( $card['card_alt_sub_title']) : ?>
        <div class="ll-cards__card__sub_title">
          <?php echo $card['card_alt_sub_title']; ?>
        </div>
        <!-- .ll-cards__card__icon -->
      <?php endif; ?>

      <?php if( $card['card_alt_description_text']) : ?>
        <div class="ll-cards__card__description_text">
          <?php echo format_text($card['card_alt_description_text']); ?>
        </div>
      <?php endif; ?>

      </div>
      <!-- .ll-cards__card -->

    <?php endforeach; ?>
  <?php endif; ?>
  </div>
  <!-- .container.text-center -->

</div>