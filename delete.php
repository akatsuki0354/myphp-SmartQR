<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chester-db";

    $conn = new mysqli($server,$username,$password,$dbname);
    if(($conn -> connect_error)){
        die("Connection failed" . $conn->connect_error);
    }

    $id = $_GET['id'];
    $sql = "DELETE FROM table_attendance WHERE ID = $id";
    if ($conn->query($sql) === TRUE) {
        header('location: index.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
?>
