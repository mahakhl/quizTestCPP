<!DOCTYPE html>
<?
session_start();
$idQ = $_SESSION['idQuestion'];
?>
<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>
		<title>Propune ceve Sugestii !!!</title>
		<style type="text/css">
		textarea{
			font-family: "Times New Roman", sans-serif; 
			border-radius: 5px; 
			font-size: 18px;
			width: 100%;
			height: 100%;}
		input{
	height: 2%; 
	width: 25%;
	background-color: #616165;
	font-size: 18px;
	text-align: center;
	color: white;
	margin-left: 37%;
	border-radius: 10px;
		</style>
	</head>
	
	<body>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" name="S" onsubmit="modal('sugg')">
		<textarea name="text" rows="10" placeholder="Ce este gresit (•ิ_•ิ)?" required id='text'></textarea><br>
		<input type="submit" name='Submit' value="Propune" >
	</form>
<?
if(isset($_POST['Submit']))
	{
		
		$File = fopen("Reports.txt", "a") or die("Unable to open this file or it don't exist anymore");
		fwrite($File,"ID Intrebare: $idQ \n");
	  	$text = $_POST['text'];
	  	fwrite($File, "$text \n\n");
	  	fclose($File);

		echo ("<script>alert('Multumesc pentru atentie si ajutor');self.close();</script>");

	}
?>
</body>
</html>
