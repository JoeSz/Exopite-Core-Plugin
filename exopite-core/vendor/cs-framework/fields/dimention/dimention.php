<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Number
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CSFramework_Option_dimention extends CSFramework_Options {

  public function __construct( $field, $value = '', $unique = '' ) {
    parent::__construct( $field, $value, $unique );
  }

  public function output() {

    $value_defaults = array(
        'width' => array(
            'value' => '100',
            'name'  => 'Width',
        ),
        'height' => array(
            'value' => '100',
            'name'  => 'Height',
        ),
    );

    //$this->value  = $this->element_value();
    $this->value  = wp_parse_args( $this->element_value(), $this->field );

    $default_width = ( isset( $this->field['width'] ) ) ?
                            $this->field['width'] :
                            $value_defaults['width'];
    $default_height = ( isset( $this->field['height'] ) ) ?
                            $this->field['height'] :
                            $value_defaults['height'];

    echo $this->element_before();

    echo '<fieldset>';

    echo cs_add_element( array(
        'pseudo' => true,
        'id'     => $this->field['id'].'_width',
        'type'   => 'number',
        'name'   => $this->element_name('[width][value]'),
        'before'  => '<p class="cs-text-muted">' . $default_width['name'] . '</p>',
        'value'  => ( isset( $this->value['width']['value'] ) ) ?
                    ( $this->value['width']['value'] ) :
                    $default_width['value'],
        'rgba'   => true,
    ) );

    echo '<span class="codestar-dimension-separator">x</span>';

    echo cs_add_element( array(
        'pseudo' => true,
        'id'     => $this->field['id'].'_height',
        'type'   => 'number',
        'name'   => $this->element_name('[height][value]'),
        'before'  => '<p class="cs-text-muted">' . $default_height['name'] . '</p>',
        'value'  => ( isset( $this->value['height']['value'] ) ) ?
                    ( $this->value['height']['value'] ) :
                    $default_height['value'],
        'rgba'   => true,
    ) );

    echo '</fieldset>';


    echo $this->element_after();

  }

}
