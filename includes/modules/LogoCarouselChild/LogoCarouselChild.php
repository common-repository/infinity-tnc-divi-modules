<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
class INFTNC_LogoCarouselChild extends ET_Builder_Module {
	// Module slug (also used as shortcode tag)
	public $slug                     = 'inftnc_logo_carousel_child';

	// Module item has to use `child` as its type property
	public $type                     = 'child';

	// Module item's attribute that will be used for module item label on modal
	public $child_title_var          = 'alt';


	// Full Visual Builder support
	public $vb_support = 'on';

	function init() {
		// Module name
		$this->name             				= esc_html__( 'Logo', 'infinity-tnc-divi-modules' );
        $this->advanced_setting_title_text 		= esc_html__( 'New Logo', 'infinity-tnc-divi-modules' );
		$this->settings_text               		= esc_html__( 'Logo Carousel Settings', 'infinity-tnc-divi-modules' );


		// Toggle settings
        $this->settings_modal_toggles = array(
            'general'  => array(
                'toggles' => array(
                    'main_content' => esc_html__( 'Content', 'infinity-tnc-divi-modules' ),
                ),
            ),
            'advanced' => array(
                'toggles' => array(
					'share_button_child'	=> array(
						'title'	=> esc_html__( 'Share Button',  'infinity-tnc-divi-modules' ),
						'priority' => 41,
					),
					'share_icon'	=> array(
						'title'	=> esc_html__( 'Share Button Icon',  'infinity-tnc-divi-modules' ),
						'priority' => 42,
					),
                ),
            ),
        );
	}

	/**
	 * Module's specific fields
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function get_fields() {
		
		return array(
            'logo'                 => array(
				'label'              => esc_html__( 'Logo', 'infinity-tnc-divi-modules'),
				'type'               => 'upload',
                'default'            =>'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTA4MCIgaGVpZ2h0PSI1NDAiIHZpZXdCb3g9IjAgMCAxMDgwIDU0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHBhdGggZmlsbD0iI0VCRUJFQiIgZD0iTTAgMGgxMDgwdjU0MEgweiIvPgogICAgICAgIDxwYXRoIGQ9Ik00NDUuNjQ5IDU0MGgtOTguOTk1TDE0NC42NDkgMzM3Ljk5NSAwIDQ4Mi42NDR2LTk4Ljk5NWwxMTYuMzY1LTExNi4zNjVjMTUuNjItMTUuNjIgNDAuOTQ3LTE1LjYyIDU2LjU2OCAwTDQ0NS42NSA1NDB6IiBmaWxsLW9wYWNpdHk9Ii4xIiBmaWxsPSIjMDAwIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz4KICAgICAgICA8Y2lyY2xlIGZpbGwtb3BhY2l0eT0iLjA1IiBmaWxsPSIjMDAwIiBjeD0iMzMxIiBjeT0iMTQ4IiByPSI3MCIvPgogICAgICAgIDxwYXRoIGQ9Ik0xMDgwIDM3OXYxMTMuMTM3TDcyOC4xNjIgMTQwLjMgMzI4LjQ2MiA1NDBIMjE1LjMyNEw2OTkuODc4IDU1LjQ0NmMxNS42Mi0xNS42MiA0MC45NDgtMTUuNjIgNTYuNTY4IDBMMTA4MCAzNzl6IiBmaWxsLW9wYWNpdHk9Ii4yIiBmaWxsPSIjMDAwIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz4KICAgIDwvZz4KPC9zdmc+Cg==',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_html__( 'Upload a Logo', 'infinity-tnc-divi-modules'),
				'choose_text'        => esc_attr__( 'Choose a Logo', 'infinity-tnc-divi-modules' ),
				'update_text'        => esc_attr__( 'Set As Logo', 'infinity-tnc-divi-modules' ),
				'description'        => esc_html__( 'Upload your desired logo, or type in the URL to the logo you would like to display.', 'infinity-tnc-divi-modules' ),
				'toggle_slug'        => 'main_content',
			),

            'alt'                 => array(
				'label'           => esc_html__( 'Logo ALT Text', 'infinity-tnc-divi-modules' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'This defines the HTML ALT text. A short description of your logo can be placed here.', 'infinity-tnc-divi-modules' ),
				'toggle_slug'     => 'main_content',
				'dynamic_content' => 'text',
			),

		);
	}

/**
	 * Module's advanced fields configuration
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function get_advanced_fields_config() { 
		return array(
			'text'	     		 => false,
			'link_options'       => false,
			'filters'            => false,
		);
	}

	/**
	 * Render module output
	 *
	 * @since 1.0.0
	 *
	 * @param array  $attrs       List of unprocessed attributes
	 * @param string $content     Content being processed
	 * @param string $render_slug Slug of module that is used for rendering output
	 *
	 * @return string module's rendered output
	 */
	function render( $attrs, $content, $render_slug ) {

		$logo = $this->props['logo'];
		$alt  = $this->props['alt'];

		$render_logo = sprintf('
				<img class="logo_carousel_img" src="%1$s" alt="%2$s">',
				/*01*/	$logo,
				/*02*/	esc_attr( $alt )
		);
		// Render module content
		$output = sprintf('
					<div class="inftnc_carousel_child">
							%1$s
			      	</div>',
					/*01*/ $render_logo
					
			);

        return $output;
	}

	protected function _render_module_wrapper( $output = '', $render_slug = '' ) {
		return $output;
	}
}

new INFTNC_LogoCarouselChild;