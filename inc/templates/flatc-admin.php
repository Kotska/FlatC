<h1>FlatC Theme Options</h1>
<?php settings_errors(); ?>
<form action="options.php" method="post">
    <?php settings_fields( 'flatc-settings-main' ); ?>
    <?php do_settings_sections( 'flatc_settings' ); ?>
    <?php submit_button(); ?>
</form>
<style>
    .logo-svg {
        width: 100px;
        height: 50px;
        display: inline-block;
        margin-left: 50px;
    }
</style>