<?php

class Opt_In_Condition_Only_On_Not_Found extends Opt_In_Condition_Abstract implements Opt_In_Condition_Interface
{
	function is_allowed(Hustle_Model $optin){
		return is_404();
	}

	function label()
	{
		return __("Only on 404 page", Opt_In::TEXT_DOMAIN);
	}
}