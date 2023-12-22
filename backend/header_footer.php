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

    <body class="bg-gray-100 min-h-screen">
      <main class="p-2 ml-64 mt-16">
        <div class="p-4 rounded-md shadow-md border border-gray-300 justify-between mt-2 ">


          <div
            class="max-w-md mx-auto border border-gray-300 bg-purple-100 p-4 rounded-md shadow-md mb-1 text-center mt-4">
            <a href="create_header_footer.php"
              class="border border-indigo-400 rounded-3xl text-gray-600 px-4 py-1 hover:bg-indigo-400 transition hover:text-gray-100">
              Create Footer</a>
          </div>

          <div class="">
            <!-- **********Show flash message from insert_data.php*********** -->
            <?php

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
            <div class="">
            </div>
          </div>

          <?php
          $sql = "SELECT * FROM header_footer";
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
                    Image
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
                      <div class="w-16 h-16">
                        <?php
                        echo "<img src='" . $row['logo_path'] . "' >";
                        ?>
                      </div>
                    </td>


                    <td class="px-6 py-4 text-right">
                      <!-- Edit User Button -->
                      <div class="flex gap-2 mt-4">
                        <!-- Edit User Button -->
                        <a href="edit_header_footer.php?id=<?php echo $row['id']; ?>"
                          class=" h-8 border border-yellow-500 rounded-3xl text-gray-600 px-4 py-[6px] hover:bg-yellow-500 transition hover:text-gray-100">Edit
                          Footer</a>
                        <!-- Delete Content Button -->
                        <button onclick="deleteHeaderFooterJs(<?php echo $row['id']; ?>)"
                          class=" h-8 border border-red-400 rounded-3xl text-gray-600 px-4 hover:bg-red-400 transition hover:text-gray-100">Delete
                          Footer</button>
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
            function deleteHeaderFooterJs(headerFooterId) {

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
                  window.location.href = 'fn_del_header_footer.php?id=' + headerFooterId;
                }
              });
            }
          </script>
        </div>

  </div>
</div>
<script>
  function showDetails(userId) {
    window.location.href = 'user_details.php?id=' + userId;
  }
</script>
</div>
</main>
<div class=" h-8 ">
</div>
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