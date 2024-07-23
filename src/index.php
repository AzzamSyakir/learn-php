<?php
require 'db.php';

try {
    $conn = ConnectDB();
    $conn->begin_transaction();

    $dateTime = new DateTime();
    $formattedDateTime = $dateTime->format('Y-m-d H:i:s');

    $query = "INSERT INTO tasks (id, title, completed, created_at, updated_at) VALUES ('id_1', 'tes_task', 2, '$formattedDateTime', '$formattedDateTime')";

    $result = $conn->query($query);

    if ($result) {
        $conn->commit();
        echo "Success query";
    } else {
        throw new Exception($conn->error);
    }
} catch (Exception $e) {
    $conn->rollBack();
    echo "Failed: " . $e->getMessage();
}
