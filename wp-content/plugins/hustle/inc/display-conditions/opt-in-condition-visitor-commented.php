<?php

class Opt_In_Condition_Visitor_Commented extends Opt_In_Condition_Abstract {
	public function is_allowed( Hustle_Model $optin ) {

		if ( 'true' === $this->args->filter_type ) {
			return $this->utils()->has_user_commented();
		} else {
			return ! ( $this->utils()->has_user_commented() );
		}
	}

	public function label() {
		return __( 'Only if user has never commented', 'wordpress-popup' );
	}
}
