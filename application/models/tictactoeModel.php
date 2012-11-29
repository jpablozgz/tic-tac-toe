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
	} while (isset($board[(($square-1)/3)+1][(($square-1)%3)+1]));
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
		if (!isset($board[(($square-1)/3)+1][(($square-1)%3)+1]))
			$board[(($square-1)/3)+1][(($square-1)%3)+1]=$mark;
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
 * Determines the winning row of 3 marks (if any)
 * @param array $board Game board
 * @param int $square Last move
 * @return array: Winning row
 */
function tictactoeWinningRow($board, $square)
{
	$winners = array();

	$i = (int)(($square-1)/3)+1; // coord i of $square
	$j = (($square-1)%3)+1; // coord j of $square
	
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