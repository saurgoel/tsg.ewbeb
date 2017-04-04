<?php get_header(); ?>
<div class="two-collumns-single left">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	<article class="post" id="post-<?php the_ID(); ?>">
		<div class="title" style="margin-top: 30px; ">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		</div>

		<div class="postmeta" style="margin-top: 15px; ">
				<span class="author">Posted by <?php the_author(); ?> </span>
				<span class="clock"> Posted on <?php the_time('M - j - Y'); ?></span>
		</div>
		<div class="entry">
			<?php the_content(); ?>
			<div class="clear"></div>
			<?php wp_link_pages(array('before' => '<p><strong>Pages: </strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>
		<div class="singleinfo">
			<span class="categori">Categories: <?php the_category(', '); ?> </span>
		</div>
	</article>
	<?php 	endwhile;  ?>
	<?php else: ?>
		<h1 class="title">Not Found</h1>
		<p>I'm Sorry,  you are looking for something that is not here. Try a different search.</p>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>