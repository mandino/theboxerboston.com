<?php
$absolute_path = __FILE__;
$path_to_file = explode('wp-content', $absolute_path);
$path_to_wp = $path_to_file[0];

//Access WordPress
require_once( $path_to_wp . '/wp-load.php' );
?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<style>
		#main-shortcodes { width: 95%; }
		#aw-shortcodes label { font-weight: bold; }
		#aw-shortcodes label em { font-weight: normal; }
		#aw-shortcodes th { padding: 18px 10px; }
		#aw-shortcodes .red { color: red; }
	</style>
</head>
<body>

<div id="main-shortcodes">

	<table id="aw-shortcodes" class="form-table">

		<tbody>

			<!-- start dropdown -->
			<tr>

				<th class="label">

					<label for="shortcode-dropdown"><?php _e('All shortcodes', 'cebolang'); ?></label>

				</th>

				<td class="field">
			
					<select name="shortcode-dropdown" id="shortcode-dropdown" class="widefat">
						<option value=""><?php _e('Pick a Shortcode', 'cebolang'); ?></option>
						<optgroup label="- <?php _e('General Features', 'cebolang'); ?> - ">
							<option value="button-code"><?php _e('Button', 'cebolang'); ?></option>
							<option value="dropcap"><?php _e('Dropcap', 'cebolang'); ?></option>
							<option value="quote"><?php _e('Blockquote', 'cebolang'); ?></option>
							<option value="accordion-content"><?php _e('Accordion Content', 'cebolang'); ?></option>
							<option value="content-tabs"><?php _e('Content Tabs', 'cebolang'); ?></option>
						</optgroup>				
						<optgroup label="- <?php _e('Layout Columns', 'cebolang'); ?> -">
							<option value="one-half"><?php _e('1/2', 'cebolang'); ?></option>
							<option value="one-half-last"><?php _e('1/2 Last', 'cebolang'); ?></option>
							<option value="one-third"><?php _e('1/3', 'cebolang'); ?></option>
							<option value="one-third-last"><?php _e('1/3 Last', 'cebolang'); ?></option>
							<option value="one-fourth"><?php _e('1/4', 'cebolang'); ?></option>
							<option value="one-fourth-last"><?php _e('1/4 Last', 'cebolang'); ?></option>
							<option value="two-third"><?php _e('2/3', 'cebolang'); ?></option>
							<option value="two-third-last"><?php _e('2/3 Last', 'cebolang'); ?></option>
							<option value="three-fourth"><?php _e('3/4', 'cebolang'); ?></option>
							<option value="three-fourth-last"><?php _e('3/4 Last', 'cebolang'); ?></option>
						</optgroup>
					</select>

				</td>

			</tr>
			<!-- end dropdown -->

			<!-- start divider -->
			<tr class="option divider">

				<th class="label">

					<label for="divider-style"><?php _e('Dotted line', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="checkbox" name="divider-style" id="divider-style" value="on">

				</td>

			</tr>
			<!-- end divider -->

			<!-- start slogan -->
			<tr class="option slogan">

				<th class="label">

					<label for="slogan-text"><?php _e('Text', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
				
					<input type="text" name="slogan-text" id="slogan-text" value="" class="widefat">

				</td>

			</tr>

			<tr class="option slogan">
				<th class="label">

					<label for="slogan-align"><?php _e('Align', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<select name="slogan-align" id="slogan-align" class="widefat">
						<option value="" selected><?php _e('Normal', 'cebolang'); ?></option>
						<option value="left"><?php _e('Left', 'cebolang'); ?></option>
						<option value="center"><?php _e('Center', 'cebolang'); ?></option>
						<option value="right"><?php _e('Right', 'cebolang'); ?></option>
					</select>

				</td>

			</tr>
			<!-- end slogan -->

			<!-- start button-code -->
			<tr class="option button-code">

				<th class="label">

					<label for="button-code-content"><?php _e('Text', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
				
					<input type="text" name="button-code-content" id="button-code-content" value="" class="widefat">

				</td>

			</tr>

			<tr class="option button-code">

				<th class="label">

					<label for="button-code-url"><?php _e('URL', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
				
					<input type="text" name="button-code-url" id="button-code-url" value="" class="widefat">

				</td>

			</tr>

			<tr class="option button-code">

				<th class="label">

					<label for="button-code-target"><?php _e('Open link in a new window/tab', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="checkbox" name="button-code-target" id="button-code-target" value="_blank">

				</td>

			</tr>

			<tr class="option button-code">

				<th class="label">

					<label for="button-code-size"><?php _e('Color', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<select name="button-code-size" id="button-code-size" class="widefat">
						<option value="" selected><?php _e('Base', 'cebolang'); ?></option>
						<option value="buttonYellow"><?php _e('Yellow', 'cebolang'); ?></option>
						<option value="buttonOrange"><?php _e('Orange', 'cebolang'); ?></option>
						<option value="buttonRed"><?php _e('Red', 'cebolang'); ?></option>
						<option value="buttonGreen"><?php _e('Green', 'cebolang'); ?></option>
						<option value="buttonBlue"><?php _e('Blue', 'cebolang'); ?></option>
						<option value="buttonTurquoise"><?php _e('Turquoise', 'cebolang'); ?></option>
						<option value="buttonPurple"><?php _e('Purple', 'cebolang'); ?></option>
						<option value="buttonGray"><?php _e('Gray', 'cebolang'); ?></option>
						<option value="buttonDarkGray"><?php _e('Dark Gray', 'cebolang'); ?></option>
						<option value="buttonWhite"><?php _e('White', 'cebolang'); ?></option>
					</select>

				</td>

			</tr>

			<!-- end button-code -->

			<!-- start dropcap -->
			<tr class="option dropcap">

				<th class="label">

					<label for="dropcap-content"><?php _e('Text', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
					
					<input type="text" name="dropcap-content" id="dropcap-content" value="" class="widefat">

				</td>

			</tr>

			<!-- end dropcap -->

			<!-- start info-box -->
			<tr class="option info-box">

				<th class="label">

					<label for="info-box-content"><?php _e('Content', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
				
					<textarea name="info-box-content" id="info-box-content" cols="30" rows="5" class="widefat"></textarea>

				</td>

			</tr>
			<!-- end info-box -->

			<!-- start quote -->
			<tr class="option quote">

				<th class="label">

					<label for="quote-author"><?php _e('Author', 'cebolang'); ?></label>

				</th>

				<td class="field">
					
					<input type="text" name="quote-author" id="quote-author" value="" class="widefat">

				</td>

			</tr>

			<tr class="option quote">

				<th class="label">

					<label for="quote-content"><?php _e('Content', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
				
					<textarea name="quote-content" id="quote-content" cols="30" rows="5" class="widefat"></textarea>

			</td>

			</tr>
			<!-- end quote -->

			<!-- start list -->
			<tr class="option list">

				<th class="label">

					<label for="list-style"><?php _e('Icon', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<select name="list-icon" id="list-icon" class="widefat">
						<option value="none"><?php _e('None', 'cebolang'); ?></option>
						<option value="arrow" selected><?php _e('Arrow', 'cebolang'); ?></option>
						<option value="arrow-2"><?php _e('Arrow 2', 'cebolang'); ?></option>
						<option value="check"><?php _e('Check', 'cebolang'); ?></option>
						<option value="check-2"><?php _e('Check 2', 'cebolang'); ?></option>
						<option value="circle"><?php _e('Circle', 'cebolang'); ?></option>
						<option value="plus"><?php _e('Plus', 'cebolang'); ?></option>
						<option value="dash"><?php _e('Dash', 'cebolang'); ?></option>
						<option value="star"><?php _e('Star', 'cebolang'); ?></option>
					</select>

				</td>

			</tr>

			<tr class="option list">

				<th class="label">

					<label for="list-style"><?php _e('Dotted Bottom Border', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="checkbox" name="list-style" id="list-style" value="dotted">

				</td>

			</tr>

			<tr class="option list">

				<th class="label">

					<label for="list-content"><?php _e('Content', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
				
					<textarea name="list-content" id="list-content" cols="30" rows="5" class="widefat"></textarea>

				</td>

			</tr>
			<!-- end list -->

			<!-- start lightbox -->
			<tr class="option lightbox">

				<th class="label">

					<label for="lightbox-type"><?php _e('Type', 'cebolang'); ?></label>

				</th>

				<td class="field">

					<select name="lightbox-type" id="lightbox-type" class="widefat">
						<option value="single-image" selected><?php _e('Single image', 'cebolang'); ?></option>
						<option value="image-gallery"><?php _e('Image gallery', 'cebolang'); ?></option>
						<option value="iframe"><?php _e('Iframe', 'cebolang'); ?></option>
					</select>

				</td>

			</tr>

			<tr class="option lightbox">

				<th class="label">

					<label for="lightbox-full"><?php _e('Full (URL)', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
					
					<input type="text" name="lightbox-full" id="lightbox-full" value="" class="widefat">

				</td>

			</tr>

			<tr class="option lightbox">

				<th class="label">

					<label for="lightbox-title"><?php _e('Title', 'cebolang'); ?></label>

				</th>

				<td class="field">
					
					<input type="text" name="lightbox-title" id="lightbox-title" value="" class="widefat">

				</td>

			</tr>

			<tr class="option lightbox">

				<th class="label">

					<label for="lightbox-zoom-icon"><?php _e('Zoom Icon', 'cebolang'); ?></label>

				</th>

				<td class="field">

					<select name="lightbox-zoom-icon" id="lightbox-zoom-icon" class="widefat">
						<option value="none"><?php _e('None', 'cebolang'); ?></option>
						<option value="" selected><?php _e('Plus', 'cebolang'); ?></option>
						<option value="video"><?php _e('Video', 'cebolang'); ?></option>
						<option value="link"><?php _e('Link', 'cebolang'); ?></option>
					</select>

				</td>

			</tr>

			<tr class="option lightbox">

				<th class="label">

					<label for="lightbox-group"><?php _e('Group name (lowercase)', 'cebolang'); ?><br /><em><?php _e('(Only for image gallery)', 'cebolang'); ?></em></label>

				</th>

				<td class="field">
					
					<input type="text" name="lightbox-group" id="lightbox-group" value="" class="widefat">

				</td>

			</tr>

			<tr class="option lightbox">

				<th class="label">

					<label for="lightbox-content"><?php _e('Content', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
				
					<textarea name="lightbox-content" id="lightbox-content" cols="30" rows="5" class="widefat"></textarea>

				</td>

			</tr>
			<!-- end lightbox -->

			<!-- start accordion-content -->
			<tr class="option accordion-content">

				<th class="label">

					<label for="accordion-content-title"><?php _e('Title', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
				
					<input type="text" name="accordion-content-title" id="accordion-content-title" value="" class="widefat">

				</td>

			</tr>

			<tr class="option accordion-content">

				<th class="label">

					<label for="accordion-content-content"><?php _e('Content', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
				
					<textarea name="accordion-content-content" id="accordion-content-content" cols="30" rows="5" class="widefat"></textarea>

				</td>

			</tr>

			<!-- end accordion-content -->


			<tr class="option content-tabs">

				<th class="label">

					<label for="content-tabs-title"><?php _e('Title', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
				
					<input type="text" name="content-tabs-title" id="content-tabs-title" value="" class="widefat">

				</td>

			</tr>

			<tr class="option content-tabs">

				<th class="label">

					<label for="content-tabs-content"><?php _e('Content', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
				
					<textarea name="content-tabs-content" id="content-tabs-content" cols="30" rows="5" class="widefat"></textarea>

				</td>

			</tr>
			<!-- end content-tabs -->

			<!-- start pricing-tables -->
			<tr class="option pricing-tables">

				<th class="label">

					<label for="pricing-tables-column-count"><?php _e('Table column count', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<select name="pricing-tables-column-count" id="pricing-tables-column-count" class="widefat">
						<option value="1"><?php _e('1', 'cebolang'); ?></option>
						<option value="2"><?php _e('2', 'cebolang'); ?></option>
						<option value="3"><?php _e('3', 'cebolang'); ?></option>
						<option value="4" selected><?php _e('4', 'cebolang'); ?></option>
						<option value="5"><?php _e('5', 'cebolang'); ?></option>
					</select>
				</td>

			</tr>

			<tr class="option pricing-tables">

				<th class="label">

					<label for="pricing-tables-type"><?php _e('Table type', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<select name="pricing-tables-type" id="pricing-tables-type" class="widefat">
						<option value="simple" selected><?php _e('Simple', 'cebolang'); ?></option>
						<option value="extended"><?php _e('Extended', 'cebolang'); ?></option>
					</select>
				</td>

			</tr>

			<tr class="option pricing-tables">

				<th class="label">

					<label for="pricing-tables-column-single"><?php _e('Single column', 'cebolang'); ?><br /><em><?php _e('(Remove wrapping shortcode)', 'cebolang'); ?></em></label>

				</th>

				<td class="field">
				
					<input type="checkbox" name="pricing-tables-column-single" id="pricing-tables-column-single" value="on">

				</td>

			</tr>

			<tr class="option pricing-tables">

				<th class="label">

					<label for="pricing-tables-column-type"><?php _e('Column type', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<select name="pricing-tables-column-type" id="pricing-tables-column-type" class="widefat">
						<option value="" selected><?php _e('Normal', 'cebolang'); ?></option>
						<option value="features-list"><?php _e('Features list (only for Extended tables)', 'cebolang'); ?></option>
					</select>
				</td>

			</tr>

			<tr class="option pricing-tables">

				<th class="label">

					<label for="pricing-tables-column-title"><?php _e('Column title', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
				
					<input type="text" name="pricing-tables-column-title" id="pricing-tables-column-title" value="" class="widefat">

				</td>

			</tr>

			<tr class="option pricing-tables">

				<th class="label">

					<label for="pricing-tables-column-price"><?php _e('Column price', 'cebolang'); ?><br /><em><?php _e('(With currency)', 'cebolang'); ?></em></label>

				</th>

				<td class="field">
				
					<input type="text" name="pricing-tables-column-price" id="pricing-tables-column-price" value="" class="widefat">

				</td>

			</tr>

			<tr class="option pricing-tables">

				<th class="label">

					<label for="pricing-tables-column-period"><?php _e('Column period', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="text" name="pricing-tables-column-period" id="pricing-tables-column-period" value="" class="widefat">

				</td>

			</tr>

			<tr class="option pricing-tables">

				<th class="label">

					<label for="pricing-tables-column-description"><?php _e('Column description', 'cebolang'); ?><br /><em><?php _e('(Only for Simple tables)', 'cebolang'); ?></em></label>

				</th>

				<td class="field">
				
					<input type="text" name="pricing-tables-column-description" id="pricing-tables-column-description" value="" class="widefat">

				</td>

			</tr>

			<tr class="option pricing-tables">

				<th class="label">

					<label for="pricing-tables-column-signup-title"><?php _e('Column Sign Up button title', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="text" name="pricing-tables-column-signup-title" id="pricing-tables-column-signup-title" value="" class="widefat">

				</td>

			</tr>

			<tr class="option pricing-tables">

				<th class="label">

					<label for="pricing-tables-column-signup-url"><?php _e('Column Sign Up button URL', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="text" name="pricing-tables-column-signup-url" id="pricing-tables-column-signup-url" value="" class="widefat">

				</td>

			</tr>

			<tr class="option pricing-tables">

				<th class="label">

					<label for="pricing-tables-column-special"><?php _e('Special column', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<select name="pricing-tables-column-special" id="pricing-tables-column-special" class="widefat">
						<option value="" selected><?php _e('No', 'cebolang'); ?></option>
						<option value="free"><?php _e('Free', 'cebolang'); ?></option>
						<option value="featured"><?php _e('Featured', 'cebolang'); ?></option>
					</select>
				</td>

			</tr>

			<tr class="option pricing-tables">

				<th class="label">

					<label for="pricing-tables-column-content"><?php _e('Column content (list items)', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
				
					<textarea name="pricing-tables-column-content" id="pricing-tables-column-content" cols="30" rows="5" class="widefat"></textarea>
					<em><?php printf( __('(Use %1$s shortcode to create a tooltip and %2$s shortcode to create a check icon.)', 'cebolang'), '<code>[tooltip text=""]</code>', '<code>[check]</code>' ); ?></em>

				</td>

			</tr>
			<!-- end pricing-tables -->

			<!-- start video-player -->
			<tr class="option video-player">

				<th class="label">

					<label for="video-player-mp4"><?php _e('MP4 file URL', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="text" name="video-player-mp4" id="video-player-mp4" value="" class="widefat">
					<em><?php _e('(For Safari, Internet Explorer 9, iPhone, iPad, Android, and Windows Phone 7)', 'cebolang'); ?></em>

				</td>

			</tr>

			<tr class="option video-player">

				<th class="label">

					<label for="video-player-webm"><?php _e('WebM file URL', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="text" name="video-player-webm" id="video-player-webm" value="" class="widefat">
					<em><?php _e('(For Firefox4, Opera, and Chrome)', 'cebolang'); ?></em>

				</td>

			</tr>

			<tr class="option video-player">

				<th class="label">

					<label for="video-player-ogg"><?php _e('OGG file URL', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="text" name="video-player-ogg" id="video-player-ogg" value="" class="widefat">
					<em><?php _e('(For older Firefox and Opera versions)', 'cebolang'); ?></em>

				</td>

			</tr>

			<tr class="option video-player">

				<th class="label">

					<label for="video-player-poster"><?php _e('Preview image URL', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="text" name="video-player-poster" id="video-player-poster" value="" class="widefat">

				</td>

			</tr>


			<tr class="option video-player">

				<th class="label">

					<label for="video-player-aspect-ratio"><?php _e('Aspect ratio', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="text" name="video-player-aspect-ratio" id="video-player-aspect-ratio" value="1.7" class="widefat">

				</td>

			</tr>

			<tr class="option video-player">

				<th class="label">

					<label><?php _e('Extra Info', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<?php _e('If video element isn\'t displayed properly, try to wrap it inside of <code>[raw]</code> shortcode.', 'cebolang'); ?>

				</td>

			</tr>
			<!-- end video-player -->

			<!-- start audio-player -->
			<tr class="option audio-player">

				<th class="label">

					<label for="audio-player-mp3"><?php _e('MP3 File URL', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="text" name="audio-player-mp3" id="audio-player-mp3" value="" class="widefat">
					<em><?php _e('(For Safari, Internet Explorer, Chrome)', 'cebolang'); ?></em>

				</td>

			</tr>

			<tr class="option audio-player">

				<th class="label">

					<label for="audio-player-ogg"><?php _e('OGG File URL', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="text" name="audio-player-ogg" id="audio-player-ogg" value="" class="widefat">
					<em><?php _e('(For Firefox, Opera, Chrome)', 'cebolang'); ?></em>

				</td>

			</tr>

			<tr class="option audio-player">

				<th class="label">

					<label><?php _e('Extra Info', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<?php _e('If audio element isn\'t displayed properly, try to wrap it inside of <code>[raw]</code> shortcode.', 'cebolang'); ?>

				</td>

			</tr>
			<!-- end audio-player -->

			<!-- start alert-boxes -->
			<tr class="option alert-boxes">

				<th class="label">

					<label for="alert-boxes-content"><?php _e('Content', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
				
					<textarea name="alert-boxes-content" id="alert-boxes-content" cols="30" rows="5" class="widefat"></textarea>

				</td>

			</tr>
			<!-- end alert-boxes -->

			<!-- start layout -->
			<tr class="option layout">

				<th class="label">

					<label for="layout-content"><?php _e('Content', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
				
					<textarea name="layout-content" id="layout-content" cols="30" rows="5" class="widefat"></textarea>

				</td>

			</tr>
			<!-- end layout -->

			<!-- start post-carousel -->
			<tr class="option post-carousel">

				<th class="label">

					<label for="post-carousel-title"><?php _e('Custom Title', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="text" name="post-carousel-title" id="post-carousel-title" value="" class="widefat">
					<em><?php _e('(Default: Latest stuff from our blog)', 'cebolang'); ?></em>

				</td>

			</tr>

			<tr class="option post-carousel">

				<th class="label">

					<label for="post-carousel-limit"><?php _e('Limit', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="text" name="post-carousel-limit" id="post-carousel-limit" value="" class="widefat">
					<em><?php _e('(Only numbers! Default: 8)', 'cebolang'); ?></em>

				</td>

			</tr>

			<tr class="option post-carousel">

				<th class="label">

					<label for="post-carousel-auto"><?php _e('Auto Scroll ', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="text" name="post-carousel-auto" id="post-carousel-auto" value="" class="widefat">
					<em><?php _e('Seconds between scroll transitions. (Only numbers! Default: 0)', 'cebolang'); ?></em>

				</td>

			</tr>

			<tr class="option post-carousel">

				<th class="label">

					<label for="post-carousel-categories"><?php _e('Categories', 'cebolang'); ?></label>

				</th>

				<td class="field">

					<select name="post-carousel-categories" id="post-carousel-categories" class="widefat" size="5" multiple>

						<option value="" selected><?php _e('All', 'cebolang'); ?></option>

						<?php $blog_categories = get_categories( array('orderby' => 'id') ); foreach( $blog_categories as $category ): ?>

							<option value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></option>

						<?php endforeach; ?>

					</select>

					<em><?php _e('(You can select multiple categories by pressing CTRL key)', 'cebolang'); ?></em>

				</td>

			</tr>

			<tr class="option post-carousel">

				<th class="label">

					<label for="post-carousel-scroll-count"><?php _e('Scroll Count', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="text" name="post-carousel-scroll-count" id="post-carousel-scroll-count" value="" class="widefat">
					<em><?php _e('(Only numbers!)', 'cebolang'); ?></em>

				</td>

			</tr>
			<!-- end post-carousel -->

			<!-- start projects-carousel -->
			<tr class="option projects-carousel">

				<th class="label">

					<label for="projects-carousel-title"><?php _e('Custom Title', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="text" name="projects-carousel-title" id="projects-carousel-title" value="" class="widefat">
					<em><?php _e('(Default: Latest projects)', 'cebolang'); ?></em>

				</td>

			</tr>
			<tr class="option projects-carousel">

				<th class="label">

					<label for="projects-carousel-limit"><?php _e('Limit', 'cebolang'); ?> <em></label>

				</th>

				<td class="field">
				
					<input type="text" name="projects-carousel-limit" id="projects-carousel-limit" value="" class="widefat">
					<em><?php _e('(Only numbers! Default: 8)', 'cebolang'); ?></em>

				</td>

			</tr>
			
			<tr class="option projects-carousel">

				<th class="label">

					<label for="projects-carousel-auto"><?php _e('Auto Scroll ', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="text" name="projects-carousel-auto" id="projects-carousel-auto" value="" class="widefat">
					<em><?php _e('Seconds between scroll transitions. (Only numbers! Default: 0)', 'cebolang'); ?></em>

				</td>

			</tr>

			<tr class="option projects-carousel">

				<th class="label">

					<label for="projects-carousel-categories"><?php _e('Categories', 'cebolang'); ?></label>

				</th>

				<td class="field">

					<select name="projects-carousel-categories" id="projects-carousel-categories" class="widefat" size="5" multiple>

						<option value="" selected><?php _e('All', 'cebolang'); ?></option>

					<?php $portfolio_categories = get_terms( 'portfolio-categories', array('orderby' => 'id') ); foreach( $portfolio_categories as $category ): ?>

						<option value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></option>

					<?php endforeach; ?>

					</select>

					<em><?php _e('(You can select multiple categories by pressing CTRL key)', 'cebolang'); ?></em>

				</td>

			</tr>

			<tr class="option projects-carousel">

				<th class="label">

					<label for="projects-carousel-scroll-count"><?php _e('Scroll Count', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="text" name="projects-carousel-scroll-count" id="projects-carousel-scroll-count" value="" class="widefat">
					<em><?php _e('(Only numbers!)', 'cebolang'); ?></em>

				</td>

			</tr>
			<!-- end projects-carousel -->

			<!-- start portfolio -->
			<tr class="option portfolio">

				<th class="label">

					<label for="portfolio-columns"><?php _e('Column', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<select name="portfolio-columns" id="portfolio-columns" class="widefat">
						<option value="one-half"><?php _e('1/2', 'cebolang'); ?></option>
						<option value="one-third"><?php _e('1/3', 'cebolang'); ?></option>
						<option value="one-fourth" selected><?php _e('1/4', 'cebolang'); ?></option>
					</select>
					
				</td>

			</tr>

			</tr>
			
			<tr class="option portfolio">

				<th class="label">

					<label for="portfolio-limit"><?php _e('Limit', 'cebolang'); ?> <em></label>

				</th>

				<td class="field">
				
					<input type="text" name="portfolio-limit" id="portfolio-limit" value="" class="widefat">
					<em><?php _e('(Only numbers! Default: All)', 'cebolang'); ?></em>

				</td>

			</tr>

			<tr class="option portfolio">

				<th class="label">

					<label for="portfolio-categories"><?php _e('Categories', 'cebolang'); ?></label>

				</th>

				<td class="field">

					<select name="portfolio-categories" id="portfolio-categories" class="widefat" size="5" multiple>

						<option value="" selected><?php _e('All', 'cebolang'); ?></option>

					<?php $portfolio_categories = get_terms( 'portfolio-categories', array('orderby' => 'id') ); foreach( $portfolio_categories as $category ): ?>

						<option value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></option>

					<?php endforeach; ?>

					</select>

					<em><?php _e('(You can select multiple categories by pressing CTRL key)', 'cebolang'); ?></em>

				</td>

			</tr>

			<tr class="option portfolio">

				<th class="label">

					<label for="portfolio-pagination"><?php _e('Hide pagination', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="checkbox" name="portfolio-pagination" id="portfolio-pagination" value="no"><br />
					<em><?php _e('(Only if Limit has been set!)', 'cebolang'); ?></em>

				</td>

			</tr>
			<!-- end portfolio -->

			<!-- start slider -->
			<tr class="option slider">

				<th class="label">

					<label for="slider-id"><?php _e('ID', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">

					<select name="slider-id" id="slider-id" class="widefat">

						<option value="" select><?php _e('Select slider', 'cebolang'); ?></option>

						<?php
							global $post;
							$args = array( 'post_type' => 'slider', 'posts_per_page' => -1 );
							query_posts( $args );
							if( have_posts() ) while ( have_posts() ) : the_post();
						?>

							<option value="<?php echo $post->post_name; ?>"><?php echo $post->post_title; ?></option>

						<?php endwhile; wp_reset_query();  ?>

					</select>

				</td>

			</tr>
			<!-- end slider -->

			<!-- start team-member -->
			<tr class="option team-member">

				<th class="label">

					<label for="team-member-id"><?php _e('Team Member', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">

					<select name="team-member-id" id="team-member-id" class="widefat">

						<option value="" select><?php _e('Select team member', 'cebolang'); ?></option>

						<?php
							global $post;
							$args = array( 'post_type' => 'team', 'posts_per_page' => -1 );
							query_posts( $args );
							if( have_posts() ) while ( have_posts() ) : the_post();
						?>

							<option value="<?php echo $post->post_name; ?>"><?php echo $post->post_title; ?></option>

						<?php endwhile; wp_reset_query();  ?>

					</select>

				</td>

			</tr>
			
			<tr class="option team-member">

				<th class="label">

					<label for="team-member-single-url"><?php _e('Single URL', 'cebolang'); ?> <em></label>

				</th>

				<td class="field">
				
					<input type="text" name="team-member-single-url" id="team-member-single-url" value="" class="widefat">

				</td>

			</tr>

			<tr class="option team-member">

				<th class="label">

					<label for="team-member-single-target"><?php _e('Open single link in a new window/tab', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<input type="checkbox" name="team-member-single-target" id="team-member-single-target" value="_blank">

				</td>

			</tr>

			<tr class="option team-member">

				<th class="label">

					<label for="team-member-column"><?php _e('Column', 'cebolang'); ?></label>

				</th>

				<td class="field">
				
					<select name="team-member-column" id="team-member-column" class="widefat">
						<option value="one-half"><?php _e('1/2', 'cebolang'); ?></option>
						<option value="one-third"><?php _e('1/3', 'cebolang'); ?></option>
						<option value="one-fourth" selected><?php _e('1/4', 'cebolang'); ?></option>
					</select>
					
				</td>

			</tr>

			<tr class="option team-member">

				<th class="label">

					<label for="team-member-last"><?php _e('Last column', 'cebolang'); ?></label>

				</th>

				<td class="field">

					<input type="checkbox" name="team-member-last" id="team-member-last" value="last">

				</td>

			</tr>
			<!-- end team-member -->

			<!-- start fullwidth-map -->
			<tr class="option fullwidth-map">

				<th class="label">

					<label for="fullwidth-map-content"><?php _e('Map shortcode', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
				
					<textarea name="fullwidth-map-content" id="fullwidth-map-content" cols="30" rows="5" class="widefat"></textarea>

				</td>

			</tr>
			<!-- end fullwidth-map -->

			<!-- start raw -->
			<tr class="option raw">

				<th class="label">

					<label for="raw-content"><?php _e('Content', 'cebolang'); ?><span class="red">*</span></label>

				</th>

				<td class="field">
				
					<textarea name="raw-content" id="raw-content" cols="30" rows="5" class="widefat"></textarea>

				</td>

			</tr>
			<!-- end raw -->

			<!-- start current -->
			<tr>

				<th class="label">

					<label for="shortcode-dropdown"><?php _e('Current shortcode with all available attributes', 'cebolang'); ?><br />					
					<em>(<span class="red"><?php _e('red', 'cebolang'); ?></span> = <?php _e('required', 'cebolang'); ?>)</em></label>

				</th>

				<td class="field">

					<code id="shortcode"></code>

				</td>

			</tr>
			<!-- end current -->

			<!-- start insert -->
			<tr>

				<th class="label"></th>

				<td class="field">

					<p><button id="insert-shortcode" class="button-primary"><?php _e('Insert Shortcode', 'cebolang'); ?></button></p>

				</td>

			</tr>
			<!-- end insert -->

		</tbody>

	</table>
	
</div><!-- end #main -->

<script>jQuery('.option').hide();</script>

</body>
</html>