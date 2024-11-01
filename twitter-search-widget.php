<?php
/*
Plugin Name: Twiter Search Widget
Plugin URI: http://code.rattlecentral.com/wp-plugins/twitter-search-widget
Description: Enables a Twitter Search widget for your sidebars, in which you can specify a search term and set the number of most recent tweets to display.
Author: Frankie Roberto, Rattle
Author URI: http://www.rattlecentral.com
Version: 0.3.3
*/



	class TwitterSearchWidget extends WP_Widget {  
	  function TwitterSearchWidget() {
	    parent::WP_Widget(false, $name = 'TwitterSearchWidget');	
	    $widget_ops = array('description' => __('Display the results from a Twitter search'), 'classname' => 'widget_twitter_search');
			$this->WP_Widget('twittersearch', __('Twitter Search'), $widget_ops, $control_ops);		
	  }
	  function widget($args, $instance) {   
			$searchterm = $instance['searchterm'];
		
			if ( isset($instance['error']) && $instance['error'] )
				return;

	    extract($args);
	    $feed = fetch_feed('http://search.twitter.com/search.atom?q=' . esc_attr($searchterm));
	    if ( !$number = (int) $instance['number'] )
				$number = 10;
			else if ( $number < 1 )
				$number = 1;
			else if ( $number > 15 )
				$number = 15;

			if ( ! is_wp_error($feed) ) {
				
				$title = apply_filters( 'widget_title', empty($instance['title']) ? 'Twitter search for "' . $searchterm . '"' : $instance['title'], $instance );
				
			echo $before_widget . $before_title . $title . $after_title;

	    echo("<ul class=\"twitter-tweets\">");

			  foreach ($feed->get_items(0,$number) as $item):
			    $twitter_user = str_replace("http://twitter.com/", "", $item->get_author()->get_link());
			      echo "<li class=\"twitter-tweet\"><a href=\"" . $item->get_author()->get_link() . "\" class=\"twitter-user\">" . $twitter_user . "</a>: <span class=\"twitter-tweet-content\">" . $item->get_content() . "</span> <a class=\"twitter-link\" href=\"" . $item->get_link() . "\">" . $item->get_date() . "</a></li>\n" ;
			  endforeach;

	    echo("</ul>");		
			echo $after_widget;
		}
	}
	  function form($instance) {
	    $title = esc_attr($instance['title']);
	    $searchterm = esc_attr($instance['searchterm']);
			if ( !$number = (int) $instance['number'] )
				$number = 5;

	    ?>
	        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

	        <p><label for="<?php echo $this->get_field_id('searchterm'); ?>"><?php _e('Search Term:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('searchterm'); ?>" name="<?php echo $this->get_field_name('searchterm'); ?>" type="text" value="<?php echo $searchterm; ?>" /></label></p>

	    		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of tweets to show:'); ?></label>
	    		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>


	    <?php    
	  }
	}


add_action('widgets_init', create_function('', 'return register_widget("TwitterSearchWidget");'));


