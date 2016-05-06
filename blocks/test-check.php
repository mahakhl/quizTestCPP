<?
include "connect";
if(isset($_GET['id_q']))
	{
		$id_q = $_GET['id_q'];
		$right = mysql_fetch_row(mysql_query("SELECT variant FROM Answer WHERE id_Q=$id_q AND ans=1 "));
		$right = $right[0];
		echo $right;
	}
?>