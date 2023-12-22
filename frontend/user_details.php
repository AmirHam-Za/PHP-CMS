<style>
  .thumb {
    min-height: 300px;
  }
</style>
<?php
include 'db_connection.php';
include 'excerpt.php';
?>
<!-- **************HEADER*************** -->
<?php include "layout/head.php"; ?>
<!-- **************HEADER*************** -->


<body class="bg-gray-100 w-screen p-0 m-0">
  <!-- **************NAV BAR*************** -->
  <?php include "layout/nav_bar.php"; ?>
  <!-- **************NAV BAR*************** -->
  </nav>
  <main class="w-full mt-16">
    <div class="container mx-auto flex">
      <div class="w-9/12">

        <!--************************************
            single page content
            **************************************-->
        <?php
        if (isset($_GET['id'])) {
          $contentId = $_GET['id'];

          $sql = "SELECT * FROM content WHERE id = $contentId";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            $content = $result->fetch_assoc();
          } else {
            $content = null;
          }
        } else {
          $content = null;
        }

        ?>
        <div class="p-4 rounded-md shadow-md border border-gray-300  mt-2">
          <div class=" bg-indigo-100 p-4 rounded-md shadow-md m-1 border border-gray-300  mt-2">
            <?php if ($content): ?>
              <div class="mb-4">
                <div class="mb-3  border-l-4 border-green-500  ">
                  <!-- <span class="font-bold ml-2">Title:</span> -->
                  <span class="ml-2 font-semibold text-2xl">
                    <?php echo $content["title"]; ?>
                  </span>
                </div>
                <!-- <span class="font-bold">Image:</span><br> -->
                <!-- <img class="thumb w-full border border-gray-400 shadow-md rounded "
                  src="<?php echo $content["image"]; ?>" alt="avatar"> -->
                <?php echo '<img class="thumb w-full h-80  border border-gray-400 shadow-md rounded" src="../backend/' . $content['image'] . '" alt="Logo">'; ?>
                <div class="flex justify-between border-b-2 border-gray-400 py-2">
                  <div class="flex gap-6 w-full">
                    <div class="font-semibold">
                      <span class="font-bold text-gray-600"><i class="fa-regular fa-calendar-days"></i></span>
                      <span class="text-gray-600">
                        <?php
                        $updatedAt = strtotime($content["updated_at"]);
                        echo date("F j, Y", $updatedAt);
                        ?>
                      </span>
                      <br>
                    </div>
                    <div class="text-gray-600">
                      <span class="font-bold"><i class="fa-solid fa-clock"></i></span>
                      <span class="font-semibold">
                        <?php echo $content["read_time"]; ?>
                      </span>
                      <span class="font-semibold ">min read</span>
                    </div>
                  </div>
                </div>
                <div class="border-b-2 border-gray-400 py-2 text-gray-800 text-lg text-semibold">
                  <!-- <span class="font-bold">Description:</span> -->
                  <?php echo $content["description"]; ?><br>
                </div>

              </div>
            <?php else: ?>
              <p>No Content found</p>
            <?php endif; ?>
            <!-- ****************
                Comment Option
                ********************* -->
            <?php
            $postId = isset($_GET['id']) ? $_GET['id'] : null;

            $postId = filter_var($postId, FILTER_VALIDATE_INT);

            if ($postId) {
              $sql = "SELECT * FROM comments WHERE post_id = $postId";
              $result = $conn->query($sql);

              ?>
              <h1 class="font-semibold border-l-4 mb-4 text-gray-600 text-xl ml-3"><i
                  class="fa-solid fa-comments"></i><span class="ml-3">Comments:</span></h1>
              <?php
              if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                  // echo '<div>';
                  // echo '<p>Name: ' . $row['name'] . '</p>';
                  // echo '<p>Comment: ' . $row['comment'] . '</p>';
                  // echo '<p>Created At: ' . $row['created_at'] . '</p>';
                  // echo '</div>';
            
                  ?>
                  <div class="bg-gray-100 shadow-md rounded-lg border border-gray-300 my-1 p-2 ">
                    <div class="flex justify-between gap-4 border-b border-gray-400">
                      <p class="font-bold text-gray-600">
                        <!-- <span>Name:</span> -->
                        <i class="fa-solid fa-circle-user"></i>
                        <?php echo $row["name"]; ?>
                      </p>
                      <p class="font-semibold text-gray-600">
                        <i class="fa-solid fa-clock"></i>
                        <?php
                        //  echo $row["created_at"];
                        ?>
                        <?php
                        // OR
                        $createdAt = strtotime($row["created_at"]);
                        ?>
                        <span class="mr-3">
                          <?php echo date(" g:i a", $createdAt); ?>
                        </span><i class="fa-regular fa-calendar-days"></i>
                        <?php
                        echo date("F j, Y", $createdAt);
                        ?><br>
                      </p>
                    </div>
                    <div class="">
                      <p class="ml-8">
                        <?php echo $row["comment"]; ?>
                      </p>
                    </div>
                    <!-- *****************
                    Delete comment option
                    ******************** -->
                    <div class="flex justify-end">
                      <!-- Delete Content Button -->
                      <!-- <button onclick="deleteComment(<?php echo $row['id']; ?>)"
                        class="mt-1 border border-red-400 rounded-3xl text-gray-600 px-4 py-1 hover:bg-red-400 transition hover:text-gray-100">Delete
                        Comment</button> -->
                      <script>
                        function deleteComment(commentId) {
                          // otr lgc

                          // var confirmation = confirm("Are you sure you want to delete this Content?");
                          //   if (confirmation) {
                          //     // Redirect to delete_user.php with the user ID
                          //     window.location.href = 'delete_comment.php?id=' + commentId;
                          //   }

                          // Use SweetAlert for confirmation****************************
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
                              window.location.href = 'delete_comment.php?id=' + commentId;
                            }
                          });
                        }
                      </script>
                      <?php


                      if (isset($_SESSION['flash_message'])) {
                        // normal flash message
                        // echo '<div id="flashMessage" class="flash-message">' . $_SESSION['flash_message'] . '</div>';
                

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
                      <style>
                        .flash-message,
                        .success-message {}
                      </style>
                    </div>
                  </div>
                  <?php
                }
              } else {
                ?>
                <div class="text-center font-semibold italic text-red-400 border border-red-300 rounded-2xl">
                  <p>
                    <?php echo 'No comments for this post.'; ?>
                  </p>
                </div>
                <?php
              }
            } else {
              echo 'Invalid post ID.';
            }
            ?>


            <div class=" my-2">
              <div class=" mx-auto bg-gray-100 p-4 rounded-md shadow-md mb-2">
                <h1 class="text-2xl font-bold mb-2 text-gray-600 "><i class="fa-solid fa-comment-dots mr-3"></i>Leave a
                  Comment</h1>
                <form action="insert_comment.php" method="post" class="space-y-4 w-full">
                  <div>
                    <label for="name" class="block  font-medium text-gray-600">Your Name:</label>
                    <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-md">
                  </div>
                  <div>
                    <label for="comment" class="block  font-medium text-gray-600">Comment:</label>
                    <textarea id="comment" name="comment" rows="1" class="mt-1 p-2 w-full border rounded-md"></textarea>
                  </div>
                  <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
                  <button type="submit"
                    class="border border-green-500 rounded-3xl text-gray-600 px-4 py-1 hover:bg-green-500 transition hover:text-gray-100">
                    Submit
                  </button>
                </form>
              </div>
            </div>
          </div>
          <div class="text-right font-bold mr-10 flex justify-center my-2 "><a
              class="border border-indigo-400 rounded-3xl text-gray-600 px-4 py-1 hover:bg-indigo-400 transition hover:text-gray-100"
              href="index.php"><i class="fa-solid fa-hand-point-left"></i> &nbsp;Home</a>
          </div>
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