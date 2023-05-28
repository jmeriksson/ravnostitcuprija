<?php
/**
 * Handles the basic setup of the theme.
 *
 * @package Ravnostitcuprija
 */

class Theme_Setup extends Loader {
	/**
	 * Add hooks and filters here.
	 *
	 * @return void
	 */
	public function init() : void {
		add_action('after_setup_theme', [ $this, 'register_menus' ]);
		add_action('after_setup_theme', [ $this, 'theme_supports' ]);
		add_action('wp_enqueue_scripts', [ $this, 'add_theme_scripts_and_styles' ]);
		add_action('init', [ $this, 'add_options_page' ]);
		add_filter('upload_mimes', [ $this, 'allow_svg_uploads' ]);
		add_action('init', [ $this, 'register_image_sizes' ]);
        add_action('init', [ $this, 'add_editor_styles']);
        add_filter('admin_post_thumbnail_html', [ $this, 'add_featured_image_instructions' ], 10, 2 );
        add_filter('post_thumbnail_id', [ $this, 'add_hero_image_as_thumbnail'], 10, 2);
	}

	/**
	 * Registers theme menues.
	 *
	 * @return void
	 */
	public function register_menus() : void {
		register_nav_menus(
			[
				'primary_menu' => __( 'Primary Menu', 'ravnostitcuprija' ),
                'footer_menu' => __('Footer menu', 'ravnostitcuprija')
			]
		);
	}

	/**
	 * Handles adding theme supports.
	 *
	 * @return void
	 */
	public function theme_supports() {
		add_theme_support( 'post-thumbnails' );
	}

	/**
	 * Handles theme scripts and styles.
	 *
	 * @return void
	 */
	public function add_theme_scripts_and_styles() : void {
		$style_modified  = gmdate( 'YmdHi', filemtime( get_template_directory() . '/assets/css/main.css' ) );
		$script_modified = gmdate( 'YmdHi', filemtime( get_template_directory() . '/assets/javascript/main.js' ) );

		// Enqueue the theme style.css file
		wp_enqueue_style( 'style', get_stylesheet_uri(), [], '1.0' );

		// Enqueue main styles from assets directory
		wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.css', [], $style_modified );

		// Enqueue main scripts from assets directory
		wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/javascript/main.js', [], $script_modified, true );
	}

	/**
	 * Adds an ACF options page.
	 *
	 * @return void
	 */
	public function add_options_page() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			$settings = [
				'page_title' => __('Global settings', 'ravnostitcuprija'),
				'menu_title' => __('Global settings', 'ravnostitcuprija'),
				'menu_slug' => 'global-settings',
				'icon_url' => 'dashicons-admin-site-alt3',
			];
			acf_add_options_page( $settings );
		}
	}

	/**
	 * Filter for allowing SVG uploads.
	 *
	 * @param Array $mime_types
	 * @return Array $mime_types filtered
	 */
	public function allow_svg_uploads( $mime_types ) {
		$mime_types['svg'] = 'image/svg+xml';
		return $mime_types;
	}

	/**
	 * Registers theme sizes used in the theme
	 *
	 * @return void
	 */
	public function register_image_sizes() {
		add_image_size('xs_4_3', 576, 432, true); // This is used
		add_image_size('xs_3_4', 576, 768, true); // This is used
		add_image_size('sm_4_3', 768, 576, true); // This us used
		add_image_size('sm_3_4', 768, 1024, true); // This is used
		add_image_size('md_4_3', 992, 744, true); // This is used
		add_image_size('548_1_1', 548, 548, true); // This is used
		add_image_size('548_4_3', 548, 411, true); // This is used
        add_image_size('720_1_1', 720, 720, true); // This is used
        add_image_size('720_4_3', 720, 540, true); // This is used
        add_image_size('720_16_9', 720, 405, true); // This is used
        add_image_size('720_3_4', 720, 960, true); // This is used
	}

    public function add_editor_styles() {
        add_editor_style(get_template_directory_uri() . '/assets/css/editor-styles.css');
    }

    public function add_featured_image_instructions($content, $post_id) : string {
        if ( get_post_type( $post_id ) === 'post' ) {
            return $content .= '<p>' . __('The featured image should have a resolution of at least 1172 x 660 pixels.') . '</p>';
        }

        return $content;
    }

    /**
     * Returning hero background image as thumbnail image for pages.
     *
     * @param integer|false $thumbnail_id
     * @param integer|WP_Post|null $post
     * @return integer
     */
    public function add_hero_image_as_thumbnail( int|false $thumbnail_id, int|WP_Post|null $post ) : int {
        // We only want to add a backup if post is of type "page" and there is no thumbnail set.
        if ($thumbnail_id || get_post_type($post) !== "page" || !$post ) {
            return $thumbnail_id;
        }

        $post_id = $post instanceof WP_Post ? $post->ID : $post;

        $page_modules = get_field('modules', $post_id) ?? false;

        if ( ! $page_modules ) {
            return $thumbnail_id;
        }
        
        foreach($page_modules as $page_module) {
            if ($page_module['acf_fc_layout'] === 'hero') {
                if ($page_module['background_image']) {
                    return $page_module['background_image'];
                }
            }
        }
        
        return $thumbnail_id;

        // $hero_image_id = get_field('')
    }
}
