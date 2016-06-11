<?//nustiu ce cauta el aici
include "blocks/connect";
include "functions/utils";
if (isset($_GET['type']))
	$Questions=10;
else
	$Questions=generateRange($_GET['level']);

?>