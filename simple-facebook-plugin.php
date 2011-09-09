<?php
/*
Plugin Name: Simple Facebook Plugin
Plugin URI: http://fornyhucker.blogspot.com/
Description: Create sidebar widget that display Facebook Like Box.
Version: 1.0
Author: Ilya Kopturov
Author URI: http://fornyhucker.blogspot.com/
License: GPL
*/

class FacebookWidget extends WP_Widget {
	/** constructor */
	function FacebookWidget() {
		$widget_ops = array( 'description' => 'Display Facebook Like Box' );
		parent::WP_Widget( 'facebookwidget', $name = 'Facebook Widget',  $widget_ops);
	}

	/** @see WP_Widget::widget */
	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		?>
		<script>
		(function(d){
			var js, id = 'facebook-jssdk'; 
			if (d.getElementById(id)) {return;}
			js = d.createElement('script'); 
			js.id = id; 
			js.async = true;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			d.getElementsByTagName('head')[0].appendChild(js);
		}(document));
		</script>
		<div 	class="fb-like-box" 
				data-href="<?php echo $instance['facebook_page_url']; ?>" 
				data-width="<?php echo $instance['width']; ?>"
				data-colorscheme="<?php echo $instance['colorscheme']; ?>"
				data-show-faces="<?php echo ($instance['show_faces']) ? 'true' : 'false'; ?>" 
				data-stream="<?php echo ($instance['stream']) ? 'true' : 'false' ;?>" 
				data-header="<?php echo ($instance['header']) ? 'true' : 'false' ;?>">
		</div>
		<?php echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['facebook_page_url'] 	= strip_tags( $new_instance[ 'facebook_page_url' ] );
		$instance['width']				= strip_tags( $new_instance[ 'width' ] );
		$instance['colorscheme']		= $new_instance[ 'colorscheme' ] ;
		$instance['show_faces']			= isset( $new_instance[ 'show_faces'] );
		$instance['stream']				= isset( $new_instance[ 'stream' ] );
		$instance['header']				= isset( $new_instance[ 'header' ] );
		return $instance;
	}

	/** @see WP_Widget::form */
	function form( $instance ) {
		if ( $instance ) {
			//var_dump($instance);
			$facebook_page_url 	= strip_tags( $instance[ 'facebook_page_url' ] );
			$width				= strip_tags( $instance[ 'width' ] );
			$colorscheme		= $instance[ 'colorscheme' ];
			$show_faces			= $instance[ 'show_faces'] ;
			$stream				= $instance[ 'stream' ] ;
			$header				= $instance[ 'header' ] ;
		} else {
			//default options
			$facebook_page_url 	= 'http://www.facebook.com/platform';
			$width				= '292';
			$colorscheme		= 'light';
			$show_faces			= true;
			$stream				= false;
			$header				= true;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('facebook_page_url'); ?>"><?php _e('Facebook Page URL:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('facebook_page_url'); ?>" name="<?php echo $this->get_field_name('facebook_page_url'); ?>" type="text" value="<?php echo $facebook_page_url; ?>" />
		</p>
		<table>
			<tr><td>
				<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Like Box width:'); ?></label> 
				</td><td>
				<input class="widefat" size="8" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" />
			</td></tr>
			<tr><td>
				&nbsp;
			</td></tr>
			<tr><td>
				<label for="<?php echo $this->get_field_id('colorschme'); ?>"><?php _e('Color Scheme:'); ?></label> 
				</td><td>
				<input type="radio" name="<?php echo $this->get_field_name('colorscheme'); ?>" value="light" <?php checked(($colorscheme == 'light') ? 1 : 0); ?>/> Light<br />
				<input type="radio" name="<?php echo $this->get_field_name('colorscheme'); ?>" value="dark" <?php checked(($colorscheme == 'dark') ? 1 : 0); ?>/> Dark
			</td></tr>
			<tr><td>
				&nbsp;
			</td></tr>
			<tr><td>
				<label for="<?php echo $this->get_field_id('show_faces'); ?>"><?php _e('Show Faces'); ?></label> 
				</td><td>
				<input id="<?php echo $this->get_field_id('show_faces'); ?>" type="checkbox" name="<?php echo $this->get_field_name('show_faces'); ?>" <?php checked(isset($show_faces) ? $show_faces : 0); ?>/>
			</td></tr>
			<tr><td>
				<label for="<?php echo $this->get_field_id('stream'); ?>"><?php _e('Show Stream'); ?></label> 
				</td><td>
				<input id="<?php echo $this->get_field_id('stream'); ?>" type="checkbox" name="<?php echo $this->get_field_name('stream'); ?>" <?php checked(isset($stream) ? $stream : 0); ?>/>
			</td></tr>
			<tr><td>
				<label for="<?php echo $this->get_field_id('header'); ?>"><?php _e('Show Header'); ?></label> 
				</td><td>
				<input id="<?php echo $this->get_field_id('header'); ?>" type="checkbox" name="<?php echo $this->get_field_name('header'); ?>" <?php checked(isset($header) ? $header : 0); ?>/> 
			</td></tr>
		</table>
		<?php 
	}

} // class FacebookWidget

function FacebookWidget_init()
{	
	add_action( 'widgets_init', create_function( '', 'return register_widget("FacebookWidget");' ) );
}

add_action("plugins_loaded", "FacebookWidget_init");
?>