<?
include ("../blocks/connect");
include ("../functions/show");
if(!isset($_GET['g']))
    $_GET['g']='MI-131';
$Questions = mysql_fetch_row(mysql_query("SELECT COUNT(id) FROM Question"));
$Questions = $Questions[0];
$Students = mysql_fetch_row(mysql_query("SELECT COUNT(id) FROM People WHERE grad='student' "));
$Students = $Students[0];
$Exams = mysql_fetch_row(mysql_query("SELECT COUNT(id_student) FROM Examene WHERE mark>4"));
$Exams = $Exams[0];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Administration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Codeply">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/styles.css" />
    <script>
    function add() 
        {
            window.open("add.php", "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=500,left=400,width=600,height=700");
        }
    function edit() 
        {
            window.open("edit.php", "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=500,left=400,width=600,height=700");
        }
    function remove() 
        {
            window.open("remove.php", "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=500,left=400,width=600,height=700");
        }
    </script>
  </head>
  <body >
    <nav class="navbar navbar-fixed-top navbar-dark bg-primary">
    <button class="navbar-toggler hidden-sm-up pull-right" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
        ☰
    </button>
    <a class="navbar-brand" href="#">Testare CPP Online [ADMIN MOD]</a>
    <div class="collapse navbar-toggleable-xs" id="collapsingNavbar">
        <ul class="nav navbar-nav pull-right">
            <li class="nav-item"><a class="nav-link" href="" onclick="add()">Adauga</a></li>
            <li class="nav-item"><a class="nav-link" href="" onclick="edit()">Editeaza</a></li>
            <li class="nav-item"><a class="nav-link" href="" onclick="remove()">Sterge</a></li>
            <li class="nav-item"><a class="nav-link" href="../index.php">LogOut</a></li>
        </ul>
    </div>

</nav>
<div class="container-fluid" id="main">
    <div class="row row-offcanvas row-offcanvas-left">

        <div class="col-lg-12 main "><br><br><br><br>
            <div class="row col-lg-offset-2">
                <div class="col-lg-3 col-md-6">
                    <div class="card card-inverse card-success">
                        <div class="card-block bg-success">
                            <div class="rotate">
                                <i class="fa fa-user fa-3x"></i>
                            </div>
                            <h6 class="text-uppercase">Studenti din toate grupele</h6>
                            <h1 class="display-1"><?echo $Students?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card card-inverse card-info">
                        <div class="card-block bg-info">
                            <div class="rotate">
                                <i class="fa fa-question-circle fa-3x"></i>
                            </div>
                            <h6 class="text-uppercase">Intrebari in baza de date</h6>
                            <h1 class="display-1"><?echo $Questions;?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card card-inverse card-danger">
                        <div class="card-block bg-danger">
                            <div class="rotate">
                                <i class="fa fa-list fa-3x"></i>
                            </div>
                            <h6 class="text-uppercase">Examene sustinute de studenti</h6>
                            <h1 class="display-1"><?echo $Exams?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div id="addBlock"></div>
            <div class="row">
            <div class="form-group col-lg-2 col-lg-offset-5">
                <label class="control-label">Alege Grupa:</label>
                    <select class="form-control" name="cList" onchange="cList(this.value)">
                      <option ></option>
                      <option >MI-131</option>
                      <option >TI-131</option>
                      <option >AI-131</option>
                      <option >C-131</option>
                    </select>
            </div>
            </div>
            <!--/row-->
            <div class="row" id="txtHint">
            
            </div>
        </div>
        <!--/main col-->
    </div>
</div>
<!--/.container-->
<footer class="container-fluid">
    <p class="text-right small">©2016 Cernavca Nicoleta</p>
</footer>
    <!--scripts loaded here-->
    <script>
function cList(str) {
    xmlhttp = new XMLHttpRequest();// code for IE7+, Firefox, Chrome, Opera, Safari       
    xmlhttp.onreadystatechange = function() 
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;            
        };
        xmlhttp.open("GET","cList.php?g="+str,true);
        xmlhttp.send();
}
</script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js,//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>