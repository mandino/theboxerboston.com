<?php
//Direct Load
require_once dirname( __FILE__ ) . '/hustle-aweber.php';
require_once dirname( __FILE__ ) . '/hustle-aweber-form-settings.php';
require_once dirname( __FILE__ ) . '/hustle-aweber-form-hooks.php';
Hustle_Providers::get_instance()->register( 'Hustle_Aweber' );
