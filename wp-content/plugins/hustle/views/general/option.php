<?php
$type       = strtolower( $type );
$type_class = 'optin_' .  $type . '_' . $type . ' ' . $type;
$for        = ( isset($for) ) ? $for : '';

// FIELD TYPE: Label
if ( 'label' === $type ) { ?>
    <label
		<?php echo isset( $for ) ? 'for="' . esc_attr( $for ) . '"' : ''; ?>
		class="<?php echo isset( $class ) ? esc_attr( $class ) : 'sui-label'; ?>"
		<?php Opt_In::render_attributes( isset( $attributes ) ? $attributes : array() ); ?>
	>
		<?php echo $value; // phpcs:ignore ?>
	</label>

<?php
// FIELD TYPE: Description
} else if ( 'description' === $type ) { ?>
	<span class="sui-description"><?php echo $value; // phpcs:ignore ?></span>

<?php
// FIELD TYPE: Notice
} else if ( 'notice' === $type ) { // Type textarea ?>
	<div <?php Opt_In::render_attributes( isset( $attributes ) ? $attributes : array() ); ?> class="sui-notice <?php echo isset( $class ) ? esc_attr( $class ) : ''; ?>">
		<p><?php echo $value; // phpcs:ignore ?></p>
	</div>

<?php
// FIELD TYPE: Textarea
} else if ( 'textarea' === $type ) { ?>
	<textarea <?php Opt_In::render_attributes( isset( $attributes ) ? $attributes : array() ); ?>
		name="<?php echo esc_attr( $name ); ?>"
		id="<?php echo esc_attr( $id ); ?>"
		cols="30" rows="10"><?php echo esc_textarea( $value ? $value : $default ); ?></textarea>

<?php
// FIELD TYPE: Select
} else if ( 'select' === $type ) { ?>
	<select
		<?php echo empty( $name )? '' : 'name="' . esc_attr( $name ) . '"'; ?>
		<?php echo empty( $id )? '' : 'id="' . esc_attr( $id ) . '"'; ?>
		<?php echo empty( $class )? '' : 'class="' . esc_attr( $class ) . '"'; ?>
		<?php Opt_In::render_attributes( isset( $attributes ) ? $attributes : array() ); ?>
	>
        <?php
		foreach ( $options as $option ) :
			$option = (array) $option;
			$value 	= isset( $option['value'] ) ? $option['value'] : '';
			$label 	= !empty( $option['label'] ) ? $option['label'] : '&#8205;';
			$_selected = is_array( $selected ) && empty( $selected ) ? '' : $selected;
            ?>
            <option <?php selected( $_selected, $value ); ?> value="<?php echo esc_attr( $value ); ?>"><?php echo esc_attr( $label ); ?></option>
        <?php endforeach; ?>
    </select>

<?php
// FIELD TYPE: Link
} else if ( 'link' === $type ) { ?>
	<a <?php Opt_In::render_attributes( isset( $attributes ) ? $attributes : array() ); ?>
		href="<?php echo esc_url( $href ); ?>"
		target="<?php echo isset( $target ) ? esc_attr( $target ) : '_self'; ?>"
		id="<?php echo isset( $id ) ? esc_attr( $id ) : ''; ?>"
		class="<?php echo esc_attr( $type_class ); ?> <?php echo isset( $class ) ? esc_attr( $class ) : ''; ?>"
			<?php echo isset( $style ) ? 'style="' . esc_attr( $style ) . '"' : ''; ?>><?php echo esc_html( $text ); ?></a>

<?php
// FIELD TYPE: Wrapper
} else if ( 'wrapper' === $type ) { ?>
    <div
		<?php Opt_In::render_attributes( isset( $attributes ) ? $attributes : array() ); ?>
		<?php echo isset( $id ) ? 'id="' . esc_attr( $id ) . '"' : ''; ?>
		class="<?php if ( empty( $is_not_field_wrapper ) ) echo 'sui-form-field '; ?><?php if ( isset( $class ) ) echo esc_attr( $class ); ?>"
		<?php echo isset( $style ) ? 'style="' . esc_attr( $style ) . '"' : ''; ?>
	>
        <?php foreach( (array) $elements as $element ) { ?>
            <?php
            $params = $element;
            if( isset( $apikey ) && 'optin_api_key' === $element['id'] )
				$params['value'] = $apikey;
            Opt_In::static_render("general/option", $params);
            ?>
        <?php } ?>
    </div>

<?php
// FIELD TYPE: Radio (Group)
} else if ( 'radios' === $type ) {
	$_selected = -1;

	if ( isset( $default ) ) {
		$_selected = $default;
	}

	if ( isset( $selected ) ) {
		$_selected = $selected;
	}

	if ( is_array( $_selected ) && empty( $_selected ) ) {
		$_selected = '';
	}

	foreach ( $options as $option ) {

		$option = (array) $option;
		$id     = esc_attr( $id . "-" . str_replace( " ", "-", strtolower( $option['value'] ) ) ); // phpcs:ignore
		$label_before = isset( $label_before ) ? $label_before : false;
		?>

		<label
			<?php echo isset( $id ) ? 'for="' . esc_attr( $id ) . '"' : ''; ?>
			class="sui-radio<?php echo isset( $class ) ? ' ' . esc_attr( $class ) : ''; ?>"
		>

			<input
				type="radio"
				<?php echo isset( $name ) ? 'name="' . esc_attr( $name ) . '"' : ''; ?>
				<?php echo isset( $option['value'] ) ? 'value="' . esc_attr( $option['value'] ) . '"' : ''; ?>
				<?php echo isset( $id ) ? 'id="' . esc_attr( $id ) . '"' : ''; ?>
				<?php Opt_In::render_attributes( isset( $item_attributes ) ? $item_attributes :  array() ); ?>
				<?php selected( $_selected, $option['value'] ); ?>
			/>

			<span aria-hidden="true"></span>

			<?php echo isset( $option['label'] ) ? '<span>' . esc_html( $option['label'] ) . '</span>' : ''; ?>

		</label>

	<?php } ?>

<?php
// FIELD TYPE: Radio
} else if ( 'radio' === $type ) { ?>

	<label
		<?php echo isset( $id ) ? 'for="' . esc_attr( $id ) . '"' : ''; ?>
		class="sui-radio<?php echo isset( $class ) ? ' ' . esc_attr( $class ) : ''; ?>"
	>
		<input
			type="radio"
			<?php echo isset( $name ) ? 'name="' . esc_attr( $name ) . '"' : ''; ?>
			<?php echo isset( $value ) ? 'value="' . esc_attr( $value ) . '"' : ''; ?>
			<?php echo isset( $id ) ? 'id="' . esc_attr( $id ) . '"' : ''; ?>
			<?php Opt_In::render_attributes( isset( $attributes ) ? $attributes : array() ); ?>
		/>
		<span aria-hidden="true"></span>
		<?php echo isset( $label ) ? '<span>' . esc_html( $label ) . '</span>' : ''; ?>
	</label>

<?php
// FIELD TYPE: Checkbox (Group)
} else if ( 'checkboxes' === $type ) {

	$_selected = -1;

	if ( isset( $default ) ) {
		$_selected = $default;
	}

	if ( isset( $selected ) ) {
		$_selected = $selected;
	}

	foreach ( $options as $option ) {

		$option  = (array) $option;
		$id      = esc_attr( $id . "-" . str_replace( " ", "-", strtolower( $option['value'] ) ) ); // phpcs:ignore
		$checked = is_array( $_selected ) ? in_array( $option['value'], $_selected ) ? checked(true, true, false) : "" : checked( $_selected, $option['value'], false ); // phpcs:ignore
		?>

		<label
			<?php echo isset( $id ) ? 'for="' . esc_attr( $id ) . '"' : ''; ?>
			class="sui-checkbox<?php echo isset( $class ) ? ' ' . esc_attr( $class ) : ''; ?>"
		>

			<input
				type="checkbox"
				<?php echo isset( $name ) ? 'name="' . esc_attr( $name ) . '"' : ''; ?>
				<?php echo isset( $option['value'] ) ? 'value="' . esc_attr( $option['value'] ) . '"' : ''; ?>
				<?php echo isset( $id ) ? 'id="' . esc_attr( $id ) . '"' : ''; ?>
				<?php Opt_In::render_attributes( isset( $item_attributes ) ? $item_attributes :  array() ); ?>
				<?php echo esc_html( $checked ); ?>
			/>

			<span aria-hidden="true"></span>

			<?php echo isset( $option['label'] ) ? '<span>' . esc_html( $option['label'] ) . '</span>' : ''; ?>

		</label>

	<?php } ?>

<?php
// FIELD TYPE: Checkbox
} else if ( 'checkbox' === $type ) { ?>

	<label
		<?php echo isset( $id ) ? 'for="' . esc_attr( $id ) . '"' : ''; ?>
		class="sui-checkbox<?php echo isset( $class ) ? ' ' . esc_attr( $class ) : ''; ?>"
	>
		<input
			type="checkbox"
			<?php echo isset( $name ) ? 'name="' . esc_attr( $name ) . '"' : ''; ?>
			<?php echo isset( $value ) ? 'value="' . esc_attr( $value ) . '"' : ''; ?>
			<?php echo isset( $id ) ? 'id="' . esc_attr( $id ) . '"' : ''; ?>
			<?php Opt_In::render_attributes( isset( $attributes ) ? $attributes : array() ); ?>
		/>
		<span aria-hidden="true"></span>
		<?php echo isset( $label ) ? '<span>' . esc_html( $label ) . '</span>' : ''; ?>
	</label>

<?php
// FIELD TYPE: Checkbox (Toggle)
} else if ( 'checkbox_toggle' === $type ) { ?>
	<label
		<?php echo isset( $id ) ? 'for="' . esc_attr( $id ) . '"' : ''; ?>
		class="sui-toggle"
	>
		<input
			type="checkbox"
			name="<?php echo esc_attr( $name ); ?>"
			value="<?php echo esc_attr( $value ); ?>"
			<?php echo isset( $id ) ? 'id="' . esc_attr( $id ) . '"' : ''; ?>
			<?php Opt_In::render_attributes( isset( $attributes ) ? $attributes : array() ); ?>
		/>
		<span class="sui-toggle-slider" aria-hidden="true"></span>
	</label>
	<?php if ( isset( $label ) && '' !== $label ) { ?>
		<label <?php echo isset( $id ) ? 'for="' . esc_attr( $id ) . '"' : ''; ?>><?php echo esc_html( $label ); ?></label>
	<?php } ?>
	<?php if ( isset( $description ) && '' !== $description ) { ?>
		<span class="sui-description sui-toggle-description"><?php echo esc_html( $description ); ?></span>
	<?php } ?>

<?php
// TAG TYPE: Small
} else if ( 'small' === $type ) { // Small tag ?>
    <p><small <?php Opt_In::render_attributes( isset( $attributes ) ? $attributes : array() ); ?> for="<?php echo esc_attr( $for ); ?>">
		<?php echo $value; // phpcs:ignore ?>
	</small></p>

<?php
// FIELD TYPE: Error label
} else if ( 'error' === $type ) { ?>
	<span
		<?php Opt_In::render_attributes( isset( $attributes ) ? $attributes : array() ); ?>
		<?php echo ( isset( $id ) ? 'id="' . esc_attr( $id ) . '"' : '' ); ?>
		class="sui-error-message<?php echo isset( $class ) ? ' ' . esc_attr( $class ) : ''; ?>"
	>
		<?php echo $value; // phpcs:ignore ?>
	</span>

<?php
// FIELD TYPE: Ajax button
// This button is not an input submit
} else if ( 'button' === $type ) { ?>
	<button
		<?php echo isset( $name ) ? 'name="' . esc_attr( $name ) . '"' : ''; ?>
		<?php echo ( isset( $id ) ? 'id="' . esc_attr( $id ) . '"' : '' ); ?>
		class="sui-button sui-button-ghost <?php echo esc_attr( $type_class ); ?> <?php echo isset( $class ) ? esc_attr( $class ) : ''; ?>"
		<?php Opt_In::render_attributes( isset( $attributes ) ? $attributes : array() ); ?>
	>
		<?php echo $value; // phpcs:ignore ?>
	</button>

<?php
// FIELD TYPE: Ajax button
// This button is not an input submit
} else if ( 'ajax_button' === $type ) { ?>
   <button <?php Opt_In::render_attributes( isset( $attributes ) ? $attributes : array() ); ?> <?php echo ( isset( $id ) ? 'id="' . esc_attr( $id ) . '"' : '' ); ?> class="<?php echo isset( $class ) ? esc_attr( $class ) : ''; ?>">
		<?php echo $value; // phpcs:ignore ?>
	</button>

<?php
// FIELD TYPE: Button
} else if ( 'submit_button' === $type ) { ?>
   <button type="submit"<?php Opt_In::render_attributes( isset( $attributes ) ? $attributes : array() ); ?> <?php echo ( isset( $id ) ? 'id="' . esc_attr( $id ) . '"' : '' ); ?> class="sui-button <?php echo isset( $class ) ? esc_attr( $class ) : ''; ?>">
		<?php echo $value; // phpcs:ignore ?>
	</button>

<?php
// FIELD TYPE: Password
} else if ( 'password-reset' === $type ) { ?>
	<div class="sui-with-button sui-with-button-icon">

		<input
			<?php Opt_In::render_attributes( isset( $attributes ) ? $attributes : array() ); ?>
			type="password"
			<?php echo isset( $name ) ? 'name="' . esc_attr( $name ) . '"' : ''; ?>
			value="<?php echo isset( $value ) ? esc_attr( $value ) : ''; ?>"
			<?php echo isset( $placeholder ) ? 'placeholder="' . esc_attr( $placeholder ) . '"' : ''; ?>
			id="<?php echo isset( $id ) ? esc_attr( $id ) : ''; ?>"
			class="sui-form-control <?php echo esc_attr( $type_class ); ?> <?php echo isset( $class ) ? esc_attr( $class ) : ''; ?>"
		/>

		<button class="sui-button-icon">
			<i aria-hidden="true" class="sui-icon-eye"></i>
			<span class="sui-password-text sui-screen-reader-text"><?php esc_html_e( 'Show Password', Opt_In::TEXT_DOMAIN ); ?></span>
			<span class="sui-password-text sui-screen-reader-text sui-hidden"><?php esc_html_e( 'Hide Password', Opt_In::TEXT_DOMAIN ); ?></span>
		</button>

	</div>

<?php } else { ?>
	<?php echo isset( $icon ) ? '<div class="sui-control-with-icon">' : ''; ?>

		<input
			<?php Opt_In::render_attributes( isset( $attributes ) ? $attributes : array() ); ?>
			type="<?php echo esc_attr( $type ); ?>"
			<?php echo isset( $name ) ? 'name="' . esc_attr( $name ) . '"' : ''; ?>
			value="<?php echo isset( $value ) ? esc_attr( $value ) : ''; ?>"
			<?php echo isset( $placeholder ) ? 'placeholder="' . esc_attr( $placeholder ) . '"' : ''; ?>
			id="<?php echo isset( $id ) ? esc_attr( $id ) : ''; ?>"
			class="sui-form-control <?php echo esc_attr( $type_class ); ?> <?php echo isset( $class ) ? esc_attr( $class ) : ''; ?>"
		/>

		<?php echo isset( $icon ) ? '<i class="sui-icon-' . esc_attr( $icon ) . '" aria-hidden="true"></i>' : ''; ?>

	<?php echo isset( $icon ) ? '</div>' : ''; ?>
<?php } ?>
