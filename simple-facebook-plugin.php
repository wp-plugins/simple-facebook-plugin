<?php
/*
Plugin Name: Simple Facebook Plugin
Plugin URI: http://plugins.topdevs.net/simple-facebook-plugin
Description: Create sidebar widget that display Facebook Like Box.
Version: 1.1.1
Author: Ilya Kopturov
Author URI: http://topdevs.net
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
			js.src = "//connect.facebook.net/<?php echo $instance['local']; ?>/all.js#xfbml=1";
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
		$instance['show_faces']			= isset( $new_instance[ 'show_faces'] );
		$instance['stream']				= isset( $new_instance[ 'stream' ] );
		$instance['header']				= isset( $new_instance[ 'header' ] );
		$instance['colorscheme']		= $new_instance[ 'colorscheme' ] ;
		$instance['local']				= $new_instance[ 'local' ] ;
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
			$local				= $instance[ 'local' ] ;
		} else {
			//default options
			$facebook_page_url 	= 'http://www.facebook.com/platform';
			$width				= '292';
			$colorscheme		= 'light';
			$show_faces			= true;
			$stream				= false;
			$header				= true;
			$local				= 'en_US';
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
		<br/>
		<p>
				<label for="<?php echo $this->get_field_id('local'); ?>"><?php _e('Language'); ?></label> 
				<select name="<?php echo $this->get_field_name('local'); ?>">
					<option <?php selected(( $local == 'cs_CZ') ? 1 : 0);?> value="cs_CZ" >Czech</option>
					<option <?php selected(( $local == 'da_DK') ? 1 : 0);?> value="da_DK" >Danish</option>
					<option <?php selected(( $local == 'nl_NL') ? 1 : 0);?> value="nl_NL" >Dutch</option>
					<option <?php selected(( $local == 'en_US') ? 1 : 0);?> value="en_US" >English (US)</option>
					<option <?php selected(( $local == 'en_GB') ? 1 : 0);?> value="en_GB" >English (UK)</option>
					<option <?php selected(( $local == 'et_EE') ? 1 : 0);?> value="et_EE" >Estonian</option>
					<option <?php selected(( $local == 'fr_FR') ? 1 : 0);?> value="fr_FR" >French</option>
					<option <?php selected(( $local == 'de_DE') ? 1 : 0);?> value="de_DE" >German</option>
					<option <?php selected(( $local == 'it_IT') ? 1 : 0);?> value="it_IT" >Italian</option>
					<option <?php selected(( $local == 'ja_JP') ? 1 : 0);?> value="ja_JP" >Japanese</option>
					<option <?php selected(( $local == 'ko_KR') ? 1 : 0);?> value="ko_KR" >Korean</option>
					<option <?php selected(( $local == 'lv_LV') ? 1 : 0);?> value="lv_LV" >Latvian</option>
					<option <?php selected(( $local == 'lt_LT') ? 1 : 0);?> value="lt_LT" >Lithuanian</option>
					<option <?php selected(( $local == 'pl_PL') ? 1 : 0);?> value="pl_PL" >Polish</option>
					<option <?php selected(( $local == 'pt_PT') ? 1 : 0);?> value="pt_PT" >Portuguese</option>
					<option <?php selected(( $local == 'ro_RO') ? 1 : 0);?> value="ro_RO" >Romanian</option>
					<option <?php selected(( $local == 'ru_RU') ? 1 : 0);?> value="ru_RU" >Russian</option>
					<option <?php selected(( $local == 'es_LA') ? 1 : 0);?> value="es_LA" >Spanish</option>
					<option <?php selected(( $local == 'es_ES') ? 1 : 0);?> value="es_ES" >Spanish (Spain)</option>
					<option <?php selected(( $local == 'es_CL') ? 1 : 0);?> value="es_CL" >Spanish (Chile)</option>
					<option <?php selected(( $local == 'es_CO') ? 1 : 0);?> value="es_CO" >Spanish (Colombia)</option>
					<option <?php selected(( $local == 'es_MX') ? 1 : 0);?> value="es_MX" >Spanish (Mexico)</option>
					<option <?php selected(( $local == 'es_VE') ? 1 : 0);?> value="es_VE" >Spanish (Venezuela)</option>
					<option <?php selected(( $local == 'sv_SE') ? 1 : 0);?> value="sv_SE" >Swedish</option>
					<option <?php selected(( $local == 'zh_CN') ? 1 : 0);?> value="zh_CN" >Simplified Chinese</option>
					<option <?php selected(( $local == 'zh_TW') ? 1 : 0);?> value="zh_TW" >Traditional Chinese (Taiwan)</option>
					<option <?php selected(( $local == 'th_TH') ? 1 : 0);?> value="th_TH" >Thai</option>
					<option <?php selected(( $local == 'tr_TR') ? 1 : 0);?> value="tr_TR" >Turkish</option>
					<option <?php selected(( $local == 'uk_UA') ? 1 : 0);?> value="uk_UA" >Ukrainian</option>
					<option <?php selected(( $local == 'tl_ST') ? 1 : 0);?> value="tl_ST" >Klingon</option>
				</select>
		</p>
		<?php 
	}

} // class FacebookWidget

function FacebookWidget_init()
{	
	add_action( 'widgets_init', create_function( '', 'return register_widget("FacebookWidget");' ) );
}

add_action("plugins_loaded", "FacebookWidget_init");
?>
