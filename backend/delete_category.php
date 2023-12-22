<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<?php
include 'db_connection.php';
function deleteCategory($categoryId)
{
    global $conn;


    //transaction
    $conn->begin_transaction();

    try {
        $sqlDeleteContent = "DELETE FROM content WHERE category_id = $categoryId";
        $conn->query($sqlDeleteContent);

        $sqlDeleteCategory = "DELETE FROM categories WHERE id = $categoryId";
        $conn->query($sqlDeleteCategory);

        $conn->commit();

        return true;
    } catch (Exception $e) {
        $conn->rollback();

        return false;
    }

}

if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    if (deleteCategory($categoryId)) {
        echo "Content deleted successfully";
        $_SESSION['flash_message'] = "Deleted successfully";
        header("Location: categories.php");
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