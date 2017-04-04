<?php
/*
Template Name: notices
*/
?>
<?php get_header(); ?>
<div class="two-collumns-single left">
	<?php head_title('NOTICE BOARD'); ?>
	<?php 
		$my_query = new WP_Query(array('showposts' =>  '-1', 'post_type' => 'post'));
		while ($my_query->have_posts()) : $my_query->the_post();
	?>
		<article class="post list" id="post-<?php the_ID(); ?>">
			<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<p class="date"><span class="clock"><?php the_time('M - j - Y'); ?></span></p>
		</article>
	<?php  endwhile; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>