<?php get_header(); ?>
<div class="two-collumns-single left">
   <?php head_title('SEARCH'); ?>
   <div class="subtitle"><p><?php $mySearch =& new WP_Query("s=$s & showposts=-1");	$num = $mySearch->post_count;	echo $num.' search results for '; the_search_query();?>.</p></div>
   <?php if (have_posts()) : ?>
   <?php while (have_posts()) : the_post(); ?>
      <article class="post list" id="post-<?php the_ID(); ?>">
            <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
            <p class="date"><span class="clock"><?php the_time('M - j - Y'); ?></span></p>
      </article>
   <?php endwhile; ?><?php getpagenavi(); ?>
   <?php else : ?>
      <h4 style="text-align: center;">Your search - <?php the_search_query();?> - did not match any entries.</h4>
      <div class="entry">
         <p>Suggestions:</p>
         <ul>
            <li>  Make sure all words are spelled correctly.</li>
            <li>  Try different keywords.</li>
            <li>  Try more general keywords.</li>
         </ul>
      </div>
   <?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>