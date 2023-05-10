<?php
/**
 * Handles search form logic
 *
 * @package Ravnostitcuprija
 */

class Search_Form extends Loader {

	/**
	 * Add hooks and filters here.
	 *
	 * @return void
	 */
	public function init() : void {
		add_filter( 'get_search_form', [ $this, 'filter_search_form_html' ] );
	}

    public function filter_search_form_html( string $html = '', array $args = [] ) {
        $aria_label = $args['aria_label'] ?? '';

        ob_start();
        ?>
        <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( get_home_url() ); ?>" aria-label="<?php echo esc_attr($aria_label); ?>">
            <div>
                <label class="screen-reader-text" for="s"><?php echo esc_attr__('Search for:', 'ravnostitcuprija') ?></label>
                <input type="text" value="" name="s" id="s" placeholder="<?php echo esc_attr__('Search...', 'ravnostitcuprija'); ?>">
                <button type="submit" id="searchsubmit" aria-label="<?php echo esc_attr__('Search', 'ravnostitcuprija'); ?>">
                    <?php echo file_get_contents( get_template_directory() . '/assets/images/icons/search.svg' ); ?>
                </button>
            </div>
        </form>
        <?php
        return ob_get_clean();
    }
}