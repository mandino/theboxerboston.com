<?php

class Opt_In_Condition_Visitor_Logged_In_Status extends Opt_In_Condition_Abstract {
	public function is_allowed( Hustle_Model $optin ){
		if ( !empty( $this->args->show_to ) ) {
			$is_user_logged_in = is_user_logged_in();
			if ( 'logged_out' === $this->args->show_to ) {
				return !$is_user_logged_in;
			} elseif ( 'logged_in' === $this->args->show_to ) {
				return $is_user_logged_in;
			}
		}

		return true;
	}

	public function label() {
		if ( !empty( $this->args->show_to ) ) {
			if ( 'logged_out' === $this->args->show_to ) {
				return __("Only if user is not logged in", 'wordpress-popup');
			} elseif ( 'logged_in' === $this->args->show_to ) {
				return __("Only if user is logged in", 'wordpress-popup');
			}
		}

		return '';
	}
}
