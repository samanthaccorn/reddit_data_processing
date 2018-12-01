<html>
<head>
<title>Webpage title</title>
<script type="text/javascript">
document.write("Hello World! </br> <a href=\"http://nd.edu\">asdf</a>")
</script>
</head>
<body>
Body <a href="http://nd.edu">Notre Dame</a>
Today's date is <?php echo date("m/d/Y"); ?>
<form action="adonoghu_ageaction.php" method="get">
Enter you age: <input type="textbox" name="age"/> 
</form>

<?php
// comment
$link = mysqli_connect('localhost', 'adonoghu', 'Nutella15!') or die('Database connection error');
mysqli_select_db($link, 'adonoghu');

$query = 'select * from user_age';
$result = mysqli_query($link, $query) or die ('Query failed:' . mysql_error());

echo "<table>\n";
while ($tuple = mysqli_fetch_array($result, MYSQL_ASSOC)) {
	echo "\t<tr>\n";
	// single quotes print out literally, double quotes doesn't
	foreach( $tuple as $col_val) {
		echo "\t\t<td> $col_val </td>\n";
	}
	echo "\t</tr>\n";
}
mysqli_free_result($result);
mysqli_close($link);

?>

</body>
</html>
