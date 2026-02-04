<?php
/**
 * Register ACF Fields for Custom Blocks
 *
 * @package FJP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'acf/init', 'fjp_register_block_fields' );
function fjp_register_block_fields() {

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	// 1. FJP Hero Block
	acf_add_local_field_group( array(
		'key' => 'group_block_fjp_hero',
		'title' => 'FJP Hero Settings',
		'fields' => array(
			array(
				'key' => 'field_hero_title',
				'label' => 'Title',
				'name' => 'title',
				'type' => 'text',
				'default_value' => 'Hero Title',
			),
			array(
				'key' => 'field_hero_description',
				'label' => 'Description',
				'name' => 'description',
				'type' => 'textarea',
				'rows' => 3,
			),
			array(
				'key' => 'field_hero_image',
				'label' => 'Background Image',
				'name' => 'background_image',
				'type' => 'image',
				'return_format' => 'url',
			),
			array(
				'key' => 'field_hero_overlay_color',
				'label' => 'Overlay Color',
				'name' => 'overlay_color',
				'type' => 'select',
				'choices' => array(
					'fjp-primary' => 'Primary (Pink)',
					'fjp-secondary' => 'Secondary (Light Pink)',
					'fjp-teal' => 'Teal',
					'fjp-green' => 'Green',
					'none' => 'None',
				),
				'default_value' => 'fjp-primary',
			),
			array(
				'key' => 'field_hero_buttons',
				'label' => 'Buttons',
				'name' => 'buttons',
				'type' => 'repeater',
				'sub_fields' => array(
					array(
						'key' => 'field_hero_btn_label',
						'label' => 'Label',
						'name' => 'label',
						'type' => 'text',
					),
					array(
						'key' => 'field_hero_btn_url',
						'label' => 'URL',
						'name' => 'url',
						'type' => 'url',
					),
					array(
						'key' => 'field_hero_btn_style',
						'label' => 'Style',
						'name' => 'style',
						'type' => 'select',
						'choices' => array(
							'primary' => 'Primary',
							'secondary' => 'Secondary',
							'outline' => 'Outline',
						),
						'default_value' => 'primary',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/fjp-hero',
				),
			),
		),
	) );

	// 2. FJP News Grid
	acf_add_local_field_group( array(
		'key' => 'group_block_fjp_news',
		'title' => 'FJP News Grid Settings',
		'fields' => array(
			array(
				'key' => 'field_news_count',
				'label' => 'Number of Posts',
				'name' => 'posts_per_page',
				'type' => 'number',
				'default_value' => 3,
			),
			array(
				'key' => 'field_news_category',
				'label' => 'Filter by Category',
				'name' => 'category',
				'type' => 'taxonomy',
				'taxonomy' => 'categoria_noticias',
				'field_type' => 'select',
				'allow_null' => 1,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/fjp-news-grid',
				),
			),
		),
	) );

	// 3. FJP Testimonials Slider
	acf_add_local_field_group( array(
		'key' => 'group_block_fjp_testimonials',
		'title' => 'FJP Testimonials Settings',
		'fields' => array(
			array(
				'key' => 'field_testimonials_count',
				'label' => 'Number of Testimonials',
				'name' => 'posts_per_page',
				'type' => 'number',
				'default_value' => 5,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/fjp-testimonials',
				),
			),
		),
	) );

	// 4. FJP Volunteer CTA
	acf_add_local_field_group( array(
		'key' => 'group_block_fjp_volunteer_cta',
		'title' => 'FJP Volunteer CTA Settings',
		'fields' => array(
			array(
				'key' => 'field_cta_title',
				'label' => 'Title',
				'name' => 'title',
				'type' => 'text',
				'default_value' => 'Join our team',
			),
			array(
				'key' => 'field_cta_text',
				'label' => 'Text',
				'name' => 'text',
				'type' => 'textarea',
			),
			array(
				'key' => 'field_cta_btn_label',
				'label' => 'Button Label',
				'name' => 'button_label',
				'type' => 'text',
				'default_value' => 'Sign Up',
			),
			array(
				'key' => 'field_cta_btn_url',
				'label' => 'Button URL',
				'name' => 'button_url',
				'type' => 'url',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/fjp-volunteer-cta',
				),
			),
		),
	) );

}
