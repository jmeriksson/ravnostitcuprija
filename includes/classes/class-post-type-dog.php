<?php
/**
 * Creates a custom post type: Dog
 *
 * @package ravnostitcuprija
 */

class Post_Type_Dog extends Loader {

	private static $post_type_name = 'dog';
    private static $post_type_singular_name;
    private static $post_type_plural_name;
    private static $post_type_slug;

	/**
	 * Add hooks and filters here.
	 *
	 * @return void
	 */
	public function init() : void {
        add_action( 'init', [ $this, 'set_translatable_strings' ], 1, 0 );
		add_action( 'init', [ $this, 'register_post_type' ] );
		add_action( 'init', [ $this, 'register_sex_taxonomy' ] );
		add_action( 'init', [ $this, 'register_weight_taxonomy' ] );
		add_action( 'init', [ $this, 'register_color_taxonomy' ] );
		add_action( 'init', [ $this, 'register_coat_length_taxonomy' ] );
		add_action( 'init', [ $this, 'register_activity_needs_taxonomy' ] );
		add_action( 'init', [ $this, 'register_tags_taxonomy' ] );
		add_action( 'pre_get_posts', [ $this, 'limit_number_of_posts_per_page' ] );
        add_filter('admin_post_thumbnail_html', [ $this, 'add_featured_image_instructions' ], 10, 2 );
	}

    public function set_translatable_strings() : void {
        self::$post_type_singular_name = _x( 'Dog', 'post type singular name', 'ravnostitcuprija' );
        self::$post_type_plural_name = _x( 'Dogs', 'post type plural name', 'ravnostitcuprija' );
        self::$post_type_slug = strtolower(self::$post_type_plural_name);
    }

	/**
	 * Registers the post type.
	 *
	 * @return void
	 */
	public function register_post_type() : void {
		$labels        = [
			'name'               => self::$post_type_plural_name,
			'singular_name'      => self::$post_type_singular_name,
			'add_new'            => _x( 'Add new', 'education', 'ravnostitcuprija' ),
			// translators: post type singular name
			'add_new_item'       => sprintf( __( 'Add new %s', 'ravnostitcuprija' ), self::$post_type_singular_name ),
			// translators: post type singular name
			'edit_item'          => sprintf( __( 'Edit %s', 'ravnostitcuprija' ), self::$post_type_singular_name ),
			// translators: post type singular name
			'new_item'           => sprintf( __( 'New %s', 'ravnostitcuprija' ), self::$post_type_singular_name ),
			// translators: post type singular name
			'view_item'          => sprintf( __( 'View %s', 'ravnostitcuprija' ), self::$post_type_singular_name ),
			// translators: post type plural name
			'view_items'         => sprintf( __( 'View %s', 'ravnostitcuprija' ), self::$post_type_plural_name ),
			// translators: post type plural name
			'search_items'       => sprintf( __( 'Search %s', 'ravnostitcuprija' ), self::$post_type_plural_name ),
			// translators: post type plural name
			'not_found'          => sprintf( __( 'No %s found', 'ravnostitcuprija' ), self::$post_type_plural_name ),
			// translators: post type plural name
			'not_found_in_trash' => sprintf( __( 'No %s found in trash', 'ravnostitcuprija' ), self::$post_type_plural_name ),
			// translators: post type plural name
			'all_items'          => sprintf( __( 'All %s', 'ravnostitcuprija' ), self::$post_type_plural_name ),
			// translators: post type singular name
			'archives'           => sprintf( __( '%s archive', 'ravnostitcuprija' ), self::$post_type_singular_name ),
			// translators: post type singular name
			'attributes'         => sprintf( __( '%s attributes', 'ravnostitcuprija' ), self::$post_type_singular_name ),
		];
		$args          = [
			'name'              => __( 'Dog', 'ravnostitcuprija' ),
			'labels'            => $labels,
			'public'            => true,
			'show_ui'           => true,
			'show_in_menu'      => true,
			'show_in_nav_menu'  => true,
			'show_in_admin_bar' => true,
			'show_in_rest'      => true,
			'menu_position'     => 10,
			'menu_icon'         => 'dashicons-pets',
			'supports'          => [ 'title', 'thumbnail', 'editor' ],
			'has_archive'       => true,
			'delete_with_user'  => false,
			'rewrite'           => [
				'slug' => self::$post_type_slug,
                'with_front' => false,
			],
		];
		register_post_type( self::$post_type_name, $args );
	}

	/**
	 * Register a taxonomy to describe the sex of the dog
	 *
	 * @return void
	 */
	public function register_sex_taxonomy() : void {
		$taxonomy_name = 'sex';
		$singular_name = _x('Sex', 'Singular name for sex, as in sex of a dog', 'ravnostitcuprija');
		$plural_name = _x('Sexes', 'Plural name for sexes, as in sexes of dogs', 'ravnostitcuprija');
        $slug = _x('sex', 'slug for the Sex taxonomy', 'ravnostitcuprija');
		$labels = [
			'name' => $plural_name,
			'singular_name' => $singular_name,
		];

		$args = [
			'public' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'rewrite' => [
				'slug' => $slug,
			],
			'labels' => $labels,
			'hierarchical' => true,
		];

		register_taxonomy( $taxonomy_name, self::$post_type_name, $args );
	}

