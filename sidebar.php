<div class="one-collumn-single sidebar right">
	<article>
		<?php head_title('SEARCH');  ?>
		<?php get_search_form(); ?>
	</article>
	<article>
		<?php head_title('LATEST UPDATES');  ?>
		<ul class="circle">
			<?php 
				$my_query = new WP_Query(array('showposts' =>  '5', 'category_name' => 'latest'));
				while ($my_query->have_posts()) : $my_query->the_post();
			?>
			<li><h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3></li>
			<?php endwhile; ?>
		</ul>
	</article>
	<ul>
		<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar') ) : else : ?>
		<?php endif; ?>
	</ul>
</div>
