<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlatC
 */
$layout = get_query_var('blog_post_layout');
$excerpt = get_the_excerpt();
$excerpt = substr($excerpt, 0, 160);
$excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));
$excerpt = $excerpt . '...';
$categories = get_the_category();
?>

<div class="post-cont">
    <div class="flatc-categories">
    <?php
        foreach ($categories as $cat) {
            echo '<a href="' . get_category_link($cat) . '" class="post-cat">' . $cat->name . '&nbsp;</a>';
        }
        ?>
    </div>
    <h3><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
    <p><?php echo $excerpt; ?></p>
</div>