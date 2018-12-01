<?php
    include_once './dbh.php';

    $query = "
        INSERT INTO topics (name)
        SELECT name FROM topics
        WHERE NOT EXISTS(
            SELECT name FROM topics WHERE name = ?
        ) LIMIT 1
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $_POST['interest']);
    $stmt->execute();
    $stmt->close();

    $query2 = "INSERT INTO interests (user_id, interest_id, timestamp, strength) VALUES ((SELECT id FROM users WHERE username=?), (SELECT id FROM topics WHERE name=?), CURRENT_TIMESTAMP, ?) ON DUPLICATE KEY UPDATE strength=strength+?, timestamp=CURRENT_TIMESTAMP";
    $stmt2 = $conn->prepare($query2);
    $num = 6;
    $stmt2->bind_param("ssii", $_POST['uname'], $_POST['interest'], $num, $num);
    $stmt2->execute();
    $stmt2->close();

    header("Location: ./index.php");

    // $query = "INSERT INTO interests (user_id, interest_id, timestamp, strength) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE strength=6 WHERE user_id=(SELECT id FROM topics WHERE name=?) and interest_id=?"
    // $stmt = $conn->prepare($query);
?>
