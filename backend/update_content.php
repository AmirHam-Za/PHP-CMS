<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $currentLogo = $_POST["current_logo_path"];
    $readTime = $_POST["read_time"];
    $description = $_POST["description"];
    $categoryId = $_POST["category_id"];
    $tagId = $_POST["tag_id"];

    $idd = 'hellooooooo';
    echo ($idd . '<br>');
    // echo ($currentImage);
    echo 'Hellooooo';
    // Handle file upload
    if ($_FILES['image']['size'] > 0) {
        // Delete the previous file
        unlink($currentLogo);

        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));


        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        if (file_exists($targetFile)) {
            $uploadOk = 0;
        }

        if ($_FILES["image"]["size"] > 500000) {
            $uploadOk = 0;
        }

        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {

                $sql = "UPDATE content SET title = '$title', image = '$targetFile', read_time = '$readTime', description = '$description', category_id = '$categoryId', tag_id = '$tagId' WHERE id = $id"; // Assuming you have an identifier for the file

                if ($conn->query($sql) === TRUE) {
                    // echo "Data updated successfully.";
                    $_SESSION['flash_message'] = "Updated successfully";
                } else {
                    echo "Error updating data: " . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {

        $sql = "UPDATE content SET title = '$title', read_time = '$readTime', description = '$description', category_id = '$categoryId', tag_id = '$tagId' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "Data updated successfully.";

            $_SESSION['flash_message'] = "Updated successfully";
        } else {
            echo "Error updating data: " . $conn->error;
        }
    }

    // header("location: index.php?id=$id");
    header("location: index.php");
}

$conn->close();

?>