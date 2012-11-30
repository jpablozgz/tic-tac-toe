<?php
/**
 * Proposes a next move for the computer
 * @param array $board Game board
 * @param string $token Token used by the computer (noughts, crosses, ...)
 * @return int: Cell to put the next token
 */
function tictactoeNextMove($board, $token)
{
	do {
		$cell = rand(1,9);
	} while (isset($board[(($cell-1)/3)+1][(($cell-1)%3)+1]));
	return $cell;
}

/**
 * Updates board with the provided move
 * @param array $board Game board
 * @param int $cell Cell where the token is to be put
 * @param string $token Token used by the current player
 * @return array: Updated game board
 */
function tictactoeUpdate($board, $cell, $token)
{
	if (is_int($cell) && $cell >= 1 && $cell <= 9)
		if (!isset($board[(($cell-1)/3)+1][(($cell-1)%3)+1]))
			$board[(($cell-1)/3)+1][(($cell-1)%3)+1]=$token;
	return $board;
}

/** 
 * Evaluates if the board is full
 * @param array $board Game board
 * @return bool: Full board?
 */
function tictactoeFullBoard($board)
{
	return (count($board,COUNT_RECURSIVE)==12);
}				

/** 
 * Returns all cells within winning lines (if any)
 * @param array $board Game board
 * @param int $cell Last move
 * @return array: Winning line
 */
function tictactoeWinningLine($board, $cell)
{
	$winners = array();

	$i = (int)(($cell-1)/3)+1; // coord i of $cell
	$j = (($cell-1)%3)+1; // coord j of $cell
	
	if(isset($board[$i][1]) && isset($board[$i][2]) && isset($board[$i][3]) &&
			($board[$i][1]==$board[$i][2]) && ($board[$i][2]==$board[$i][3]))
		array_push($winners, array($i,1),array($i,2),array($i,3));
	
	if(isset($board[1][$j]) && isset($board[2][$j]) && isset($board[3][$j]) &&
			($board[1][$j]==$board[2][$j]) && ($board[2][$j]==$board[3][$j]))
		array_push($winners, array(1,$j),array(2,$j),array(3,$j));
		
	if(isset($board[1][1]) && isset($board[2][2]) && isset($board[3][3]) &&
			($board[1][1]==$board[2][2]) && ($board[2][2]==$board[3][3]))
		array_push($winners, array(1,1),array(2,2),array(3,3));
		
	if(isset($board[3][1]) && isset($board[2][2]) && isset($board[1][3]) &&
			($board[3][1]==$board[2][2]) && ($board[2][2]==$board[1][3]))
		array_push($winners, array(3,1),array(2,2),array(1,3));
		
	return $winners;
}
?>