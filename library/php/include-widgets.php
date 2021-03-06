<?php


/* ----------------------------------------------------------------------------------- */
/* Homepage Secondary Area (Widgets)
/* ----------------------------------------------------------------------------------- */

function ufandshands_secondary_widget_area() {

		$homepage_layout_color = of_get_option("opt_homepage_layout_color");
		
		if(empty($homepage_layout_color)) {
			echo "<div id='secondary' >";
			
		} else {
			echo "<div id='secondary' class='homepage_layout_white' >";
				//echo "<div id='content-shadow'>";
		}
	  
				echo "<div class='container'>";
		
					$homepage_layout = of_get_option("opt_homepage_layout");
						
					switch($homepage_layout) {
					
						case "3c-default":
								echo "<section class='span-12 omega'>";
									get_sidebar('home_left');
								echo "</section>";
								
								echo "<section class='span-6 omega'>";
									get_sidebar('home_middle');
								echo "</section>";
								
								echo "<section class='span-6 omega'>";
									get_sidebar('home_right');
								echo "</section>";
							break;
							
						case "3c-thirds":
								echo "<section class='span-8 omega'>";
									get_sidebar('home_left');
								echo "</section>";
								
								echo "<section class='span-8 omega'>";
									get_sidebar('home_middle');
								echo "</section>";
								
								echo "<section class='span-8 omega'>";
									get_sidebar('home_right');
								echo "</section>";
							break;
							
						case "2c-bias":
								echo "<section class='span-16 omega'>";
									get_sidebar('home_left');
								echo "</section>";
												
								echo "<section class='span-8 omega'>";
									get_sidebar('home_right');
								echo "</section>";
							break;
							
						case "2c-half":
								echo "<section class='span-12 omega'>";
									get_sidebar('home_left');
								echo "</section>";
												
								echo "<section class='span-12 omega'>";
									get_sidebar('home_right');
								echo "</section>";
							break;
							
						case "1c-100":
								echo "<section class='span-24'>";
									get_sidebar('home_left');
								echo "</section>";
							break;
							
						case "1c-100-2c-half":
								echo "<section class='span-24'>";
									get_sidebar('home_left');
								echo "</section>";

								echo "<section class='span-12 omega'>";
									get_sidebar('home_middle');
								echo "</section>";
												
								echo "<section class='span-12 omega'>";
									get_sidebar('home_right');
								echo "</section>";
							break;
					}
					
					echo "</div>";
					
			if(!empty($homepage_layout_color)) {
				//echo "</div>";
			} else {
				echo "<div id='secondary-shadow'></div>";
			}
			
		echo "</div><!-- end #secondary -->";
}

/* ----------------------------------------------------------------------------------- */
/* Detect if a sidebar has widgets
/*
/* $sidebar - the name of the sidebar
/* $echo - true; will run the get_sidebar function for you and return it's contents
/* $sidebar_count_only - true; will echo a count of the widgets in the sidebar
/* ----------------------------------------------------------------------------------- */

function ufandshands_sidebar_detector($sidebar, $echo=true, $sidebar_count_only=false) {
				
	$the_sidebar_count = wp_get_sidebars_widgets();
	$the_sidebar_count = count($the_sidebar_count[$sidebar]);
  
  // Is this being used???
  if($sidebar_count_only) {
		echo $the_sidebar_count;
		return;
	}
  
	if(!empty($the_sidebar_count)) { 	
    ob_start();
    
    $sidebar_content = dynamic_sidebar($sidebar);
    
    if($sidebar_content) {
      $str = ob_get_contents();
    } else {
      $str = '';
    }
    
    ob_end_clean();
    
    if($echo) {
      echo $str;
    } else {
      return $str;
    }
  }
}

/* ----------------------------------------------------------------------------------- */
/* returns the number of widgets in a specific sidebar
/*
/* $sidebar - the name of the sidebar
/* ----------------------------------------------------------------------------------- */
function ufandshands_sidebar_widget_count($sidebar) {
    $the_sidebar_count = wp_get_sidebars_widgets();
    return count($the_sidebar_count[$sidebar]);
}


/* ----------------------------------------------------------------------------------- */
/* Creates sidebars for our template
/*
/* Some widgetized zones have logic checking whether the layout options the user selected
/* will require them to exist at all (for example; if I select a 2 column homepage layout
/* I do not need 'Home Middle'.
/*
/* Additionally, there is logic to hide/display certain zones based on if the user is a
/* super administrator
/* ----------------------------------------------------------------------------------- */

$homepage_layout = of_get_option("opt_homepage_layout");
$disabled_global_elements = of_get_option("opt_disable_global_elements");

