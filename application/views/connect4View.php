<!DOCTYPE html>
<html lang="en">
<head>
<title>Exercise course CTA: Connect 4</title>
<meta name="robots" content="noarchive,noodp,noydir">
<meta name="description" content="Connect 4">
<meta name="keywords" content="Transpose,Matrix,Web,PHP">
<meta charset="UTF-8" />
<style type="text/css">
	div#board table {
		border: 1px solid black;
		margin-bottom: 2em;
	}
	div#board td {
		border: 1px solid black;
		width: 50px;
		height: 50px;
		vertical-align:middle;
		text-align:center;
		font-size:xx-large;
	}
</style>
</head>
<body>
<div id="board">
<form action="index.php" method="POST">
	<input type="hidden" name="game" value="<?=$game?>"/>
	<input type="hidden" name="game_ended" value="<?=$game_ended?>"/>
	<input type="hidden" name="winners" value="<?=serialize($winners);?>"/>
	<input type="hidden" name="board" value="<?=serialize($board);?>"/>
	<table>
		<tr>
<? for($j=1;$j<=7;$j++):
		if(!isset($board[1][$j])):?>
			<th><input type="submit" name="<?=$j?>" value="HERE"/></th>
<? 		endif;
   endfor;?>
		</tr>
<? for($i=1;$i<=6;$i++):?>
		<tr>
<? for($j=1;$j<=7;$j++):?>
			<td><?if (isset($board[$i][$j])):
				echo $board[$i][$j];
			else: ?>&nbsp;<?
			endif;
			?></td>
<? endfor;?>
		</tr>
<? endfor;?>
	</table>
<input type="submit" name="connect4" value="Regenerate Connect 4"/>
<input type="submit" name="tictactoe" value="Switch to Tic-Tac-Toe"/>
</form>
</div>
</body>
</html>