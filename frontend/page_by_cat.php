<?php
include 'db_connection.php';
include 'excerpt.php';

$sql = "SELECT * FROM content";
$result = $conn->query($sql);

$sqlCategories = "SELECT * FROM categories";
$resultCategories = $conn->query($sqlCategories);

$sqlTags = "SELECT * FROM tags";
$resultTags = $conn->query($sqlTags);
?>

<!-- **************HEADER*************** -->
<?php include "layout/head.php"; ?>
<!-- **************HEADER*************** -->

<body class="bg-gray-100 w-screen p-0 m-0">
  <div>
    <!-- **************NAV BAR*************** -->
    <?php include "layout/nav_bar.php"; ?>
    <!-- **************NAV BAR*************** -->
  </div>
  <main class="w-full mt-16">

    <?php
    include 'db_connection.php';

    if (isset($_GET['id'])) {
      $categoryId = $_GET['id'];

      $categoryQuery = "SELECT * FROM categories WHERE id = $categoryId";
      $categoryResult = $conn->query($categoryQuery);

      if ($categoryResult->num_rows > 0) {
        $category = $categoryResult->fetch_assoc();
        ?>
        <div class=" container mx-auto flex ">
          <div class="w-9/12">

            <!-- ******Show specific  Category name******* -->
            <div class="p-2 rounded-md shadow-md border border-gray-300 mt-2 text-center">
              <h1><span class="font-semibold text-gray-600">Category :</span>
                <span class="font-bold text-gray-600">
                  <?php echo $category['name']; ?>
                </span>
              </h1>
            </div>

            <div class="p-4 rounded-md shadow-md border border-gray-300 flex flex-wrap justify-between mt-2">
              <?php

              $contentQuery = "SELECT * FROM content WHERE category_id = $categoryId";
              $contentResult = $conn->query($contentQuery);

              if ($contentResult->num_rows > 0) {

                foreach ($contentResult as $content) {
                  ?>
                  <div class="mb-4 w-1/3 ">
                    <div class="m-2 content-item rounded bg-indigo-100 p-2 border border-gray-300 shadow">
                      <div class="w-full">
                        <div class="m-1 p-1 content-item rounded bg-indigo-100 "
                          data-category-id="<?php echo $row['category_id']; ?>">

                          <div class="mb-3 border-l-4 border-green-500">
                            <!-- <span class="font-bold">Title:</span> -->
                            <span class="ml-2 font-semibold  text-gray-600">
                              <?php echo $content["title"]; ?>
                            </span><br>
                          </div>

                          <!-- <img class=" h-40 w-full border border-gray-400  rounded " src="<?php echo $content["image"]; ?>" alt=""> -->
                          <?php echo '<img class="h-40 w-full border border-gray-400  rounded" src="../backend/' . $content['image'] . '" alt="Logo">'; ?>

                          <div class="flex justify-between border-b border-gray-400 py-2">
                            <div class="flex gap-6 w-full">
                              <div class="font-semibold">
                                <span class="font-semibold text-gray-600 text-sm"><i
                                    class="fa-regular fa-calendar-days"></i></span>
                                <span class="text-gray-600 text-sm">
                                  <?php
                                  $updatedAt = strtotime($content["updated_at"]);
                                  echo date("F j, Y", $updatedAt); // Adjust the format as needed
                                  ?>
                                </span>
                                <br>
                              </div>
                              <div class="text-gray-600">
                                <span class="text-sm text-gray-600"><i class="fa-solid fa-clock"></i></span>
                                <span class="font-semibold text-sm">
                                  <?php echo $content["read_time"]; ?>
                                </span>
                                <span class="font-semibold text-sm ">min read</span>
                              </div>
                            </div>
                          </div>

                          <!-- *************Description with excerpt*********** -->
                          <div class=" border-gray-400 py-2 text-gray-800 text-lg text-semibold">
                            <!-- <span class="font-bold">Description:</span> -->
                            <?php
                            $excerpt = generateExcerpt($content["description"]);
                            echo $excerpt;
                            ?>
                          </div>


                          <!--******************** Buttons ********************-->
                          <div class="flex mt-4 justify-end">
                            <!-- Show Details Button -->
                            <button onclick="showDetails(<?php echo $content['id']; ?>)"
                              class="border border-indigo-400 rounded-3xl text-gray-600 px-4 py-1 hover:bg-indigo-400 transition hover:text-gray-100">Show
                              Details</button>
                            <!-- Edit Content Button -->
                            <script>
                              function showDetails(contentId) {
                                window.location.href = 'user_details.php?id=' + contentId;
                              }
                            </script>
                          </div>
                        </diV>
                      </diV>
                    </diV>
                  </div>
                <?php
                }
              } else {
                echo "<p>No content found for this category.</p>";
              }
      } else {
        echo "<p>Category not found.</p>";
      }
    } else {
      echo "<p>Invalid request. Please provide a category ID.</p>";
    }
    ?>
        </div>
        <div class="text-right font-bold mr-10 flex justify-center my-2 "><a
            class="border border-indigo-400 rounded-3xl text-gray-600 px-4 py-1 hover:bg-indigo-400 transition hover:text-gray-100"
            href="index.php"><i class="fa-solid fa-hand-point-left"></i> &nbsp;Home</a>
        </div>
      </div>

      <!-- **************SIDEBAR*************** -->
      <?php include "layout/sidebar.php"; ?>
      <!-- **************SIDEBAR*************** -->
    </div>
    </div>

  </main>
  <!-- ************FOOTER************** -->
  <?php include "layout/footer.php"; ?>
  <!-- ************FOOTER************** -->
</body>

</html>
<?php
// Close the connection
$conn->close();
?>