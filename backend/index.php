<?php include 'layout/header.php'; ?>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: ../login.php');
  exit();
}
include 'db_connection.php';
?>
<div class="flex flex-col">
  <div class="">
    <?php include 'layout/nav.php'; ?>
  </div>

  <div class="flex">
    <div class="">
      <!-- **********SIDEBAR*********** -->
      <?php include 'layout/sidebar.php'; ?>
      <!-- **********SIDEBAR*********** -->
    </div>
    <div class="p-2 ml-64 mt-12 w-full">

      <body class="bg-gray-200">
        <div class="">
          <div class=" p-4 mt-4 rounded-md shadow-md bg-gray-100 border  border-gray-00">
            <a href="create.php"
              class="border border-green-500 rounded-3xl text-gray-600 px-4 py-1 hover:bg-green-500 transition hover:text-gray-100  text-center">
              Create New Content</a href="create.php">
          </div>
        </div>
        <div class="p-4 mt-4 rounded-md shadow-md bg-gray-100 border  border-gray-300">



          <div class="">
            <?php
            if (isset($_SESSION['flash_message'])) {
              echo '<div id="flashMessage" class="flash-message absolute top-4 right-6 px-16 bg-gray-100  text-center rounded border-l-8  border-green-500 z-10 h-12 flex items-center animate__animated animate__tada  animate__slow"><p class=" font-bold text-green-500">' . $_SESSION['flash_message'] . '</p></div>';

              unset($_SESSION['flash_message']);
              echo '<script>
                setTimeout(function() {
                    document.getElementById("flashMessage").style.display = "none";
                }, 2500);
            </script>';
            }
            ?>
            <div class="">
            </div>
          </div>

          <div class="w-full">
            <?php
            $sql = "SELECT * FROM content";
            $result = $conn->query($sql);

            if ($result->num_rows > 0): ?>

              <!-- *******************CONTENT DATA TABLE*************************** -->
              <table class="w-full  text-left rtl:text-right text-gray-500 ">
                <thead class="text-center text-sm bg-indigo-200 rounded text-gray-700 uppercase  dark:bg-gray-700 ">
                  <tr>
                    <th scope="col" class="px-6 py-3">
                      Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Read Time
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Tag
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Action
                    </th>
                  </tr>
                </thead>
                <?php while ($row = $result->fetch_assoc()): ?>
                  <tbody>
                    <tr
                      class="bg-white dark:bg-gray-800 border-b text-center border-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-600">
                      <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <span class="ml-2 mb-2 font-semibold  text-gray-600">
                          <?php echo $row["title"]; ?>
                        </span>
                      </th>
                      <td class="px-6 py-4">
                        <span class="ml-2 mb-2 font-semibold  text-gray-600">
                          <?php echo $row["read_time"]; ?><br>
                        </span>
                      </td>
                      <td class="px-6 py-4">
                        <span class="ml-2 mb-2 font-semibold  text-gray-600">
                          <?php echo $row["description"]; ?><br>
                        </span>
                      </td>
                      <td class="px-6 py-4">
                        <?php
                        // Query to fetch category details
                        $categoryId = $row['category_id'];
                        $sqlCategory = "SELECT name FROM categories WHERE id = $categoryId";
                        $resultCategory = $conn->query($sqlCategory);
                        $category = $resultCategory->fetch_assoc();

                        // Display category
                        ?>
                        <span class="ml-2 mb-2 font-semibold  text-gray-600">
                          <?php echo $category['name']; ?><br>
                        </span>
                        <!-- echo "<p>Category: {$category['name']}</p>"; -->
                      </td>
                      <td class="px-6 py-4">
                        <?php
                        // Query to fetch tag details
                        $tagId = $row['tag_id'];
                        $sqlTag = "SELECT name FROM tags WHERE id = $tagId";
                        $resultTag = $conn->query($sqlTag);
                        $tag = $resultTag->fetch_assoc();

                        // Display tag
                        ?>

                        <span class="ml-2 mb-2 font-semibold  text-gray-600">
                          <?php echo $tag['name']; ?><br>
                        </span>
                        <!-- echo "<p>Tag: {$tag['name']}</p>"; -->
                      </td>
                      <td class="">
                        <div class="w-16 h-16">
                          <img class="" src="<?php echo $row["image"]; ?>" alt="">
                        </div>
                      </td>
                      <td class="px-6 py-4 text-right">
                        <div class="">
                          <!-- Edit User Button -->
                          <button>
                            <a href="edit_user.php?id=<?php echo $row['id']; ?>"
                              class="ml-2 text-center border border-yellow-500 rounded-3xl text-gray-600 px-4 py-1 hover:bg-yellow-500 transition hover:text-gray-100 flex items-center mb-2">Edit
                            </a>
                          </button>


                          <!-- Delete Content Button -->
                          <button onclick="deleteUserJs(<?php echo $row['id']; ?>)"
                            class="ml-2 text-center border border-red-500 rounded-3xl text-gray-600 px-4 py-1 hover:bg-red-500 transition hover:text-gray-100">Delete
                          </button>
                          <script>
                            function deleteUserJs(userId) {
                              Swal.fire({
                                title: 'Are you sure?',
                                text: 'You won\'t be able to revert this!',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                              }).then((result) => {
                                if (result.isConfirmed) {

                                  window.location.href = 'delete_user.php?id=' + userId;
                                }
                              });
                            }
                          </script>
                        </div>
                      </td>
                    </tr>

                  </tbody>
                <?php endwhile; ?>
              <?php else: ?>
                <p>No data found</p>
              <?php endif; ?>
              <script>
                function showDetails(contentId) {
                  window.location.href = 'user_details.php?id=' + contentId;
                }
              </script>
            </table>
          </div>
        </div>
      </body>
      <?php
      $conn->close();
      ?>
    </div>
  </div>
</div>
</body>
<script src="dashboard/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</html>