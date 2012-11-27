<?php

require_once("../application/models/connect4Model.php");
require_once("../application/models/tictactoeModel.php");

if((!$_POST) || isset($_POST['tictactoe']) 	// reloaded page
	|| isset($_POST['connect4'])) 			// or game to be restarted/changed
{
	if ((!$_POST) || isset($_POST['tictactoe']))
		$game = 'tictactoe';
	else 
		$game = 'connect4';
	$winners = array();
	$game_ended = FALSE;
	$board = array();
}
else // a button was pressed playing the current game
{
	$game = $_POST['game'];
	$board = unserialize($_POST['board']);
	$winners = unserialize($_POST['winners']);
	$game_ended = unserialize($_POST['game_ended']);
	if($game_ended===FALSE)
	{
		$square = intval(array_search('HERE',$_POST));
		$board = call_user_func($game.'Update',$board,$square,'X');
		if (($game_ended = call_user_func($game.'EvaluateEnd',$board,$square)) === TRUE)
			$winners = call_user_func($game.'WinningRow',$board,$square);
		else
		{
			$square = call_user_func($game.'NextMove',$board,'O');
			$board = call_user_func($game.'Update',$board,$square,'O');
			if (($game_ended = call_user_func($game.'EvaluateEnd',$board,$square)) === TRUE)
				$winners = call_user_func($game.'WinningRow',$board,$square);
		}
	}
}
		
include("../application/views/".$game."View.php"); // update screen

?>