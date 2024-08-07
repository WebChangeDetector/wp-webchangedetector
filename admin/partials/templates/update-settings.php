<?php
/**
 * Help - manual checks settings
 *
 *  @package    webchangedetector
 */

$weekdays = array( 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday' );

$auto_update_settings = get_option( 'wcd_auto_update_settings' );
if ( ! $auto_update_settings ) { // Set defaults.
	$auto_update_settings['auto_update_checks_enabled']   = '';
	$auto_update_settings['auto_update_checks_from']      = '10:00';
	$auto_update_settings['auto_update_checks_to']        = '16:00';
	$auto_update_settings['auto_update_checks_monday']    = 'checked';
	$auto_update_settings['auto_update_checks_tuesday']   = 'checked';
	$auto_update_settings['auto_update_checks_wednesday'] = 'checked';
	$auto_update_settings['auto_update_checks_thursday']  = 'checked';
	$auto_update_settings['auto_update_checks_friday']    = 'checked';
	$auto_update_settings['auto_update_checks_saturday']  = '';
	$auto_update_settings['auto_update_checks_sunday']    = '';
	$auto_update_settings['auto_update_checks_emails']    = get_option( 'admin_email' );
}
foreach ( $weekdays as $weekday ) {
	if ( ! isset( $auto_update_settings[ 'auto_update_checks_' . $weekday ] ) ) {
		$auto_update_settings[ 'auto_update_checks_' . $weekday ] = '';
	} elseif ( 'on' === $auto_update_settings[ 'auto_update_checks_' . $weekday ] ) {
		$auto_update_settings[ 'auto_update_checks_' . $weekday ] = 'checked';
	}
}
if ( ! isset( $auto_update_settings['auto_update_checks_enabled'] ) ) {
	$auto_update_settings['auto_update_checks_enabled'] = '';
} elseif ( 'on' === $auto_update_settings['auto_update_checks_enabled'] ) {
	$auto_update_settings['auto_update_checks_enabled'] = 'checked';
}
?>
<div style="width: 50%; float: left;">
	<div style="padding: 10px; margin-top: 20px;" class="auto-setting toggle">
		<label for="threshold" >Threshold</label>
		<input name="threshold" class="threshold" type="number" step="0.1" min="0" max="100" value="<?php echo esc_html( $group_and_urls['threshold'] ); ?>"> %<br>
	</div>
	<div style="padding: 10px;" class="auto-setting">
		<label for="auto_update_checks_enabled" >Checks at WP auto updates</label>
		<input id="auto_update_checks_enabled" name="auto_update_checks_enabled" type="checkbox" <?php echo esc_html( $auto_update_settings['auto_update_checks_enabled'] ); ?> class="auto_update_checks_enabled">
		<small> WP auto updates have to be enabled. This option only enables checks during auto updates.</small>
	</div>
	<div id="auto_update_checks_settings">
		<div style="padding: 10px; " class="auto-setting toggle">
			<label for="auto_update_checks_from" >Auto update times from </label>
			<input id="auto_update_checks_from" name="auto_update_checks_from" value="<?php echo esc_html( $auto_update_settings['auto_update_checks_from'] ); ?>" type="time" class="auto_update_checks_from">
			<label for="auto_update_checks_to" style="min-width: inherit"> to </label>
			<input id="auto_update_checks_to" name="auto_update_checks_to" value="<?php echo esc_html( $auto_update_settings['auto_update_checks_to'] ); ?>" type="time" class="auto_update_checks_to">
		</div>
		<span class="notice notice-error" id="error-from-to-validation" style="display: none;">
			<span style="padding: 10px; display: block;" class="default-bg">The time window is invalid. The "to" time must be greater than "from" time.</span>
		</span>
		<div style="padding: 10px; " class="auto-setting toggle">
			<label for="auto_update_checks_weekdays" style="vertical-align:top;">On days</label>
			<div id="auto_update_checks_weekday_container" style="display: inline-block">
				<input name="auto_update_checks_monday" type="checkbox" <?php echo esc_html( $auto_update_settings['auto_update_checks_monday'] ); ?> class="auto_update_checks_monday">
				<label for="auto_update_checks_monday" style="min-width: inherit">Monday </label><br>
				<input name="auto_update_checks_tuesday" type="checkbox" <?php echo esc_html( $auto_update_settings['auto_update_checks_tuesday'] ); ?> class="auto_update_checks_tuesday">
				<label for="auto_update_checks_monday" style="min-width: inherit">Tuesday </label><br>
				<input name="auto_update_checks_wednesday" type="checkbox" <?php echo esc_html( $auto_update_settings['auto_update_checks_wednesday'] ); ?> class="auto_update_checks_wednesday">
				<label for="auto_update_checks_wednesday" style="min-width: inherit">Wednesday </label><br>
				<input name="auto_update_checks_thursday" type="checkbox" <?php echo esc_html( $auto_update_settings['auto_update_checks_thursday'] ); ?> class="auto_update_checks_thursday">
				<label for="auto_update_checks_thursday" style="min-width: inherit">Thursday </label><br>
				<input name="auto_update_checks_friday" type="checkbox" <?php echo esc_html( $auto_update_settings['auto_update_checks_friday'] ); ?> class="auto_update_checks_friday">
				<label for="auto_update_checks_friday" style="min-width: inherit">Friday </label><br>
				<input name="auto_update_checks_saturday" type="checkbox" <?php echo esc_html( $auto_update_settings['auto_update_checks_saturday'] ); ?> class="auto_update_checks_saturday">
				<label for="auto_update_checks_saturday" style="min-width: inherit">Saturday </label><br>
				<input name="auto_update_checks_sunday" type="checkbox" <?php echo esc_html( $auto_update_settings['auto_update_checks_sunday'] ); ?> class="auto_update_checks_sunday">
				<label for="auto_update_checks_sunday" style="min-width: inherit">Sunday </label><br>
			</div>
			<span class="notice notice-error" id="error-on-days-validation" style="display: none;">
				<span style="padding: 10px; display: block;" class="default-bg">At least one weekday has to be selected.</span>
			</span>
		</div>
		<div style="padding: 10px; " class="auto-setting toggle" >
			<label for="auto_update_checks_emails" >Notification email to</label>
			<input name="auto_update_checks_emails" style="width: calc(100% - 160px)" type="text" value="<?php echo esc_html( $auto_update_settings['auto_update_checks_emails'] ); ?>" class="auto_update_checks_emails">
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
<div style="width: 50% ; float: left; ">
	<div style="border-left: 1px solid #aaa; padding: 10px;">
		<?php require 'css-settings.php'; ?>
	</div>
</div>
<div class="clear"></div>
