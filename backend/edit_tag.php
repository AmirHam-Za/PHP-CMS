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

            <body class="bg-gray-100">
                <!--*******************************************
    page's main contents 
    ********************************************** -->
                <?php
                // Function to fetch footer details by ID
                function getTagDetails($tagId)
                {
                    global $conn;

                    $tagId = (int) $tagId;

                    $sql = "SELECT * FROM tags WHERE id = $tagId";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        return $result->fetch_assoc();
                    } else {
                        return null;
                    }
                }

                function updateTag($tagId, $name)
                {
                    global $conn;

                    $tagId = (int) $tagId;
                    $name = $conn->real_escape_string($name);



                    $sql = "UPDATE tags SET name='$name' WHERE id=$tagId";

                    if ($conn->query($sql) === TRUE) {
                        return true;
                    } else {
                        return false;
                    }
                }
                // Check if the footer ID is set in the query parameters
                if (isset($_GET['id'])) {
                    $tagId = $_GET['id'];

                    $tagDetails = getTagDetails($tagId);

                    if (!$tagDetails) {
                        echo "Content not found";
                        exit();
                    }

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $name = $_POST["name"];


                        if (updateTag($tagId, $name)) {

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
                    exit();
                }
                ?>
                <div class="mx-auto border border-gray-400 p-4 rounded-md shadow-md">
                    <h2 class="text-3xl font-bold mb-4 text-center text-gray-600">Edit Tag</h2>
                    <form method="post">
                        <div class="">
                            <div class="mb-4 bg-gray-200 rounded p-2">
                                <label class="block text-lg text-gray-600 font-bold mb-2 pl-2" for="name">Name:</label>
                                <input type="text" id="name" name="name" value="<?php echo $tagDetails['name']; ?>"
                                    class="p-2 border rounded w-full" required>
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