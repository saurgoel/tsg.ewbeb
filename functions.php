<?php

/* 1) -------------------IMP FUNCTIONS---------------*/
//GETTING THE BASE LINK
function base_link($tax){ echo get_option('home');   echo '/'.$tax;   }

//HEADINGS
function head_title($title){   echo '<h2 class="heading">'.$title.'</h2>';   echo '<hr/>';}

//CUSTOM TITLE OF POSTS
function custom_title($after = '', $length) {
    $mytitle = get_the_title();
    if ( strlen($mytitle) > $length ) {
    $mytitle = substr($mytitle,0,$length);
    echo $mytitle . $after;
    } else {
    echo $mytitle;
    }
}

//CUSTOM EXCERPT OF POSTS
function custom_excerpt($charlength) {
    $excerpt = get_the_excerpt();
    $charlength++;

    if ( mb_strlen( $excerpt ) > $charlength ) {
        $subex = mb_substr( $excerpt, 0, $charlength - 5 );
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            echo mb_substr( $subex, 0, $excut );
        } else {
            echo $subex;
        }
        echo '...';
    } else {
        echo $excerpt;
    }
}

// DISPLAYING THE GALLERY
function gallery($size = thumbnail) {
    if($images = get_posts(array('post_parent' => get_the_ID(),'post_type'      => 'attachment','numberposts'    => -1, 'post_status'    => null,'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC',  ))) 
    {
        head_title('GALLERY');
        echo '<div class="gallery">';
        foreach($images as $image) {           
            echo '<a href="'.wp_get_attachment_url($image->ID,'large').'">';
            echo wp_get_attachment_image($image->ID,$size);
            echo '</a>';
        }
        echo '</div>';
    }
}

// GET THUMBNAIL URL
function get_image_url(){
	$image_id = get_post_thumbnail_id();
	$image_url = wp_get_attachment_image_src($image_id,'large');
	$image_url = $image_url[0];
	echo $image_url;
	}	

// PAGE NAVIGATION 
function getpagenavi(){
    echo '<div id="navigation" class="clearfix">';
    if(function_exists('wp_pagenavi')) :  wp_pagenavi();
    else :
        echo '<div class="alignleft">'; next_posts_link(__('&laquo; Older Entries','web2feeel')); echo '</div>';
        echo '<div class="alignright">'; previous_posts_link(__('Newer Entries &raquo;','web2feel')); echo '</div>';
        echo '<div class="clear"></div>';
    endif; 
    echo '</div>';
}


/*===========================================================THEME RELATED FUNCTIONS===============================================================*/

/* 1) ---------FEATURED THUMBNAILS----------- */
if ( function_exists( 'add_theme_support' ) ) { add_theme_support( 'post-thumbnails' );}
set_post_thumbnail_size( 180,180, true );   //the featured image size
update_option( 'thumbnail_size_w', 180, true );	    //the image thumbnail size
update_option( 'thumbnail_size_h', 180, true );	

/* 2) --------------SHORCODES----------------*/
function heading($atts, $content = null){
    echo '<h3 class="heading">'.$content.'</h3><hr/>';
}add_shortcode('heading', 'heading');

function accordion($atts, $content = null){
    echo '<h3 class="heading">'.$content.'</h3><hr/>';
}add_shortcode('heading', 'accordion');

/* 3) ------------INTIALIZATION-------------*/

