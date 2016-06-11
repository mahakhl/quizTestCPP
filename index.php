<?
if (isset($_POST['submit']))//daca este apasat butonul de logare
    {
      $Email = $_POST['E'];
      $User = $_POST['U'];
      include "blocks/connect";//conectarea
      $Q=mysql_query("SELECT grad FROM People WHERE paswd='$Email' and nume='$User'");//aflat ce tip de om ii acest utilizator
        if($Q === FALSE)die(mysql_error());
      $q=mysql_fetch_row($Q);
      session_start();//pentru transmiterea datelor intre pagini in aceeasi sesiune
      $_SESSION["E"] = "$Email";
      $_SESSION["U"] = "$User";
      switch ($q[0]) {//unde sa plecam in dependenta de utilizator
        case 'student': header('Location: view.php');break;
        case 'prof': header('Location: administration');break;
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>quizCPP Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<!--logarea-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <h1 class="text-center">Login</h1>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" name="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
              <input name="E" type="password" class="form-control input-lg" placeholder="Email">
            </div>
            <div class="form-group">
              <input name="U" type="text" class="form-control input-lg" placeholder="Nume">
            </div>
            <div class="form-group">
              <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Autentificare</button>
            </div>
          </form>
      </div>
      <div class="modal-footer">  
      </div>
  </div>
  </div>
</div>

	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>