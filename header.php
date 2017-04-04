<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_get_archives('type=monthly&format=link'); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>

<!-- FRONT PAGE SLIDER -->
<?php if(is_front_page()): ?>
<script type="text/javascript" src="http://u.jimdo.com/www54/o/sdfd33ca1d413f4c9/userlayout/js/jquery-cycle-all.js"></script>
<script type="text/javascript">
//<![CDATA[  
 var $j = jQuery.noConflict(); 
   $j(document).ready(function() {   
   $j('#slideshow').cycle({
			 fx: 'fade',
			 pager: '#smallnav', 
			 pause:   1, 
			 speed: 1200,
			 timeout:  3500 
		  });                     
	});
//]]>
</script>

<?php endif; ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/accordion.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/fixed-nav.js"></script>
</head>
<body <?php body_class(); ?> >

<?php if(is_front_page()): ?>
<div id="slideshow"> 
	 <img src="<?php bloginfo('stylesheet_directory'); ?>/images/slide-2.jpg" class="bg"/>
	 <img src="<?php bloginfo('stylesheet_directory'); ?>/images/slide-3.jpg" class="bg"/>
	 <img src="<?php bloginfo('stylesheet_directory'); ?>/images/slide-4.jpg" class="bg"/>
	 <img src="<?php bloginfo('stylesheet_directory'); ?>/images/slide-1.jpg" class="bg"/> 
</div>

<?php endif; ?>

<?php if(is_front_page()): ?>
	<div id="header" class="front-page-top">
<?php else: ?>
	<div id="header" class="top">
<?php endif; ?>
	<div class="container">
		<div id="logo">
			<img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="TSG Logo"/>
		</div>
		<div id="blogname">	
			<h1><a href="<?php bloginfo('siteurl');?>/" title="Technology Students Gymkhana"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/gymkhana-text.png" alt="TSG Logo"/></a></h1>
		</div>
		<?php if(is_front_page()): ?>
			<div id="header-search">
				<?php get_search_form(); ?>
			</div>
		<?php endif; ?>
		<div class="clear"></div>
	</div>
	<div id="header-menu">
		<div class="container">
			<ul id="suckerfishnav" class="sf-menu">
				<li><a href="<?php base_link(''); ?>">HOME</a></li>
				<li class="gc"><a href="<?php base_link('gc'); ?>">GENERAL CHAMPIONSHIP</a>
					<div class="arrow-up" ></div>
					<ul>
						<li><a href="<?php base_link('gc/soc-cult'); ?>">SOC-CULT</a></li>
						<li><a href="<?php base_link('gc/sports'); ?>">SPORTS</a></li>
						<li><a href="<?php base_link('gc/tech'); ?>">TECH</a></li>
					</ul>
				</li>
				<li class="student-activities"><a href="<?php base_link('student-activities'); ?>">STUDENT ACTIVITIES</a>
					<div class="arrow-up" ></div>
					<ul>
						<li><a href="<?php base_link('student-activities/acheivements'); ?>">ACHEIVEMENTS</a></li>
						<li><a href="<?php base_link('student-activities/initiatives'); ?>">INITIATIVES</a></li>
					</ul>
				</li>
				<li class="societies"><a href="<?php base_link('societies'); ?>">SOCIETIES</a></li>
				<li class="fests"><a href="<?php base_link('fests'); ?>">FESTS</a>
					<div class="arrow-up" ></div>
					<ul>
						<li><a href="<?php base_link('fests/kshitij'); ?>">KSHITIJ</a></li>
						<li><a href="<?php base_link('fests/sf'); ?>">SPRING FEST</a></li>
						<li><a href="<?php base_link('fests/shaurya'); ?>">SHAURYA</a></li>
						<li><a href="<?php base_link('fests/off-campus'); ?>">OFF CAMPUS FESTS</a></li>
					</ul>
				</li>
				<li><a href="<?php base_link('notices'); ?>">NOTICE BOARD</a></li>
				
			</ul>
		</div>
	</div>
</div>

<div class="clear"></div>
<div class="container casing">