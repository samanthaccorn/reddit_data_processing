<html>
<head>
<title> This is my webpage </title>
</head>
<body>
<form action="mgalbavy_ageaction.php" method="get">
Enter your age: <input type="textbox" name="age"/>
</form>

<?php
// connecting to database
// single quotes and double quotes are different in php
// double quotes allows the use of special characters
$link = mysqli_connect('localhost', 'mgalbavy', 'goirish') or die ('Database connection error');
// or die used for error checking
mysqli_select_db($link, 'mgalbavy');

$query = 'select * from user_age';
$result = mysqli_query($link, $query) or die ('Query Failed : ' . mysql_error());
// associative array (aka dictionary)
echo "<table>\n";
while ($tuple = mysqli_fetch_array($result, MYSQL_ASSOC)) {

        echo "\t<tr>\n";
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
