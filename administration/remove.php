<?
include "../blocks/connect";
mysql_query("set names 'utf8'");
$range;
if(!isset($_GET['p']))
	$range=1;
else
	$range=$_GET['p'];

function getQuestions()
	{
		$max=$GLOBALS['range']*5;
		$min = $max - 4;
		$Q = mysql_query("SELECT * FROM Question WHERE id BETWEEN $min AND $max ");
		$q = mysql_fetch_array($Q);
		do
			{
				echo "<a class='nav-link' href='remove.php?id=$q[0]'>$q[1]</a><br>";
			}while($q = mysql_fetch_array($Q));

	}
if (isset($_GET['id']))
	{
		$idQ=$_GET['id'];
		$query=mysql_query("DELETE FROM Question WHERE id='$idQ'");
		if($query === FALSE)
			die(mysql_error());

		$query2=mysql_query("DELETE FROM Answer WHERE id_Q='$idQ'");
		if($query2 === FALSE)
			die(mysql_error());

	}
?>
<!DOCTYPE html>
	<html>
		<head>
			<title>Sterge Intrebari</title>
				<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" />
    		 	<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
    			<meta name="generator" content="Codeply">
		</head>
		<body>
			<div class="container">
				<ul id="list">
					<?getQuestions();?>
				</ul>
				<?
				$p=$range-1;
				$n=$range+1;
				echo '<ul class="pager">';
					echo "<li><a href=\"remove.php?p=$p\">Previous</a></li>";
					echo "<li><a href=\"remove.php?p=$n\">Next</a></li>";
				echo '</ul>';
				?>
			</div>
		</body>
	</html>
