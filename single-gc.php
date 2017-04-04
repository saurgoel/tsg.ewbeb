<?php get_header(); ?>
<div class="two-collumns-single left">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<article class="post" id="post-<?php the_ID(); ?>">
			<h2 class="heading"><?php the_title(); ?></h2><hr/>	
			<p><?php the_content(); ?></p>
			<div class="clear"></div>
			<?php head_title('RESULTS'); ?>
			<?php 	if (get_post_meta($post->ID, 'result-link', true)) { echo get_post_meta($post->ID, 'result-link', true);  } else { echo '<p>Results will be updated soon.</p>'; } ?>
			<div class="clear"></div>
			<?php head_title('EVENTS'); ?>
			<?php 
				$events = get_post_meta($post->ID, 'events', true);
				if ($events) {  echo $events;  } else { echo '<p>Events will be updated soon</p>'; }
			 	gallery('thumbnail'); 
		     ?>	
		<article>	
	<?php  endwhile; endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>