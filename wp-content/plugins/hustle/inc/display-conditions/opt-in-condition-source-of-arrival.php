<?php

class Opt_In_Condition_Source_Of_Arrival extends Opt_In_Condition_Abstract {
	public function is_allowed( Hustle_Model $optin ) {

		$is_external_source_allowed = true;
		$is_search_source_allowed = true;

		if ( isset( $this->args->source_external ) && 'true' === $this->args->source_external ) {
			$internal = preg_replace( '#^https?://#', '', get_option( 'home' ) );
			$is_external_source_allowed = ! $this->utils()->test_referrer( $internal );
		}

		if ( isset( $this->args->source_search ) && 'true' === $this->args->source_search ) {
			$is_search_source_allowed = $this->is_from_searchengine_ref();
		}

		return $is_external_source_allowed && $is_search_source_allowed;
	}

	/**
	 * Tests if the current referrer is a search engine.
	 * Current referrer has to be specified in the URL param "thereferer".
	 *
	 * @return bool
	 */
	public function is_from_searchengine_ref() {
		$response = false;
		$referrer = $this->utils()->get_referrer();

		$patterns = array(
			'/search?',
			'.google.',
			'web.info.com',
			'search.',
			'del.icio.us/search',
			'delicious.com/search',
			'soso.com',
			'/search/',
			'.yahoo.',
			'.bing.',
		);

		foreach ( $patterns as $url ) {
			if ( false !== stripos( $referrer, $url ) ) {
				if ( '.google.' === $url ) {
					if ( $this->is_googlesearch( $referrer ) ) {
						$response = true;
					} else {
						$response = false;
					}
				} else {
					$response = true;
				}
				break;
			}
		}
		return $response;
	}

	/**
	 * Checks if the referrer is a google web-source.
	 *
	 * courtesy Philipp Stracker
	 *
	 * @param  string $referrer
	 * @return bool
	 */
	public function is_googlesearch( $referrer = '' ) {
		$response = true;

		// Get the query strings and check its a web source.
		$qs = wp_parse_url( $referrer, PHP_URL_QUERY );
		$qget = array();

		foreach ( explode( '&', $qs ) as $keyval ) {
			$kv = explode( '=', $keyval );
			if ( 2 === count( $kv ) ) {
				$qget[ trim( $kv[0] ) ] = trim( $kv[1] );
			}
		}

		if ( isset( $qget['source'] ) ) {
			$response = 'web' === $qget['source'] ;
		}

		return $response;
	}
	public function label(){
		return __("Only from search engine", 'wordpress-popup');
	}
}
