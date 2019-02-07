<script id="wpoi-e-newsletter-box-back" type="text/template">

<div id="wpmudev-settings-widget-enews_back" class="wpmudev-box wpmudev-box-close">

	<div class="wpmudev-box-head">

		<h2><?php _e( '{{optin_name}} - Setup', Opt_In::TEXT_DOMAIN ); ?></h2>

		<div class="wpmudev-box-action"><?php $this->render("general/icons/icon-minus" ); ?></div>

	</div>

	<div class="wpmudev-box-body">

		<p><?php _e( 'Add <strong>{{optin_name}}</strong> emails to these e-Newsletter groups:', Opt_In::TEXT_DOMAIN ); ?></p>

		<table cellspacing="0" cellpadding="0" class="wpmudev-table">

			<thead>

				<tr>

					<th colspan="2"><?php _e( 'e-Newsletter Groups', Opt_In::TEXT_DOMAIN ); ?></th>

				</tr>

			</thead>

			<tbody>

				<# _.each( groups, function( group, index ) { #>

					<tr>

						<td class="wpmudev-enews-group"><span for="wpoi-e-newsletter-group-{{group.group_id}}">{{group.group_name}} ({{group.type}})</span></td>

						<td class="wpmudev-enews-switch"><div class="wpmudev-switch">

							<input id="wpoi-e-newsletter-group-{{group.group_id}}" class="wpoi-e-newsletter-group" type="checkbox" value="{{group.group_id}}" {{_.checked(group.selected, true)}}>

							<label class="wpmudev-switch-design" for="wpoi-e-newsletter-group-{{group.group_id}}" aria-hidden="true"></label>

						</div></td>

					</tr>

				<# }); #>

			</tbody>

			<tfoot>

				<tr>

					<td colspan="2">

						<div class="wpmudev-enews-action">

							<a href="#0" class="wpmudev-button optin-enews-sync-cancel"><?php _e( "Cancel", Opt_In::TEXT_DOMAIN ); ?></a>

							<a href="#0" class="wpmudev-button wpmudev-button-blue optin-enews-sync-save" data-id="{{optin_id}}" data-nonce="{{save_nonce}}" ><?php _e( "Save Settings", Opt_In::TEXT_DOMAIN ); ?></a>

						</div>

					</td>

				</tr>

			</tfoot>

		</table>

	</div>

</div>

</script>