<?
include 'blocks/connect';
mysql_query("set names 'utf8'");
/*$bor;$DayNight;
$T=date('H')+7;
if($T>6&& $T<21)
	{$bor="borD";$DayNight="day";}
else
	{$bor="borN";$DayNight="night";}*/
$bor="borD";$DayNight="day";
$Y=mysql_query("SELECT value FROM years", $connect);
$y=mysql_fetch_array($Y);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<link href="css/styles.css" rel="stylesheet" >
		<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="img/LOGO.png" />
		<script src="js/modal.js"></script>
		<script src="js/index.js"></script>
	</head>
		<header>
			<?include 'blocks/top-menu';?><span id="time"></span>
		</header>
		<body <?echo "class='$GLOBALS[DayNight]'";?>>
			<div class="section">
				<h1>Anii de studii</h1>
					<?
					do{echo"<a href='#'><div class='borN' onclick='chColor($y[0])' id='$y[0]'>$y[0]</div></a>";}while ($y=mysql_fetch_array($Y));
					?>
				<h1 id="title2"></h1>
				<p id='yearp'>
	<?function grabData($year)
	{
		$dis=mysql_query("SELECT DISTINCT id_discipline FROM questions WHERE id_year=$year");
		$dis_q=mysql_fetch_array($dis);if($dis === FALSE) { die(mysql_error());}
		do{
		$D=mysql_query("SELECT value,id FROM disciplines WHERE id=$dis_q[0]");
		
		if (mysql_num_rows($D)>0)
			{
				$d=mysql_fetch_array($D);
				do
					{echo ("<div class=\"$GLOBALS[bor]\" id=\"$d[1]\" onclick=\"chColor($d[1])\">$d[0]</div>");}
				while ($d=mysql_fetch_array($D));
			}}while($dis_q=mysql_fetch_array($dis));
	}?>
				</p>
				<p id='start'></p>
			</div>
			<?include "blocks/dev";?>
			<?include "blocks/sugg";?>
<script>
var Year = new Array();
var Dis = new Array();
		function getData()
			{
				document.getElementById("yearp").innerHTML="";
				var X = "<p><input id='startButton' type='button' value='START' onclick='send()'></p>";console.log(Year+" "+Year.length);
				for(q=0;q<Year.length;q++)
					{el=document.getElementById("yearp");
						switch(Year[q])
										{
											case 1 : el.innerHTML = el.innerHTML + '<? grabData(1);?>'; break;
											case 2 : el.innerHTML = el.innerHTML + '<? grabData(2);?>'; break;
											case 3 : el.innerHTML = el.innerHTML + '<? grabData(3);?>'; break;
											case 4 : el.innerHTML = el.innerHTML + '<? grabData(4);?>'; break;
											case 5 : el.innerHTML = el.innerHTML + '<? grabData(5);?>'; break;
											case 6 : el.innerHTML = el.innerHTML + '<? grabData(6);?>'; break;
										}}
				if(Dis.length==0)
					document.getElementById("start").innerHTML="";
				else
					document.getElementById("start").innerHTML=X;

			}

		function toColor(value1, value2, cache)
			{
				getData();console.log("Tabel - "+value1+" Lungimea - "+value1.length+" Cache"+cache);
				if(value1.length==0)
					{document.getElementById(cache).style.background="";
						document.getElementById(cache).style.color="";}
				else
				for(q=0;q<value1.length;q++)
				{if(value2 == 1)
					{console.log("FOR "+value1[q]);
						document.getElementById(value1[q]).style.background="#6385B3";
						document.getElementById(value1[q]).style.color="white";
					}
				else
					{console.log("FORE "+value1[q]);
						document.getElementById(cache).style.background="";
						document.getElementById(cache).style.color="";
						document.getElementById(value1[q]).style.background="#6385B3";
						document.getElementById(value1[q]).style.color="white";
					}}
			}
		function chColor(Y)
			{
				if(Y>6)
					Tabel=Dis;
				else
					Tabel=Year;
				if(Tabel[0]==null)
					{Tabel.push(Y);console.log("NOU");toColor(Tabel,1,0);}
				else
					{
						if(inArray(Tabel, Y))
							{Tabel.splice(Tabel.indexOf(Y),1);toColor(Tabel,0,Y);}
						else
							{Tabel.push(Y);toColor(Tabel,1,0);}
					}
				if(Year.length==0)
					document.getElementById("title2").innerHTML = "";
				else
					document.getElementById("title2").innerHTML = "Dicipline din Anul " + Year;
			}
</script>
		</body>
</html>
