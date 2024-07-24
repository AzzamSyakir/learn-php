<?php 
function CreateData(mysqli $conn) :  bool {
  try {
    $dateTime = new DateTime();
    $formattedDateTime = $dateTime->format('Y-m-d H:i:s');

    $query = "INSERT INTO tasks (id, title, completed, created_at, updated_at) VALUES ('id_1', 'tes_task', 2, '$formattedDateTime', '$formattedDateTime')";

    $result = $conn->query($query);

    if ($result) {
        $conn->commit();
    } else {
        throw new Exception($conn->error);
    }
} catch (Exception $e) {
    $conn->rollBack();
    echo "Failed: " . $e->getMessage();
}
return $result;
}