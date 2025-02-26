<?php
/**
 * Help - manual checks settings
 *
 *  @package    webchangedetector
 */

// Are we allowed to see the settings?
if ( ! empty( $this->website_details['allowances']['manual_checks_settings'] ) && $this->website_details['allowances']['manual_checks_settings'] ) {
	$wizard_text = '<h2>Manual Checks & Auto Update Checks</h2>In this tab, you can make all settings for auto update checks and start manual checks.';
	$this->print_wizard(
		$wizard_text,
		'wizard_manual_checks_tab',
		'wizard_manual_checks_settings',
		false,
		true,
		'top left-plus-200'
	);

	$wizard_text = '<h2>Settings</h2><p>If you want to check your Website during WP auto updates, you can enable this here. </p>';
	$this->print_wizard(
		$wizard_text,
		'wizard_manual_checks_settings',
		'wizard_manual_checks_urls',
		false,
		false,
		'bottom  top-minus-150 left-plus-300'
	);

	$auto_update_settings = $this->website_details['auto_update_settings'];

	$weekdays = array( 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday' );
	foreach ( $weekdays as $weekday ) {
		if ( ! empty( $auto_update_settings[ 'auto_update_checks_' . $weekday ] ) ) {
			$auto_update_settings[ 'auto_update_checks_' . $weekday ] = 'checked';
		} else {
			$auto_update_settings[ 'auto_update_checks_' . $weekday ] = '';
		}
	}

	if ( ! empty( $auto_update_settings['auto_update_checks_enabled'] ) ) {
		$auto_update_settings['auto_update_checks_enabled'] = 'checked';
	} else {
		$auto_update_settings['auto_update_checks_enabled'] = '';
	}

	$auto_update_checks_enabled = true;
	if ( ! $auto_update_settings || ! array_key_exists( 'auto_update_checks_enabled', $auto_update_settings ) || 0 === (int) $auto_update_settings['auto_update_checks_enabled'] ) {
		$auto_update_checks_enabled = false;
	}
	?>

	<form class="wcd-frm-settings box-plain" action="admin.php?page=webchangedetector-update-settings" method="post">
		<input type="hidden" name="wcd_action" value="save_group_settings">
		<input type="hidden" name="step" value="pre-update">
		<input type="hidden" name="group_id" value="<?php echo esc_html( $group_id ); ?>">
		<?php wp_nonce_field( 'save_group_settings' ); ?>
		<h2>Settings</h2>
		<p style="text-align: center;">Make all settings for auto-update checks and for manual checks. </p>
		<div class="setting-container-column">
			<div class="setting-row toggle">
				<label for="threshold" >Threshold</label>
				<input name="threshold" class="threshold" type="number" step="0.1" min="0" max="100" value="<?php echo esc_html( $group_and_urls['threshold'] ); ?>"> %<br>
				<small>Ignore changes in Change Detections below the threshold.</small>
			</div>
			<div class="setting-row toggle">
				<label for="auto_update_checks_enabled" >Checks at WP auto updates</label>
				<input type="hidden" name="auto_update_checks_enabled" value="0">
				<input id="auto_update_checks_enabled" value="1" name="auto_update_checks_enabled" type="checkbox" <?php echo esc_html( $auto_update_settings['auto_update_checks_enabled'] ); ?> class="auto_update_checks_enabled">
				<small> WP auto updates have to be enabled. This option only enables checks during auto updates.</small>
			</div>
			<div id="auto_update_checks_settings">
				<div class="setting-row toggle">
					<label for="auto_update_checks_from" >Auto update times from </label>
					<input id="auto_update_checks_from" name="auto_update_checks_from" value="<?php echo esc_html( $auto_update_settings['auto_update_checks_from'] ); ?>" type="time" class="auto_update_checks_from">
					<label for="auto_update_checks_to" style="min-width: inherit"> to </label>
					<input id="auto_update_checks_to" name="auto_update_checks_to" value="<?php echo esc_html( $auto_update_settings['auto_update_checks_to'] ); ?>" type="time" class="auto_update_checks_to">
					<small>Set the time frame in which you want to allow WP auto updates.</small>
				</div>

				<div class="setting-row toggle">
					<label for="auto_update_checks_weekdays" style="vertical-align:top;">On days</label>
					<div id="auto_update_checks_weekday_container" style="display: inline-block">

						<input name="auto_update_checks_monday" value="0" type="hidden">
						<input name="auto_update_checks_monday" value="1" type="checkbox" <?php echo esc_html( $auto_update_settings['auto_update_checks_monday'] ); ?> class="auto_update_checks_monday">
						<label for="auto_update_checks_monday" style="min-width: inherit">Monday </label><br>

						<input name="auto_update_checks_tuesday" value="0" type="hidden">
						<input name="auto_update_checks_tuesday" value="1" type="checkbox" <?php echo esc_html( $auto_update_settings['auto_update_checks_tuesday'] ); ?> class="auto_update_checks_tuesday">
						<label for="auto_update_checks_tuesday" style="min-width: inherit">Tuesday </label><br>

						<input name="auto_update_checks_wednesday" value="0" type="hidden">
						<input name="auto_update_checks_wednesday" value="1" type="checkbox" <?php echo esc_html( $auto_update_settings['auto_update_checks_wednesday'] ); ?> class="auto_update_checks_wednesday">
						<label for="auto_update_checks_wednesday" style="min-width: inherit">Wednesday </label><br>

						<input name="auto_update_checks_thursday" value="0" type="hidden">
						<input name="auto_update_checks_thursday" value="1" type="checkbox" <?php echo esc_html( $auto_update_settings['auto_update_checks_thursday'] ); ?> class="auto_update_checks_thursday">
						<label for="auto_update_checks_thursday" style="min-width: inherit">Thursday </label><br>

						<input name="auto_update_checks_friday" value="0" type="hidden">
						<input name="auto_update_checks_friday" value="1" type="checkbox" <?php echo esc_html( $auto_update_settings['auto_update_checks_friday'] ); ?> class="auto_update_checks_friday">
						<label for="auto_update_checks_friday" style="min-width: inherit">Friday </label><br>

						<input name="auto_update_checks_saturday" value="0" type="hidden">
						<input name="auto_update_checks_saturday" value="1" type="checkbox" <?php echo esc_html( $auto_update_settings['auto_update_checks_saturday'] ); ?> class="auto_update_checks_saturday">
						<label for="auto_update_checks_saturday" style="min-width: inherit">Saturday </label><br>

						<input name="auto_update_checks_sunday" value="0" type="hidden">
						<input name="auto_update_checks_sunday" value="1" type="checkbox" <?php echo esc_html( $auto_update_settings['auto_update_checks_sunday'] ); ?> class="auto_update_checks_sunday">
						<label for="auto_update_checks_sunday" style="min-width: inherit">Sunday </label><br>
					</div>
					<small>Set the weekdays in which you want to allow WP auto updates.</small>
					<span class="notice notice-error" id="error-on-days-validation" style="display: none;">
						<span style="padding: 10px; display: block;" class="default-bg">At least one weekday has to be selected.</span>
					</span>
				</div>
				<div class="setting-row toggle">
					<label for="auto_update_checks_emails" >Notification email to (comma separated)</label>
					<input name="auto_update_checks_emails" style="width: 100%" type="text" value="<?php echo esc_html( $auto_update_settings['auto_update_checks_emails'] ); ?>" class="auto_update_checks_emails">
					<small>Enter the email address(es) which should get notified on about auto update checks.</small>
				</div>
			</div>
			<input type="hidden" name="group_name" value="<?php echo esc_html( $group_and_urls['name'] ); ?>">
		</div>
		<script>
			function show_auto_update_settings() {
				if(jQuery("#auto_update_checks_enabled:checked").length) {
					jQuery("#auto_update_checks_settings").slideDown();
				} else {
					jQuery("#auto_update_checks_settings").slideUp();
				}
				return true;
			}
			jQuery("#auto_update_checks_enabled").on( "click", show_auto_update_settings);
			show_auto_update_settings();
		</script>
		<div class="setting-container-column last">
			<?php require 'css-settings.php'; ?>
		</div>
		<div class="clear"></div>

		<button
				class="button button-primary"
				type="submit"
				onclick="return wcdValidateFormManualSettings()"
				style="margin-top: 20px;"
		>
			Save
		</button>
	</form>
	<?php
}