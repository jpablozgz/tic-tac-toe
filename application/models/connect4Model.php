<?php

/** 
 * Proposes a next move for the player (assuming that at least one is possible)
 * @param array $board Game board
 * @param string $mark Mark used by the computer (noughts, crosses, ...)
 * @return int: Column to drop next
 */
function connect4NextMove($board, $mark)
{
	do {
		$column = rand(1,7);
	} while (isset($board[1][$column]));
	return $column;
}

/**
 * Returns the row of the lowest unused square in the column
 * @param array $board Game board
 * @param int $column Column selected
 * @return int: Lowest row with square empty (0 = full column)
 */
function connect4FirstUnusedSquare($board, $column)
{
	if (is_int($column) && $column >= 1 && $column <= 7)
	{
		$row = 6;
		while ($row>0 && isset($board[$row][$column]))
			$row--;
	}
	return $row;	
}

/**
 * Updates board with the provided move
 * @param array $board Game board
 * @param int $column Column where the mark is to be dropped
 * @param string $mark Mark used by the current player
 * @return array: Updated game board
 */
function connect4Update($board, $column, $mark)
{
	if (is_int($column) && $column >= 1 && $column <= 7)
	{
		$row = connect4FirstUnusedSquare($board, $column);
		if($row!=0)
			$board[$row][$column]=$mark;
	}
	return $board;
}

/** 
 * Evaluates if the board is full
 * @param array $board Game board
 * @return bool: Full board?
 */
function connect4FullBoard($board)
{
	return (count($board,COUNT_RECURSIVE)==48);
}				

/** 
 * Determines the winning row of 4 marks (if any)
 * @param array $board Game board
 * @param int $column Column in which the last mark was dropped
 * @return array: Winning row
 */
function connect4WinningRow($board, $column)
{
	$winners=array();

	$row=connect4FirstUnusedSquare($board,$column)+1;
	$mark=$board[$row,$column];

	array_keys($board[$row],$mark);
	//Mirar si hay cuatro keys consecutivas (conteniendo a $column)
	//en el vector que me devuelve la anterior funcion
	
	//Luego hay que hacer algo parecido por columna y para las dos diagonales

	return $winners;
}
?>