<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<?php

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {

    $fileId = $_GET['id'];
    $fileId = filter_var($fileId, FILTER_SANITIZE_NUMBER_INT);

    $sql = "SELECT image FROM content WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $fileId);

    $stmt->execute();
    $stmt->bind_result($filePath);

    $stmt->fetch();

    $stmt->close();

    $sqlDelete = "DELETE FROM content WHERE id = ?";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bind_param("i", $fileId);

    if ($stmtDelete->execute()) {
        $deletionSuccessful = true;
        $_SESSION['flash_message'] = "Deleted successfully";
        if (!empty($filePath) && file_exists($filePath)) {
            unlink($filePath);
        }
    } else {
        $deletionSuccessful = false;
        echo "Error deleting file: " . $conn->error;
    }
    $stmtDelete->close();

    header('Location: index.php');
    exit();
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