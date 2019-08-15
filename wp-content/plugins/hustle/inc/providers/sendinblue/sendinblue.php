<?php
//Direct Load
require_once dirname( __FILE__ ) . '/hustle-sendinblue.php';
require_once dirname( __FILE__ ) . '/hustle-sendinblue-form-settings.php';
require_once dirname( __FILE__ ) . '/hustle-sendinblue-form-hooks.php';
Hustle_Providers::get_instance()->register( 'Hustle_SendinBlue' );
