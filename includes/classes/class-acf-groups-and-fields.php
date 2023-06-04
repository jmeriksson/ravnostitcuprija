<?php
/**
 * This class handles registering ACF fields for the theme.
 *
 * @package Ravnostitcuprija
 */

class ACF_Groups_And_Fields extends Loader {
	/**
	 * Add hooks and filters here.
	 *
	 * @return void
	 */
	public function init() : void {
		add_action( 'acf/init', [ $this, 'register_acf_groups' ] );
		add_filter( 'acf/load_field/key=global_settings_field_footer_flexible_content_navigation_menu', [ $this, 'add_all_wp_nav_menus_as_choices_to_field' ]);
		add_filter( 'acf/load_field/key=global_settings_field_dog_adoption_page_form', [ $this, 'add_all_ninja_forms_as_choices_to_field']);
	}

	/**
	 * Register ACF groups.
	 *
	 * @return void
	 */
	public function register_acf_groups() : void {
		acf_add_local_field_group( self::register_global_settings_group() );
		acf_add_local_field_group( self::register_page_with_modules_group() );
		acf_add_local_field_group( self::register_dog_post_type_group() );
	}

	/**
	 * Register a group for global settings.
	 *
	 * @return array
	 */
	public static function register_global_settings_group() : array {
		$group_name = 'global_settings';
		$prefix = $group_name . '_field_';
		$fields = [
			[
				'key' => $prefix . 'general_settings_tab',
				'name' => 'general_settings_tab',
				'label' => __('General settings', 'ravnostitcuprija'),
				'type' => 'tab',
				'placement' => 'top',
				'endpoint' => 0,
			],
			[
				'key' => $prefix . 'email',
				'name' => 'email',
				'label' => __('E-mail', 'ravnostitcuprija'),
				'type' => 'text',
			],
			[
				'key' => $prefix . 'phone_number',
				'name' => 'phone_number',
				'label' => __('Phone number', 'ravnostitcuprija'),
				'type' => 'text',
			],
			[
				'key' => $prefix . 'social_media',
				'name' => 'social_media',
				'label' => __('Social media', 'ravnostitcuprija'),
				'type' => 'flexible_content',
				'layouts' => [
					'instagram' => [
						'key' => $prefix . 'social_media_instagram',
						'name' => 'instagram',
						'label' => __('Instagram', 'ravnostitcuprija'),
						'display' => 'block',
						'sub_fields' => [
							[
								'key' => $prefix . 'social_media_instagram_url',
								'name' => 'url',
								'label' => __('URL', 'ravnostitcuprija'),
								'type' => 'url',
							],
							[
								'key' => $prefix . 'social_media_instagram_alt_text',
								'name' => 'alt_text',
								'label' => __('Alternative title', 'ravnostitcuprija'),
								'type' => 'text',
								'instructions' => __('Add an alternativ title to be read by screen readers'),
								'default_value' => __('Follow us on Instagram', 'ravnostitcuprija'),
							]
						],
						'min' => '',
						'max' => '',
					],
					'facebook' => [
						'key' => $prefix . 'social_media_facebook',
						'name' => 'facebook',
						'label' => __('Facebook', 'ravnostitcuprija'),
						'display' => 'block',
						'sub_fields' => [
							[
								'key' => $prefix . 'social_media_facebook_url',
								'name' => 'url',
								'label' => __('URL', 'ravnostitcuprija'),
								'type' => 'url',
							],
							[
								'key' => $prefix . 'social_media_facebook_alt_text',
								'name' => 'alt_text',
								'label' => __('Alternativ title', 'ravnostitcuprija'),
								'type' => 'text',
								'instructions' => __('Add an alternativ title to be read by screen readers'),
								'default_value' => __('Follow us on Facebook', 'ravnostitcuprija'),
							]
						],
						'min' => '',
						'max' => '',
					],
				],
				'button_label' => __('Add social media', 'ravnostitcuprija'),
				'min' => '',
				'max' => '',
			],
			[
				'key' => $prefix . 'footer_tab',
				'name' => 'footer_tab',
				'label' => __('Footer', 'ravnostitcuprija'),
				'type' => 'tab',
				'placement' => 'top',
				'endpoint' => 0,
			],
			[
				'key' => $prefix . 'footer_flexible_content',
				'name' => 'footer_flexible_content',
				'label' => __('Footer sections', 'ravnostitcuprija'),
				'type' => 'flexible_content',
				'layouts' => [
					'text_section' => [
						'key' => $prefix . 'footer_flexible_content_text_section',
						'name' => 'text_section',
						'label' => __('Text section', 'ravnostitcuprija'),
						'display' => 'block',
						'sub_fields' => [
							[
								'key' => $prefix . 'footer_flexible_content_text_section_headline',
								'name' => 'headline',
								'label' => __('Headline', 'ravnostitcuprija'),
								'type' => 'text',
							],
							[
								'key' => $prefix . 'footer_flexible_content_text_section_text_content',
								'name' => 'text_content',
								'label' => __('Text content', 'ravnostitcuprija'),
								'type' => 'textarea',
								'rows' => 4,
								'new_lines' => 'br',
							],
						],
					],
					'navigation' => [
						'key' => $prefix . 'footer_flexible_content_navigation',
						'name' => 'navigation',
						'label' => __('Navigation menu', 'ravnostitcuprija'),
						'display' => 'block',
						'sub_fields' => [
							[
								'key' => $prefix . 'footer_flexible_content_navigation_headline',
								'name' => 'headline',
								'label' => __('Headline', 'ravnostitcuprija'),
								'type' => 'text',
							],
						] ,
					],
					'contact' => [
						'key' => $prefix . 'footer_flexible_content_contact',
						'name' => 'contact',
						'label' => __('Contact', 'ravnostitcuprija'),
						'display' => 'block',
						'sub_fields' => [
							[
								'key' => $prefix . 'footer_flexible_content_contact_headline',
								'name' => 'headline',
								'label' => __('Headline', 'ravnostitcuprija'),
								'instructions' => __('Social media links, email, and phone number will be fecthed from the values you have stored in the tab called "General settings"', 'ravnostitcuprija'),
								'type' => 'text',
							],
                            [
                                'key' => $prefix . 'footer_flexible_content_contact_display_social_media',
                                'name' => 'display_social_media',
                                'label' => __('Display social media icons?', 'ravnostitcuprija'),
                                'type' => 'true_false',
                                'default_value' => 0,
                                'wrapper' => [
                                    'width' => 33
                                ],
                            ],
                            [
                                'key' => $prefix . 'footer_flexible_content_contact_display_email',
                                'name' => 'display_email',
                                'label' => __('Display email?', 'ravnostitcuprija'),
                                'type' => 'true_false',
                                'default_value' => 0,
                                'wrapper' => [
                                    'width' => 33
                                ],
                            ],
                            [
                                'key' => $prefix . 'footer_flexible_content_contact_display_phone',
                                'name' => 'display_phone',
                                'label' => __('Display phone number?', 'ravnostitcuprija'),
                                'type' => 'true_false',
                                'default_value' => 0,
                                'wrapper' => [
                                    'width' => 34
                                ],
                            ],
						],
					],
				],
				'button_label' => __('Add section', 'ravnostitcuprija'),
				'min' => '',
				'max' => 3,
			],
			[
				'key' => $prefix . 'dog_adoption_page_tab',
				'name' => 'dog_adoption_page_tab',
				'label' => __('Dog page', 'ravnostitcuprija'),
				'type' => 'tab',
				'placement' => 'top',
				'endpoint' => 0,
			],
			[
				'key' => $prefix . 'dog_adoption_page_information',
				'name' => 'dog_adoption_page_information',
				'type' => 'message',
				'message' => _x('This content will be displayed on all dog pages. You can inject the dog\'s name into the headline and text content by using the %DOGNAME% snippet.', 'The %DOGNAME% snippet should not be translated', 'ravnostitcuprija'),
			],
			[
				'key' => $prefix . 'dog_adoption_page_headline',
				'name' => 'dog_adoption_page_headline',
				'label' => __('Headline', 'ravnostitcuprija'),
				'type' => 'text',
			],
			[
				'key' => $prefix . 'dog_adoption_page_content',
				'name' => 'dog_adoption_page_content',
				'label' => __('Text content', 'ravnostitcuprija'),
				'type' => 'wysiwyg',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 0,
			],
			[
				'key' => $prefix . 'dog_adoption_page_form',
				'name' => 'dog_adoption_page_form',
				'label' => __('Dog adoption form', 'ravnostitcuprija'),
				'type' => 'select',
				'choices' => [],
				'multiple' => 0,
				'default_value' => false,
				'allow_null' => 0,
				'ui' => 0,
				'return_format' => 'value',
			],
            [
				'key' => $prefix . 'dog_adoption_reserved_dog_information',
				'name' => 'dog_adoption_reserved_dog_information',
				'type' => 'message',
				'message' => _x('This content will be displayed on dog pages if the dog is reserved. You can inject the dog\'s name into the headline and text content by using the %DOGNAME% snippet.', 'The %DOGNAME% snippet should not be translated', 'ravnostitcuprija'),
			],
            [
                'key' => $prefix . 'dog_adoption_reserved_dog_headline',
                'name' => 'dog_adoption_reserved_dog_headline',
                'type' => 'text',
                'label' => __('Headline', 'ravnostitcuprija'),
            ],
            [
				'key' => $prefix . 'dog_adoption_reserved_dog_content',
				'name' => 'dog_adoption_reserved_dog_content',
				'label' => __('Text content', 'ravnostitcuprija'),
				'type' => 'wysiwyg',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 0,
			],
			[
				'key' => $prefix . 'dog_archive_page_tab',
				'name' => 'dog_archive_page_tab',
				'label' => __('Dog archive', 'ravnostitcuprija'),
				'type' => 'tab',
				'placement' => 'top',
				'endpoint' => 0,
			],
			[
				'key' => $prefix . 'dog_archive_headline',
				'name' => 'dog_archive_headline',
				'label' => __('Dog archive headline', 'ravnostitcuprija'),
				'type' => 'text',
			],
			[
				'key' => $prefix . 'dog_archive_text_content',
				'name' => 'dog_archive_text_content',
				'label' => __('Dog archive text content', 'ravnostitcuprija'),
				'type' => 'wysiwyg',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 0,
            ],
            [
                'key' => $prefix . 'faq_tab',
                'name' => 'faq_tab',
                'label' => __('FAQ', 'ravnostitcuprija'),
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'key' => $prefix . 'faq_image',
                'name' => 'faq_image',
                'label' => __('FAQ image', 'ravnostitcuprija'),
                'instructions' => __('This photo will be displayed at the top of all FAQ pages', 'ravnostitcuprija'),
                'type' => 'image',
                'return_format' => 'id',
                'preview_size' => 'medium',
            ],
            [
                'key' => $prefix . '404_tab',
                'name' => '404_tab',
                'label' => __('404', 'ravnostitcuprija'),
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'key' => $prefix . '404_headline',
                'name' => '404_headline',
                'label' => __('Headline', 'ravnostitcuprija'),
                'type' => 'text',
            ],
            [
                'key' => $prefix . '404_page_content',
                'name' => '404_page_content',
                'label' => __('Page content', 'ravnostitcuprija'),
                'type' => 'wysiwyg',
                'toolbar' => 'full',
                'media_upload' => 1,
            ],
            [
                'key' => $prefix . '404_button',
                'name' => '404_button',
                'label' => __('Button', 'ravnostitcuprija'),
                'type' => 'link',
                'return_format' => 'array',
            ],
		];

		return [
			'key' => 'group_' . $group_name,
			'title' => __('Global Settings', 'ravnostitcuprija'),
			'fields' => $fields,
			'location' => [
				[
					[
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'global-settings'
					],
				],
			],
		];
	}

