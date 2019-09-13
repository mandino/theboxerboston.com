<?php

class Opt_In_Condition_Visitor_Country extends Opt_In_Condition_Abstract {
	public function is_allowed( Hustle_Model $optin ){

		if ( isset( $this->args->countries ) ) {

			if ( 'except' === $this->args->filter_type ) {
				return ! ( $this->utils()->test_country( $this->args->countries ) );
			} elseif ( 'only' === $this->args->filter_type ) {
				return $this->utils()->test_country( $this->args->countries );
			}
		}
		
		return true;
	}

	public function label() {
		return isset( $this->args->countries ) ? __( 'From specific countrie', 'wordpress-popup') : "";
	}
}
