<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Shortcode
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CSFramework_Option_shortcodes extends CSFramework_Options {

  public function __construct( $field, $value = '', $unique = '' ) {
    parent::__construct( $field, $value, $unique );
  }

    public function output() {
        echo $this->element_before();

        global $shortcode_tags;

        $label = ( isset( $this->field['label'] ) ) ? '<div class="cs-text-desc">'. $this->field['label'] . '</div>' : '';
        ?>
        <p><?php echo $label; ?></p>
        <div class="section panel">
            <div class="shortcodes-container">
            <?php

            $shortcodes = array();

            foreach($shortcode_tags as $code => $function) {
                array_push( $shortcodes, $code );
            }

            sort( $shortcodes );

            $max = count( $shortcodes );
            for ($i=0; $i < $max; $i++) {
                ?><div class="shortcode-item">[<?php echo $shortcodes[$i]; ?>]</div><?php
            }
            ?>
            </div>
        </div>
        <?php

        echo $this->element_after();
    }

}
