<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Shadow
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */

/*
To Use:

    array(
        'id'        => 'unique-id',
        'type'      => 'shadow',
        'title'     => __( 'Shadow', 'cs-framework' ),
        'preview'   => true,
        'horizontal-length' => array(
            'step'  => 1,
            'min'   => 0,
            'max'   => 10,
            'value' => 0,
            'name'  => 'Horizontal',
        ),
        'vertical-length'   =>  array(
            'step'  => 1,
            'min'   => 0,
            'max'   => 10,
            'value' => 0,
            'name'  => 'Vertical',
        ),
        'blur-radius'       =>  array(
            'step'  => 1,
            'min'   => 0,
            'max'   => 10,
            'value' => 0,
            'name'  => 'Blur radius',
        ),
        'spread-radius'     =>  array(
            'step'  => 1,
            'min'   => 0,
            'max'   => 10,
            'value' => 0,
            'name'  => 'Spread radius',
        ),
        'color' => array(
            'value'  => '#cccccc',
            'name'   => 'Color',
        ),
    ),

 */

class CSFramework_Option_shadow extends CSFramework_Options {

    public function __construct( $field, $value = '', $unique = '' ) {
        parent::__construct( $field, $value, $unique );
    }

    public function output() {

        $value_defaults = array(
            'preview'           => true,
            'horizontal-length' => array(
                'step'  => 1,
                'min'   => 0,
                'max'   => 10,
                'value' => 0,
                'name'  => 'Horizontal',
            ),
            'vertical-length'   =>  array(
                'step'  => 1,
                'min'   => 0,
                'max'   => 10,
                'value' => 0,
                'name'  => 'Vertical',
            ),
            'blur-radius'       =>  array(
                'step'  => 1,
                'min'   => 0,
                'max'   => 10,
                'value' => 0,
                'name'  => 'Blur radius',
            ),
            'spread-radius'     =>  array(
                'step'  => 1,
                'min'   => 0,
                'max'   => 10,
                'value' => 0,
                'name'  => 'Spread radius',
            ),
            'color' => array(
                'value'  => 'rgba(0,0,0,0.6)',
                'name'   => 'Color',
            ),
        );

        // Get values
        $this->value  = wp_parse_args( $this->element_value(), $this->field );
        $default_horizontal_slider = ( isset( $this->field['horizontal-length'] ) ) ?
                                $this->field['horizontal-length'] :
                                $value_defaults['horizontal-length'];
        $default_vertical_slider = ( isset( $this->field['vertical-length'] ) ) ?
                                $this->field['vertical-length'] :
                                $value_defaults['vertical-length'];
        $default_blur_radius_slider = ( isset( $this->field['blur-radius'] ) ) ?
                                $this->field['blur-radius'] :
                                $value_defaults['blur-radius'];
        $default_spread_radius_slider = ( isset( $this->field['spread-radius'] ) ) ?
                                $this->field['spread-radius'] :
                                $value_defaults['spread-radius'];
        $default_background = ( isset( $this->field['color'] ) ) ?
                                $this->field['color'] :
                                $value_defaults['color'];
        $default_preview = ( isset ( $this->value['preview'] ) ) ?
                                $this->value['preview'] :
                                $value_defaults['preview'];

        echo $this->element_before();

        echo '<fieldset>';

        echo cs_add_element( array(
            'pseudo'   => true,
            'id'       => $this->field['id'].'-horizontal-length',
            'class'    => 'horizontal-length',
            'type'     => 'slider',
            'name'     => $this->element_name('[horizontal-length][value]'),
            'before'   => '<p class="cs-text-muted">' . $default_horizontal_slider['name'] . '</p>',
            'value'    => ( isset( $this->value['horizontal-length']['value'] ) ) ?
                          ( $this->value['horizontal-length']['value'] ) :
                          $default_horizontal_slider['value'],
            'options'  => array(
                    'step' => $default_horizontal_slider['step'],
                    'min'  => $default_horizontal_slider['min'],
                    'max'  => $default_horizontal_slider['max'],
                    'unit' => ''
            ),
        ) );

        echo cs_add_element( array(
            'pseudo'   => true,
            'id'       => $this->field['id'].'-vertical-length',
            'class'    => 'vertical-length',
            'type'     => 'slider',
            'name'     => $this->element_name('[vertical-length][value]'),
            'before'   => '<p class="cs-text-muted">' . $default_vertical_slider['name'] . '</p>',
            'value'    => ( isset( $this->value['vertical-length']['value'] ) ) ?
                          ( $this->value['vertical-length']['value'] ) :
                          $default_vertical_slider['value'],
            'options'  => array(
                    'step' => $default_vertical_slider['step'],
                    'min'  => $default_vertical_slider['min'],
                    'max'  => $default_vertical_slider['max'],
                    'unit' => ''
            ),
        ) );

        echo '<div class="cs-separator cs-shadow-separator"></div>';

        echo cs_add_element( array(
            'pseudo'   => true,
            'id'       => $this->field['id'].'-blur-radius',
            'class'    => 'blur-radius',
            'type'     => 'slider',
            'name'     => $this->element_name('[blur-radius][value]'),
            'before'   => '<p class="cs-text-muted">' . $default_blur_radius_slider['name'] . '</p>',
            'value'    => ( isset( $this->value['blur-radius']['value'] ) ) ?
                          ( $this->value['blur-radius']['value'] ) :
                          $default_blur_radius_slider['value'],
            'options'  => array(
                    'step' => $default_blur_radius_slider['step'],
                    'min'  => $default_blur_radius_slider['min'],
                    'max'  => $default_blur_radius_slider['max'],
                    'unit' => ''
            ),
        ) );

        echo cs_add_element( array(
            'pseudo'   => true,
            'id'       => $this->field['id'].'-spread-radius',
            'class'    => 'spread-radius',
            'type'     => 'slider',
            'name'     => $this->element_name('[spread-radius][value]'),
            'before'   => '<p class="cs-text-muted">' . $default_spread_radius_slider['name'] . '</p>',
            'value'    => ( isset( $this->value['spread-radiu']['value'] ) ) ?
                          ( $this->value['spread-radiu']['value'] ) :
                          $default_spread_radius_slider['value'],
            'options'  => array(
                    'step' => $default_spread_radius_slider['step'],
                    'min'  => $default_spread_radius_slider['min'],
                    'max'  => $default_spread_radius_slider['max'],
                    'unit' => ''
            ),
        ) );

        echo '<div class="cs-separator cs-shadow-separator"></div>';

        echo cs_add_element( array(
            'pseudo' => true,
            'id'     => $this->field['id'].'-color',
            'class'  => 'color',
            'type'   => 'color_picker',
            'name'   => $this->element_name('[color][value]'),
            'before' => '<p class="cs-text-muted">' . $default_background['name'] . '</p>',
            'value'  => ( isset( $this->value['color']['value'] ) ) ?
                        ( $this->value['color']['value'] ) :
                        $default_background['value'],
            'rgba'   => true,
        ) );

        if ( ( $default_preview
         ) ) {
            echo '<div class="cs-separator cs-shadow-separator"></div>';
            echo '<div class="preview-container"><div class="shadow-preview-box"></div></div>';
        }

        echo '</fieldset>';

        echo $this->element_after();

    }

}