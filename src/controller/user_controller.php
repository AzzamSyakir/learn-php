<?php
require_once __DIR__ . '/../db.php';

class UserController
{
    public function get()
    {
        $conn = ConnectDB();
        $fetchUser = $this->fetchUser($conn);

        if (!empty($fetchUser)) {
            foreach ($fetchUser as $row) {
                echo "ID: " . $row['id'] . " - name: " . $row['name'] . " - password: " . $row['password'] . " - created_at: " . $row['created_at'] . " - updated_at: " . $row['updated_at'] . "<br>";
            }
        } else {
            echo "No user found.";
        }
    }

    private function fetchUser(mysqli $conn): array
    {
        $user = [];
        try {
            $query = "SELECT * FROM users"; 
            $result = $conn->query($query);

            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $user[] = $row;
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

        return $user;
    }

    public function post()
    {
        $conn = ConnectDB();
        $name = $_POST['name'];
        $password = $_POST['password'];

        if (empty($name)) {
            echo "Name must be filled";
        } elseif (empty($password)) {
            echo "Password must be filled";
        } else {
            $createUser = $this->createUser($conn, $name, $password);
            if ($createUser) {
                $conn->commit();
                echo "CreateUser success";
            } else {
                $conn->rollBack();
                echo "CreateUser failed";
            }
        }
    }

    private function createUser(mysqli $conn, string $name, string $password): bool
    {
        try {
            $dateTime = new DateTime();
            $formattedDateTime = $dateTime->format('Y-m-d H:i:s');
            $id = substr(sha1(time()), 0, 10);

            $query = "INSERT INTO users (id, name, password, created_at, updated_at) VALUES ('$id', '$name', '$password', '$formattedDateTime', '$formattedDateTime')";
            $result = $conn->query($query);

            if ($result) {
                $conn->commit();
            } else {
                throw new Exception($conn->error);
            }
        } catch (Exception $e) {
            $conn->rollBack();
            echo "Failed: " . $e->getMessage();
            return false;
        }

        return true;
    }
}
