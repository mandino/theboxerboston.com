<?php

class Opt_In_Condition_Pages extends Opt_In_Condition_Abstract {
	public function is_allowed( Hustle_Model $optin ){
		global $post;

		if ( !isset( $this->args->pages ) || empty( $this->args->pages ) ) {
			if ( !isset($this->args->filter_type) || "except" === $this->args->filter_type ) {
				return true;
			} else {
				return false;
			}
		} elseif ( in_array("all", $this->args->pages, true) ) {
			if ( !isset($this->args->filter_type) || "except" === $this->args->filter_type ) {
				return false;
			} else {
				return true;
			}
		}

		switch( $this->args->filter_type ){
			case "only":
				if ( class_exists('woocommerce') ) {
					if( is_shop() ) return in_array( wc_get_page_id('shop'), (array) $this->args->pages );
				}
				if( !isset( $post ) || !( $post instanceof WP_Post ) || "page" !== $post->post_type ) return false;

				return in_array( $post->ID, (array) $this->args->pages );
			case "except":
				if ( class_exists('woocommerce') ) {
					if( is_shop() ) return !in_array( wc_get_page_id('shop'), (array) $this->args->pages );
				}
				if( !isset( $post ) || !( $post instanceof WP_Post ) || "page" !== $post->post_type ) return true;

				return !in_array( $post->ID, (array) $this->args->pages );
			default:
				return true;
		}
	}


	public function label(){
		if ( isset( $this->args->pages ) && !empty( $this->args->pages ) && is_array( $this->args->pages ) ) {
			$total = count( $this->args->pages );
			switch( $this->args->filter_type ){
				case "only":
					return ( in_array("all", $this->args->pages, true) )
						? __("All pages", 'wordpress-popup')
						: sprintf( __("%d pages", 'wordpress-popup'), $total );
				case "except":
					return ( in_array("all", $this->args->pages, true) )
						? __("No pages", 'wordpress-popup')
						: sprintf( __("All pages except %d", 'wordpress-popup'), $total );
				default:
					return null;
			}
		} else {
			return ( !isset($this->args->filter_type) || "except" === $this->args->filter_type )
				? __("All pages", 'wordpress-popup')
				: __("No pages", 'wordpress-popup');
		}
	}
}
