<?php
  include 'db_connection.php';
  
  $sql = "SELECT * FROM content";
  $result = $conn->query($sql);
  
  $sqlCategories = "SELECT * FROM categories";
  $resultCategories = $conn->query($sqlCategories);
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Data</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  </head>
  <body class="bg-gray-100 p-8">

    <!-- Category Filter Dropdown -->
    <label for="categoryFilter">Filter by Category:</label>
    <select id="categoryFilter" onchange="filterContent()">
      <option value="all">All Categories</option>
      <?php while ($category = $resultCategories->fetch_assoc()): ?>
      <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
      <?php endwhile; ?>
    </select>
    <div class="max-w-md mx-auto bg-white p-4 rounded-md shadow-md">
      <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
      <div class="mb-4 content-item" data-category-id="<?php echo $row['category_id']; ?>">
        <span class="font-bold">Title:</span> <?php echo $row["title"]; ?><br>
        <span class="font-bold">Image:</span><br>
        <img src="<?php echo $row["image"]; ?>" alt="">
        <span class="font-bold">Read Time:</span> <?php echo $row["read_time"]; ?><br>
        <span class="font-bold">Description:</span> <?php echo $row["description"]; ?><br>
        <!-- Buttons -->
        <div class="flex mt-2">
          <!-- Show Details Button -->
          <button onclick="showDetails(<?php echo $row['id']; ?>)"
            class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Show Details</button>
          <!-- Edit Content Button -->

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
        function filterContent() {
            var selectedCategoryId = document.getElementById('categoryFilter').value;
            var contentItems = document.getElementsByClassName('content-item');
        
            for (var i = 0; i < contentItems.length; i++) {
                var itemCategoryId = contentItems[i].getAttribute('data-category-id');
        
                // Show or hide content items based on the selected category
                if (selectedCategoryId === 'all' || selectedCategoryId === itemCategoryId) {
                    contentItems[i].style.display = 'block';
                } else {
                    contentItems[i].style.display = 'none';
                }
            }
        }
        
        function showDetails(contentId) {
            // Redirect to user_details.php with the content ID
            window.location.href = 'user_details.php?id=' + contentId;
        }
      </script>
    </div>
  </body>
</html>
<?php
  // Close the connection
  $conn->close();
  ?>