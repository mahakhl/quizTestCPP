<?
include ("blocks/connect");
session_start();
$Email=$_SESSION["E"];
$User=$_SESSION["U"];
$Q = mysql_query("SELECT id,prenume FROM People WHERE paswd='$Email'");
$Q = mysql_fetch_row($Q);$g=$Q[0];$Q = $Q[1];
$Grupa = mysql_query("SELECT name FROM grupa WHERE id_student='$g'");
$Grupa = mysql_fetch_row($Grupa);$Grupa=$Grupa[0];
$Practica = mysql_fetch_row(mysql_query("SELECT corect, total FROM `practice` WHERE id_student='$g'"));
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Testare CPP online</title>
    <meta name="description" content="Serviciu de testare a cunostintelor in limbajul CPP. La fel se poate de trecut examen oficial, oferit de profesor." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Codeply">
   <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/styles.css" />
    
  </head>
  <body >
    <br><br>
    <nav class="navbar navbar-fixed-top navbar-dark bg-primary">
    <button class="navbar-toggler hidden-sm-up pull-right" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
        ☰
    </button>
    <a class="navbar-brand" href="#">Testare CPP Online</a>
    <div class="collapse navbar-toggleable-xs" id="collapsingNavbar">
        <ul class="nav navbar-nav pull-right">
            <li class="nav-item"><a class="nav-link"><?echo "$Grupa | $User $Q";?></a></li>
            <li class="nav-item"><a class="nav-link" href="index.php">LogOut</a></li>
        </ul>
    </div>
</nav>
<div class="container-fluid" id="main">
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-md-3 col-lg-2 sidebar-offcanvas" id="sidebar" role="navigation">
            <div class="list-group">
                <a href="#about" class="list-group-item">Despre</a>
                <a href="#level" class="list-group-item">Niveluri</a>
                <a href="#statE" class="list-group-item">Statistica Examene</a>
                <a href="#statP" class="list-group-item">Statistica Practica</a>
            </div>
        </div>
        <!--/col-->

        <div class="col-md-9 col-lg-10 main">

            <!--toggle sidebar button-->
            <p class="hidden-md-up">
                <button type="button" class="btn btn-primary-outline btn-sm" data-toggle="offcanvas"><i class="fa fa-chevron-left"></i> Menu</button>
            </p>
            <h1 class="display-1 hidden-xs-down">
                <button type="button" class="btn btn-success btn-lg"><a href="test.php?level=P" style="color:white; text-decoration: none;">Practica</a></button>
                <button type="button" class="btn btn-success btn-lg"><a href="test.php?type=E" style="color:white; text-decoration: none;">Examen</a></button>
            </h1>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card card-inverse card-success">
                        <div class="card-block bg-success">
                            <h6 class="text-uppercase">Raspuns in Total</h6>
                            <h1 class="display-1"><?echo $Practica[1];?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card card-inverse card-info">
                        <div class="card-block bg-info">
                            <h6 class="text-uppercase">Raspunse corect</h6>
                            <h1 class="display-1"><?echo $Practica[0];?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h2 id="level">Niveluri</h2>
            <div class="card-deck-wrapper">
                <div class="card-deck">
                    <div class="card card-inverse card-success text-center">
                        <a href="test.php?level=P1" style="color:white; text-decoration: none;">
                        <div class="card-block" >
                            <blockquote class="card-blockquote">
                                <p>Nivelul Incepator - presupunem ca esti familiarizat cu notiunele de baza ale limbajul C++</p>
                                <footer>Nu ezita, verifica cunostintele de la curs</footer>
                            </blockquote>
                        </div></a>
                    </div>
                    <div class="card card-inverse card-info text-center">
                        <a href="test.php?level=P2" style="color:white; text-decoration: none;">
                        <div class="card-block" onclick="test('P2')">
                            <blockquote class="card-blockquote">
                                <p>Nivelul Mediu - presupunem ca deja ai nivelul incepator si ai cunoscut mai detailat limbajul.</p>
                                <footer>Treci testul si primesti un bal la evaluarea final. Nu ezita</footer>
                            </blockquote>
                        </div></a>
                    </div>
                    <div class="card card-inverse card-warning text-center">
                        <div class="card-block" onclick="test('P3')">
                            <blockquote class="card-blockquote">
                                <p>Nivel Avansat - presupunem ca esti la sfirsit de curs si stii tainele C++</p>
                                <footer>Garantat vei fii apreciat de profesor. Incearcati cunostintele</footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
            <!--/row-->
            <hr>
            <!-- Statistica -->
            <h2 id="statE">Statistica Examene</h2>
<? require ("functions/show");?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nume</th>
                        <th>Prenume</th>
                        <th>Grupa</th>
                        <th>Nota</th>
                    </tr>
                </thead>
                <tbody>
                    <?showStudentsMarks();?>
                </tbody>
            </table>
            <h2 id="statP">Statistica Practica</h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nume</th>
                        <th>Prenume</th>
                        <th>Grupa</th>
                        <th>Corecte</th>
                        <th>Totale</th>
                        <th>Ratia</th>
                    </tr>
                </thead>
                <tbody>
                    <?showStudentsPractice();?>
                </tbody>
            </table>
            <!-- About/Despre -->
            <h2 id="about">Despre</h2>
            <hr>
            <p>
                Este un model de testare pe 3 nivele (începător, mediu ,avansat) în domeniul programării și anume limbajului C++. <br>
                Întrebările sunt propuse de către profesor spre pregătire pentru examen. Mai alcatuieste
            </p>
            <hr>
        </div>
        <!--/main col-->
    </div>

</div>

<footer class="container-fluid">
    <p class="text-right small">©2016 Cernavca Nicoleta</p>
</footer>
<script>
        functions test(type)
            {
                alert(type);
                switch(type)
                    {
                        case 'E' : window.location="localhost/quizCPP/test.php?type=E";break;
                        case 'P' : window.location="localhost/quizCPP/test.php?level=P";break;
                        case 'P1' : window.location="localhost/quizCPP/test.php?level=P1";break;
                        case 'P2' : window.location="localhost/quizCPP/test.php?level=P2";break;
                        case 'P3' : window.location="localhost/quizCPP/test.php?level=P3";break;
                    }
            }
    </script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js,//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>