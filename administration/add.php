<?
include "../blocks/connect";
mysql_query("set names 'utf8'");

function compile($query)
	{
		$result=mysql_query($query);
		if($result === FALSE)
			die(mysql_error());
	}

function getID($value)
	{
		$X=mysql_query("SELECT id FROM Question WHERE quiz='$value'");
		$x=mysql_fetch_array($X);
		return $x[0];
	}

if (isset($_POST['submit']))
	{
		$question = $_POST['q'];
		$level = $_POST['level'];
		switch ($level)
			{
				case 'Incepator':$level=1;break;
				case 'Mediu':$level=2;break;
				case 'Avansat':$level=3;break;
			}
		$check = $_POST['check'];

		$answers=array(3);
		if(!empty($_POST['ans']))
			{	$i=0;
				foreach($_POST['ans'] as $sel)
					$answers[$i++]=$sel;
			}
		
		$questionQuery = "INSERT INTO Question (quiz, level) VALUES ('$question','$level')";
		compile($questionQuery);
		
		$questionID = getID($question);
		
		for($i=0;$i<3;$i++)
			{
				$a;
				if(($i+1)==$check)
					$a=1;
				else
					$a=0;
				$answerQuery="INSERT INTO Answer (id_Q, variant, ans) VALUES ('$questionID','$answers[$i]','$a')";
				compile($answerQuery);
			}
	}
?>
<!DOCTYPE html>
	<html>
		<head>
			<title>Adaugare Intrebari</title>
				<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" />
    		 	<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
    			<meta name="generator" content="Codeply">
		</head>
		<body>
			<div class="container">
			<form name="add" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			  <div class="form-group">
			    <label>Intrebarea</label>
			     <textarea class="form-control" rows="5" name="q" required></textarea>
			  </div>
			  <div class="form-group">
			    <label>Nivelul de greutate</label>
			    <select class="form-control" name="level" required>
                      <option ></option>
                      <option >Incepator</option>
                      <option >Mediu</option>
                      <option >Avansat</option>
                    </select>
			  </div>
			  
			  	<?
					for($i=1;$i<4;$i++)
						{
							echo '<div class="form-group">';
							echo '<label>Varianta de raspuns #'.$i.'</label>';
							echo '<input type="text" class="form-control" name="ans[]" placeholder="varianta '.$i.'" required>';
							echo '<input type="radio" name="check" value="'.$i.'">Corect</label>';
							echo '</div>';
						}
				?>
			  <button type="submit" class="btn btn-primary btn-block" name="submit">Adauga</button>
			</form>
		</div>
		</body>
	</html>
