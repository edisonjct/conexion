<script src="../js/myjava.js"></script>
<?php
$factura = $_GET['factura'];
$cliente = $_GET['cliente'];
$IDB = $_GET['IDB'];

$random = mysql_connect('localhost', 'root', '');
mysql_select_db('mrbooks', $random);
$sql = "select nombres from autores ORDER BY RAND() LIMIT 1;";
$result = mysql_query($sql, $random);
$row = mysql_fetch_array($result);


if($IDB >= '13'){	
	echo '<div id=imprimeme>
	<img src="../recursos/librimundi.png" width="180" height="80" alt="" /><br>
	'.$cliente.'<br>
	'.$row['nombres'].'<br>
	</div>';
} else {
	echo '<div id=imprimeme>
	<img src="../recursos/mrbooks.png" width="180" height="80" alt="" /><br>
	'.$cliente.'<br>
	'.$row['nombres'].'<br>
	</div>';
}

echo '<br><a onclick="confirmation();"><img src="../recursos/impresora.png" width="55" height="55" alt="" /></a>';