//PAGE CREATION
// Only created when a theme is actiated not when it is running
if (isset($_GET['activated']) && is_admin()){
    add_action('init', 'create_initial_pages');
}
function create_initial_pages() {
    $pages= array(
                    array('name'  => 'notices','title' => 'notices', 'template' => 'page-notices.php'),
                    array('name'  => 'gallery','title' => 'gallery', 'template' => 'page-gallery.php'), //ex. template-custom.php. Leave blank if you don't want a custom page template.don't change the code bellow, unless you know what you're doing
                    array('name'  => 'feedback','title' => 'feedback', 'template' => ''),
                    array('name'  => 'calendar','title' => 'calendar', 'template' => ''),
                    array('name'  => 'credits','title' => 'credits', 'template' => ''),
                    array('name'  => 'contact','title' => 'contact', 'template' => ''),
                    array('name'  => 'grievance','title' => 'grievance', 'template' => ''),
                    array('name'  => 'office-bearers','title' => 'office-bearers', 'template' => '')
                );

    $template = array(
        'post_type'   => 'page',
        'post_status' => 'publish',
        'post_author' => 1
    );

    foreach( $pages as $page ) 
    {
        $exists = get_page_by_title( $page['title'] );
        $my_page = array('post_name'  => $page['name'],'post_title' => $page['title']);
        $my_page = array_merge( $my_page, $template );
        if(!isset($page_check->ID))
        {
            $new_page_id = wp_insert_post($my_page);
            if(!empty($new_page_template))
            {
                update_post_meta($new_page_id, '_wp_page_template', $page['template']);
            }
        }
    }
}

//SETTING THE PERMALINKS
function reset_permalinks() {
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure( '/%category%/%postname%/' );
}
add_action( 'init', 'reset_permalinks' );


/* 3) --------CUSTOM POST TYPES----------*/

//CUSTOM POST TYPE GC (WITH ARCHIVES)
add_action( 'init', 'gc_init', 20 );
function gc_init() {
    $labels = array('name' => __( 'General Champ.' ),'singular_name' => __( 'General Championship' ),'add_new' => __( 'Add new GC' ),'add_new_item' => __( 'Add New General Championship' ),'edit' => __( 'Edit' ),'edit_item' => __( 'Edit General Championship' ),'new_item' => __( 'New General Championship' ),'view' => __( 'View General Championship' ),'view_item' => __( 'View General Championship' ),'search_items' => __( 'Search General Championship' ),'not_found' => __( 'No General Championship found' ),'not_found_in_trash' => __( 'No General Championship found in Trash' ),'parent' => __( 'Parent General Championship' ),);
    $args = array('labels' => $labels,'hierarchical' => false,'description' => 'General champioinships','supports' => array( 'title', 'editor', 'excerpt','custom-fields', 'thumbnail'),'show_ui' => true,'show_in_menu' => true,'menu_position' => 5,'show_in_nav_menus' => true,'publicly_queryable' => true,'exclude_from_search' => false,'query_var' => true,'can_export' => true,'rewrite' => array('slug' => 'gc','with_front' => FALSE),'public' => true,'has_archive' => true ,'capability_type' => 'post');  
    register_post_type( 'gc', $args );//max 20 charachter cannot contain capital letters and spaces
} 

//CUSTOM POST TYPE QUOTES (NO ARCHIVES)
add_action( 'init', 'quote_init', 20 );
function quote_init() {
    $labels = array('name' => __( 'Quotes' ),'singular_name' => __( 'Quote' ),'add_new' => __( 'Add new Quote' ),'add_new_item' => __( 'Add New Quote' ),'edit' => __( 'Edit' ),'edit_item' => __( 'Edit Quote' ),'new_item' => __( 'New Quote' ),'view' => __( 'View Quote' ),'view_item' => __( 'View Quote' ),'search_items' => __( 'Search Quote' ),'not_found' => __( 'No Quote found' ),'not_found_in_trash' => __( 'No Quote found in Trash' ),'parent' => __( 'Parent Quote' ),);
    $args = array('labels' => $labels,'hierarchical' => false,'description' => 'Custom Quote Posts','supports' => array( 'title'),'show_ui' => true,'show_in_menu' => true,'menu_position' => 5,'show_in_nav_menus' => false,'publicly_queryable' => true,'exclude_from_search' => true,'query_var' => true,'can_export' => true,'rewrite' => array('slug' => 'quote','with_front' => FALSE),'public' => false,'capability_type' => 'post');  
    register_post_type( 'quote', $args );//max 20 charachter cannot contain capital letters and spaces
} 

