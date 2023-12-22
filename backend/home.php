<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="dashboard/style.css">
  <title>Document</title>
</head>

<body>
  <div class="flex flex-col">
    <div class="">
      <?php
      include 'dashboard/nav.php';
      ?>
    </div>

    <div class="flex">
      <div class="">
        <?php include 'dashboard/sidebar.php'; ?>
      </div>
      <div class="p-2">
        <?php
        session_start();
        if (!isset($_SESSION['user_id'])) {
          header('Location: login.php');
          exit();
        }

        include 'db_connection.php';
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

        <body class="bg-gray-100 p-8">
          <div class="max-w-md mx-auto bg-green-200 p-4 rounded-md shadow-md mb-1 text-center">
            <a href="create.php" class="bg-green-500 text-white px-4 py-2 rounded-full mt-2">
              Create Content</a href="create.php">
          </div>
          <div class="max-w-md mx-auto bg-white p-4 rounded-md shadow-md">
            <?php
            $sql = "SELECT * FROM content";
            $result = $conn->query($sql);

            if ($result->num_rows > 0): ?>
              <?php while ($row = $result->fetch_assoc()): ?>
                <div class="mb-4">
                  <span class="font-bold">Title:</span>
                  <?php echo $row["title"]; ?><br>
                  <span class="font-bold">Image:</span><br>
                  <img src="<?php echo $row["image"]; ?>" alt="">
                  <span class="font-bold">Read Time:</span>
                  <?php echo $row["read_time"]; ?><br>
                  <span class="font-bold">Description:</span>
                  <?php echo $row["description"]; ?><br>
                  <?php
                  $categoryId = $row['category_id'];
                  $sqlCategory = "SELECT name FROM categories WHERE id = $categoryId";
                  $resultCategory = $conn->query($sqlCategory);
                  $category = $resultCategory->fetch_assoc();

                  ?>
                  <span class="font-bold">Category:</span>
                  <?php echo $category['name']; ?><br>
                  <?php
                  $tagId = $row['tag_id'];
                  $sqlTag = "SELECT name FROM tags WHERE id = $tagId";
                  $resultTag = $conn->query($sqlTag);
                  $tag = $resultTag->fetch_assoc();

                  ?>
                  <span class="font-bold">Category:</span>
                  <?php echo $tag['name']; ?><br>
                  <div class="flex mt-2">

                    <button class="bg-green-500 text-white px-4 py-2 rounded">
                      <a class="" href="user_details.php?id=<?php echo $row['id']; ?>"
                        class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Show Details</a>
                    </button>
                    <!-- ************************************************ -->

                    <!-- Edit User Button -->
                    <a href="edit_user.php?id=<?php echo $row['id']; ?>"
                      class="bg-yellow-500 text-white px-4 py-2 rounded mr-2">Edit Content</a>
                    <!-- Delete Content Button -->
                    <button onclick="deleteUser(<?php echo $row['id']; ?>)"
                      class="bg-red-500 text-white px-4 py-2 rounded">Delete User</button>
                  </div>
                  <hr class="my-2">

                </div>
              <?php endwhile; ?>
            <?php else: ?>
              <p>No data found</p>
            <?php endif; ?>
            <!-- Details container -->
            <div id="details-container" class="hidden mt-4">
              <!-- Details will be shown here using JavaScript -->
            </div>
            <script>
              function showDetails(userId) {
                window.location.href = 'user_details.php?id=' + userId;
              }

              function deleteUser(userId) {
                var confirmation = confirm("Are you sure you want to delete this Content?");
                if (confirmation) {
                  window.location.href = 'delete_user.php?id=' + userId;
                }
              }
            </script>
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

</html>