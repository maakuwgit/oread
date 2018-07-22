<?php
/**
* cards
* -----------------------------------------------------------------------------
*
* cards component
*/

$defaults = [
  'title' => 'Lorem Ipsum',
  'cards' => false
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
?>

<?php if ( ll_empty( $component_data ) ) return; ?>

<div class="ll-cards dark-bg<?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="cards">

  <div class="container text-center">

  <?php if( $title ) : ?>
    <<?php echo $title['tag']; ?> class="ll-cards__title">
      <?php echo $title['text']; ?>
    </<?php echo $title['tag']; ?>>
  <?php endif; ?>

  <?php foreach( $cards as $card ) : ?>

    <div class="ll-cards__card">

    <?php if( $card['card_icon']) : ?>
      <div class="ll-cards__card__icon">
        <?php echo wp_get_attachment_image($card['card_icon']); ?>
      </div>
      <!-- .ll-cards__card__icon -->
    <?php endif; ?>

    <?php if( $card['card_title']) : ?>
      <div class="ll-cards__card__title">
        <?php echo $card['card_title']; ?>
      </div>
      <!-- .ll-cards__card__title -->
    <?php endif; ?>

    <?php if( $card['card_description_text']) : ?>
      <div class="ll-cards__card__description_text">
        <?php echo format_text($card['card_description_text']); ?>
      </div>
    <?php endif; ?>

    <?php if( $card['card_button_field']) : ?>
      <div class="ll-cards__card__button_field">
        <a href="<?php echo $card['card_button_field']['url']; ?>" class="btn">
          <?php echo $card['card_button_field']['title']; ?>
        </a>
      </div>
      <!-- .ll-cards__button_field -->
    <?php endif; ?>

    </div>
    <!-- .ll-cards__card -->

  <?php endforeach; ?>

  </div>
  <!-- .container.text-center -->

</div>