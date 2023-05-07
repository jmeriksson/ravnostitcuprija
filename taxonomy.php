<?php
/**
* Dog post archive
*
* @package ravnostitcuprija
*/

get_header();

$term = get_queried_object();
$taxonomy = get_taxonomy($term->taxonomy);

?>

<main class="main">
	<div class="container">
        <section class="section">
            <?php if ($term && $taxonomy) : ?>
                <h1><?php echo $taxonomy->labels->singular_name . ': ' . $term->name; ?></h1>
            <?php endif; ?>
        </section>
		<?php if (have_posts()) : ?>
			<section class="section">
				<div class="dog-archive-grid">
					<?php while(have_posts()) : ?>
						<?php
							the_post();
							$dog_id = get_the_ID();
							$sex = get_the_terms($dog_id, 'sex');
							$weight = get_the_terms($dog_id, 'weight');
							$date_of_birth = get_field('date_of_birth', $dog_id);
							$age = ravnostit_calculate_dog_age($date_of_birth, 'Y');
						?>
						<div class="dog-archive-entry">
							<a href="<?php echo esc_url(get_the_permalink()); ?>">
								<figure>
									<?php the_post_thumbnail('xs_4_3'); ?>
								</figure>
								<div class="dog-archive-entry__bottom">
									<h2><?php echo esc_html(the_title()); ?></h2>
									<div class="dog-archive-entry__meta">
										<p>
											<?php if ($sex && ! $sex instanceof WP_Error) : ?>
												<span><?php echo esc_html($sex[0]->name); ?></span>
											<?php endif; ?>
											<?php if ($age) : ?>
												<span><?php echo esc_html($age); ?></span>
											<?php endif; ?>
											<?php if ($weight && ! $weight instanceof WP_Error) : ?>
												<span>
													<?php
													printf(
														esc_html__('Weight: %s', 'ravnostitcuprija'),
														$weight[0]->name,
													);
													?>
												</span>
											<?php endif; ?>
										</p>
									</div>
								</div>
							</a>
						</div>
					<?php endwhile; ?>
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
					<p><?php echo esc_html__('Sorry, there are no dogs available for adoption at the moment', 'ravnostitcuprija'); ?></p>
				</section>
		<?php endif; ?>
	</div>
</main>

<?php
wp_reset_postdata();
get_footer();