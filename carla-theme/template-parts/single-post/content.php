<?php
/**
 * Template part for displaying posts
 *
 */
$post_id = get_the_ID();
$thumbnail_id = get_post_thumbnail_id($post_id);
$thumbnail_html = wp_get_attachment_image($thumbnail_id, 'full');
$thumbnail = get_the_post_thumbnail();
$author_name = get_the_author_meta('display_name');
$author_description = get_the_author_meta('description');
?>


<header class="entry-header my-3">
	<?php
	the_breadcrumb();
	if (is_singular()):
		the_title('<h1 class="entry-title my-2 ">', '</h1>');
	else:
		the_title('<h2 class="entry-title my-2 "><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
	endif;

	if ('post' === get_post_type()):
		?>
		<div class="entry-meta text-capitalize">
			<?php
			carla_posted_on();
			carla_posted_by();
			?>
		</div>
	<?php endif; ?>
</header>

<div class="featured-image mb-3 rounded overflow-hidden">
	<?php
	// Output the post thumbnail if it exists
	if ($thumbnail_html) {
		// echo '<img width="900" height="500" src="' . esc_url($thumbnail_url) . '" class="attachment-medium_large size-medium_large img-fluid w-100 object-fit-cover rounded my-3" style="aspect-ratio: 16/9;">';
		echo $thumbnail_html;
	}
	?>
</div>

<div class="entry-content">
	<?php
	the_content(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'carla'),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			wp_kses_post(get_the_title())
		)
	);

	wp_link_pages(
		array(
			'before' => '<div class="page-links">' . esc_html__('Pages:', 'carla'),
			'after' => '</div>',
		)
	);
	?>
</div><!-- .entry-content -->


