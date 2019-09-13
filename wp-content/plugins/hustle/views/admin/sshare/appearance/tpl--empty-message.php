<div id="hustle-appearance-empty-message" class="sui-message"<?php if ( ! $is_empty ) echo ' style="display: none;"'; ?>>

	<?php echo Opt_In_Utils::render_image_markup(
		esc_url( self::$plugin_url . 'assets/images/hustle-empty-message.png' ),
		esc_url( self::$plugin_url . 'assets/images/hustle-empty-message@2x.png' ),
		'sui-image'
	); // WPCS: XSS ok. ?>

	<div class="sui-message-content">

		<h2><?php esc_html_e( 'No Display Option Enabled', 'wordpress-popup' ); ?></h2>

		<p><?php printf( esc_html__( 'Whoops, you need to choose where you want the social widget to show up first. Jump back to %1$sDisplay Options%2$s and enable a module.', 'wordpress-popup' ), '<a href="#" data-tab="display" class="hustle-go-to-tab">', '</a>' ); ?></p>

	</div>

</div>
