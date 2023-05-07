<?php
/**
* Dog post archive
*
* @package ravnostitcuprija
*/

get_header();

$headline = get_field('dog_archive_headline', 'options') ?? false;
$content = get_field('dog_archive_text_content', 'options') ?? false;

$filtering_options = [
    [
        'headline' => __('Sex', 'ravnostitcuprija'),
        'taxonomy' => 'sex',
        'terms' => get_categories(
            [
                'taxonomy' => 'sex',
                'orderby' => 'name',
            ]
        )
    ],
    [
        'headline' => __('Weight', 'ravnostitcuprija'),
        'taxonomy' => 'weight',
        'terms' => get_categories(
            [
                'taxonomy' => 'weight',
                'orderby' => 'name',
            ]
        )
    ],
    [
        'headline' => __('Color', 'ravnostitcuprija'),
        'taxonomy' => 'color',
        'terms' => get_categories(
            [
                'taxonomy' => 'color',
                'orderby' => 'name',
            ]
        )
    ],
    [
        'headline' => __('Activity needs', 'ravnostitcuprija'),
        'taxonomy' => 'activity-needs',
        'terms' => get_categories(
            [
                'taxonomy' => 'activity-needs',
                'orderby' => 'name',
            ]
        )
    ],
    [
        'headline' => __('Coat length', 'ravnostitcuprija'),
        'taxonomy' => 'coat-length',
        'terms' => get_categories(
            [
                'taxonomy' => 'coat-length',
                'orderby' => 'name',
            ]
        )
    ],
];

?>

<main class="main">
	<div class="container">
        <section class="section">
            <?php if ($headline) : ?>
                <h1><?php echo esc_html($headline); ?></h1>
            <?php endif; ?>
            <?php if ($content) : ?>
                <div class="entry-content">
                    <?php echo wp_kses_post($content); ?>
                </div>
            <?php endif; ?>
            <div class="filtering">
                <button class="btn btn--primary" id="js-dog-archive-filter-button">
                    <?php echo esc_html__('Filter selection', 'ravnostitcuprija'); ?>
                    <?php echo file_get_contents( get_template_directory() . '/assets/images/icons/filter.svg' ) ?>
                </button>
                <div class="filtering-form-wrapper hidden" id="js-filtering-form-wrapper">
                    <form method="GET" id="dog-archvive-filter-form">
                        <?php foreach ( $filtering_options as $filter ) : ?>
                            <div>
                            <h3 class="h4"><?php echo esc_html( $filter['headline'] ); ?></h3>
                            <input type="radio" name="<?php echo esc_attr($filter['taxonomy']); ?>" id="<?php echo esc_attr($filter['taxonomy']) ?>-any" value="0" />
                            <label for="<?php echo esc_attr($filter['taxonomy']) ?>-any"><?php echo esc_html__('Any', 'ravnostitcuprija'); ?></label>
                            <?php foreach ($filter['terms'] as $term ) : ?>
                                <input type="radio" name="<?php echo esc_attr($filter['taxonomy']); ?>" id="<?php echo esc_attr($term->taxonomy) . '-' . esc_attr($term->slug); ?>" value="<?php echo esc_attr($term->slug); ?>" <?php echo (isset($_GET[$term->taxonomy]) && $_GET[$term->taxonomy] == $term->slug) ? 'checked' : ''; ?>/>
                                <label for="<?php echo esc_attr($term->taxonomy) . '-' . esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></label>
                            <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                        <div class="submit-button">
                            <button class="btn btn--primary" type="submit"><?php echo esc_html__('Filter', 'ravnostitcuprija'); ?></button>
                            <?php global $wp; ?>
                            <a href="<?php echo home_url($wp->request); ?>" class="btn btn--secondary"><?php echo esc_html__('Clear all filters', 'ravnostitcuprija'); ?></a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
		<?php if (have_posts()) : ?>
			<section class="section">
				<div class="dog-archive-grid">
					<?php 
                    while(have_posts()) {
                        the_post();
                        get_template_part('/templates/partials/card-dog', '', ['post_id' => get_the_ID()]);
                    }
                    ?>
				</div>
			</section>
			<section class="section">
                <?php
                $pagination_args = [
                    'prev_text' => __('Previous', 'ravnostitcuprija'),
                    'next_text' => __('Next', 'ravnostitcuprija'),
                ];
                the_posts_pagination($pagination_args);
                ?>
			</section>
		<?php else : ?>
				<section class="section">
					<p><?php echo esc_html__('Sorry, there are no dogs available for adoption at the moment, or no dogs matching the criteria you have selected.', 'ravnostitcuprija'); ?></p>
				</section>
		<?php endif; ?>
	</div>
</main>

<?php
wp_reset_postdata();
get_footer();