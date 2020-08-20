<h1>FlatC Menu Settings</h1>
<?php settings_errors(); ?>
<form action="options.php" method="post">
    <?php settings_fields( 'flatc-settings-group' ); ?>
    <?php do_settings_sections( 'flatc_settings_menu' ); ?>
    <?php submit_button(); ?>
</form>