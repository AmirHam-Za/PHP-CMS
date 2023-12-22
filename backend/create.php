<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}
?>
<?php include 'layout/header.php'; ?>

<body>
    <div class="flex flex-col">
        <div class="">
            <?php include 'layout/nav.php'; ?>
        </div>

        <div class="flex">
            <div class="">
                <?php include 'layout/sidebar.php'; ?>
            </div>
            <div class="p-2 ml-64 mt-12">
                <?php
                include 'db_connection.php';
                // Function to delete a user by ID
                function deleteUser($contentId)
                {
                    global $conn;

                    $contentId = (int) $contentId;

                    $sql = "DELETE FROM users WHERE id = $contentId";

                    if ($conn->query($sql) === TRUE) {
                        return true;
                    } else {
                        return false;
                    }
                }
                ?>

                <body class="bg-gray-100">
                    <!-- *****************BODY CONTENT AREA********************** -->
                    <div class="mt-4 max-w-md mx-auto bg-indigo-200 p-4 rounded-md shadow-md mb-1 text-center">
                        <h2 class="text-2xl font-bold text-center text-slate-500">Create New Content</h2>

                    </div>
                    <div class="max-w-md mx-auto bg-white p-4 rounded-md shadow-md">

                        <div class="mx-auto bg-purple-100 p-4 rounded-md shadow mt-3">
                            <!-- Create User Form -->

                            <form action="insert_data.php" method="post" enctype="multipart/form-data">

                                <label class="text-gray-600 text-sm font-semibold" for="title">Title:</label><br>
                                <input class="h-8 rounded mb-2" type="text" name="title" id="title" required><br>

                                <label class="text-gray-600 text-sm font-semibold" for="image">Image:</label><br>
                                <input class="h-8 rounded mb-2" type="file" name="image" id="image" required><br>

                                <label class="text-gray-600 text-sm font-semibold" for="read_time">Read
                                    Time:</label><br>
                                <input class="h-8 rounded mb-2" type="text" name="read_time" id="read_time"
                                    required><br>

                                <label class="text-gray-600 text-sm font-semibold"
                                    for="description">Description:</label><br>
                                <input class="h-8 rounded mb-2" type="text" name="description" id="description"
                                    required><br>





                                <div class="relative z-0 w-full mb-5 group">
                                    <!--************  Fetch tag from the "categories" table*********************-->
                                    <?php
                                    $sqlCategories = "SELECT id, name FROM categories";
                                    $resultCategories = $conn->query($sqlCategories);
                                    ?>

                                    <!--************ Select Option for category table*********************-->
                                    <label class="text-gray-600 text-sm font-semibold" for="selectCategory">Select
                                        Category:</label><br>
                                    <select id="selectCategory" onchange="displaySelectedCategory()">
                                        <option class="h-8 rounded mb-2" value="">Select Category</option>
                                        <?php while ($category = $resultCategories->fetch_assoc()): ?>
                                            <option class="h-8 rounded mb-2" value="<?php echo $category['id']; ?>">
                                                <?php echo $category['name']; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>


                                    <!--************ Input Field to Display Selected Category*********************-->
                                    <div>
                                        <label class="text-gray-600 text-sm font-semibold"
                                            for="selectedCategory">Selected Category:</label><br>
                                        <input class="h-8 rounded mb-2" type="text" name="category_id"
                                            id="selectedCategory" readonly><br>
                                    </div>
                                    <!--************ JS function for Category selection*********************-->
                                    <script>
                                        function displaySelectedCategory() {
                                            // Get the selected category ID
                                            var selectedCategoryId = document.getElementById('selectCategory').value;

                                            // Display the selected category name in the input field
                                            document.getElementById('selectedCategory').value = selectedCategoryId;
                                        }
                                    </script>
                                </div>


                                <div class="relative z-0 w-full mb-5 group">
                                    <!--************  Fetch tag from the "tags" table*********************-->
                                    <?php
                                    $sqlTags = "SELECT id, name FROM tags";
                                    $resultTags = $conn->query($sqlTags);
                                    ?>

                                    <!--************ Select Option for tag table*********************-->
                                    <label class="text-gray-600 text-sm font-semibold" for="selectTag">Select
                                        Tag:</label><br>
                                    <select id="selectTag" onchange="displaySelectedTag()">
                                        <option class="h-8 rounded mb-2" value="">Select Tag</option>
                                        <?php while ($tag = $resultTags->fetch_assoc()): ?>
                                            <option class="h-8 rounded mb-2" value="<?php echo $tag['id']; ?>">
                                                <?php echo $tag['name']; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>


                                    <!--************ Input Field to Display Selected Category*********************-->
                                    <div>
                                        <label class="text-gray-600 text-sm font-semibold" for="selectedTag">Selected
                                            Tag:</label><br>
                                        <input class="h-8 rounded mb-2" type="text" name="tag_id" id="selectedTag"
                                            readonly><br>

                                    </div>
                                    <!--************ JS function for Category selection*********************-->

                                    <script>
                                        function displaySelectedTag() {
                                            // Get the selected tag ID
                                            var selectedTagId = document.getElementById('selectTag').value;

                                            // Display the selected tag name in the input field
                                            document.getElementById('selectedTag').value = selectedTagId;
                                        }
                                    </script>
                                </div>

                                <button type="submit" name="user" value="Submit"
                                    class="border border-indigo-400 rounded-3xl text-gray-600 px-4 py-1 hover:bg-indigo-400 transition hover:text-gray-100">
                                    Create Category
                                </button>
                            </form>
                        </div>

                    </div>

                </body>
                <?php
                // Close the connection
                $conn->close();

                ?>
            </div>
        </div>
    </div>
</body>
<script src="dashboard/custom.js"></script>

</html>