<!-- author -->
<div class="container p-0 mb-4 bg-body-tertiary rounded p-4">
	<div class="row">
		<p class="fs-4 fw-semibold text-capitalize">
			<?php echo $author_name; ?>
		</p>
		<p>
			<?php echo $author_description; ?>
		</p>

		<div class="author-social-links d-flex gap-2">
			<?php if (!empty(get_the_author_meta('twitter'))): ?>
				<div><a href="<?php echo esc_url(get_the_author_meta('twitter')); ?>" target="_blank">
						<svg width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
							aria-hidden="true" focusable="false">
							<path
								d="M13.982 10.622 20.54 3h-1.554l-5.693 6.618L8.745 3H3.5l6.876 10.007L3.5 21h1.554l6.012-6.989L15.868 21h5.245l-7.131-10.378Zm-2.128 2.474-.697-.997-5.543-7.93H8l4.474 6.4.697.996 5.815 8.318h-2.387l-4.745-6.787Z">
							</path>
						</svg>
					</a></div>
			<?php endif; ?>
			<?php if (!empty(get_the_author_meta('facebook'))): ?>
				<div><a href="<?php echo esc_url(get_the_author_meta('facebook')); ?>" target="_blank">
						<svg width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
							aria-hidden="true" focusable="false">
							<path
								d="M12 2C6.5 2 2 6.5 2 12c0 5 3.7 9.1 8.4 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.3v7C18.3 21.1 22 17 22 12c0-5.5-4.5-10-10-10z">
							</path>
						</svg>
					</a></div>
			<?php endif; ?>
			<?php if (!empty(get_the_author_meta('linkedin'))): ?>
				<div><a href="<?php echo esc_url(get_the_author_meta('linkedin')); ?>" target="_blank">
						<svg width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
							aria-hidden="true" focusable="false">
							<path
								d="M19.7,3H4.3C3.582,3,3,3.582,3,4.3v15.4C3,20.418,3.582,21,4.3,21h15.4c0.718,0,1.3-0.582,1.3-1.3V4.3 C21,3.582,20.418,3,19.7,3z M8.339,18.338H5.667v-8.59h2.672V18.338z M7.004,8.574c-0.857,0-1.549-0.694-1.549-1.548 c0-0.855,0.691-1.548,1.549-1.548c0.854,0,1.547,0.694,1.547,1.548C8.551,7.881,7.858,8.574,7.004,8.574z M18.339,18.338h-2.669 v-4.177c0-0.996-0.017-2.278-1.387-2.278c-1.389,0-1.601,1.086-1.601,2.206v4.249h-2.667v-8.59h2.559v1.174h0.037 c0.356-0.675,1.227-1.387,2.526-1.387c2.703,0,3.203,1.779,3.203,4.092V18.338z">
							</path>
						</svg>
					</a></div>
			<?php endif; ?>
			<?php if (!empty(get_the_author_meta('instagram'))): ?>
				<div><a href="<?php echo esc_url(get_the_author_meta('instagram')); ?>" target="_blank">
						<svg width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
							aria-hidden="true" focusable="false">
							<path
								d="M12,4.622c2.403,0,2.688,0.009,3.637,0.052c0.877,0.04,1.354,0.187,1.671,0.31c0.42,0.163,0.72,0.358,1.035,0.673 c0.315,0.315,0.51,0.615,0.673,1.035c0.123,0.317,0.27,0.794,0.31,1.671c0.043,0.949,0.052,1.234,0.052,3.637 s-0.009,2.688-0.052,3.637c-0.04,0.877-0.187,1.354-0.31,1.671c-0.163,0.42-0.358,0.72-0.673,1.035 c-0.315,0.315-0.615,0.51-1.035,0.673c-0.317,0.123-0.794,0.27-1.671,0.31c-0.949,0.043-1.233,0.052-3.637,0.052 s-2.688-0.009-3.637-0.052c-0.877-0.04-1.354-0.187-1.671-0.31c-0.42-0.163-0.72-0.358-1.035-0.673 c-0.315-0.315-0.51-0.615-0.673-1.035c-0.123-0.317-0.27-0.794-0.31-1.671C4.631,14.688,4.622,14.403,4.622,12 s0.009-2.688,0.052-3.637c0.04-0.877,0.187-1.354,0.31-1.671c0.163-0.42,0.358-0.72,0.673-1.035 c0.315-0.315,0.615-0.51,1.035-0.673c0.317-0.123,0.794-0.27,1.671-0.31C9.312,4.631,9.597,4.622,12,4.622 M12,3 C9.556,3,9.249,3.01,8.289,3.054C7.331,3.098,6.677,3.25,6.105,3.472C5.513,3.702,5.011,4.01,4.511,4.511 c-0.5,0.5-0.808,1.002-1.038,1.594C3.25,6.677,3.098,7.331,3.054,8.289C3.01,9.249,3,9.556,3,12c0,2.444,0.01,2.751,0.054,3.711 c0.044,0.958,0.196,1.612,0.418,2.185c0.23,0.592,0.538,1.094,1.038,1.594c0.5,0.5,1.002,0.808,1.594,1.038 c0.572,0.222,1.227,0.375,2.185,0.418C9.249,20.99,9.556,21,12,21s2.751-0.01,3.711-0.054c0.958-0.044,1.612-0.196,2.185-0.418 c0.592-0.23,1.094-0.538,1.594-1.038c0.5-0.5,0.808-1.002,1.038-1.594c0.222-0.572,0.375-1.227,0.418-2.185 C20.99,14.751,21,14.444,21,12s-0.01-2.751-0.054-3.711c-0.044-0.958-0.196-1.612-0.418-2.185c-0.23-0.592-0.538-1.094-1.038-1.594 c-0.5-0.5-1.002-0.808-1.594-1.038c-0.572-0.222-1.227-0.375-2.185-0.418C14.751,3.01,14.444,3,12,3L12,3z M12,7.378 c-2.552,0-4.622,2.069-4.622,4.622S9.448,16.622,12,16.622s4.622-2.069,4.622-4.622S14.552,7.378,12,7.378z M12,15 c-1.657,0-3-1.343-3-3s1.343-3,3-3s3,1.343,3,3S13.657,15,12,15z M16.804,6.116c-0.596,0-1.08,0.484-1.08,1.08 s0.484,1.08,1.08,1.08c0.596,0,1.08-0.484,1.08-1.08S17.401,6.116,16.804,6.116z">
							</path>
						</svg>
					</a></div>
			<?php endif; ?>
			<!-- Repeat for other social networks -->
		</div>

	</div>
</div>


<!-- post navigation-->
<nav aria-label="post navigation">
	<div class="d-flex justify-content-center gap-3 ">
		<div class="d-flex justify-content-center p-2 gap-3 w-50 bg-body-tertiary fw-bold rounded">
			« <?php previous_post_link('%link'); ?>
		</div>
		<div class="d-flex justify-content-center p-2 gap-3 w-50 bg-body-tertiary fw-bold rounded">
			<?php next_post_link('%link'); ?> »
		</div>
	</div>
</nav>