<?php get_header(); ?>
<div class="two-collumns-single left">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<article class="post" id="post-<?php the_ID(); ?>">
			<h2 class="heading"><?php the_title(); ?></h2><hr/>	
			<p><?php the_content(); ?></p>
			<div class="clear"></div>
			<?php head_title('CONTACTS'); ?>
			<?php 
				$members = get_post_meta($post->ID, 'members', true);
				if ($members) {  echo $members;  } else { echo '<p>Members will be updated soon</p>'; }
				gallery('thumbnail'); 
			 ?>	
		<article>	
	<?php  endwhile; endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>