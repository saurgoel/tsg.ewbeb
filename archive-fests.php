<?php get_header(); ?>
<div class="two-collumns-single left">
<?php head_title('FESTS'); ?>
<article class="post">
	<p>Following are the List of Fests:</p>
	<ul class="thumbnail-list">
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php if(has_post_thumbnail()):  ?>
				<li class="thumbnail">		
				<div id="logos"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_post_thumbnail(); ?></a></div>
			<?php else: ?>
				<li class="no-thumbnail">
			<?php endif; ?>
			<div class="btitle">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			</div>
			<div class="boxentry">
				<?php custom_excerpt(250); ?>
			</div>
			<div class="clear"></div>
				</li>
		<?php endwhile; else: ?>
		<p>There are no posts to show now.</p>
		<?php  endif; ?>
	</ul>
</article>	
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>	