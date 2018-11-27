<?php
    include_once './dbh.php';

    $query = "INSERT INTO users (username, password, deleted) VALUES (?, ?, ?)";  
    $stmt = $conn->prepare($query);
    $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
    $valid = 'False';
    $stmt->bind_param("sss", $_POST['name'], $pwd_hash, $valid);
    $stmt->execute();
    $stmt->close();
    
    // header("Location: ./remove.php?name=" . $_POST['name']);
    header("Location: ./index.php")
?>
