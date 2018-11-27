<?php
    include_once './dbh.php';

    $query = "
        INSERT INTO users (username, password, deleted)
        SELECT username, password, deleted FROM users
        WHERE NOT EXISTS(
            SELECT username, password, deleted FROM users where username = ?, password = ?, deleted = ?
        ) LIMIT 1
    ";
    //$query = "INSERT INTO users (username, password, deleted) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    echo mysql_error();
    $pwd_hash = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    $valid = 'False';
    $stmt->bind_param("sss", $_POST['name'], $pwd_hash, $valid);
    $stmt->execute();
    $stmt->close();
    
    header("Location: ./index.php");
?>
