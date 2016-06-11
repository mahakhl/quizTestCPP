<?
include "connect";
include "../functions/utils";

function GenerateQuizTabel($quantity, $level)
	{
		if($level==0)
			{$level=UniqueRandomNumbersWithinRange(1,3,1);$level=$level[0];}
		//se genereaza intrebari in paralel din 2 tabele
		$QuestionsQuery=mysql_query("	SELECT 
										Question.id AS id_q , 
										Question.quiz AS question,
										Answer.id AS id_a ,
										Answer.variant,
										Answer.ans AS answer 
										FROM Question JOIN Answer 
										ON Question.id=Answer.id_Q 
										WHERE Question.level='$level' 
										LIMIT $quantity");

		if($QuestionsQuery === FALSE)die(mysql_error());
		
		$QuestionsResult=mysql_fetch_array($QuestionsQuery);
		$i=0;
		$QuestionsArray = array(4); //5coloane si ? rinduri
		do
			{
				$QuestionsArray[$i++]=$QuestionsResult;
			}while($QuestionsResult=mysql_fetch_array($QuestionsQuery));
		$id=$QuestionsArray[0][0];
		echo "<h1>Intrebarea</h1>";
		echo "<label>".$QuestionsArray[0][1]."</label><br>";
		echo "<h2>Variante de Raspuns</h2>";
		echo "<input type='radio' name='ans' value='".$QuestionsArray[0][3]."'>".$QuestionsArray[0][3]."</label><br>";
		echo "<input type='radio' name='ans' value='".$QuestionsArray[1][3]."'>".$QuestionsArray[1][3]."</label><br>";
		echo "<input type='radio' name='ans' value='".$QuestionsArray[2][3]."'>".$QuestionsArray[2][3]."</label><br>";
		echo "<button type='submit' name='submitAns' class='btn btn-block btn-primary' onclick='check($id)'>Raspuns</button><br>";
	}

if (isset($_GET['type']))
	{
		switch ($_GET['type'])
			{//generam intrebari in dependenta de nivel
				case 'E' : GenerateQuizTabel(10,0); break;//10 intrebari din toate 
				case 'P1' : GenerateQuizTabel(10,1); break;//toate intrebarile din nivelul 1=incepator
				case 'P2' : GenerateQuizTabel(10,2); break;//toate intrebarile din nivelul 2=mediu
				case 'P3' : GenerateQuizTabel(10,3); break;//toate intrebarile din nivelul 3=avansat
				case 'P' : GenerateQuizTabel(10,0); break;//toate intrebarile din toate nivelele
			}
	}
if(isset($_GET['v613']))
	{
		switch ($_GET['v613'])
			{//update pentru statistica studentului instantanee
				case 'on' : UpdateUserInfo(1);GenerateQuizTabel(10,0);break;
				case 'off' :  UpdateUserInfo(0);GenerateQuizTabel(10,0);break;
			}
	}

?>