<?php
/* Template Name: Blank */
get_header();
?>
<main id="primary" class="site-main">
	<div class="container-full-width" >
			<?php
				while ( have_posts() ) :
					the_post();

					 the_content(); 

				endwhile;
			?>
	</div>
</main>
<?php
get_footer();