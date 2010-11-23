<?php

class MainPage
{
	function Show( $AShowClass )
	{
		if( !isset( $AShowClass ) )
			user_error('MainPage: Не назначен класс !',E_ERROR);
		$AShowClass->display();	}

	function Edit( $AShowClass )
	{
		if( !isset( $AShowClass ) )
			user_error('MainPage: Не назначен класс !',E_ERROR);
		$AShowClass->display();
	}
}

?>