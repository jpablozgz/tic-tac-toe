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
<? for($i=1;$i<=3;$i++):?>
		<tr>
<? for($j=1;$j<=3;$j++):?>
		<td><?if (isset($board[$i][$j])):
				echo $board[$i][$j];
			else: ?><input type="submit" name="<?=($i-1)*3+$j?>" value="HERE"/><?
			endif;
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