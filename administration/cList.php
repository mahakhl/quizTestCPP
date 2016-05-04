<?
include ("../functions/show");
include ("../blocks/connect");
if(!isset($_GET['g']))
    $_GET['g']="MI-131";
$g = $_GET['g'];
echo " <div class='col-lg-5'><h2 id='statE'>Statistica Examene $g</h2>";
echo "<table class='table table-hover'><thead><tr><th>Nume</th><th>Prenume</th><th>Nota</th></tr></thead>";
echo "<tbody>";
echo showStudentsMarks($g);
echo "</tbody></table></div>";
echo "<div class='col-lg-7'><h2 id='statP'>Statistica Practica $g</h2>";
echo "<table class='table table-hover'><thead><tr><th>Nume</th><th>Prenume</th><th>Corecte</th><th>Totale</th><th>Ratia</th></tr></thead>";
echo "<tbody>";
echo showStudentsPractice($g);
echo "</tbody></table></div>";
?>