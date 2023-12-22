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
      <?php include 'layout/sidebar.php'; ?>
    </div>
    <main class="p-2 ml-64 mt-16">
      <div class="p-4 rounded-md shadow-md border border-gray-300 justify-between mt-2 ">

        <body class="bg-gray-100 ">

          <div class="max-w-md mx-auto bg-purple-100 p-4 rounded-md shadow-md mb-1 text-center mt-4">
            <a href="#"
              class="border border-indigo-400 rounded-3xl text-gray-600 px-4 py-1 hover:bg-indigo-400 transition hover:text-gray-100">
              All Comments
            </a>
          </div>
          <div class="">
            <!-- **********Show flash message from insert_data.php*********** -->
            <?php

            if (isset($_SESSION['flash_message'])) {
              // normal flash message
              // echo '<div id="flashMessage" class="flash-message">' . $_SESSION['flash_message'] . '</div>';
              // animated flash message
              echo '<div id="flashMessage" class="flash-message absolute top-4 right-6 px-16 bg-gray-100  text-center rounded border-l-8  border-green-500 z-10 h-12 flex items-center animate__animated animate__tada  animate__slow"><p class="text-xl font-bold text-green-500">' . $_SESSION['flash_message'] . '</p></div>';
              // Clear the flash message to show it only once
              unset($_SESSION['flash_message']);

              // JavaScript to hide the flash message after 5 seconds
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
            $sql = "SELECT * FROM comments";
            $result = $conn->query($sql);

            if ($result->num_rows > 0): ?>


              <!-- *******************CONTENT DATA PART*************************** -->
              <table class="w-full  text-left rtl:text-right text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 ">
                  <tr>
                    <th scope="col" class="px-6 py-3">
                      Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Comment
                    </th>

                    <th scope="col" class="px-6 py-3">
                      Action
                    </th>
                  </tr>
                </thead>
                <?php while ($row = $result->fetch_assoc()): ?>
                  <tbody>
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                      <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <span class="ml-2 mb-2 font-semibold  text-gray-600">
                          <?php echo $row["name"]; ?>
                        </span>
                      </th>
                      <td class="px-6 py-4">
                        <span class="ml-2 mb-2 font-semibold  text-gray-600">
                          <?php echo $row["comment"]; ?><br>
                        </span>
                      </td>
                      <td class="px-6 py-4 text-right">
                        <!-- Edit User Button -->
                        <div class="flex gap-2 mt-4">
                          <a href="edit_comment.php?id=<?php echo $row['id']; ?>"
                            class=" h-8 border border-yellow-500 rounded-3xl text-gray-600 px-4 py-[6px] hover:bg-yellow-500 transition hover:text-gray-100">Edit
                          </a>
                          <!-- Delete Content Button -->
                          <button onclick="deleteCommentJs(<?php echo $row['id']; ?>)"
                            class=" h-8 border border-red-400 rounded-3xl text-gray-600 px-4 hover:bg-red-400 transition hover:text-gray-100">Delete
                          </button>
                        </div>
                      </td>
                    </tr>

                  </tbody>
                <?php endwhile; ?>
              <?php else: ?>
                <p>No data found</p>
              <?php endif; ?>

            </table>









            <script>
              function deleteCommentJs(commentId) {
                // You can implement further confirmation logic if needed
                // var confirmation = confirm("Are you sure you want to delete this Content?");

                // if (confirmation) {
                //     // Redirect to delete_user.php with the user ID
                //     window.location.href = 'delete_user.php?id=' + userId;
                // }


                // Use SweetAlert for confirmation
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
                    // Redirect to delete_user.php with the user ID after confirmation
                    window.location.href = 'delete_comment.php?id=' + commentId;
                  }
                });
              }
            </script>
          </div>



      </div>
  </div>

  <!-- Details container -->
  <div id="details-container" class="hidden mt-4">
    <!-- Details will be shown here using JavaScript -->
  </div>
  <script>
    function showDetails(commentId) {
      // Redirect to user_details.php with the user ID
      window.location.href = 'user_details.php?id=' + commentId;
    }


  </script>
</div>


</main>
</body>
<?php
// Close the connection
$conn->close();

?>


</div>
</div>
</div>
<div class=" h-8">
  <!-- **********FOOTER*********** -->
  <?php include 'layout/footer_part_backend.php'; ?>
  <!-- **********FOOTER*********** -->
</div>
</body>
<script src="dashboard/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


</html>