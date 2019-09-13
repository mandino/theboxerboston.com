<?php

class Opt_In_Condition_Posts extends Opt_In_Condition_Abstract {
	public function is_allowed( Hustle_Model $optin ){
		global $post;

		if ( !isset( $this->args->posts ) || empty( $this->args->posts ) ) {
			if ( !isset($this->args->filter_type) || "except" === $this->args->filter_type ) {
				return true;
			} else {
				return false;
			}
		} elseif ( in_array("all", $this->args->posts, true) ) {
			if ( !isset($this->args->filter_type) || "except" === $this->args->filter_type ) {
				return false;
			} else {
				return true;
			}
		}

		switch( $this->args->filter_type ){
			case "only":
				if( !isset( $post ) || !( $post instanceof WP_Post ) || "post" !== $post->post_type ) return false;

				return in_array( $post->ID, (array) $this->args->posts );
			case "except":
				if( !isset( $post ) || !( $post instanceof WP_Post ) || "post" !== $post->post_type ) return true;

				return !in_array( $post->ID, (array) $this->args->posts );
			default:
				return true;
		}
	}


	public function label(){
		if ( isset( $this->args->posts ) && !empty( $this->args->posts ) && is_array( $this->args->posts ) ) {
			$total = count( $this->args->posts );
			switch( $this->args->filter_type ){
				case "only":
					return ( in_array("all", $this->args->posts, true) )
						? __("All posts", 'wordpress-popup')
						: sprintf( __("%d posts", 'wordpress-popup'), $total );
				case "except":
					return ( in_array("all", $this->args->posts, true) )
						? __("No posts", 'wordpress-popup')
						: sprintf( __("All posts except %d", 'wordpress-popup'), $total );
				default:
					return null;
			}
		} else {
			return ( !isset($this->args->filter_type) || "except" === $this->args->filter_type )
				? __("All posts", 'wordpress-popup')
				: __("No posts", 'wordpress-popup');
		}
	}
}
