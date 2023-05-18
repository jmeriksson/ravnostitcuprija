<?php
/**
* Single dog post
*
* @package Ravnostitcuprija
*/

get_header();
$taxonomies = get_post_taxonomies();
$terms = wp_get_post_terms($post->ID, $taxonomies);
$tags = []; 
$categories = [];

foreach($terms as $term) {
	switch($term->taxonomy) {
		case 'tag':
			$tags[] = $term;
			break;
        default:
            $categories[$term->slug] = $term;
	}
}

$date_of_birth = get_field('date_of_birth') ?? false;
$additional_photos = get_field('additional_photos') ?? false;
$general_dog_page_headline = get_field('dog_adoption_page_headline', 'options') ?? false;
$dog_adoption_page_content = get_field('dog_adoption_page_content', 'options') ?? false;
$dog_adoption_page_form = get_field('dog_adoption_page_form', 'options') ?? false;
$dog_archive_permalink = get_post_type_archive_link('dog');
$reserved = get_field('reserved') ?? false;
$reserved_headline = get_field('dog_adoption_reserved_dog_headline', 'options') ?? false;
$reserved_text_content = get_field('dog_adoption_reserved_dog_content', 'options') ?? false;
?>

<main class="main">
	<div class="container">
		<section class="section single-dog-post-first-section">
			<?php if (get_post_thumbnail_id()) : ?>
				<div class="single-dog-post-hero">
					<figure>
                        <a target="_blank" href="<?php echo get_the_post_thumbnail_url(get_the_ID()) ?>">
						    <?php echo get_the_post_thumbnail(get_the_ID(), 'sm_3_4'); ?>
                        </a>
                        <?php if ($reserved) : ?>
                            <div class="reserved-image-banner"><?php esc_html_e('Reserved', 'ravnostitcuprija'); ?></div>
                        <?php endif; ?>
					</figure>
				</div>
			<?php endif; ?>
			<div class="single-dog-post-main-content">
				<?php the_title('<h1>', '</h1>', true); ?>
				<?php if (count($tags) > 0 || true ): ?>
					<div class="dog-tags">
						<?php foreach ($tags as $tag): ?>
							<span title="<?php echo esc_attr($tag->description); ?>"><?php echo esc_html($tag->name); ?></span>
						<?php endforeach; ?>
					</div>			
				<?php endif; ?>
				<div class="single-dog-post-content entry-content">
					<?php the_content(); ?>
				</div>
				<div class="single-dog-post-meta">
					<?php if ($date_of_birth) : ?>
						<p>
							<?php
							printf(
								esc_html__('Age: %s%s%s', 'ravnostitcuprija'),
								'<span class="regular-weight">',
								ravnostit_calculate_dog_age($date_of_birth, 'YM'),
								'</span>',
							);
							?>
						</p>
					<?php endif; ?>
                    <?php foreach ($categories as $category) : ?>
                        <p>
                            <?php
                                printf(
                                    '%s: <a href="%s">%s</a>',
                                    esc_html(ucfirst(str_replace('-', ' ', $category->taxonomy))),
                                    get_post_type_archive_link('dog') . '?' . $category->taxonomy . '=' . $category->slug,
                                    esc_html($category->name)
                                );
                            ?>
                        </p>
                    <?php endforeach; ?>
                </div>
			</div>
		</section>

			<?php if ($additional_photos && count($additional_photos) > 0 ): ?>
				<section class="section single-dog-post-gallery">
					<div class="swiper swiper-1234">
						<div class="swiper-wrapper">
							<?php foreach($additional_photos as $photo_id): ?>
								<div class="swiper-slide">
									<figure>
                                        <a target="_blank" href="<?php echo wp_get_attachment_url($photo_id); ?>">
										    <?php echo wp_get_attachment_image($photo_id, 'xs_3_4'); ?>
                                        </a>
									</figure>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="swiper-pagination"></div>
					</div>
				</section>
			<?php endif; ?>

            <?php if (!$reserved) : ?>

                <section class="section single-dog-post-adoption-section">
                    <?php if ($general_dog_page_headline) : ?>
                        <h2><?php echo esc_html(str_replace('%DOGNAME%', get_the_title(), $general_dog_page_headline)); ?></h2>
                    <?php endif; ?>
                    <div class="single-dog-post-adoption">
                        <?php if ($dog_adoption_page_content) : ?>
                            <div class="single-dog-post-adoption-text-content">
                                <?php echo wp_kses_post(str_replace('%DOGNAME%', get_the_title(), $dog_adoption_page_content)); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($dog_adoption_page_form && function_exists('Ninja_Forms')) : ?>
                            <div class="single-dog-post-adoption-form">
                                <?php Ninja_Forms()->display($dog_adoption_page_form); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>

            <?php else : ?>

                <section class="section single-dig-post-reserved-section">
                    <div class="reserved-wrapper">
                        <?php if ($reserved_headline) : ?>
                            <div class="single-dog-post-reserved-headline">
                                <h2><?php echo esc_html(str_replace('%DOGNAME%', get_the_title(), $reserved_headline)); ?></h2>
                            </div>
                        <?php endif; ?>
                        <?php if ($dog_adoption_page_content) : ?>
                            <div class="single-dog-post-reserved-text-content">
                                <?php echo wp_kses_post(str_replace('%DOGNAME%', get_the_title(), $reserved_text_content)); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>

            <?php endif; ?>
		</div>
	</div>
</main>
<?php

get_footer();
