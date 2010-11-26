<?php

class Session
{
	function Session($ASid='')
	{
		if($ASid!='')			session_id($ASid);	}

	function Start()
	{
		session_start();
	}

	function set($AName,$AValue)
	{
		$_SESSION[$AName]=$AValue;
	}

	function get($AName)
	{
		if( isset($_SESSION[$AName]) )
			return $_SESSION[$AName];
		else
			return null;
	}

}

?>