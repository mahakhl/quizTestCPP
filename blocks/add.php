<!DOCTYPE html>
<?
include 'connect';
mysql_query("set names 'utf8'");
$Y=mysql_query("SELECT value FROM years", $connect);
$y=mysql_fetch_array($Y);

$P=mysql_query("SELECT value FROM profiles", $connect);
$p=mysql_fetch_array($P);

$D=mysql_query("SELECT value FROM disciplines", $connect);
$d=mysql_fetch_array($D);
/*
$Q=mysql_query("SELECT value FROM questions", $connect);
$q=mysql_fetch_array($Q);
*/
?>
	<head>
		<title>Add</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="../css/awesomplete.css" />
		<!--<script src="../js/awesomplete.js" async></script>-->

		<style>
		.myform{text-align:center;}
		textarea {font-size: 18px;font-family: "Times New Roman", sans-serif;border-radius: 5px;width: 48%;}
		select {width: 12%; font-family: "Times New Roman", sans-serif; font-size: 16px;}
		#ans{width: 38%;font-family: "Times New Roman", sans-serif; font-size: 16px;}
		</style>
	</head>
	<body>
		<!--<h3 align="center">
			Verifică te rog Întrebarea<br>
			<input class="awesomplete" list="mylist" style="width:660px; font-size=12px;" /> 
		</h3>-->
		
		<!--<datalist id="mylist">
			<?do{echo"<option>$q[0]</option>";}while($q=mysql_fetch_array($Q))?>
		</datalist>-->
			<form class="myform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" align="center">
				<p align="center">
				<select name="type">
					<option>Tipul A3</option>
					<option>Tipul A1</option>
				</select>
				<select name="years">
					<?do{echo"<option>Anul $y[0]</option>";}while($y=mysql_fetch_array($Y))?>
				</select>

				<select name="profiles">
					<?do{echo"<option>$p[0]</option>";}while($p=mysql_fetch_array($P))?>
				</select>
				
				<select name="disciplines">
					<?do{echo"<option>$d[0]</option>";}while($d=mysql_fetch_array($D))?>
				</select>
				</p>
			<textarea name="question" placeholder="Introdu Întrebarea" required></textarea><br>
			<?
			for($i=1;$i<6;$i++)
				echo '<p><input id="ans" type="text" name="ans[]" placeholder="Varianta de raspuns"><input type="checkbox" value="'.$i.'" name="check_list[]">Raspuns Corect</p>';
			?>
			<p><input type="submit" value="Adauga Înrebare" name="submit"></p>
		</form>
	</body>
</html>
<?
function getID($value, $table)
	{
		$X=mysql_query("SELECT id FROM $table WHERE value='$value'");
		$x=mysql_fetch_array($X);
		return $x[0];
	}
function compile($query)
	{
		$result=mysql_query($query);
		if($result === FALSE)
			die(mysql_error());
	}
if (isset($_POST['submit']))
	{
		$Y=$_POST['years'];		$D=$_POST['disciplines'];		$P=$_POST['profiles'];		$Q=$_POST['question'];		$T=$_POST['type'];
		$A=array(5);	$AF=array(5);	$answer=array(5);
		if(!empty($_POST['check_list']))
			{	$i=0;
				foreach($_POST['check_list'] as $selected)
					$A[$i++]=$selected;
			}
		if(!empty($_POST['ans']))
			{	$i=0;
				foreach($_POST['ans'] as $selected)
					$AF[$i++]=$selected;
			}
		for($a=0,$b=0;$a<6;$a++)
			{
				if($a==$A[$b])
					{$b++;$answer[$a]=1;}
				else
					$answer[$a]=0;
			}
$D=getID($D,'disciplines');
$Y=substr($Y, -1);	$T=substr($T, -2);	$P=getID($P,'profiles');
$query="INSERT INTO questions (id_discipline, id_profile, id_year, value, type) VALUES ('$D','$P','$Y','$Q','$T')";
compile($query);
$iQ=getID($Q,'questions');
for($a=1,$b=0;$a<=5;$a++,$b++)
	{
		$query="INSERT INTO answers (id_questions, value, correct) VALUES ('$iQ','$AF[$b]', '$answer[$a]')";
		compile($query);
	}
}
?>
