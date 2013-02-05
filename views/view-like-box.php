	<?php // Check if shortcode return string and not bool 
		if ( is_string( $border ) ) $border = ( $border == 'true') ? true : false;
		if ( is_string( $faces 	) ) $faces 	= ( $faces 	== 'true') ? true : false;
		if ( is_string( $stream ) ) $stream = ( $stream == 'true') ? true : false;
		if ( is_string( $header ) ) $header = ( $header == 'true') ? true : false;
	?>
	<!-- SFPlugin by TopDevs -->
	<script>
		(function(d){
			var js, id = 'facebook-jssdk';
			if (d.getElementById(id)) {return;}
			js = d.createElement('script');
			js.id = id;
			js.async = true;
			js.src = "//connect.facebook.net/<?php echo $local; ?>/all.js#xfbml=1";
			d.getElementsByTagName('head')[0].appendChild(js);
		}(document));
	</script>
	
	<!-- HTML5 Like Box Code START -->
	<div class="sfp-container"<?php if ( !$border ) { ?> style="width: <?php echo $width - 2; ?>px;	height: <?php echo $height - 2; ?>px; overflow: hidden;" <?php } ?>>
		<div class="fb-like-box"<?php if ( !$border ) { ?> style="margin: -1px 0px 0px -1px;"  <?php } ?>
			data-href="<?php echo $url; ?>"
			data-width="<?php echo $width; ?>"
			data-height="<?php echo $height; ?>"
			data-colorscheme="<?php echo $colorscheme; ?>"
			data-show-faces="<?php echo ( $faces ) ? 'true' : 'false'; ?>" 
			data-stream="<?php echo ( $stream ) ? 'true' : 'false' ;?>" 
			data-header="<?php echo ( $header ) ? 'true' : 'false' ;?>">
		</div>
	</div>
	<!-- HTML5 Like Box Code END -->