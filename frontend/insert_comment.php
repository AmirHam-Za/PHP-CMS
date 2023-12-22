<?php

session_start();

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $post_id = $_POST["post_id"];
    // $read_time = $_POST["read_time"];
    // $description = $_POST["description"];
    // $category_id  = $_POST["category_id"];
    // $tag_id  = $_POST["tag_id"];

    $sql = "INSERT INTO comments (name, comment, post_id) VALUES ('$name', '$comment', '$post_id')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['flash_message'] = "Comment Posted";


        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();

?>