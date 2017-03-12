<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Color Picker Menu
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */

/*
To Use:

    array(
        'id'        => 'unique-id',
        'type'      => 'color_picker_menu',
        'title'     => __( 'Menu color picker', 'cs-framework' ),
        'background' => array(
            'value' => '#cccccc',
            'name'  => 'Background color',
        ),
        'background-active-hover' => array(
            'value' => '#cccccc',
            'name'  => 'Background active and hover color',
        ),
        'link' => array(
            'value' => '#cccccc',
            'name'  => 'Link color',
        ),
        'link-active-hover' => array(
            'value' => '#cccccc',
            'name'  => 'Link active and hover color',
        ),
    ),

 */

class CSFramework_Option_color_picker_menu extends CSFramework_Options {

    public function __construct( $field, $value = '', $unique = '' ) {
        parent::__construct( $field, $value, $unique );
    }

    public function output() {

        $value_defaults = array(
            'background' => array(
                'value' => '#cccccc',
                'name'  => 'Background color',
            ),
            'background-active-hover' => array(
                'value' => '#cccccc',
                'name'  => 'Background active and hover color',
            ),
            'link' => array(
                'value' => '#cccccc',
                'name'  => 'Link color',
            ),
            'link-active-hover' => array(
                'value' => '#cccccc',
                'name'  => 'Link active and hover color',
            ),
        );

        //$this->value  = $this->element_value();
        $this->value  = wp_parse_args( $this->element_value(), $this->field );
        $default_background = ( isset( $this->field['background'] ) ) ?
                                $this->field['background'] :
                                $value_defaults['background'];
        $default_background_active_hover = ( isset( $this->field['background-active-hover'] ) ) ?
                                $this->field['background-active-hover'] :
                                $value_defaults['background-active-hover'];
        $default_link = ( isset( $this->field['link'] ) ) ?
                                $this->field['link'] :
                                $value_defaults['link'];
        $default_link_active_hover = ( isset( $this->field['link-active-hover'] ) ) ?
                                $this->field['link-active-hover'] :
                                $value_defaults['link-active-hover'];

        echo $this->element_before();

        echo '<fieldset>';

        echo cs_add_element( array(
            'pseudo' => true,
            'id'     => $this->field['id'].'_background',
            'type'   => 'color_picker',
            'name'   => $this->element_name('[background][value]'),
            'before'  => '<p class="cs-text-muted">' . $default_background['name'] . '</p>',
            'value'  => ( isset( $this->value['background']['value'] ) ) ?
                        ( $this->value['background']['value'] ) :
                        $default_background['value'],
            'rgba'   => true,
        ) );

        echo cs_add_element( array(
            'pseudo' => true,
            'id'     => $this->field['id'].'_background-active-hover',
            'type'   => 'color_picker',
            'name'   => $this->element_name('[background-active-hover][value]'),
            'before'  => '<p class="cs-text-muted">' . $default_background_active_hover['name'] . '</p>',
            'value'  => ( isset( $this->value['background-active-hover']['value'] ) ) ?
                        ( $this->value['background-active-hover']['value'] ) :
                        $default_background_active_hover['value'],
            'rgba'   => true,
        ) );

        echo '<div class="cs-separator cs-color-picker-menu-separator"></div>';

        echo cs_add_element( array(
            'pseudo' => true,
            'id'     => $this->field['id'].'_link',
            'type'   => 'color_picker',
            'name'   => $this->element_name('[link][value]'),
            'before'  => '<p class="cs-text-muted">' . $default_link['name'] . '</p>',
            'value'  => ( isset( $this->value['link']['value'] ) ) ?
                        ( $this->value['link']['value'] ) :
                        $default_link['value'],
            'rgba'   => true,
        ) );

        echo cs_add_element( array(
            'pseudo' => true,
            'id'     => $this->field['id'].'_link-active-hover',
            'type'   => 'color_picker',
            'name'   => $this->element_name('[link-active-hover][value]'),
            'before'  => '<p class="cs-text-muted">' . $default_link_active_hover['name'] . '</p>',
            'value'  => ( isset( $this->value['link-active-hover']['value'] ) ) ?
                        ( $this->value['link-active-hover']['value'] ) :
                        $default_link_active_hover['value'],
            'rgba'   => true,
        ) );

        echo '</fieldset>';

        echo $this->element_after();

    }
}