//CUSTOM POST TYPE SOCIETIES (WITH ARCHIVES)
add_action( 'init', 'societies_init', 20 );
function societies_init() {
    $labels = array('name' => __( 'Societies' ),'singular_name' => __( 'Society' ),'add_new' => __( 'add new Society' ),'add_new_item' => __( 'Add New Society' ),'edit' => __( 'Edit' ),'edit_item' => __( 'Edit Society' ),'new_item' => __( 'New Society' ),'view' => __( 'View Society' ),'view_item' => __( 'View Society'),'search_items' => __( 'Search Societies' ),'not_found' => __( 'No Societies found' ),'not_found_in_trash' => __( 'No Societies found in Trash' ),'parent' => __( 'Parent Society' ),);
    $args = array('labels' => $labels,'hierarchical' => false,'description' => 'Sociesties in KGP','supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),'show_ui' => true,'show_in_menu' => true,'menu_position' => 5,'show_in_nav_menus' => true,'publicly_queryable' => true,'exclude_from_search' => true,'query_var' => true,'can_export' => true,'rewrite' => array('slug' => 'societies','with_front' => FALSE),'public' => true, 'has_archive' => true ,'capability_type' => 'post');  
    register_post_type( 'societies', $args );//max 20 charachter cannot contain capital letters and spaces
} 

//CUSTOM POST TYPE STUDENT ACTIVITIES (WITH ARCHIVES)
add_action( 'init', 'student_activities_init', 20 );
function student_activities_init() {
    $labels = array('name' => __( 'Student Activities' ),'singular_name' => __( 'Student Activity' ),'add_new' => __( 'Add new Student Activity' ),'add_new_item' => __( 'Add New Student Activity' ),'edit' => __( 'Edit' ),'edit_item' => __( 'Edit Student Activity' ),'new_item' => __( 'New Student Activity' ),'view' => __( 'View Student Activity' ),'view_item' => __( 'View Student Activity'),'search_items' => __( 'Search Student Activities' ),'not_found' => __( 'No Student Activities found' ),'not_found_in_trash' => __( 'No Student Activities found in Trash' ),'parent' => __( 'Parent Student Activity' ),);
    $args = array('labels' => $labels,'hierarchical' => false,'description' => 'Student Activities in KGP','supports' => array( 'title', 'editor', 'excerpt', 'thumbnail'),'show_ui' => true,'show_in_menu' => true,'menu_position' => 5,'show_in_nav_menus' => true,'publicly_queryable' => true,'exclude_from_search' => false,'query_var' => true,'can_export' => true,'rewrite' => array('slug' => 'student-activities','with_front' => FALSE),'public' => true, 'has_archive' => true ,'capability_type' => 'post');  
    register_post_type( 'student_activities', $args );//max 20 charachter cannot contain capital letters and spaces
} 

//CUSTOM POST TYPE FESTS (WITH ARCHIVES)
add_action( 'init', 'fests_init', 20 );
function fests_init() {
    $labels = array('name' => __( 'Fests' ),'singular_name' => __( 'Fests' ),'add_new' => __( 'Add New Fest' ),'add_new_item' => __( 'Add New Fest' ),'edit' => __( 'Edit' ),'edit_item' => __( 'Edit Fest' ),'new_item' => __( 'New Fest' ),'view' => __( 'View Update' ),'view_item' => __( 'View Fest'),'search_items' => __( 'Search Fests' ),'not_found' => __( 'No Fests found' ),'not_found_in_trash' => __( 'No Fests found in Trash' ),'parent' => __( 'Parent Fest' ),);
    $args = array('labels' => $labels,'hierarchical' => false,'description' => 'Fests','supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),'show_ui' => true,'show_in_menu' => true,'menu_position' => 10,'show_in_nav_menus' => true,'publicly_queryable' => true,'exclude_from_search' => false,'query_var' => true,'can_export' => true,'rewrite' => array('slug' => 'fests','with_front' => FALSE),'public' => true, 'has_archive' => true ,'capability_type' => 'post');  
    register_post_type( 'fests', $args );//max 20 charachter cannot contain capital letters and spaces
} 

/*-------------META BOXES---------------------*/
//CUSTOM META BOXES FOR THE GC POINTS UPDATES
add_action( 'add_meta_boxes', 'cd_add_quote_meta' );  
function cd_add_quote_meta()  
{  
    add_meta_box( 'quote-meta', __( 'GC Scores' ), 'cd_quote_meta_cb', 'gc', 'normal', 'high' );  
}  
function cd_quote_meta_cb( $post )  
{  
    // Get values for filling in the inputs if we have them.  
    $hall_name_1 = get_post_meta( $post->ID, '_cd_quote_hall_name_1', true );  
    $hall_score_1 = get_post_meta( $post->ID, '_cd_quote_hall_score_1', true );  
    $hall_name_2 = get_post_meta( $post->ID, '_cd_quote_hall_name_2', true );  
    $hall_score_2 = get_post_meta( $post->ID, '_cd_quote_hall_score_2', true );  
    $hall_name_3 = get_post_meta( $post->ID, '_cd_quote_hall_name_3', true );  
    $hall_score_3 = get_post_meta( $post->ID, '_cd_quote_hall_score_3', true ); 
      
    // Nonce to verify intention later  
    wp_nonce_field( 'save_quote_meta', 'quote_nonce' );  
    ?>  
    
    <p>  
        <label for="hall-name-1">1st Hall name</label>  
        <input type="text" x id="hall-name-1" name="_cd_quote_hall_name_1" value="<?php echo $hall_name_1; ?>" />  
    </p>  
     <p>  
        <label for="hall-score-1">1st Hall score</label>  
        <input type="text" x id="hall-score-1" name="_cd_quote_hall_score_1" value="<?php echo $hall_score_1; ?>" />  
    </p>  
     <p>  
        <label for="hall-name-2">2nd Hall name</label>  
        <input type="text" x id="hall-name-2" name="_cd_quote_hall_name_2" value="<?php echo $hall_name_2; ?>" />  
    </p>  
     <p>  
        <label for="hall-score-2">2nd Hall score</label>  
        <input type="text" x id="hall-score-2" name="_cd_quote_hall_score_2" value="<?php echo $hall_score_2; ?>" />  
    </p>  
     <p>  
        <label for="hall-name-3">3rd Hall name</label>  
        <input type="text" x id="hall-name-3" name="_cd_quote_hall_name_3" value="<?php echo $hall_name_3; ?>" />  
    </p>  
    <p>  
        <label for="hall-score-3">3rd Hall score</label>  
        <input type="text"  id="hall-score-3" name="_cd_quote_hall_score_3" value="<?php echo $hall_score_3; ?>" />  
    </p>  
    <?php  
      
}  
add_action( 'save_post', 'cd_quote_meta_save' );  
function cd_quote_meta_save( $id )  
{  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;  
      
    if( !isset( $_POST['quote_nonce'] ) || !wp_verify_nonce( $_POST['quote_nonce'], 'save_quote_meta' ) ) return;  
      
    if( !current_user_can( 'edit_post' ) ) return;  
      
    $allowed = array(  
        'p' => array()  
    );  
      
    if( isset( $_POST['_cd_quote_hall_name_1'] ) )  
        update_post_meta( $id, '_cd_quote_hall_name_1', wp_kses( $_POST['_cd_quote_hall_name_1'], $allowed ) );  
      
    if( isset( $_POST['_cd_quote_hall_score_1'] ) )  
        update_post_meta( $id, '_cd_quote_hall_score_1', esc_attr( strip_tags( $_POST['_cd_quote_hall_score_1'] ) ) );  
          
    if( isset( $_POST['_cd_quote_hall_name_2'] ) )  
        update_post_meta( $id, '_cd_quote_hall_name_2', esc_attr( strip_tags( $_POST['_cd_quote_hall_name_2'] ) ) );  
        
    if( isset( $_POST['_cd_quote_hall_score_2'] ) )  
        update_post_meta( $id, '_cd_quote_hall_score_2', esc_attr( strip_tags( $_POST['_cd_quote_hall_score_2'] ) ) ); 
        
    if( isset( $_POST['_cd_quote_hall_name_3'] ) )  
        update_post_meta( $id, '_cd_quote_hall_name_3', esc_attr( strip_tags( $_POST['_cd_quote_hall_name_3'] ) ) ); 
        
    if( isset( $_POST['_cd_quote_hall_score_3'] ) )  
        update_post_meta( $id, '_cd_quote_hall_score_3', esc_attr( strip_tags( $_POST['_cd_quote_hall_score_3'] ) ) ); 
      
}  


//CUSTOM META BOXES FOR THE UPCOMING EVENTS
add_action( 'add_meta_boxes', 'cd_add_event_meta' );  
function cd_add_event_meta()  
{  
    add_meta_box( 'event-meta', __( 'UPCOMING EVENTS' ), 'cd_event_meta_cb', 'gc', 'normal', 'high' );  
}  
function cd_event_meta_cb( $post ){ 
    // Get values for filling in the inputs if we have them.  
    $event_name_1 = get_post_meta( $post->ID, '_cd_event_name_1', true );  
    $event_date_1 = get_post_meta( $post->ID, '_cd_event_date_1', true );  
    $event_name_2 = get_post_meta( $post->ID, '_cd_event_name_2', true );  
    $event_date_2 = get_post_meta( $post->ID, '_cd_event_date_2', true );  
    $event_name_3 = get_post_meta( $post->ID, '_cd_event_name_3', true );  
    $event_date_3 = get_post_meta( $post->ID, '_cd_event_date_3', true ); 
      
    // Nonce to verify intention later  
    wp_nonce_field( 'save_event_meta', 'event_nonce' );  
    ?>  
    
    <p>  
        <label for="event-name-1">1st Event Name</label>  
        <input type="text" x id="event-name-1" name="_cd_event_name_1" value="<?php echo $event_name_1; ?>" />  
    </p>  
     <p>  
        <label for="event-date-1">1st Event Date</label>  
        <input type="text" x id="event-date-1" name="_cd_event_date_1" value="<?php echo $event_date_1; ?>" />  
    </p>  
     <p>  
        <label for="event-name-2">2nd Event Name</label>  
        <input type="text" x id="event-name-2" name="_cd_event_name_2" value="<?php echo $event_name_2; ?>" />  
    </p>  
     <p>  
        <label for="event-date-2">2nd Event Date</label>  
        <input type="text" x id="event-date-2" name="_cd_event_date_2" value="<?php echo $event_date_2; ?>" />  
    </p>  
     <p>  
        <label for="event-name-3">3rd Event Name</label>  
        <input type="text" x id="event-name-3" name="_cd_event_name_3" value="<?php echo $event_name_3; ?>" />  
    </p>  
    <p>  
        <label for="event-date-3">3rd Event Date</label>  
        <input type="text"  id="event-date-3" name="_cd_event_date_3" value="<?php echo $event_date_3; ?>" />  
    </p>  
    <?php  
      
}  
add_action( 'save_post', 'cd_event_meta_save' );  
function cd_event_meta_save( $id )  
{  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;  
      
    if( !isset( $_POST['event_nonce'] ) || !wp_verify_nonce( $_POST['event_nonce'], 'save_event_meta' ) ) return;  
      
    if( !current_user_can( 'edit_post' ) ) return;  
      
    $allowed = array(  
        'p' => array()  
    );  
      
    if( isset( $_POST['_cd_event_name_1'] ) )  
        update_post_meta( $id, '_cd_event_name_1', wp_kses( $_POST['_cd_event_name_1'], $allowed ) );  
      
    if( isset( $_POST['_cd_event_date_1'] ) )  
        update_post_meta( $id, '_cd_event_date_1', esc_attr( strip_tags( $_POST['_cd_event_date_1'] ) ) );  
          
    if( isset( $_POST['_cd_event_name_2'] ) )  
        update_post_meta( $id, '_cd_event_name_2', esc_attr( strip_tags( $_POST['_cd_event_name_2'] ) ) );  
        
    if( isset( $_POST['_cd_event_date_2'] ) )  
        update_post_meta( $id, '_cd_event_date_2', esc_attr( strip_tags( $_POST['_cd_event_date_2'] ) ) ); 
        
    if( isset( $_POST['_cd_event_name_3'] ) )  
        update_post_meta( $id, '_cd_event_name_3', esc_attr( strip_tags( $_POST['_cd_event_name_3'] ) ) ); 
        
    if( isset( $_POST['_cd_event_date_3'] ) )  
        update_post_meta( $id, '_cd_event_date_3', esc_attr( strip_tags( $_POST['_cd_event_date_3'] ) ) ); 
      
}  


//CHANING THE POSTS NAME TO NOTICE BOARD
function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Notice Board';
    $submenu['edit.php'][5][0] = 'Notice Board';
    $submenu['edit.php'][10][0] = 'New Notice';
    echo '';
}

function change_post_object_label() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'Notices';
        $labels->singular_name = 'Notice';
        $labels->add_new = 'Add Notice';
        $labels->add_new_item = 'Add Notice';
        $labels->edit_item = 'Edit Notice';
        $labels->new_item = 'Notice';
        $labels->view_item = 'View Notices';
        $labels->search_items = 'Search Notices';
        $labels->not_found = 'No Notices found';
        $labels->not_found_in_trash = 'No Notices found in Trash';
    }
    add_action( 'init', 'change_post_object_label' );
    add_action( 'admin_menu', 'change_post_menu_label' );

