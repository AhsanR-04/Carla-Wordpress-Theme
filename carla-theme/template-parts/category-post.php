<?php
/**
 * Template part for displaying posts
 */

$category = isset(get_the_category()[0]) ? get_the_category()[0] : '';
$cat_link = !empty($category) ? get_category_link($category) : '';
$cat_name = $category->name;
$post_id = get_the_ID();
$thumbnail_id = get_post_thumbnail_id($post_id);
$thumbnail_html = wp_get_attachment_image($thumbnail_id, 'medium_large');
$title = get_the_title();
$author_name = get_the_author_meta('display_name'); 
$author_id = get_the_author_meta('ID');
$author_link = get_author_posts_url($author_id);
$avatar = get_avatar($author_id, $size = '40');
$the_date = get_the_date();
?>

<article id="post-<?php the_ID(); ?>" class="col-lg-4 col-md-6 col-12 mb-4">
    <a href="<?php echo esc_url(get_permalink()); ?>" class="item-link h-100">
        <div class="card bg-light-subtle overflow-hidden h-100">
            <div class="post-image aspect_ratio_4">
                <?php if ($thumbnail_html) {
                    echo $thumbnail_html;
                } ?>
            </div>
            <div class="card-img-overlay">
                <span class="badge text-bg-primary">
                    <?php echo esc_html($cat_name); ?>
                </span>
            </div>

            <div class="card-body">
                <div class="card-title fs-6 lh-sm fw-bold">
                    <?php echo esc_html($title); ?>
                </div>

                <div class="meta-info d-flex align-items-center text-capitalize gap-4">
                    <div class="author-info d-flex align-items-center gap-2">
                        <div class="avatar-img rounded-circle overflow-hidden">
                            <?php echo $avatar ?>
                        </div>
                        By <?php echo esc_html($author_name); ?>
                    </div>

                    <div class="date">
                        <?php echo $the_date; ?>
                    </div>

                </div>
            </div>

        </div>
    </a>
</article><!-- #post-<?php the_ID(); ?> -->