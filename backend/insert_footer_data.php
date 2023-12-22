<?php
session_start();

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];


    $sql = "INSERT INTO footer (name) VALUES ('$name')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['flash_message'] = "Data inserted successfully";

        header("Location: footer.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();

?>