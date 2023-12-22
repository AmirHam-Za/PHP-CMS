<?php
session_start();

include 'db_connection.php';
include 'header.php';

function deleteComment($commentId)
{
    global $conn;

    $commentId = (int) $commentId;

    $sql = "DELETE FROM comments WHERE id = $commentId";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

if (isset($_GET['id'])) {
    $commentId = $_GET['id'];

    if (deleteComment($commentId)) {
        echo "Content deleted successfully";
        $_SESSION['flash_message'] = "Deleted successfully";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        // header("Location: user_details.php");
        exit();
    } else {
        echo "Error deleting content";
    }
} else {
    echo "Invalid content ID";
}

if ($deletionSuccessful) {
    echo '<script>
            Swal.fire({
               icon: "success",
               title: "Content deleted successfully!",
               showConfirmButton: false,
               timer: 1500
            });
         </script>';
}
$conn->close();

?>