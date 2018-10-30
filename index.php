<?php
  $dbServername = "dsg1.crc.nd.edu";
  $dbUsername = "scorn";
  $dbPassword = "taurus";
  $dbName = "scorn";

  $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

  if (!$conn) {
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
  }

  /* create select statement */
  //if ($stmt = mysqli_prepare ($conn, "SELECT author, subreddit, title, permalink FROM posts")) {
    //mysqli_stmt_bind_param($stmt, "i", $_GET["author"]);
    
    //mysqli_stmt_execute($stmt);

    //mysqli_stmt_bind_result($stmt, $post);

    /*while (mysqli_stmt_fetch($stmt)) {
      echo "$post";
    }*/

  $query = 'SELECT * FROM posts';
  $result = mysqli_query($conn, $query) or die ('Query failed: ' . mysql_error());
  
  /* dump results */
  echo "<table>\n";
  while ($tuple = mysqli_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($tuple as $col_value) {
      echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
  }
    /*close statement */
    //mysqli_stmt_close($stmt);
 
  /* close connection */

  mysqli_close($conn);
?>
