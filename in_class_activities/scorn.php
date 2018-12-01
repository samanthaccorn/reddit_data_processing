<html>
<head>
<title>Webpage</title>

</head>

<body>
Today's date is <?php echo date("m/d/y"); ?><br/>
<form action="scorn_ageaction.php" method="get">
Enter your age: <input type="textbox" name="age"/>

<?php 

$link = mysqli_connect('localhost', 'scorn', 'taurus') or die ('Database connection error');
mysqli_select_db($link,'scorn');

$query = 'select * from user_age';
$result = mysqli_query($link,$query) or die ('Query failed'.mysql_error());
echo "<table>\n";
while ($tuple = mysqli_fetch_array($result,MYSQL_ASSOC)) {
	echo "\t<tr>\n";
	foreach ($tuple as $col_value) {
		echo "\t\t<td> $col_value </td>\n";
	}
	echo "\t</tr>\n";
}

mysqli_free_result($result);
mysqli_close($link);

?>

</form>
</body>
</html>
