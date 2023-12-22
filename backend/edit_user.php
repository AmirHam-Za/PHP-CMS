<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}
include 'db_connection.php';
?>
<?php include 'layout/header.php'; ?>


<div class="flex flex-col">
  <div class="">
    <?php include 'layout/nav.php'; ?>
  </div>

  <div class="flex">
    <div class="">
      <?php include 'layout/sidebar.php'; ?>
    </div>
    <div class="w-full p-2 ml-64 mt-16">

      <div class="bg-gray-100">
        <!-- *********************************************
    page's main contents 
    ********************************************** -->
        <?php
        // Function to fetch user details by ID
        function getUserDetails($contentId)
        {
          global $conn;

          $contentId = (int) $contentId;

          $sql = "SELECT * FROM content WHERE id = $contentId";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            return $result->fetch_assoc();
          } else {
            return null;
          }
        }

        // Check if the user ID is set in the query parameters
        if (isset($_GET['id'])) {
          $contentId = $_GET['id'];

          $contentDetail = getUserDetails($contentId);

          if (!$contentDetail) {
            echo "Content not found";
            exit();
          }

          ?>
          <div class="w-full">

          </div>
          <?php
        } else {
          echo "Invalid Content ID";
          exit();
        }

        ?>
        <div class="mx-auto border border-gray-400 p-4 rounded-md shadow-md">
          <h2 class="text-3xl font-bold mb-4 text-center text-gray-600">Edit Content</h2>
          <form action="update_content.php" method="post" enctype="multipart/form-data">
            <div class="">
              <div class="mb-4 bg-gray-200 rounded p-2">
                <label class="block text-lg text-gray-600 font-bold mb-2 pl-2" for="id">Id to be hidden</label>
                <input type="text" id="id" name="id" value="<?php echo $contentDetail['id']; ?>"
                  class="p-2 border rounded w-full">
              </div>

              <div class="mb-4 bg-gray-200 rounded p-2">
                <label class="block text-lg text-gray-600 font-bold mb-2 pl-2" for="currentLogo">Current logo path
                  to be hidden</label>
                <input type="text" id="currentLogo" name="current_logo_path"
                  value="<?php echo $contentDetail['image']; ?>" readonly class="p-2 border rounded w-full">
              </div>

              <div class="mb-4 bg-gray-200 rounded p-2">
                <label class="block text-lg text-gray-600 font-bold mb-2 pl-2" for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?php echo $contentDetail['title']; ?>"
                  class="p-2 border rounded w-full" required>
              </div>

              <div class="mb-4 bg-gray-200 rounded p-2">
                <label class="block text-lg text-gray-600 font-bold mb-2 pl-2" for="img">Image:</label>
                <input type="file" id="img" name="image" accept="image/*" class="p-2 border rounded w-full">
              </div>

              <div class="mb-4 bg-gray-200 rounded p-2">
                <label class="block text-lg text-gray-600 font-bold mb-2 pl-2" for="readTime">Reading Time:</label>
                <input type="number" id="readTime" name="read_time" value="<?php echo $contentDetail['read_time']; ?>"
                  class="p-2 border rounded w-full" required>
              </div>

              <div class="mb-4 bg-gray-200 rounded p-2">
                <label class="block text-lg text-gray-600 font-bold mb-2 pl-2" for="description">Description:</label>
                <input class="p-2 border rounded w-full" type="text" id="description" name="description"
                  value="<?php echo $contentDetail['description']; ?>" required>
              </div>

              <div class="relative z-0 w-full mb-5 group flex gap-4 bg-gray-200 rounded p-2">
                <div class="w-1/2">
                  <!--************  Fetch tag from the "categories" table*********************-->
                  <?php
                  $sqlCategories = "SELECT id, name FROM categories";
                  $resultCategories = $conn->query($sqlCategories);
                  ?>

                  <!--************ Select Option for category table*********************-->
                  <label class="block text-lg text-gray-600 font-bold mb-2 pl-2" for="selectCategory">Select
                    Category:</label>
                  <select class="p-2 border rounded w-full" id="selectCategory" onchange="displaySelectedCategory()">
                    <option value="">Select Category</option>
                    <?php while ($category = $resultCategories->fetch_assoc()): ?>
                      <option value="<?php echo $category['id']; ?>">
                        <?php echo $category['name']; ?>
                      </option>
                    <?php endwhile; ?>
                  </select>
                </div>


                <!--************ textarea Field to Display Selected Category*********************-->
                <div class="w-1/2">
                  <label class="block text-lg text-gray-600 font-bold mb-2 pl-2" for="selectedCategory">Selected
                    Category:</label>
                  <input class="p-2 border rounded w-full" name="category_id" type="text" id="selectedCategory"
                    value="<?php echo $contentDetail['category_id']; ?>" readonly>
                </div>
                <!--************ JS function for Category selection*********************-->
                <script>
                  function displaySelectedCategory() {
                    var selectedCategoryId = document.getElementById('selectCategory').value;

                    document.getElementById('selectedCategory').value = selectedCategoryId;
                  }
                </script>
              </div>


              <div class="relative z-0 w-full group flex gap-4 mb-4 bg-gray-200 rounded p-2">
                <div class="w-1/2">
                  <!--************  Fetch tag from the "tags" table*********************-->
                  <?php
                  $sqlTags = "SELECT id, name FROM tags";
                  $resultTags = $conn->query($sqlTags);
                  ?>

                  <!--************ Select Option for tag table*********************-->
                  <label class="block text-lg text-gray-600 font-bold mb-2 pl-2" for="selectTag">Select Tag:</label>
                  <select class="p-2 border rounded w-full" id="selectTag" onchange="displaySelectedTag()">
                    <option value="">Select Tag</option>
                    <?php while ($tag = $resultTags->fetch_assoc()): ?>
                      <option value="<?php echo $tag['id']; ?>">
                        <?php echo $tag['name']; ?>
                      </option>
                    <?php endwhile; ?>
                  </select>
                </div>


                <!--************ Input Field to Display Selected Category*********************-->
                <div class="w-1/2">
                  <label class="block text-lg text-gray-600 font-bold mb-2 pl-2" for="selectedTag">Selected Tag:</label>
                  <input class="p-2 border rounded w-full" name="tag_id" type="text" id="selectedTag"
                    value="<?php echo $contentDetail['tag_id']; ?>" readonly>
                </div>
                <!--************ JS function for Category selection*********************-->

                <script>
                  function displaySelectedTag() {
                    var selectedTagId = document.getElementById('selectTag').value;
                    document.getElementById('selectedTag').value = selectedTagId;
                  }
                </script>
              </div>
              <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            </div>
          </form>
        </div>
        <?php
        $conn->close();
        ?>
      </div>
    </div>
  </div>
</div>
<script src="dashboard/custom.js"></script>

</html>