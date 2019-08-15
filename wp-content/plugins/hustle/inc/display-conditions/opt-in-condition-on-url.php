<?php

class Opt_In_Condition_On_Url extends Opt_In_Condition_Abstract {
	public function is_allowed( Hustle_Model $optin ) {

		$is_url = $this->utils()->check_url( $this->utils()->get_current_actual_url(), preg_split('/\r\n|\r|\n/', $this->args->urls ) );

		if ( 'only' === $this->args->filter_type ) {
			return $is_url;

		} elseif ( 'except' === $this->args->filter_type ) {
			return ! $is_url;
		}

		return true;
	}

	public function label() {
		return __( 'Not on specific URLs', Opt_In::TEXT_DOMAIN );
	}
}
