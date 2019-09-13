<?php

class Opt_In_Condition_From_Referrer extends Opt_In_Condition_Abstract {
	public function is_allowed( Hustle_Model $optin ) {

		if ( ! isset( $this->args->refs ) ) {
			return true;
		}

		if ( 'true' === $this->args->filter_type ) {
			return $this->utils()->test_referrer( $this->args->refs );
		} else {
			return ! ( $this->utils()->test_referrer( $this->args->refs ) );
		}
	}

	public function label() {
		return __( 'Not from specific referrers', 'wordpress-popup');
	}
}
