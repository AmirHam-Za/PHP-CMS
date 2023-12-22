<?php
// Include your database connection file
include '../db_connection.php';

// Fetch the first row from the header_footer table
$sql = "SELECT * FROM header_footer LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>
    <div class="bg-indigo-300 h-16 flex justify-between items-center fixed w-full top-0 ">
<div class="w-full flex items-center justify-between">
<div class=" ml-10">
        <img src="<?php  ?>" alt="" width="50">
        <a href="dashboard.php">
        <?php echo '<img class="w-14 h-14" src="' . $row['logo_path'] . '" alt="Logo">'; ?>
        </a>
    </div>
    <div class="text-right font-bold mr-10 "><a class="border border-green-500 rounded-3xl text-gray-600 px-4 py-1 hover:bg-green-500 transition hover:text-gray-100"
      href="../logout.php">Logout</a>
    </div>
</div>
  </div>

    <?php

} else {
    // echo "No data found in header_footer table.";
}

?>








  


