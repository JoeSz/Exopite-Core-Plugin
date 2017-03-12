<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Editor
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CSFramework_Option_acecsseditor extends CSFramework_Options {

  public function __construct( $field, $value = '', $unique = '' ) {
    parent::__construct( $field, $value, $unique );
  }

  public function output() {

    echo $this->element_before();
    echo '<textarea id="exopite-css-textarea" name="'. $this->element_name() .'"'. $this->element_class() . '>'. $this->element_value() .'</textarea>';
    echo '<div ' . $this->element_attributes() .'></div>';
    echo $this->element_after();

  }

}
