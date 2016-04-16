<?
include 'blocks/connect';
mysql_query("set names 'utf8'");$bor="borD";$DayNight="day";$currentQ;$currentT;$flag;$DO;$tempN;$HowMore;
if(!isset($_POST['submit'])){
$dis=$_GET['dis'];
$flag = False;$DO = True;$tempN=1;$HowMore=1;
$disArray = array();
	extractNumbers();
$objDisciplineArray = array();
$objansArray = array();
for($y=1;$y<=count($disArray);$y++)
	{
		$temp = 'objDiscipline'.$y;
		$$temp = new objDiscipline($disArray[$y-1]);
		$$temp->Name = getNameById($disArray[$y-1],"disciplines");
		$$temp->Year = getByIdD($disArray[$y-1],"years","id_year");
		$$temp->Profile = getByIdD($disArray[$y-1],"profiles","id_profile");
		$$temp->Type = getByIdD($disArray[$y-1],"profiles","id_profile");
		$x=countBySource('id','questions',$disArray[$y-1]);
		$$temp->uRandArray = randomGen(1,$x,$x);
		array_push($objDisciplineArray,$$temp);
	}
}

else
{
	$tempObj = new objAnswer();
	$str_var = $_POST["objArray"];
	$str_var2 = $_POST["ansArray"];
	$tempN = $_POST['Number'] -1 ;
	$HowMore = $_POST['HowMore'];
	$q = $_POST['qID'];//id
	$ras = $_POST['ans'];//array of answers as strings
	$objDisciplineArray = unserialize(base64_decode($str_var));
	$objansArray = unserialize(base64_decode($str_var2));
	$tempObj->Question = $q;//id
	$tempObj->selectArray = $ras; //strings
	array_push($objansArray, $tempObj);//push new objAnswer
	$flag = True;$DO = True;
	if($tempN == 0)
		$DO = False;
}
function extractNumbers()
	{
		$tempString="";$tempNumber=0;
		for($i=0;$i<strlen($GLOBALS['dis']);$i++)
			if($GLOBALS['dis'][$i]!=',')
				$tempString.=$GLOBALS['dis'][$i];
			else
				{
					$GLOBALS['disArray'][$tempNumber]=$tempString;
					$tempString="";
					$tempNumber++;
				}
		$GLOBALS['disArray'][$tempNumber]=$tempString;
	}

function getNameById($value,$source)
	{
		$X=mysql_query("SELECT value FROM $source WHERE id=$value");
		if($X === FALSE)
			die(mysql_error());
		$x=mysql_fetch_row($X);
		return $x[0];
	}
function getByIdD($ID,$source,$what)
	{
		$X = mysql_query("SELECT value FROM $source WHERE id = (SELECT $what FROM disciplines WHERE id=$ID)");
		if($X === FALSE) { die(mysql_error());}
		$x = mysql_fetch_array($X);
		return $x[0];
	}

function countBySource($value1, $source,$value2)
	{
		$result = mysql_query("SELECT DISTINCT $value1 FROM $source WHERE id_discipline=$value2");
			if($result === FALSE) { die(mysql_error());}
		$num_rows = mysql_num_rows($result);
		return $num_rows;
	}

