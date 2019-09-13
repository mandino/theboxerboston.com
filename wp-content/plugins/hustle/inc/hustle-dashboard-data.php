<?php

/**
 * To be removed after in 4.0.2. Leaving it for now to avoid PHP
 * errors of non existent class when upgrading.
 */
class Hustle_Dashboard_Data {

	//const CURRENT_COLOR_INDEX = 'hustle_color_index';

	public $popups = array();
	public $slideins = array();
	public $embeds = array();
	public $social_sharings = array();
	public $active_modules = array();
	public $metrics = array();

	//public $color = 0;
	//public $types = array();
	//public $colors = array(
	//	'#FF0000',
	//	'#FFFF00',
	//	'#00EAFF',
	//	'#AA00FF',
	//	'#FF7F00',
	//	'#BFFF00',
	//	'#0095FF',
	//	'#FF00AA',
	//	'#FFD400',
	//	'#6AFF00',
	//	'#0040FF',
	//	'#EDB9B9',
	//	'#B9D7ED',
	//	'#E7E9B9',
	//	'#DCB9ED',
	//	'#B8EDE0',
	//	'#8F2323',
	//	'#2362BF',
	//	'#8F6A23',
	//	'#6B238F',
	//	'#4F8F23',
	//	'#000000',
	//);


	public function __construct() {
		$this->_prepare_data();
	}

	private function _prepare_data() {

		// to be replaced
		//$temp_index = 0;
		//$this->color = (int) get_option( self::CURRENT_COLOR_INDEX, 0 );

		// Update color index
		//update_option( self::CURRENT_COLOR_INDEX, $this->color );
	}
}