	/**
	 * Register a taxonomy to describe the weight of the dog
	 *
	 * @return void
	 */
	public function register_weight_taxonomy() : void {
		$taxonomy_name = 'weight';
		$singular_name = _x('Weight', 'Singular name for weight', 'ravnostitcuprija');
		$plural_name = _x('Weights', 'Plural name for weights', 'ravnostitcuprija');
		$labels = [
			'name' => $plural_name,
			'singular_name' => $singular_name,
		];

		$args = [
			'public' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'rewrite' => [
				'slug' => _x('weight', 'slug for the Weight taxonomy', 'ravnostitcuprija'),
			],
			'labels' => $labels,
			'hierarchical' => true,
		];

		register_taxonomy( $taxonomy_name, self::$post_type_name, $args );
	}

	/**
	 * Register a taxonomy to describe the color of the dog
	 *
	 * @return void
	 */
	public function register_color_taxonomy() : void {
		$taxonomy_name = 'color';
		$singular_name = _x('Color', 'Singular name for color', 'ravnostitcuprija');
		$plural_name = _x('Colors', 'Plural name for colors', 'ravnostitcuprija');
		$labels = [
			'name' => $plural_name,
			'singular_name' => $singular_name,
		];

		$args = [
			'public' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'rewrite' => [
				'slug' => _x('color', 'slug for the Color taxonomy', 'ravnostitcuprija'),
			],
			'labels' => $labels,
			'hierarchical' => true,
		];

		register_taxonomy( $taxonomy_name, self::$post_type_name, $args );
	}

	/**
	 * Register a taxonomy to describe the coat length of the dog
	 *
	 * @return void
	 */
	public function register_coat_length_taxonomy() : void {
		$taxonomy_name = 'coat-length';
		$singular_name = _x('Coat length', 'Singular name for coat length', 'ravnostitcuprija');
		$plural_name = _x('Coat lengths', 'Plural name for coat lengths', 'ravnostitcuprija');
		$labels = [
			'name' => $plural_name,
			'singular_name' => $singular_name,
		];

		$args = [
			'public' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'rewrite' => [
				'slug' => _x('coat-length', 'slug for the Coat length taxonomy', 'ravnostitcuprija'),
			],
			'labels' => $labels,
			'hierarchical' => true,
		];

		register_taxonomy( $taxonomy_name, self::$post_type_name, $args );
	}

	/**
	 * Register a taxonomy to describe the activity needs of the dog
	 *
	 * @return void
	 */
	public function register_activity_needs_taxonomy() : void {
		$taxonomy_name = 'activity-needs';
		$singular_name = _x('Activity needs', 'Singular name for activity needs', 'ravnostitcuprija');
		$plural_name = _x('Activity needs', 'Plural name for activity needs', 'ravnostitcuprija');
		$labels = [
			'name' => $plural_name,
			'singular_name' => $singular_name,
		];

		$args = [
			'public' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'rewrite' => [
				'slug' => _x('activity-needs', 'slug for the Activity needs taxonomy', 'ravnostitcuprija'),
			],
			'labels' => $labels,
			'hierarchical' => true,
		];

		register_taxonomy( $taxonomy_name, self::$post_type_name, $args );
	}

	/**
	 * Register a taxonomy for tags
	 *
	 * @return void
	 */
	public function register_tags_taxonomy() : void {
		$taxonomy_name = 'tag';
		$singular_name = _x('Tag', 'Singular name for tag', 'ravnostitcuprija');
		$plural_name = _x('Tags', 'Plural name for tags', 'ravnostitcuprija');
		$labels = [
			'name' => $plural_name,
			'singular_name' => $singular_name,
		];

		$args = [
			'public' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'labels' => $labels,
			'hierarchical' => false,
            'has_archive' => true,
		];

		register_taxonomy( $taxonomy_name, self::$post_type_name, $args );
	}

	/**
	 * Sets the number of posts to fetch per archive page for this post type.
	 *
	 * @param WP_Query $query
	 * @return void
	 */
	public function limit_number_of_posts_per_page($query) : void {
		if ( $query->is_main_query() && !is_admin() && is_post_type_archive( 'dog' ) ) {
			$query->set('posts_per_archive_page', 15);
		}
	}

    public function add_featured_image_instructions($content, $post_id) : string {
        if ( get_post_type( $post_id ) === self::$post_type_name ) {
            return $content .= '<p>' . __('The featured image should have a resolution of at least 720 x 960 pixels.') . '</p>';
        }

        return $content;
    }
}
