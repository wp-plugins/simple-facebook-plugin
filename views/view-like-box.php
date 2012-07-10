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
	<div class="fb-like-box"
		data-href="<?php echo $url; ?>"
		data-width="<?php echo $width; ?>"
		data-height="<?php echo $height; ?>"
		data-colorscheme="<?php echo $colorscheme; ?>"
		data-show-faces="<?php echo ( $faces ) ? 'true' : 'false'; ?>" 
		data-stream="<?php echo ( $stream ) ? 'true' : 'false' ;?>" 
		data-header="<?php echo ( $header ) ? 'true' : 'false' ;?>">
	</div>
	<!-- HTML5 Like Box Code END -->