if ( function_exists ('register_sidebar')) { 
		
		register_sidebar (array(
			'name' => 'Home Left',
			'id' => 'home_left',
			'description' => 'Widgets in this area will be shown on the LEFT side of your HOME PAGE',
			'before_widget' => '<div class="widget home_widget">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		)); 

		if ( $homepage_layout=="3c-default" || $homepage_layout=="3c-thirds"  || $homepage_layout=="1c-100-2c-half" ) {
			register_sidebar (array(
				'name' => 'Home Middle',
				'id' => 'home_middle',
				'description' => 'Widgets in this area will be shown on the MIDDLE (or BOTTOM LEFT) of your HOME PAGE',
				'before_widget' => '<div class="widget home_widget">',
				'after_widget' => '</div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			)); 
		}

		if ($homepage_layout!="1c-100") {
			register_sidebar (array(
				'name' => 'Home Right',
				'id' => 'home_right',
				'description' => 'Widgets in this area will be shown on the RIGHT side of your HOME PAGE',
				'before_widget' => '<div class="widget home_widget">',
				'after_widget' => '</div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			)); 
		}

		register_sidebar (array(
			'name' => 'Page Left Sidebar',
			'id' => 'page_sidebar',
			'description' => 'Widgets in this area will be shown in the LEFT SIDEBAR of a PAGE',
			'before_widget' => '<div class="widget sidebar_widget">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		)); 

		register_sidebar (array(
			'name' => 'Page Right Sidebar',
			'id' => 'page_right',
			'description' => 'Widgets in this area will be shown to the right of page content in a third column',
			'before_widget' => '<div class="widget sidebar_widget">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		)); 

		register_sidebar (array(
			'name' => 'Post Sidebar',
			'id' => 'post_sidebar',
			'description' => 'Widgets in this area will be shown in the SIDE of a POST.',
			'before_widget' => '<div class="widget sidebar_widget">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		)); 

		register_sidebar (array(
			'name' => 'Footer',
			'id' => 'site_footer',
			'description' => 'Widgets in this area will be shown in the FOOTER.',
			'before_widget' => '<div class="widget footer_widget">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
		
		if ($disabled_global_elements) {
		register_sidebar (array(
			'name' => 'Site Custom Footer',
			'id' => 'site_footer_custom',
			'description' => 'Widgets in this area will be shown in custom FOOTER.',
			'before_widget' => '<div class="widget footer_widget"><div class="box">',
			'after_widget' => '</div></div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
		}
} 

	

// unregister some default WP Widgets
function unregister_default_wp_widgets() {
	unregister_widget('WP_Widget_Pages');
 	unregister_widget('WP_Widget_Calendar');
 	unregister_widget('WP_Widget_Meta');
 	unregister_widget('WP_Widget_Search');
 	unregister_widget('WP_Widget_Recent_Posts');
 	unregister_widget('WP_Widget_RSS');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);




// widget: recent posts
include 'widgets/widget-recent-posts.php';

// widget: insert an image
include 'widgets/widget-insert-image.php';

// widget: Embed page content into a widgetized area
include 'widgets/widget-embed-pages.php';

// widget: Random Quotes
include 'widgets/widget-random-quotes.php';

// widget: RSS 2.0
include 'widgets/widget-rss.php';




/* ----------------------------------------------------------------------------------- */
/* Customize Tag Cloud Widget Modification
/* ----------------------------------------------------------------------------------- */

add_filter( 'widget_tag_cloud_args', 'ufandshands_tag_cloud_args' );
function ufandshands_tag_cloud_args( $args ) {
	$args['number'] = 15;
	$args['largest'] = 28;
	$args['smallest'] = 9;
	$args['unit'] = 'px';
	return $args;
}



/**
 * Add "first" and "last" CSS classes to dynamic sidebar widgets. Also adds numeric index class for each widget (widget-1, widget-2, etc.)
 */
function widget_first_last_classes($params) {

	global $my_widget_num; // Global counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets

	if(!$my_widget_num) {// If the counter array doesn't exist, create it
		$my_widget_num = array();
	}

	if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id] ++;
	} else { // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;
	}

	$class = 'widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options

	if($my_widget_num[$this_id] == 1) { // If this is the first widget
		$class .= 'widget-first';
	} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
		$class .= 'widget-last';
	}

  	/**
	 * Add default classes from register_sidebar
	 */
	preg_match("/class=\"([^\"']*)\"/", $params[0]['before_widget'], $defaults);
	if( $defaults ){
		$class .= ' ' . $defaults[1];
	}
	
	$params[0]['before_widget'] = sprintf('<div id="%s" class="%s">', $params[0]['widget_id'], $class );
	return $params;

}
add_filter('dynamic_sidebar_params','widget_first_last_classes');


?>