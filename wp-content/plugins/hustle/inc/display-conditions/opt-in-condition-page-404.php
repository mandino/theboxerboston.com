<?php

 /*
  * This functionality has been changed to only affect 404 pages.
  * Name is not changed to keep legacy condition but it now determines
  * if the popup should be displayed on 404 pages rather than only on 404 pages.
  */
class Opt_In_Condition_Page_404 extends Opt_In_Condition_Abstract {
	public function is_allowed( Hustle_Model $optin ) {
		return is_404();
	}

	public function label() {
		return __( '404 page', 'wordpress-popup');
	}
}
