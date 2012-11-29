<!DOCTYPE html>
<html lang="en">
<head>
<title>Exercise course CTA: Tic-tac-toe</title>
<meta name="robots" content="noarchive,noodp,noydir">
<meta name="description" content="Tic-tac-toe">
<meta name="keywords" content="Transpose,Matrix,Web,PHP">
<meta charset="UTF-8" />
<style type="text/css">
	div#board table {
		border: 1px solid black;
		margin-bottom: 2em;
	}
	div#board td {
		border: 1px solid black;
		width: 100px;
		height: 100px;
		vertical-align:middle;
		text-align:center;
		font-size:xx-large;
	}
	td.winner {
		background-color: yellow;
	}
</style>
</head>
<body>
<? if ($game_ended):
		if (!$winners):?>
<h2>The game ended in a draw.</h2>
<?		else: if ($board[$winners[0][0]][$winners[0][1]]=="X"):?>
<h2>You win!</h2>
<?		else:?>
<h2>Computer wins!</h2>
<?		endif;endif;
endif;?>
<div id="board">
<form action="index.php" method="POST">
	<input type="hidden" name="game" value="<?=$game?>"/>
	<input type="hidden" name="board" value="<?=htmlspecialchars(serialize($board));?>"/>
	<table>
<? for($i=1;$i<=3;$i++):?>
		<tr>
<? for($j=1;$j<=3;$j++):
	if(array_search(array($i,$j),$winners)===FALSE):?>
		<td><?
	else:?>
		<td class="winner"><?
	endif;
	if (isset($board[$i][$j])):
		echo $board[$i][$j];
	else: if (!$game_ended):
			?><input type="submit" name="<?=($i-1)*3+$j?>" value="HERE"/><?
		  else:?>&nbsp;<?
	endif;endif;
		?></td>
<? endfor;?>
		</tr>
<? endfor;?>
	</table>
<input type="submit" name="tictactoe" value="Regenerate Tic-Tac-Toe"/>
<input type="submit" name="connect4" value="Switch to Connect 4"/>
</form>
</div>
</body>
</html>