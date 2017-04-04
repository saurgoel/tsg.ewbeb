<?php get_header(); ?>
<div class="three-collumns-single">
	<?php 
		$my_query = new WP_Query(array('post_type' => 'quote', 'showposts' =>  '1'));
		while ($my_query->have_posts()) : $my_query->the_post();
	?>
		<article class="quote boxentry">
			<h2><?php the_title(); ?></h3>
			<p>Technology Students' Gymkhana is the hub of the numerous extra-curricular and co-curricular activities in IIT Kharagpur ranging from sports to socio-cultural. From its inception in 1952, the Gymkhana has played a key role in the everyday lives of Kgpians cultivating and nurturing their extra-curricular talents. The moto of Technology Students' Gymkhana is YOGAH KARMASU KAUSALAM which in English means "Perfection in action is Yoga". The Technology Students' Gymkhana, IIT Kharagpur is managed by the students, for the students, under the guidance and active participation of the faculty and staff members.</p>
		</article>
	<?php endwhile; ?>
</div>
<div class="clear"></div>
<div class="three-collumns">
	<?php head_title('GENERAL CHAMPIONSHIP UPDATES');  ?>
	<?php 
		$my_query = new WP_Query(array('post_type' => 'gc', 'showposts' =>  '3'));
		while ($my_query->have_posts()) : $my_query->the_post();
	?>
		<article class="post one-collumn" id="post-<?php the_ID(); ?>">
			<?php 
				//pre declaring variables
				$name_1 = 'RK';	$name_2 = 'PT';	$name_3 = 'AZ';	$score_1 = '1';	$score_1 = '1';	$score_1 = '1';			
				
				$name_1 = get_post_meta( $post->ID, '_cd_quote_hall_name_1', true ); 
				$score_1 = get_post_meta( $post->ID, '_cd_quote_hall_score_1', true ); 
				$name_2 = get_post_meta( $post->ID, '_cd_quote_hall_name_2', true ); 
				$score_2 = get_post_meta( $post->ID, '_cd_quote_hall_score_2', true ); 
				$name_3 = get_post_meta( $post->ID, '_cd_quote_hall_name_3', true ); 
				$score_3 = get_post_meta( $post->ID, '_cd_quote_hall_score_3', true ); 
				if($score_1==NULL){ $score_1 = 1;} 
				$width_1 = 245;
				$width_2 = ($score_2/$score_1)*$width_1;
				$width_3 = ($score_3/$score_1)*$width_1;
			?>
			
			<div class="histogram" style="width:<?php echo $width_1; ?>px;"><p class="hall-name font-style-1 left"><?php echo $name_1; ?></p><p class="font-style-1 right"><?php echo $score_1; ?></p></div> 
			<div class="histogram" style="width:<?php echo $width_2; ?>px;"><p class="hall-name font-style-1 left"><?php echo $name_2; ?></p><p class="font-style-1 right"><?php echo $score_2; ?></p></div> 
			<div class="histogram" style="width:<?php echo $width_3; ?>px;"><p class="hall-name font-style-1 left"><?php echo $name_3; ?></p><p class="font-style-1 right"><?php echo $score_3; ?></p></div> 
			<div class="clear"></div>
			<div class="btitle">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			</div>
			<div class="boxentry">
				<?php custom_excerpt(250); ?>
				<div class="clear"></div>
			</div>
		</article>
	<?php endwhile; wp_reset_postdata(); ?>
	<div class="clear"></div>
</div>
<p class="alert">Try the new gymkhana <a href="https://chrome.google.com/webstore/detail/cbnbmhdddoilkjanldbnonnpjjikmnmd">chrome gadget</a> for easy updates.</p>
<div class="clear"></div>
<div class="two-collumns-single left">
	<?php head_title('LATEST UPDATES');  ?>
	<?php 
		$my_query = new WP_Query(array('showposts' =>  '9', 'category_name' => 'latest'));
		while ($my_query->have_posts()) : $my_query->the_post();
	?>
		<article class="post list" id="post-<?php the_ID(); ?>">
			<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<p class="date"><span class="clock"><?php the_time('M - j - Y'); ?></span></p>
		</article>
		<div class="clear"></div>
	<?php endwhile; wp_reset_postdata();?>
	<a href="<?php base_link('notices'); ?>" class="button-1 right">more updates</a>
</div>

<div class="one-collumn-single right">
	<?php head_title('UPCOMING EVENTS'); ?>
	<?php 
		$my_query = new WP_Query(array('post_type' => 'gc', 'showposts' =>  '3'));
		while ($my_query->have_posts()) : $my_query->the_post();
	
			$event_1 = get_post_meta( $post->ID, '_cd_event_name_1', true ); 
			$date_1 = get_post_meta( $post->ID, '_cd_event_date_1', true ); 
			$event_2 = get_post_meta( $post->ID, '_cd_event_name_2', true ); 
			$date_2 = get_post_meta( $post->ID, '_cd_event_date_2', true ); 
			$event_3 = get_post_meta( $post->ID, '_cd_event_name_3', true ); 
			$date_3 = get_post_meta( $post->ID, '_cd_event_date_3', true ); 
			if(!((empty($date_1))&&(empty($event_1)))):  ?>
				<article class="post list" id="post-<?php the_ID(); ?>">
					<h3><?php echo $event_1; ?></h2>
					<p class="date"><span class="clock"><?php echo $date_1; ?></span></p>
				</article>
			<div class="clear"></div>
			<?php endif; ?>
			
			<?php if(!((empty($event_2))&&(empty($date_2)))): ?>
				<article class="post list" id="post-<?php the_ID(); ?>">
					<h3><?php echo $event_2; ?></h2>
					<p class="date"><span class="clock"><?php echo $date_2; ?></span></p>
				</article>
			<div class="clear"></div>
			<?php endif; ?>
			
			<?php if(!((empty($date_3))&&(empty($event_3)))): ?>
				<article class="post list" id="post-<?php the_ID(); ?>">
					<h3><?php echo $event_3; ?></h2>
					<p class="date"><span class="clock"><?php echo $date_3; ?></span></p>
				</article>
			<div class="clear"></div>
			<?php endif; ?>
			<?php endwhile; wp_reset_postdata(); ?>
			
</div>

<?php get_footer(); ?>