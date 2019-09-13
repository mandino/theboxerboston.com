<?php

class Opt_In_Condition_Categories extends Opt_In_Condition_Abstract {
	public function is_allowed( Hustle_Model $optin ){

		if ( class_exists('woocommerce') ){
			if ( is_woocommerce() ) {
				return true;
			}
		}

		if ( !isset( $this->args->categories ) || empty( $this->args->categories ) ) {
			if ( !is_singular() ) {
				if ( !isset($this->args->filter_type) || "except" === $this->args->filter_type ) {
					return true;
				} else {
					return false;
				}
			} else {
				return true;
			}
		} elseif ( in_array("all", $this->args->categories, true) ) {
			if ( !isset($this->args->filter_type) || "except" === $this->args->filter_type ) {
				return false;
			} else {
				return true;
			}
		}

		switch( $this->args->filter_type ){
			case "only":
				return array() !== array_intersect( $this->_get_current_categories(), (array) $this->args->categories );
			case "except":
				return array() === array_intersect( $this->_get_current_categories(), (array) $this->args->categories );
			default:
				return true;
		}
	}

	/**
	 * Returns categories of current page|post
	 *
	 * @since 2.0
	 * @return array
	 */
	private function _get_current_categories(){
		global $post;
		if( !isset( $post ) ) return array();

		$terms = get_the_terms( $post, "category" );
		$term_ids = $terms && !is_wp_error( $terms ) ? wp_list_pluck( $terms, 'term_id' ) : array();
		return array_map( 'strval', $term_ids );
	}

	public function label(){
		if ( isset( $this->args->categories ) && !empty( $this->args->categories ) && is_array( $this->args->categories ) ) {
			$total = count( $this->args->categories );
			switch( $this->args->filter_type ){
				case "only":
					return ( in_array("all", $this->args->categories, true) )
						? __("All categories", 'wordpress-popup')
						: sprintf( __("%d categories", 'wordpress-popup'), $total );
				case "except":
					return ( in_array("all", $this->args->categories, true) )
						? __("No categories", 'wordpress-popup')
						: sprintf( __("All categories except %d", 'wordpress-popup'), $total );

				default:
					return null;
			}
		} else {
			return ( !isset($this->args->filter_type) || "except" === $this->args->filter_type )
				? __("All categories", 'wordpress-popup')
				: __("No categories", 'wordpress-popup');
		}
	}
}
