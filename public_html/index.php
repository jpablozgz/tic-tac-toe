<?php

require_once("../application/models/connect4Model.php");
require_once("../application/models/tictactoeModel.php");

$winners = array();
$game_ended = FALSE;

if((!$_POST) || isset($_POST['tictactoe']) 	// reloaded page
	|| isset($_POST['connect4'])) 			// or game to be restarted/changed
{
	if ((!$_POST) || isset($_POST['tictactoe']))
		$game = 'tictactoe';
	else 
		$game = 'connect4';
	$board = array();
}
else // a button was pressed playing the current game
{
	$game = $_POST['game'];
	$board = unserialize(htmlspecialchars_decode($_POST['board']));

	$square_pressed = intval(array_search('HERE',$_POST));
	$board = call_user_func($game.'Update',$board,$square_pressed,'X');
	$winners = call_user_func($game.'WinningRow',$board,$square_pressed);
	$game_ended = $winners || call_user_func($game.'FullBoard',$board);
	if (!$game_ended)
	{
		$square = call_user_func($game.'NextMove',$board,'O');
		$board = call_user_func($game.'Update',$board,$square,'O');
		$winners = call_user_func($game.'WinningRow',$board,$square);
		$game_ended = $winners || call_user_func($game.'FullBoard',$board);
	}
}

include("../application/views/".$game."View.php"); // update screen

?>