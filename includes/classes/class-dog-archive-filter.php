<?php
/**
 * Handles filters of the dog post archive
 *
 * @package Ravnostitcuprija
 */

class Dog_Archive_Filter extends Loader {
    public static $all_filters = [
        'sex',
        'activity-needs',
        'coat-length',
        'weight',
        'color',
        'tag'
    ];

	/**
	 * Add hooks and filters here.
	 *
	 * @return void
	 */
	public function init() : void {
        add_action( 'pre_get_posts', [ $this, 'filter_posts' ], 10, 1 );
	}

    // public static function get_all_taxonomies() : array {

    // }

    public function filter_posts( WP_Query $query ) : WP_Query {
        if ( is_admin() ) {
            return $query;
        }

        if ( ! is_archive() || 'dog' !== $query->get('post_type') ) {
            return $query;
        }

        $tax_query = [];

        foreach ( self::$all_filters as $filter ) {
            if ( isset($_GET[$filter]) && ! empty($_GET[$filter]) ) {
                $tax_query[] = [
                    'taxonomy' => $filter,
                    'field' => 'slug',
                    'terms' => $_GET[$filter],
                ];
            }
        }

        if ( count( $tax_query ) > 0 ) {
            $query->set('tax_query', $tax_query);
        }

        return $query;
    }
}
