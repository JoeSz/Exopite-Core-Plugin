<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Border
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */

/*
To Use:

    array(
        'id'        => 'unique-id',
        'type'      => 'border',
        'title'     => __( 'Border', 'cs-framework' ),
        'preview'   => true,
        'width' => array(
            'step'  => 1,
            'min'   => 0,
            'max'   => 10,
            'value' => 0,
            'name'  => 'Width',
        ),
        'style' => array(
            'value' => 'dotted',
            'name'  => 'Style',
        ),
        'color' => array(
            'value'  => '#000000',
            'name'   => 'Color',
        ),
    ),

 */

class CSFramework_Option_border extends CSFramework_Options {

    public function __construct( $field, $value = '', $unique = '' ) {
        parent::__construct( $field, $value, $unique );
    }

    public function output() {

        $value_defaults = array(
            'preview'   => true,
            'width' => array(
                'step'  => 1,
                'min'   => 0,
                'max'   => 10,
                'value' => 0,
                'name'  => 'Width',
            ),
            'style' => array(
                'value' => 'none',
                'name'  => 'Style',
            ),
            'color' => array(
                'value'  => '#ffffff',
                'name'   => 'Color',
            ),
        );

        // Get values
        $this->value  = wp_parse_args( $this->element_value(), $this->field );
        $default_slider = ( isset( $this->field['width'] ) ) ?
                            $this->field['width'] :
                            $value_defaults['width'];
        $default_select = ( isset( $this->field['style'] ) ) ?
                            $this->field['style'] :
                            $value_defaults['style'];
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
            'id'       => $this->field['id'].'-width',
            'class'    => 'width',
            'type'     => 'slider',
            'name'     => $this->element_name('[width][value]'),
            'before'    => '<p class="cs-text-muted">' . $default_slider['name'] . '</p>',
            'value'    => ( isset( $this->value['width']['value'] ) ) ?
                          ( $this->value['width']['value'] ) :
                          $default_slider['value'],
            'options'  => array(
                    'step' => $default_slider['step'],
                    'min'  => $default_slider['min'],
                    'max'  => $default_slider['max'],
                    'unit' => ''
            )
        ) );

        echo cs_add_element( array(
            'pseudo'     => true,
            'id'         => $this->field['id'].'-style',
            'class'      => 'style',
            'type'       => 'select',
            'name'       => $this->element_name('[style][value]'),
            'before'      => '<p class="cs-text-muted">' . $default_select['name'] . '</p>',
            'value'      => ( isset( $this->value['style']['value'] ) ) ?
                            ( $this->value['style']['value'] ) :
                            $default_select['value'],
            'options'    => array(
                    'none'   => 'None',
                    'solid'  => 'Solid',
                    'dotted' => 'Dotted',
                    'dashed' => 'Dashed',
                    'double' => 'Double',
            )
        ) );

        echo cs_add_element( array(
            'pseudo' => true,
            'id'     => $this->field['id'].'-color',
            'class'  => 'color',
            'type'   => 'color_picker',
            'name'   => $this->element_name('[color][value]'),
            'before'  => '<p class="cs-text-muted">' . $default_background['name'] . '</p>',
            'value'  => ( isset( $this->value['color']['value'] ) ) ?
                        ( $this->value['color']['value'] ) :
                        $default_background['value'],
            'rgba'   => true,
        ) );

        if ( $default_preview ) {
            echo '<div class="cs-separator cs-shadow-separator"></div>';
            echo '<div class="preview-container"><div class="border-preview-box"></div></div>';
        }

        echo '</fieldset>';

        echo $this->element_after();

    }
}
