<?php
    include_once './dbh.php';

    $query = "UPDATE users SET deleted='True' WHERE username=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $_POST['name']);
    
    $stmt->execute();
    $stmt->close();