	/**
	 * Filters an ACF field and adds all wp menus to its ´choices´ entry.
	 *
	 * @param array $field
	 * @return array
	 */
	public static function add_all_wp_nav_menus_as_choices_to_field( $field ) : array {
		$all_wp_nav_menus = get_registered_nav_menus();
		$field['choices'] = $all_wp_nav_menus;
		return $field;
	}

	public static function add_all_ninja_forms_as_choices_to_field( $field ) : array {
		if ( ! function_exists('Ninja_Forms') ) {
			return $field;
		}
		$forms = Ninja_Forms()->form()->get_forms();
		$constructed_form_array = [];
		foreach($forms as $form) {
			$constructed_form_array[$form->get_id()] = $form->get_setting('title');
		}
		$field['choices'] = $constructed_form_array;
		return $field;
	}

	/**
	 * Register a group for the Page with modules template.
	 *
	 * @return array
	 */
	public static function register_page_with_modules_group() : array {
		$group_name = 'page_with_modules';
		$prefix = $group_name . '_field_';
		$fields = [
			[
				'key' => $prefix . 'modules',
				'name' => 'modules',
				'label' => __('Modules', 'ravnostitcuprija'),
				'type' => 'flexible_content',
				'layouts' => [
					'hero' => [
						'key' => $prefix . 'hero',
						'name' => 'hero',
						'label' => __('Hero', 'ravnostitcuprija'),
						'display' => 'block',
						'sub_fields' => [
							[
								'key' => $prefix . 'hero_background_image',
								'name' => 'background_image',
								'label' => __('Background image', 'ravnostitcuprija'),
								'type' => 'image',
								'return_format' => 'id',
								'preview_size' => 'medium',
                                'wrapper' => [
									'width' => '70',
								],
							],
                            [
                                'key' => $prefix . 'hero_size',
                                'name' => 'hero_size',
                                'label' => __('Hero size', 'ravnostitcuprija'),
                                'type' => 'button_group',
                                'choices' => [
                                    'small' => __('Small', 'ravnostitcuprija'),
                                    'large' => __('Large', 'ravnostitcuprija')
                                ],
                                'allow_null' => 0,
                                'layout' => 'horizontal',
                                'return_format' => 'value',
                                'wrapper' => [
									'width' => '30',
								],
                                'default_value' => 'large'
                            ],
							[
								'key' => $prefix . 'hero_headline',
								'name' => 'headline',
								'label' => __('Headline', 'ravnostitcuprija'),
								'type' => 'text',
								'wrapper' => [
									'width' => '70',
								],
							],
							[
								'key' => $prefix . 'hero_headline_size',
								'name' => 'headline_size',
								'label' => __('Headline size', 'ravnostitcuprija'),
								'type' => 'button_group',
								'instructions' => __('Please only use the H1 size once per page', 'ravnostitcuprija'),
								'wrapper' => [
									'width' => '30',
								],
								'choices' => [
									'h1' => 'H1',
									'h2' => 'H2',
								],
								'allow_null' => 0,
								'layout' => 'horizontal',
								'return_format' => 'value',
 							],
							[
								'key' => $prefix . 'hero_text_content',
								'name' => 'text_content',
								'label' => __('Text content', 'ravnostitcuprija'),
								'type' => 'textarea',
								'new_lines' => 'br',
							],
							[
								'key' => $prefix . 'hero_primary_button',
								'name' => 'primary_button',
								'label' => __('Primary button', 'ravnostitcuprija'),
								'type' => 'link',
								'wrapper' => [
									'width' => '50',
								],
								'return_format' => 'array',
							],
							[
								'key' => $prefix . 'hero_secondary_button',
								'name' => 'secondary_button',
								'label' => __('Secondary button', 'ravnostitcuprija'),
								'type' => 'link',
								'wrapper' => [
									'width' => '50',
								],
								'return_format' => 'array',
							],
						],
						'min' => '',
						'max' => '',
					],
                    'excerpt' => [
                        'key' => $prefix . 'excerpt',
                        'name' => 'excerpt',
                        'label' => __('Excerpt', 'ravnostitcuprija'),
                        'display' => 'block',
                        'sub_fields' => [
                            [
                                'key' => $prefix . 'excerpt_content',
                                'name' => 'content',
                                'label' => __('Content', 'ravnostitcuprija'),
                                'instructions' => __('This field will not be displayed on the page, it is only used as an excerpt.', 'ravnostitcuprija'),
                                'type' => 'textarea',
                                'new_lines' => 'br'
                            ],
                        ],
                    ],
					'icon_row' => [
						'key' => $prefix . 'icon_row',
						'name' => 'icon_row',
						'label' => __('Icon row', 'ravnostitcuprija'),
						'display' => 'block',
						'sub_fields' => [
                            [
                                'key' => $prefix . 'icon_row_icon_style',
                                'name' => 'icon_style',
                                'label' => __('Icon style', 'ravnostitcuprija'),
                                'type' => 'select',
                                'choices' => [
                                    'transparent' => __('Transparent background', 'ravnostitcuprija'),
                                    'squared' => __('Square background', 'ravnostitcuprija'),
                                    'round' => __('Round background', 'ravnostitcuprija'),
                                ],
                                'default_value' => 'transparent',
                                'allow_null' => 0,
                                'multiple' => 0,
                                'ui' => 0,
                                'return_format' => 'value',
                                'required' => 1
                            ],
							[
								'key' => $prefix . 'icon_row_icons',
								'name' => 'icons',
								'label' => __('Icons', 'ravnostitcuprija'),
								'type' => 'repeater',
								'min' => 0,
								'max' => 3,
								'layout' => 'block',
								'button_label' => __('Add icon', 'ravnostitcuprija'),
								'sub_fields' => [
									[
										'key' => $prefix . 'icon_row_icons_icon',
										'name' => 'icon',
										'label' => __('Icon', 'ravnostitcuprija'),
										'type' => 'select',
										'wrapper' => [
											'width' => '20',
										],
										'choices' => [
											'dog' => __('Dog', 'ravnostitcuprija'),
											'dog-and-person' => __('Dog with person', 'ravnostitcuprija'),
											'dog-and-house' => __('Dog in house', 'ravnostitcuprija'),
										],
										'default_value' => 'dog',
										'allow_null' => 0,
										'multiple' => 0,
										'ui' => 0,
										'return_format' => 'value',
                                        'required' => 1,
									],
									[
										'key' => $prefix . 'icon_row_icons_text_content',
										'name' => 'text_content',
										'label' => __('Text content', 'ravnostitcuprija'),
										'type' => 'textarea',
										'wrapper' => [
											'width' => '60',
										],
										'rows' => 4,
										'new_lines' => 'br',
									],
                                    [
                                        'key' => $prefix . 'icon_row_icons_link',
                                        'name' => 'link',
                                        'label' => __('Link', 'ravnostitcuprija'),
                                        'type' => 'link',
                                        'wrapper' => [
											'width' => '20',
										]
                                    ]
								],
							],
						],
						'min' => '',
						'max' => '',
					],
					'featured_post' => [
						'key' => $prefix . 'featured_post',
						'name' => 'featured_post',
						'label' => __('Featured post', 'ravnostitcuprija'),
						'display' => 'block',
						'sub_fields' => [
							[
								'key' => $prefix . 'featured_post_select_post',
								'name' => 'select_post',
								'label' => __('Select post', 'ravnostitcuprija'),
								'type' => 'post_object',
								'post_type' => 'post',
								'allow_null' => 0,
								'multiple' => 0,
								'return_format' => 'id',
							],
							[
								'key' => $prefix . 'featured_post_image',
								'name' => 'image',
								'label' => __('Image', 'ravnostitcuprija'),
								'instructions' => __('Leave blank for post featured image', 'ravnostitcuprija'),
								'type' => 'image',
								'return_format' => 'id',
								'preview_size' => 'medium',
							],
							[
								'key' => $prefix . 'featured_post_headline',
								'name' => 'headline',
								'label' => __('Headline', 'ravnostitcuprija'),
								'instructions' => __('Leave blank post title', 'ravnostitcuprija'),
								'type' => 'text',
							],
							[
								'key' => $prefix . 'featured_post_excerpt',
								'name' => 'excerpt',
								'label' => __('Excerpt', 'ravnostitcuprija'),
								'instructions' => __('Leave blank for post excerpt', 'ravnostitcuprija'),
								'type' => 'textarea',
								'rows' => 4,
								'new_lines' => 'br',
							],
							[
								'key' => $prefix . 'featured_post_button_text',
								'name' => 'button_text',
								'label' => __('Button text', 'ravnostitcuprija'),
								'instructions' => __('Text on the button that takes the user to the blog post. Leave blank to not display a button', 'ravnostitcuprija'),
								'type' => 'text',
							],
						],
						'min' => '',
						'max' => '',
					],
					'faqs' => [
						'key' => $prefix . 'faqs',
						'name' => 'faqs',
						'label' => __('FAQs', 'ravnostitcuprija'),
						'display' => 'block',
						'sub_fields' => [
							[
								'key' => $prefix . 'faqs_headline',
								'name' => 'headline',
								'label' => __('Headline', 'ravnostitcuprija'),
								'type' => 'text',
							], 
							[
								'key' => $prefix . 'faqs_text_content',
								'name' => 'text_content',
								'label' => __('Text content', 'ravnostitcuprija'),
								'type' => 'textarea',
								'new_lines' => 'br',
							],
							[
								'key' => $prefix . 'faqs_link',
								'name' => 'link',
								'label' => __('Link', 'ravnostitcuprija'),
								'type' => 'link',
								'return_format' => 'array',
							],
							[
								'key' => $prefix . 'faqs_select_posts',
								'name' => 'select_posts',
								'label' => __('FAQs', 'ravnostitcuprija'),
								'type' => 'relationship',
								'post_type' => 'faq',
								'filters' => ['search', 'taxonomy'],
								'min' => 1,
								'max' => 0,
								'return_format' => 'id',
							],
						],
					],
                    'text_block' => [
                        'key' => $prefix . 'text_block',
						'name' => 'text_block',
						'label' => __('Text block', 'ravnostitcuprija'),
						'display' => 'block',
						'sub_fields' => [
                            [
                                'key' => $prefix . 'text_block_content',
                                'name' => 'content',
                                'label' => __('Content', 'ravnostitcuprija'),
                                'type' => 'wysiwyg',
                                'toolbar' => 'full',
                                'tabs' => 'all',
                                'media_upload' => 1,
                            ]
                        ]
                    ],
                    'text_and_image' => [
                        'key' => $prefix . 'text_and_image',
                        'name' => 'text_and_image',
                        'label' => __('Text and image', 'ravnostitcuprija'),
                        'display' => 'block',
                        'sub_fields' => [
                            [
                                'key' => $prefix . 'text_and_image_content',
                                'name' => 'content',
                                'label' => __('Content', 'ravnostitcuprija'),
                                'type' => 'wysiwyg',
                                'tabs' => 'all',
                                'media_upload' => 0,
                                'toolbar' => 'full',
                            ],
                            [
                                'key' => $prefix . 'text_and_image_image',
                                'name' => 'image',
                                'label' => __('Image', 'ravnostitcuprija'),
                                'type' => 'image',
                                'return_format' => 'id',
                                'preview_size' => 'medium',
                                'wrapper' => [
                                    'width' => 50
                                ]
                            ],
                            [
                                'key' => $prefix . 'text_and_image_image_position',
                                'name' => 'image_position',
                                'label' => __('Image position', 'ravnostitcuprija'),
                                'type' => 'button_group',
                                'choices' => [
                                    'left' => __('Left', 'ravnostitcuprija'),
                                    'right' => __('Right', 'ravnostitcuprija'),
                                ],
                                'default_value' => 'left',
                                'allow_null' => 0,
                                'wrapper' => [
                                    'width' => 50
                                ]
                            ],
                            [
                                'key' => $prefix . 'text_and_image_cta_button',
                                'name' => 'cta_button',
                                'label' => __('CTA button', 'ravnostitcuprija'),
                                'type' => 'link',
                                'return_format' => 'array'
                            ]
                        ]
                    ],
                    'columns' => [
                        'key' => $prefix . 'columns',
                        'name' => 'columns',
                        'label' => __('Columns', 'ravnostitcuprija'),
                        'display' => 'block',
                        'sub_fields' => [
                            [
                                'key' => $prefix . 'columns_mobile_no_of_columns',
                                'name' => 'mobile_no_of_columns',
                                'label' => __('Number of columns (mobile)', 'ravnostitcurpija'),
                                'type' => 'button_group',
                                'allow_null' => 0,
                                'choices' => [
                                    '1' => '1',
                                    '2' => '2'
                                ],
                                'default_value' => '1',
                                'wrapper' => [
                                    'width' => 33
                                ]
                            ],
                            [
                                'key' => $prefix . 'columns_tablet_no_of_columns',
                                'name' => 'tablet_no_of_columns',
                                'label' => __('Number of columns (tablet)', 'ravnostitcurpija'),
                                'type' => 'button_group',
                                'allow_null' => 0,
                                'choices' => [
                                    '1' => '1', 
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4'
                                ],
                                'default_value' => '2',
                                'wrapper' => [
                                    'width' => 33
                                ]
                            ],
                            [
                                'key' => $prefix . 'columns_desktop_no_of_columns',
                                'name' => 'desktop_no_of_columns',
                                'label' => __('Number of columns (desktop)', 'ravnostitcuprija'),
                                'type' => 'button_group',
                                'allow_null' => 0,
                                'choices' => [
                                    '1' => '1',
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4'
                                ],
                                'default_value' => '4',
                                'wrapper' => [
                                    'width' => 33
                                ]
                            ],
                            [
                                'key' => $prefix . 'columns_image_ratio',
                                'name' => 'image_ratio',
                                'label' => __('Image ratio', 'ravnostitcuprija'),
                                'type' => 'button_group',
                                'allow_null' => 0,
                                'choices' => [
                                    '1_1' => __('1:1 (square)', 'ravnostitcuprija'),
                                    '4_3' => __('4:3 (landscape)', 'ravnostitcuprija'),
                                    '16_9' => __('16:9 (widescreen)', 'ravnostitcuprija'),
                                    '3_4' => __('3:4 (portrait)', 'ravnostitcuprija')
                                ],
                                'default_value' => '4:3',
                                'wrapper' => [
                                    'width' => 33
                                ]
                            ],
                            [
                                'key' => $prefix . 'columns_repeater',
                                'name' => 'repeater',
                                'label' => __('Columns', 'ravnostitcuprija'),
                                'type' => 'repeater',
                                'min' => 1,
                                'layout' => 'block',
                                'button_label' => __('Add column', 'ravnostitcuprija'),
                                'sub_fields' => [
                                    [
                                        'key' => $prefix . 'columns_repeater_image',
                                        'name' => 'image',
                                        'label' => __('Image', 'ravnostitcuprija'),
                                        'type' => 'image',
                                        'return_format' => 'id',
                                        'preview_size' => 'medium',
                                        'wrapper' => [
                                            'width' => 50
                                        ]
                                    ],
                                    [
                                        'key' => $prefix . 'columns_repeater_image_link',
                                        'name' => 'image_link',
                                        'label' => __('Image link', 'ravnostitcuprija'),
                                        'instructions' => __('Adding a link here turns the image into a clickable link.', 'ravnostitcuprija'),
                                        'type' => 'link',
                                        'return_format' => 'array'
                                    ],
                                    [
                                        'key' => $prefix . 'columns_repeater_content',
                                        'name' => 'content',
                                        'label' => __('Content', 'ravnostitcuprija'),
                                        'type' => 'wysiwyg',
                                        'toolbar' => 'full',
                                        'tabs' => 'all',
                                        'media_upload' => 0,
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'spotlight' => [
                        'key' => $prefix . 'spotlight',
                        'name' => 'spotlight',
                        'label' => __('Spotlight', 'ravnostitcuprija'),
                        'display' => 'block',
                        'sub_fields' => [
                            [
                                'key' => $prefix . 'spotlight_headline',
                                'name' => 'headline',
                                'label' => __('Headline', 'ravnostitcuprija'),
                                'type' => 'text',
                            ],
                            [
                                'key' => $prefix . 'spotlight_content',
                                'name' => 'content',
                                'label' => __('Text content', 'ravnostitcuprija'),
                                'type' => 'textarea',
                                'new_lines' => 'br',
                            ],
                            [
                                'key' => $prefix . 'spotlight_select_posts',
                                'name' => 'select_posts',
                                'label' => __('Posts in the spotlight', 'ravnostitcuprija'),
                                'type' => 'relationship',
								'post_type' => ['post', 'dog', 'page'],
								'filters' => ['search', 'taxonomy'],
								'min' => 1,
								'max' => 0,
								'return_format' => 'id',
                            ],
                            [
                                'key' => $prefix . 'spotlight_footer',
                                'name' => 'footer',
                                'label' => __('Module footer', 'ravnostitcuprija'),
                                'type' => 'wysiwyg',
                                'tabs' => 'all',
                                'toolbar' => 'full',
                                'media_upload' => 0,
                            ]
                        ]
                    ],
                    'headline_and_content' => [
                        'key' => $prefix . 'headline_and_content',
                        'name' => 'headline_and_content',
                        'label' => __('Headline and content (40/60)', 'ravnostitcuprija'),
                        'display' => 'block',
                        'sub_fields' => [
                            [
                                'key' => $prefix . 'headline_and_content_headline',
                                'name' => 'headline',
                                'label' => __('Headline', 'ravnostitcuprija'),
                                'type' => 'text'
                            ],
                            [
                                'key' => $prefix . 'headline_and_content_content',
                                'name' => 'content',
                                'label' => __('Content', 'ravnostitcuprija'),
                                'type' => 'wysiwyg',
                                'tabs' => 'all',
                                'toolbar' => 'full',
                                'media_upload' => 0,
                            ]
                        ],
                    ],
                    'form' => [
                        'key' => $prefix . 'form',
                        'name' => 'form',
                        'label' => __('Form', 'ravnostitcuprija'),
                        'dispay' => 'block',
                        'sub_fields' => [
                            [
                                'key' => $prefix . 'form_layout',
                                'name' => 'layout',
                                'label' => __('Layout', 'ravnostitcuprija'),
                                'type' => 'button_group',
                                'choices' => [
                                    'form_only' => __('Form only', 'ravnostitcuprija'),
                                    'form_and_text' => __('Form and text (2 columns)', 'ravnostitcuprija'),
                                ],
                                'allow_null' => 0,
                                'default_value' => 'form_only'
                            ],
                            [
                                'key' => $prefix . 'form_shortcode',
                                'name' => 'shortcode',
                                'label' => __('Form shortcode', 'ravnostitcuprija'),
                                'type' => 'text',
                            ],
                            [
                                'key' => $prefix . 'form_headline',
                                'name' => 'headline',
                                'label' => __('Headline'),
                                'type' => 'text',
                                'wrapper' => [
                                    'width' => 70
                                ],
                                'conditional_logic' => [
                                    [
                                        [
                                            'field' => $prefix . 'form_layout',
                                            'operator' => '==',
                                            'value' => 'form_and_text'
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'key' => $prefix . 'form_headline_size',
                                'name' => 'headline_size',
                                'label' => __('Headline size'),
                                'type' => 'button_group',
                                'choices' => [
                                    'h1' => __('H1', 'ravnostitcuprija'),
                                    'h2' => __('H2', 'ravnostitcuprija'),
                                ],
                                'default_value' => 'h2',
                                'allow_null' => 0,
                                'wrapper' => [
                                    'width' => 30
                                ],
                                'conditional_logic' => [
                                    [
                                        [
                                            'field' => $prefix . 'form_layout',
                                            'operator' => '==',
                                            'value' => 'form_and_text'
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'key' => $prefix . 'form_text_content',
                                'name' => 'text_content',
                                'label' => __('Text content'),
                                'type' => 'wysiwyg',
                                'media_upload' => 0,
                                'tabs' => 'all',
                                'toolbar' => 'full',
                                'conditional_logic' => [
                                    [
                                        [
                                            'field' => $prefix . 'form_layout',
                                            'operator' => '==',
                                            'value' => 'form_and_text'
                                        ]
                                    ]
                                ]
                            ],
                        ]
                    ]
				],
				'button_label' => __('Add module', 'ravnostitcuprija'),
				'min' => '',
				'max' => '',
			],
		];

		return [
			'key' => 'group_' . $group_name,
			'title' => __('Page with modules', 'ravnostitcuprija'),
			'fields' => $fields,
			'location' => [
				[
					[
						'param' => 'page_template',
						'operator' => '==',
						'value' => 'page-templates/page-with-modules.php',
					],
				],
			],
			'hide_on_screen' => [
				'the_content',
			],
			'active' => true,
		];
	}

	/**
	 * Register a group for the Dog post type.
	 *
	 * @return array
	 */
	public static function register_dog_post_type_group() : array {
		$group_name = 'dog_post_type';
		$prefix = $group_name . '_field_';
		$fields = [
			[
				'key' => $prefix . 'date_of_birth',
				'name' => 'date_of_birth',
				'label' => __('Date of birth', 'ravnostitcuprija'),
				'type' => 'date_picker',
				'return_format' => 'Ymd',
			],
			[
				'key' => $prefix . 'additional_photos',
				'name' => 'additional_photos',
				'label' => __('Additional photos', 'ravnostitcuprija'),
				'type' => 'gallery',
				'return_format' => 'ID',
            ],
            [
                'key' => $prefix . 'reserved',
                'name' => 'reserved',
                'label' => __('Reserved?', 'ravnostitcuprija'),
                'type' => 'true_false',
                'ui' => 1,
            ]
		];
		return [
			'key' => 'group_' . $group_name,
			'title' => __('Dog', 'ravnostitcuprija'),
			'fields' => $fields,
			'location' => [
				[
					[
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'dog',
					],
				],
			],
			'active' => true,
		];
	}
}