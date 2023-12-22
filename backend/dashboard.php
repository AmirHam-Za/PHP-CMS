<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: ../login.php');
  exit();
}
?>
<?php
include 'layout/header.php';
?>
<div class="flex flex-col">
  <div class="">
    <?php
    include 'layout/nav.php';
    ?>
  </div>

  <div class="flex w-100%">
    <div class="">
      <?php include 'layout/sidebar.php'; ?>
    </div>
    <!-- DASHBOARD CONTENT START -->

    <div class="bg-gray-100 ml-64 mt-20 w-full mr-2">
      <div class="border border-indigo-400 rounded bg-gray-200">
        <h1 class="text-3xl text-gray-600 text-center">
          Welcome to CMS Dashboard
        </h1>
      </div>
      <!--  -->
      

    </div>
  </div>
  <!-- DASHBOARD CONTENT END -->

</div>
<?php $conn->close(); ?>
<script src="dashboard/custom.js"></script>

</html>