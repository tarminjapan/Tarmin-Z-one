<?php get_header(); ?>

<main class="postlist">

<?php if(have_posts()): while(have_posts()): the_post(); ?>

<article <?php post_class(); ?>>
<a href="<?php the_permalink(); ?>">

<?php if( has_post_thumbnail() ): ?>
<figure>
<?php the_post_thumbnail(); ?>
</figure>
<?php endif; ?>

<h1><?php the_title(); ?></h1>

</a>
</article>

<?php endwhile; endif; ?>

<?php the_posts_pagination( array(
	'prev_text' => '<i class="fas fa-angle-left"></i><span class="screen-reader-text">‘O‚Ö</span>',
	'next_text' => '<span class="screen-reader-text">ŽŸ‚Ö</span><i class="fas fa-angle-right"></i>',
)); ?>

</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>