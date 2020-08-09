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
?>

<div class="post-cont <?php echo $layout ?>">
    <h3><?php echo get_the_title(); ?></h3>
    <p><?php echo $excerpt; ?></p>
    <button data-link="<?php echo get_permalink(); ?>" class="readmore">Tovább</button>
</div>
