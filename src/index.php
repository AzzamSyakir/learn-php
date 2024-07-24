<?php
require 'db.php';
require 'create.php';
require 'fetch.php';

$conn = ConnectDB();
$conn->begin_transaction();

// $createTask = CreateData($conn);
// if ($createTask) {
//     echo "query success";
// } 

$fetchTask = FetchData($conn);
if (!empty($fetchTask)) {
    foreach ($fetchTask as $row) {
        echo "ID: " . $row['id'] . " - title: " . $row['title'] . " - completed: " . $row['completed'] . " - created_at: " . $row['created_at'] . " - updated_at: " . $row['updated_at'] . "<br>";
    }
} else {
    echo "No data found.";
}
