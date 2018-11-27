<html>
<head>
<title>Post Data</title>
</head>
  <body>
  <?php

    include_once './connect.php';
   
    //$permalink = $_GET['permaink'];

    /* create prepared statement */
    /*if ($stmt = mysqli_prepare($conn, "SELECT * FROM posts WHERE permalink = ?")) {
      
      mysqli_stmt_bind_param($stmt, "s", $permalink);

      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);?>
   
      <form method="get" action="post_data.php">
	<?php echo "Cool stuff about the post";?>
        <?php while ($posts = mysqli_fetch_array($result, MYSQLI_NUM)) {
          foreach ($posts as $post) { ?>
            <button type="submit" ><?php echo "\t\t<td>$post</td>\n";?></button><br><?php 
          }
        }?>
      </form>
      <?php mysqli_stmt_close($stmt);
    }
  ?>
  </body>
</html>

<?php
  /* close connection to database 
  mysqli_close($conn);
?>*/

  echo "Cool stuff about this post";?>
</body>
</html>
