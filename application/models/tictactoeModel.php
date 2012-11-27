<?php
/**
 * Proposes a next move for the computer
 * @param array $board Game board
 * @param string $mark Mark used by the computer (noughts, crosses, ...)
 * @return int: Square to mark next
 */
function tictactoeNextMove($board, $mark)
{
	do {
		$square = rand(1,9);
	} while (isset($board[($square/3)+1][$square%3]));
	return $square;
}

/**
 * Updates board with the provided move
 * @param array $board Game board
 * @param int $square Square to be marked
 * @param string $mark Mark used by the current player
 * @return array: Updated game board
 */
function tictactoeUpdate($board, $square, $mark)
{
	if (is_int($square) && $square >= 1 && $square <= 9)
		if (!isset($board[($square/3)+1][$square%3]))
			$board[($square/3)+1][$square%3]=$mark;
	return $board;
}

/** 
 * Evaluates if the game came to an end after the last move
 * @param array $board Game board
 * @param int $square Last move
 * @return bool: Game ended?
 */
function tictactoeEvaluateEnd($board, $square)
{
	return FALSE;
}				

/** 
 * Determines the winning row of 3 marks (if any)
 * @param array $board Game board
 * @param int $square Last move
 * @return array: Winning row
 */
function tictactoeWinningRow($board, $square)
{
	return array();
}
?>