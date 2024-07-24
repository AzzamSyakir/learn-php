<?php 
function FetchData(mysqli $conn ) : array {
    $data = [];
    try {

        $query = "SELECT * FROM tasks"; 
    
        $result = $conn->query($query);
    
        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            } else {
                echo "0 results";
            }
            $conn->commit();
        } else {
            throw new Exception($conn->error);
        }
    } catch (Exception $e) {
        $conn->rollBack();
        echo "Failed: " . $e->getMessage();
    }
    return $data;
}
