<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

class WP_Customize_Category_Control extends WP_Customize_Control {

	public function render_content() {
        $dropdown = wp_dropdown_categories(
            array(
                'name'              => '_customize-dropdown-categories-' . $this->id,
                'echo'              => 0,
                'show_option_none'  => __( '&mdash; Select &mdash;', 'awaken' ),
                'option_none_value' => '0',
                'selected'          => $this->value(),
            )
        );

        // Hackily add in the data link parameter.
        $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

        printf(
            '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
            $this->label,
            $dropdown
        );
    }	

}

?>