<html>
<head>
<title>Post</title>
</head>
  <body>
  <?php

    include_once './connect.php';

    $post_title = $_GET["post_title"];
  ?>
  Post's title is <?php echo $post_title; ?> <br/>

  <?php 
    /* create prepared statement */
    if ($stmt = mysqli_prepare($conn, "SELECT * FROM posts WHERE title = ?")) {
      
      mysqli_stmt_bind_param($stmt, "s", $post_title);

      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);?>
      <form method="get" action="post_data.php">
        <?php while ($posts = mysqli_fetch_array($result, MYSQLI_NUM)) {

	  ?><button type="submit" value="<?php $posts[3]?>" ><?php echo "\t\t<td>$posts[3]</td>\n";?></button><br><?php 
        }?>
      </form>
      <?php mysqli_stmt_close($stmt);
    }
  ?>
  </body>
</html>

<?php
  /* close connection to database */
  mysqli_close($conn);
?>
