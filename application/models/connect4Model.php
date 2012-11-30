<?php

/** 
 * Proposes a next move for the player (assuming that at least one is possible)
 * @param array $board Game board
 * @param string $token Token used by the computer (noughts, crosses, ...)
 * @return int: Column to drop next token
 */
function connect4NextMove($board, $token)
{
	do {
		$column = rand(1,7);
	} while (isset($board[1][$column]));
	return $column;
}

/**
 * Returns the row of the lowest unused cell in the column
 * @param array $board Game board
 * @param int $column Column selected
 * @return int: Lowest row with empty cell (0 = the column is full)
 */
function connect4FirstUnusedCell($board, $column)
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
 * @param int $column Column where the token is to be dropped
 * @param string $token Token used by the current player
 * @return array: Updated game board
 */
function connect4Update($board, $column, $token)
{
	if (is_int($column) && $column >= 1 && $column <= 7)
	{
		$row = connect4FirstUnusedCell($board, $column);
		if($row!=0)
			$board[$row][$column]=$token;
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
 * Looks for a winning line in a series of aligned cells
 * @param array $series Series of aligned cells with the same token
 * @return array: Cells of the winning line
 */
function seriesContainsWinningLine($series)
{
	$winners = array();
	
	if($series)
	{
		$min_series = min(array_keys($series));
		$max_series = max(array_keys($series));
		$consecutive=array();

		for($i=$min_series;$i<=$max_series;$i++)
		{
			if(array_key_exists($i,$series))
				$consecutive[]=$series[$i];
			else
			{
				if(count($consecutive)>=4)
					array_push($winners,$consecutive);
				$consecutive=array();
			} 
		}
		if(count($consecutive)>=4)
			array_push($winners,$consecutive);
	}

	return $winners;
}

/** 
 * Returns all cells within winning lines (if any)
 * @param array $board Game board
 * @param int $column Column in which the last token was dropped
 * @return array: Cells of the winning lines
 */
function connect4WinningLine($board, $last_col)
{
	$winners=array();
	$last_row=connect4FirstUnusedCell($board,$last_col)+1;

	// Add last_row to the lines to be checked
	$checkable_lines[] = $board[$last_row];
	for($j=1;$j<=7;$j++)
		if(isset($board[$last_row][$j]))
			$coords[$j] = array($last_row,$j);
	$coords_lines[] = $coords;
	
	// Add last_column to the lines to be checked
	$line = array();
	$coords = array();
	for($i=1;$i<=6;$i++)
	{
		if(isset($board[$i][$last_col]))
		{
			$line[$i] = $board[$i][$last_col];
			$coords[$i] = array($i,$last_col);
		}
	}
	$checkable_lines[] = $line;
	$coords_lines[] = $coords;

	// Add diagonal 1 to the lines to be checked
	$line = array();
	$coords = array();
	$i = 6; $j = 1;
	$left = ($last_col <= 7 - $last_row);
	if($left) 		//upper left triangular submatrix
		for($i=$last_row+$last_col-1;$i>=1;$i--)
		{
			if(isset($board[$i][$j]))
			{
				$line[$j] = $board[$i][$j];
				$coords[$j] = array($i,$j);
			}
			$j++;
		}
	else			//bottom right triangular submatrix
		for($j=$last_col+$last_row-6;$j<=7;$j++)
		{
			if(isset($board[$i][$j]))
			{
				$line[$j] = $board[$i][$j];
				$coords[$j] = array($i,$j);
			}
			$i--;
		}
	$checkable_lines[] = $line;
	$coords_lines[] = $coords;
	
	// Add diagonal 2 to the lines to be checked
	$line = array();
	$coords = array();
	$i = 1; $j = 1;
	$left = ($last_row >= $last_col);
	if($left)	 	//bottom left triangular submatrix
		for($i=$last_row-$last_col+1;$i<=6;$i++)
		{
			if(isset($board[$i][$j]))
			{
				$line[$j] = $board[$i][$j];
				$coords[$j] = array($i,$j);
			}
			$j++;
		}
	else	 		//upper right triangular submatrix
		for($j=$last_col-$last_row+1;$j<=7;$j++)
		{
			if(isset($board[$i][$j]))
			{
				$line[$i] = $board[$i][$j];
				$coords[$i] = array($i,$j);
			}
			$i++;
		}
	$checkable_lines[] = $line;
	$coords_lines[] = $coords;
	
	// Look for winning series in the four checkable lines
	$last_token=$board[$last_row][$last_col];
	for ($i=0; $i<=3; $i++)
	{
		$series = array();
		$keys = array_keys($checkable_lines[$i],$last_token);
		foreach ($keys as $key)
			$series[$key] = $coords_lines[$i][$key];
		$prueba = seriesContainsWinningLine($series);
		$winners = array_merge($winners, seriesContainsWinningLine($series));
	}
	
	return $winners;
}
?>