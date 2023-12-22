<?php
include 'db_connection.php';
include 'excerpt.php';


$sql = "SELECT * FROM content";
$result = $conn->query($sql);

?>
<!-- **************HEADER*************** -->
<?php include "layout/head.php"; ?>
<!-- **************HEADER*************** -->

<body class="bg-gray-200 w-screen p-0 m-0">

  <!-- **************NAV BAR*************** -->
  <?php include "layout/nav_bar.php"; ?>
  <!-- **************NAV BAR*************** -->

  <main class="w-full mt-16 ">

    <div class=" container mx-auto flex">
      <div class=" w-9/12 ">
        <div class="p-4 rounded-md shadow-md bg-gray-100 border  border-gray-300 flex flex-wrap justify-between mt-2 ">
          <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
              <div class="mb-4 w-1/3">
                <div class="m-2 content-item rounded bg-indigo-100 p-2 border border-gray-300 shadow"
                  data-category-id="<?php echo $row['category_id']; ?>">
                  <div class="mb-3 border-l-4 border-green-500">
                    <!-- <span class="font-bold">Title:</span> -->
                    <span class="ml-2 font-semibold text-xl text-gray-600">
                      <?php echo $row["title"]; ?>
                    </span><br>
                  </div>

                  <!-- <span class="font-bold">Image:</span><br> -->
                  <!-- <img class=" h-40 w-full border border-gray-400  rounded " src="<?php echo $row["image"]; ?>" alt=""> -->
                  <?php echo '<img class="h-40 w-full border border-gray-400  rounded" src="../backend/' . $row['image'] . '" alt="Logo">'; ?>


                  <div class="flex justify-between border-b border-gray-400 py-2">
                    <div class="flex gap-6 w-full">
                      <div class="font-semibold">
                        <span class="font-semibold text-gray-600 text-sm"><i class="fa-regular fa-calendar-days"></i></span>
                        <span class="text-gray-600 text-sm">
                          <?php
                          $updatedAt = strtotime($row["updated_at"]);
                          echo date("F j, Y", $updatedAt); 
                          ?>
                        </span>
                        <br>
                      </div>
                      <div class="text-gray-600">
                        <span class="text-sm text-gray-600"><i class="fa-solid fa-clock"></i></span>
                        <span class="font-semibold text-sm">
                          <?php echo $row["read_time"]; ?>
                        </span>
                        <span class="font-semibold text-sm ">min read</span>
                      </div>
                    </div>
                  </div>

                  <!-- ***********Description with excerpt*********** -->
                  <div class=" border-gray-400 py-2 text-gray-800 text-lg text-semibold">
                    <?php
                    $excerpt = generateExcerpt($row["description"]);
                    echo $excerpt;
                    
                    ?>
                  </div>
                  <!-- Buttons -->
                  <div class="flex mt-4 justify-end">
                    <!-- Show Details Button -->
                    <button onclick="showDetails(<?php echo $row['id']; ?>)"
                      class="border border-indigo-400 rounded-3xl text-gray-600 px-4 py-1 hover:bg-indigo-400 transition hover:text-gray-100">Show
                      Details</button>
                    <!-- Edit Content Button -->
                  </div>
                  <script>
                    function showDetails(contentId) {
                      // Redirect to user_details.php with the content ID
                      window.location.href = 'user_details.php?id=' + contentId;
                    }
                  </script>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <p>No data found</p>
          <?php endif; ?>

        </div>
        <!-- <div class="text-right font-bold mr-10 flex justify-center my-2 "><a
            class="border border-indigo-400 rounded-3xl text-gray-600 px-4 py-1 hover:bg-indigo-400 transition hover:text-gray-100"
            href="index.php"><i class="fa-solid fa-hand-point-left"></i> &nbsp;Home</a>
        </div> -->
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
$conn->close();
?>