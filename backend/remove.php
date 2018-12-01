<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<form action="./deleteuser.php" method="POST">
    <h1>
    <?php
        echo $_REQUEST['name']
    ?>
    </h1>
    <input type="hidden" name="name" value="<?php echo $_REQUEST['name']; ?>">
    <button type="submit" name="submit">Delete User</button>
</form>

</body>
</html>
