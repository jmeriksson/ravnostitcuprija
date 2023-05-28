<?php
/**
 * Creates a custom post type: FAQ
 *
 * @package Ravnostitcuprija
 */

class Post_Type_FAQ extends Loader {
	/**
	 * Add hooks and filters here.
	 *
	 * @return void
	 */
	public function init() : void {
		add_action( 'init', [ $this, 'register_post_type' ] );
        add_action( 'post_thumbnail_id', [ $this, 'add_post_thumbnail_backup' ], 10, 2 );
	}

	/**
	 * Registers the post type.
	 *
	 * @return void
	 */
	public function register_post_type() : void {
		$singular_name = _x( 'FAQ', 'post type singular name', 'ravnostitcuprija' );
		$plural_name   = _x( 'FAQs', 'post type plural name', 'ravnostitcuprija' );
		$labels        = [
			'name'               => $plural_name,
			'singular_name'      => $singular_name,
			'add_new'            => _x( 'Add new', 'education', 'ravnostitcuprija' ),
			// translators: post type singular name
			'add_new_item'       => sprintf( __( 'Add new %s', 'ravnostitcuprija' ), $singular_name ),
			// translators: post type singular name
			'edit_item'          => sprintf( __( 'Edit %s', 'ravnostitcuprija' ), $singular_name ),
			// translators: post type singular name
			'new_item'           => sprintf( __( 'New %s', 'ravnostitcuprija' ), $singular_name ),
			// translators: post type singular name
			'view_item'          => sprintf( __( 'View %s', 'ravnostitcuprija' ), $singular_name ),
			// translators: post type plural name
			'view_items'         => sprintf( __( 'View %s', 'ravnostitcuprija' ), $plural_name ),
			// translators: post type plural name
			'search_items'       => sprintf( __( 'Search %s', 'ravnostitcuprija' ), $plural_name ),
			// translators: post type plural name
			'not_found'          => sprintf( __( 'No %s found', 'ravnostitcuprija' ), $plural_name ),
			// translators: post type plural name
			'not_found_in_trash' => sprintf( __( 'No %s found in trash', 'ravnostitcuprija' ), $plural_name ),
			// translators: post type plural name
			'all_items'          => sprintf( __( 'All %s', 'ravnostitcuprija' ), $plural_name ),
			// translators: post type singular name
			'archives'           => sprintf( __( '%s archive', 'ravnostitcuprija' ), $singular_name ),
			// translators: post type singular name
			'attributes'         => sprintf( __( '%s attributes', 'ravnostitcuprija' ), $singular_name ),
		];
		$args          = [
			'name'              => __( 'FAQ', 'ravnostitcuprija' ),
			'labels'            => $labels,
			'public'            => true,
			'show_ui'           => true,
			'show_in_menu'      => true,
			'show_in_nav_menu'  => true,
			'show_in_admin_bar' => true,
			'show_in_rest'      => true,
			'menu_position'     => 10,
			'menu_icon'         => 'dashicons-format-chat',
			'supports'          => [ 'title', 'editor', 'thumbnail' ],
			'has_archive'       => false,
			'delete_with_user'  => false,
		];
		register_post_type( 'faq', $args );
	}

    /**
     * Adds a backup image as a post thumbnail for FAQ posts, if none is set
     *
     * @param integer|false $thumbnail_id
     * @param integer|WP_Post|null $post
     * @return integer
     */
    public function add_post_thumbnail_backup( int|false $thumbnail_id, int|WP_Post|null $post) : int {
        // We only want to add a backup if post is of type "faq" and there is no thumbnail set.
        if ($thumbnail_id || get_post_type($post) !== "faq") {
            return $thumbnail_id;
        }

        $backup_thumbnail = get_field('faq_image', 'options') ?? false;

        if ($backup_thumbnail) {
            return $backup_thumbnail;
        }

        return $thumbnail_id;
    }
}
