<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<?php
include 'layout/header.php';
include 'db_connection.php';
?>

<div class="flex flex-col">
    <div class="">
        <?php include 'layout/nav.php'; ?>
    </div>
    <div class="flex">
        <div class="">
            <?php include 'layout/sidebar.php'; ?>
        </div>
        <div class="w-full p-2 ml-64 mt-16">

            <?php
            ?>

            <body class="bg-gray-100">
                <!--*******************************************
    page's main contents 
    ********************************************** -->
                <?php


                // Function to fetch footer details by ID
                function getFooterDetails($footerId)
                {
                    global $conn;

                    $footerId = (int) $footerId;

                    $sql = "SELECT * FROM comments WHERE id = $footerId";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        return $result->fetch_assoc();
                    } else {
                        return null;
                    }
                }

                function updateFooter($footerId, $name, $comment, $postId)
                {
                    global $conn;

                    $footerId = (int) $footerId;
                    $name = $conn->real_escape_string($name);
                    $comment = $conn->real_escape_string($comment);
                    $postId = $conn->real_escape_string($postId);



                    $sql = "UPDATE comments SET name='$name', comment='$comment', post_id='$postId' WHERE id=$footerId";

                    if ($conn->query($sql) === TRUE) {
                        return true;
                    } else {
                        return false;
                    }
                }

                if (isset($_GET['id'])) {
                    $footerId = $_GET['id'];

                    $footerDetail = getFooterDetails($footerId);

                    if (!$footerDetail) {
                        echo "Content not found";
                        exit();
                    }
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $name = $_POST["name"];
                        $comment = $_POST["comment"];
                        $postId = $_POST["post_id"];


                        if (updateFooter($footerId, $name, $comment, $postId)) {
                            ?>
                            <div class="w-full">
                                <?php
                                $_SESSION['flash_message'] = "Updated successfully";
                                if (isset($_SESSION['flash_message'])) {


                                    // animated flash message
                                    echo '<div id="flashMessage" class="flash-message absolute top-4 right-6 px-16 bg-gray-100  text-center rounded border-l-8  border-green-500 z-10 h-12 flex items-center animate__animated animate__tada  animate__slow"><p class="text-xl font-bold text-green-500">' . $_SESSION['flash_message'] . '</p></div>';

                                    unset($_SESSION['flash_message']);

                                    echo '<script>
                                        setTimeout(function() {
                                            document.getElementById("flashMessage").style.display = "none";
                                        }, 2500);
                                    </script>';
                                }

                                ?>
                            </div>
                            <?php
                        } else {
                            echo "Error updating user";
                        }
                    }
                } else {
                    echo "Invalid Content ID";

                    // header("Location: comment.php");
                    exit();
                }
                ?>
                <div class="mx-auto border border-gray-400 p-4 rounded-md shadow-md">
                    <h2 class="text-3xl font-bold mb-4 text-center text-gray-600">Edit Commennt</h2>
                    <form method="post">
                        <div class="">
                            <div class="mb-4 bg-gray-200 rounded p-2">
                                <label class="block text-lg text-gray-600 font-bold mb-2 pl-2" for="postId">Post
                                    Id:</label>
                                <input type="text" id="postId" name="post_id"
                                    value="<?php echo $footerDetail['post_id']; ?>" class="p-2 border rounded w-full"
                                    required>
                            </div>

                            <div class="mb-4 bg-gray-200 rounded p-2">
                                <label class="block text-lg text-gray-600 font-bold mb-2 pl-2" for="name">Name:</label>
                                <input type="text" id="name" name="name" value="<?php echo $footerDetail['name']; ?>"
                                    class="p-2 border rounded w-full" required>
                            </div>

                            <div class="mb-4 bg-gray-200 rounded p-2">
                                <label class="block text-lg text-gray-600 font-bold mb-2 pl-2"
                                    for="comment">Name:</label>
                                <input type="text" id="comment" name="comment"
                                    value="<?php echo $footerDetail['comment']; ?>" class="p-2 border rounded w-full"
                                    required>
                            </div>
                            <button type="submit"
                                class="border border-indigo-400 rounded-3xl text-gray-600 px-4 py-1 hover:bg-indigo-400 transition hover:text-gray-100">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
                <?php
                $conn->close();
                ?>
        </div>
    </div>
</div>
</body>
<script src="dashboard/custom.js"></script>

</html>