<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<?php

include 'db_connection.php';

function deleteTag($tagId)
{
    global $conn;
    $conn->begin_transaction();

    try {
        $sqlDeleteContent = "DELETE FROM content WHERE tag_id = $tagId";
        $conn->query($sqlDeleteContent);

        $sqlDeleteTag = "DELETE FROM tags WHERE id = $tagId";
        $conn->query($sqlDeleteTag);
        $conn->commit();

        return true;
    } catch (Exception $e) {
        $conn->rollback();

        return false;
    }

}

if (isset($_GET['id'])) {
    $tagId = $_GET['id'];

    if (deleteTag($tagId)) {
        echo "Content deleted successfully";
        $_SESSION['flash_message'] = "Deleted successfully";
        header("Location: tags.php");
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