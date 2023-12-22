<!-- ************************ -->
<!-- UPDATE                   -->
<!-- ************************ -->
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
    $name = $_POST["name"];
    $id = $_POST["id"];
    $currentLogo = $_POST["current_logo_path"];
    echo ($id . '<br>');
    echo ($name);
    echo 'Hellooooo';
    // Handle file upload
    if ($_FILES['logo_path']['size'] > 0) {
        // Delete the previous file
        unlink($currentLogo);

        $targetDir = "uploads";
        $targetFile = $targetDir . basename($_FILES["logo_path"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the image file is a actual image or fake image
        $check = getimagesize($_FILES["logo_path"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }


        if (file_exists($targetFile)) {
            $uploadOk = 0;
        }


        if ($_FILES["logo_path"]["size"] > 500000) {
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
            // If everything is ok, try to upload file
            if (move_uploaded_file($_FILES["logo_path"]["tmp_name"], $targetFile)) {

                $sql = "UPDATE header_footer SET name = '$name', logo_path = '$targetFile' WHERE id = $id "; // Assuming you have an identifier for the file
                if ($conn->query($sql) === TRUE) {
                    echo "Data updated successfully.";

                    $_SESSION['flash_message'] = "Updated successfully";
                } else {
                    echo "Error updating data: " . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        //  update data without changing the logo
        $sql = "UPDATE header_footer SET name = '$name' WHERE id = $id "; // Assuming you have an identifier for the file
        if ($conn->query($sql) === TRUE) {
            echo "Data updated successfully.";

            $_SESSION['flash_message'] = "Updated successfully";
        } else {
            echo "Error updating data: " . $conn->error;
        }
    }

    header("location: header_footer.php");
}

$conn->close();
?>