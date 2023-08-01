<?php
class DatabaseConnection {
    private $host;
    private $username;
    private $password;
    private $database;

    public function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connect() {
        $conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    public function fetchUsers() {
        $conn = $this->connect();
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        $users = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        $conn->close();
        return $users;
    }
}

// Usage example:
$db = new DatabaseConnection('localhost', 'username', 'password', 'my_database');
$users = $db->fetchUsers();
foreach ($users as $user) {
    echo "ID: " . $user['id'] . ", Name: " . $user['name'] . ", Email: " . $user['email'] . "<br>";
}
?>
