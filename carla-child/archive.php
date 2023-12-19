<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pls-snu
 */

get_header();
?>

<main id="primary" class="site-main">

	<div class="page-header container py-5  text-center">
		<?php
		do_action('pls_cat_before_title');
		the_archive_title('<h1 class="page-title">', '</h1>');
		do_action('pls_cat_after_title');
		do_action('pls_cat_before_desc');
		the_archive_description('<div class="archive-description">', '</div>');
		do_action('pls_cat_after_desc');
		?>
	</div><!-- .page-header -->

	<!-- adding minimium 8 child category -->
	<div class="container  mb-4">
		<div class="row">

			<?php if (is_category()) {
				// Get the current category ID on the archive page
				$current_category = get_queried_object();

				// Get the child categories of the current category
				$child_categories = get_categories(
					array(
						'child_of' => $current_category->term_id,
					)
				);

				// Sort child categories by the number of posts in descending order
				usort($child_categories, function ($a, $b) {
					return $b->count - $a->count;
				});

				// Limit the number of child categories to display
				$max_categories_to_display = 8;
				$displayed_categories = array_slice($child_categories, 0, $max_categories_to_display);

				if (!empty($displayed_categories)) {
					echo '<ul class="child-cat authors_ul d-flex p-0 gap-4 justify-content-center flex-wrap ">';
					foreach ($displayed_categories as $category) {
						echo '<li class="child-cat-item bg-light rounded ">';
						echo '<a class="d-block px-4 py-3 text-dark text-center fs-5 fw-bold" href="' . get_category_link($category->term_id) . '" title="' . $category->name . '" >' . $category->name . '</a>';
						echo '</li>';
					}
					echo '</ul>';
				}
			}
			?>
		</div>
	</div>

	<!-- adding Top 3 Authors -->
	<div class="container  mb-4">
		<div class="row ">
			<?php
			if (is_category()) {
				echo do_shortcode('[category_authors]');
			}
			;
			?>
		</div>
	</div>


	<!-- featured-section -->
	<div class="container pb-5 mb-5 border-bottom featured-section">
		<div class="row">
			<div class="group-grid">
				<?php
				if (is_category()) {
					// Determine the current category
					$current_category = get_queried_object();

					// Check if $current_category is not null
					if ($current_category) {
						// Query the latest post in the current category with the "featured" tag
						$args = array(
							'category_name' => $current_category->slug,
							'tag' => 'featured',
							'posts_per_page' => 3,
							'orderby' => 'date',
							'order' => 'DESC',
						);

						$latest_featured_post = new WP_Query($args);

						// Display the post
										
						if ($latest_featured_post->have_posts()) {
							$i = 0; // Initialize a post count variable
							while ($latest_featured_post->have_posts()) {
								$latest_featured_post->the_post();
								?>

								<?php
								$post_id = get_the_ID();
								$thumbnail_url = get_the_post_thumbnail_url($post_id, 'wide');
								?>


								<a href="<?php the_permalink(); ?>" class="d-block grid-item item-<?php $i; ?>">
									<div class="card h-100 border-0 overflow-hidden">

										<img class="w-100 h-100" width="auto" height="250" src="<?php echo $thumbnail_url; ?>')"
											style="aspect-ratio:16/9 !important;">


										<div class="card-img-overlay d-flex flex-column justify-content-between">
											<p><span class="badge text-bg-light">
													<?php
													$categories = get_the_category();
													if (!empty($categories)) {
														echo esc_html($categories[0]->name); // Display the first category of the post
													}
													?>
												</span></p>
											<div class="card-info">
												<div class="card-title text-light fs-5 lh-sm fw-bold">
													<?php the_title(); ?>
												</div>
											</div>
										</div>
									</div>
								</a>

								<?php
								// Reset post data to restore the main loop's context
								wp_reset_postdata();
								$i++;
							}
						}
					}
				}
				?>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">

			<?php if (have_posts()): ?>
				<?php
				do_action('pls_cat_before_loop');
				/* Start the Loop */
				while (have_posts()):
					the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part('template-parts/content', get_post_type());

				endwhile;
				do_action('pls_cat_after_loop');

				// the_posts_navigation();
				bootscore_pagination();

			else:
				// get_template_part( 'template-parts/content', 'none' );
				?>

				<div class="py-5 text-center">
					<p>
						<?php esc_html_e('No content found. Please try again with some different keywords.', 'pls-snu'); ?>
					</p>
					<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
						<label class="w-100">
							<span class="screen-reader-text">
								<?php echo _x('Search for:', 'label', 'your-theme-text-domain'); ?>
							</span>
							<input type="search" class="search-field w-100 p-2 "
								placeholder="<?php echo esc_attr_x('Hit enter to search or ESC to close', 'placeholder', 'your-theme-text-domain'); ?>"
								value="<?php echo get_search_query(); ?>" name="s" />
						</label>
					</form>
				</div>
			<?php endif; ?>
		</div>
	</div>
</main><!-- #main -->
<?php
get_sidebar();
get_footer();