// REMOVE META BOXES FROM WORDPRESS DASHBOARD FOR ALL USERS
function disable_default_dashboard_widgets() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
    remove_meta_box('dashboard_plugins', 'dashboard', 'core');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
    remove_meta_box('dashboard_primary', 'dashboard', 'core');
    remove_meta_box('dashboard_secondary', 'dashboard', 'core');
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

//CUSTOM META BOX FOR THE RULES ON THE DASHBOARD
function my_custom_dashboard_widgets() {
    global $wp_meta_boxes;	
    wp_add_dashboard_widget('custom_help_widget', 'GENERAL RULES AND TIPS', 'dashboard_rules');
}
function dashboard_rules() { ?>
    <p>These are some of the general rules for some one who is new to this interface. </p>
    <h3>POSTING RULES</h3><br/>
    <li><strong>NOTICE BOARD</strong>: Meant for posting in the notice board. Accesible on the left side. There are categories like the 'latest-updates' category. These notices appear on the ticker.</li>
    <li><strong>GENERAL CHAMP</strong>: This is meant to update the scores of the indivisual GC on the home page of the gymkhana. Accesible on the left side. It is also used to display the upcoming events.</li>
    <li><strong>QUOTES</strong>: This is meant to update the gymkhana Quote that is present by default on the home page. Accesible on the left side </li>
    <li><strong>SOCIETIES</strong>: This is meant to display the info of different societies. Accesible on the left side</li>  
    <li><strong>STUDENT ACTIVITIES</strong>: This is meant to display the information of intiatives and acheivements. Accesible on the left side</li>  
    <li><strong>FESTS</strong>: This is meant to display the info of the fests - KTJ, SF, Shaurya, other fests. Accesible on the left side</li> 
    <li><strong>DEFAULT PAGES</strong>: Feedback, contact, credits, calendar, contact, office-bearers.</li>
    <li><strong>CUSTOM PAGES</strong>: Archives, Notices, Gallery.</li>
    <br/>
    <h3>GENERAL RULES</h3>
    <li>Only notices appear in searches and the URL</li>
<?php   
}
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets'); 





 
?>