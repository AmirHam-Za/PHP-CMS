<?php

// session_start();
// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php');
//     exit();
// }

  
$sql = "SELECT * FROM header_footer LIMIT 1";
$getLOgo = $conn->query($sql);

if ($getLOgo->num_rows > 0) {
    $footerTitle = $getLOgo->fetch_assoc();
    ?>
  <div>
    <nav class="bg-indigo-300 py-1 h-16 flex justify-between items-center fixed w-full top-0 ">
      <div class="container mx-auto flex items-center justify-between ">

      <div class="ml-10">
      <img src="<?php  ?>" alt="" width="50">
        <a href="index.php">
        <?php echo '<img class="w-14 h-14" src="../backend/' . $footerTitle['logo_path'] . '" alt="Logo">'; ?>
        </a>
        <?php
            
            ?>
      </div>
      <div class="text-right font-bold mr-10 "><a class="border border-green-500 rounded-3xl text-gray-600 px-4 py-1 hover:bg-green-500 transition hover:text-gray-100"
          href="../login.php">Login</a>
      </div>
      </div>
    </nav>
  </div>


    <?php
    // Display the data
    // echo '<h1>' . $row['name'] . '</h1>';
} else {
    // echo "No data found in header_footer table.";
}

?>