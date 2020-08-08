<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlatC
 */
$layout = get_query_var('blog_post_layout');
?>

<div class="post-cont <?php echo $layout ?>">
    <h3><?php echo get_the_title(); ?></h3>
    <p><?php echo get_the_excerpt(); ?></p>
    <button class="readmore">Tovább</button>
</div>
