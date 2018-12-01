<?php
session_start();
if (isset($_SESSION['views']) )
$_SESSION['views'] = $_SESSION['views']+1;
else
$_SESSION['views'] = 1;
?>

<html>
<body>
<?php
$age=$_GET["age"];
?>
You are now <?=$age?> years old.<br/>
You have visited this page <?=$_SESSION['views']?> times.

<?php

$link = mysqli_connect('localhost','scorn','taurus');
mysqli_select_db($link, 'scorn');

if ($stmt = mysqli_prepare($link, "insert into user_age (age) values (?)") ) {
	mysqli_stmt_bind_param($stmt,"i",$_GET["age"]);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}

if ($stmt = mysqli_prepare($link,"select age from user_age where age <= ?") ) {
	mysqli_stmt_bind_param($stmt,"i",$_GET["age"]);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$age);
?>

<table>
	<?php
	while (mysqli_stmt_fetch($stmt)) {
	?>
		<tr>
			<?php
				echo "\t\t<td>$age</td>\n";
			?>
		</tr>
	<?php
	}
	?>	
</table>

<?php
}
?>

</body>
</html>
