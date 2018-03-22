<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Typography Advanced
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CSFramework_Option_typography_attribute extends CSFramework_Options {

  public function __construct( $field, $value = '', $unique = '' ) {
    parent::__construct( $field, $value, $unique );
  }

  public function output() {

    echo $this->element_before();

    $defaults_value = array(
      'size'         => '16',
      'height'       => '20',
      'color'        => '#333',
    );

    $value         = wp_parse_args( $this->element_value(), $defaults_value );

    //Container
    echo '<div class="cs_font_field" data-id="'.$this->field['id'].'">';

      echo cs_add_element( array(
        'pseudo'          => true,
        'type'            => 'number',
        'name'            => $this->element_name( '[size]' ),
        'value'           => $value['size'],
        'default'         => ( isset( $this->field['default']['size'] ) ) ? $this->field['default']['size'] : '',
        'wrap_class'      => 'small-input font-size',
        'before'          => 'Font Size ',
      ) );

      echo cs_add_element( array(
        'pseudo'          => true,
        'type'            => 'number',
        'name'            => $this->element_name( '[height]' ),
        'value'           => $value['height'],
        'default'         => ( isset( $this->field['default']['height'] ) ) ? $this->field['default']['height'] : '',
        'wrap_class'      => 'small-input line-height',
        'before'          => 'Line Height ',
      ) );
      echo '<div class="cs-divider"></div>';
      echo '<label class="cs-typography-color"> Color ';
      echo cs_add_element( array(
        'pseudo'          => true,
        'id'              => $this->field['id'].'_color',
        'type'            => 'color_picker',
        'name'            => $this->element_name('[color]'),
        'attributes'      => array(
          'data-atts'     => 'bgcolor',
        ),
        'value'           => $value['color'],
        'default'         => ( isset( $this->field['default']['color'] ) ) ? $this->field['default']['color'] : '',
        'rgba'            => ( isset( $this->field['rgba'] ) && $this->field['rgba'] === false ) ? false : '',
      ) );
      echo '</label>';

      /**
       * Font Preview
       */
      if (isset( $this->field['preview'] ) && $this->field['preview'] == true) {
        if (isset( $this->field['preview_text'] )) {
          $preview_text = $this->field['preview_text'];
        }else {
          $preview_text = 'Lorem ipsum dolor sit amet, pro ad sanctus admodum, vim at insolens.';
        }
        echo '<div id="preview-'.$this->field['id'].'" style="font-family:;" class="cs-font-preview">'. $preview_text .'</div>';
      }

      //echo '<input type="text" name="'. $this->element_name( '[font]' ) .'" class="cs-typo-font hidden" data-atts="font" value="'. $value['font'] .'" />';


    //end container
    echo '</div>';

    echo $this->element_after();

  }

}
