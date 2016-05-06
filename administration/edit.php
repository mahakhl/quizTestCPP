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
				echo "<a class='nav-link' href='edit.php?id=$q[0]'>$q[1]</a><br>";
			}while($q = mysql_fetch_array($Q));

	}


if(isset($_POST['submit']))
	{
		$question = $_POST['q'];
		$level = $_POST['level'];
		$id=$_POST['id'];
		$check = $_POST['check'];
		
		switch ($level)
			{
				case 'Incepator':$level=1;break;
				case 'Mediu':$level=2;break;
				case 'Avansat':$level=3;break;
			}

		$AnsIDs = mysql_query("SELECT id FROM Answer WHERE id_Q=$id");
		$AnsIndex = mysql_fetch_row($AnsIDs);
		$idAnswers=array(3);$x=0;
		do
			{
				$idAnswers[$x++]=$AnsIndex[0];
			}while($AnsIndex = mysql_fetch_row($AnsIDs));

		$answers=array(3);
		if(!empty($_POST['ans']))
			{	$i=0;
				foreach($_POST['ans'] as $sel)
					$answers[$i++]=$sel;
			}
		
		$UpdateQuestion = mysql_query("UPDATE Question SET quiz='$question', level='$level' WHERE id='$id'");
		if($UpdateQuestion === FALSE)
			die(mysql_error());

		for($i=0;$i<3;$i++)
			{
				$a;
				if(($i+1)==$check)
					$a=1;
				else
					$a=0;
				$UpdateAnswear = mysql_query("UPDATE Answer SET variant='$answers[$i]', ans='$a' WHERE id='$idAnswers[$i]' ");
					if($UpdateAnswear === FALSE)
						die(mysql_error());
			}		
	}

?>
<!DOCTYPE html>
	<html>
		<head>
			<title>Editeaza Intrebari</title>
				<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" />
    		 	<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
    			<meta name="generator" content="Codeply">
		</head>
		<body>
			<div class="container" id="main">
				<?
				if(isset($_GET['id']))
					{
						$var = $_GET['id'];
						$Question = mysql_fetch_row(mysql_query("SELECT * FROM Question WHERE id=$var"));
						echo "<form name=\"edit\" action=\"edit.php\" method=\"POST\">";
						echo "<label>Intrebarea</label>";
			     		echo "<textarea class='form-control' rows='5' name='q' required>$Question[1]</textarea>";
			     		echo "<label>Nivelul de greutate</label>";
			    		echo "<select class='form-control' name='level' required>";
			    		
               			echo "<option></option><option>Incepator</option><option >Mediu</option><option >Avansat</option>";
                      	echo "</select>";
              			$Q = mysql_query("SELECT * FROM `Answer` WHERE id_Q=$var ");
              			$i=1;
						$q = mysql_fetch_array($Q);
							do
								{
									echo '<div class="form-group">';
									echo '<label>Varianta de raspuns #'.$i.'</label>';
									echo '<input type="text" class="form-control" name="ans[]" value="'.$q[2].'" required>';
									if($q[3]==1)
										echo '<input type="radio" name="check" value="'.$i.'" checked>Corect</label>';
									else
										echo '<input type="radio" name="check" value="'.$i.'" >Corect</label>';
									echo '</div>';
									$i++;
								}while($q = mysql_fetch_array($Q));
						echo "<input type='hidden' value=$var name='id'>";
                      	echo "<button type='submit' class='btn btn-primary btn-block' name='submit'>Update</button>";
                    
					}
				else
					{
						getQuestions();
						$p=$range-1;
						$n=$range+1;
						echo '<ul class="pager">';
						echo "<li><a href=\"edit.php?p=$p\">Previous</a></li>";
						echo "<li><a href=\"edit.php?p=$n\">Next</a></li>";
						echo '</ul>';
					}
				?>
			</div>
		</body>
	</html>