function randomGen($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

function randQuizz()
	{
		$randNum = rand(0,count($GLOBALS['objDisciplineArray'])-1);
		$tempObj = $GLOBALS['objDisciplineArray'][$randNum];
		if(empty($tempObj->uRandArray))
			randQuizz();
		else{
		$querry = mysql_query("SELECT id,value,type FROM questions WHERE id_discipline=$tempObj->ID");
		$index = array_shift($tempObj->uRandArray);
		while($index>0)
			{$T = mysql_fetch_array($querry);$index--;}
		echo "$GLOBALS[tempN] / $GLOBALS[HowMore]<br>$T[value]";
		$GLOBALS['currentQ'] = $T['id'];$GLOBALS['currentT'] = $T['type'];
		if($GLOBALS['tempN']>0)
			echo ("
					<script>document.getElementById('profile').innerHTML='$tempObj->Profile';
					document.getElementById('discipline').innerHTML='$tempObj->Name';
					document.getElementById('year').innerHTML='$tempObj->Year'</script>"
					);
		else
		echo ("
					<script>document.getElementById('profile').innerHTML='';
					document.getElementById('discipline').innerHTML='';
					document.getElementById('year').innerHTML=''</script>"
					);
			}
	}

function getNumofQuestions()
	{
		if ($GLOBALS['flag'] == FALSE)
			echo '<input type="text" id="numCountQuizz" placeholder="Cîte Întrebări" onchange="countQuizzB()">';
	}

function checkAnswear()
	{$total=count($GLOBALS['objansArray']);$CAP=0;
		foreach ($GLOBALS['objansArray'] as $key)
			{
				$Querry=mysql_query("SELECT value,type,id_discipline FROM questions WHERE id=$key->Question");
					if($Querry === FALSE)die(mysql_error());
				$Q=mysql_fetch_array($Querry);
				if($Q['type']=='A1')//tipul intrebarii
					$type='radio';
				else
					$type='checkbox';			
				do
					{$C=0;$S=0;$I=0;
						echo "<h4 align='left'>$Q[value]</h4>";
						$mainQuerry=mysql_query("SELECT value,correct FROM answers WHERE id_questions=$key->Question");
							if($mainQuerry === FALSE)die(mysql_error());
						$q=mysql_fetch_array($mainQuerry);
						echo "<p align='left'>";
						do
						{
							if($q['correct']==1)
								{
									$C++;//correct
									if(in_array($q['value'], $key->selectArray))
										{
											echo "<span style='color:green'><input type=$type checked>$q[value]</span><br>";
											$S++;//selected
										}
									else
										{echo "<span style='color:green'><input type=$type>$q[value]</span><br>";}
								}
							else
								if(in_array($q['value'], $key->selectArray))
									{echo "<span style='color:red'><input type=$type checked>$q[value]</span><br>";$I++;$result-=1/5;}
								else
									echo "<span style='color:red'><input type=$type>$q[value]</span><br>";
						}while($q=mysql_fetch_array($mainQuerry));
						echo "</p>";
					$result=round(($S/$C),2);
					
					if ( $I == 0 and $S == $C )//absolut corect
						{$CAP++;echo"<p align='left'>Punctaj 1 <span style='color:green'>Correct</span></p>";}
					
					elseif ( $I >=2  or $I >= $S)//gresit
						echo"<p align='left'><span style='color:red'>Greșit</span></p>";
					
					elseif ( $I == 1 )
						{$result-=0.2;$CAP+=$result;echo"<p align='left'>Punctaj $result <span style='color:green'>Presupunem că correct</span></p>";}
					else
						{$CAP+=$result;echo"<p align='left'>Punctaj $result <span style='color:green'>Presupunem că correct</span></p>";}
				
				}while($Q=mysql_fetch_array($Querry));
			}$P=round(($CAP/$total*100),2);
			echo "<script>
					document.getElementById('title').innerHTML='Rezultat '+$P+'%';
					document.getElementById('title').style.background='linear-gradient(to right, #6385B3 $P%,#CF3333 0%)';
					document.getElementById('title').id='title3';
					</script>";
	}
class objDiscipline
	{
		function __construct($ID)
			{$this->ID=$ID;}
		public $ID, $Name, $Profile, $Year, $Type, $uRandArray = array();
	}

class objAnswer
	{public $Question, $selectArray = array();}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<link href="css/styles.css" rel="stylesheet" >
		<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="img/LOGO.png" />
		<script type="text/javascript" src="js/modal.js"></script>
	</head>
		<header>
			<?include 'blocks/top-menu';?>
			<span id="numSet"><? getNumofQuestions() ?></span>
		</header>
	<body <?echo "class='$GLOBALS[DayNight]'";?>>
		<div class="section">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='POST' align="left">
				<?if($DO == TRUE)
				echo "<p align='left'>
					<table>
						<tr align='right'>
							<td>Profil: </td>
							<td id='profile' align='left'></td>
						</tr>
						<tr align='right'>
							<td>Disciplina: </td>
							<td id='discipline' align='left'></td>
						</tr>
						<tr align='right'>
							<td>Anul de Studii: </td>
							<td id='year' align='left'></td>
						</tr>
					</table>";?>
				</p>
				<h3 id='title' align="center">
					<?
						if($DO == TRUE)
							randQuizz();
					?>
				</h3>
				<?if($DO == TRUE)
				{session_start();
				$_SESSION['idQuestion'] = $currentQ;
					$mainQuerry=mysql_query("SELECT * FROM answers WHERE id_questions=$currentQ");
					if($mainQuerry === FALSE) { die(mysql_error());}
					if($currentT == 'A1')
						{
							while($junkQuerry=mysql_fetch_array($mainQuerry))
								{$A=$junkQuerry['correct'];echo"<p align='left'><input type='radio' name='ans[]' class='A$A' value='$junkQuerry[value]'>$junkQuerry[value]</p>";}
						}
					else
						{
							while($junkQuerry=mysql_fetch_array($mainQuerry))
								{$A=$junkQuerry['correct'];echo"<p align='left'><input type='checkbox' name='ans[]' class='A$A' value='$junkQuerry[value]'>$junkQuerry[value]</p>";}
						}
					
				}
				else
					checkAnswear();
				?>
				<input type='hidden' name='objArray' value='<?php print base64_encode(serialize($objDisciplineArray)) ?>'>
				<input type='hidden' name='ansArray' value='<?php print base64_encode(serialize($objansArray)) ?>'>
	
				<?if($DO == TRUE)
					echo "
					<input type='hidden' name='qID' value='$currentQ'>
					<input type='hidden' name='Number' id='Number' value='$tempN'> 
					<input type='hidden' name='HowMore' id='HowMore' value='$HowMore'> 
					<input id='nextButton' type='submit' name='submit' value='Urmatoarea'>
					<input id='check' type='button' name='check' value='Află Răspunsul' onclick='checki()'>
					";?>
				</form>
		</div>
			<?include "blocks/dev";?>
			<?include "blocks/sugg";?>
		<script>
				function countQuizzB()
				{
					Number = document.getElementById('numCountQuizz').value;
					document.getElementById('numSet').innerHTML="";
					document.getElementById('Number').value=Number;
					document.getElementById('HowMore').value=Number;
				}
				function checki()
					{
						var elements = document.getElementsByClassName("A1");
						var Correct = new Array();
						for(var i=0; i<elements.length; i++)
    						Correct.push(elements[i].value);
						alert("Răspunsul Corect \n" + Correct);
					}
		</script>
	</body>
</html>
