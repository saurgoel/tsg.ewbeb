<?php get_header(); ?>
<div class="two-collumns-single left">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<article class="post" id="post-<?php the_ID(); ?>">
			<h2 class="heading"><?php the_title(); ?></h2><hr/>
			<p><?php the_content(); ?></p>
			<div class="clear"></div>
		</article>	
	<?php  endwhile; endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>