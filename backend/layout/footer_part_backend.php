<!-- ************FOOTER*************** -->
    <?php
if (!isset($_SESSION['user_id'])) {
  header('Location: ../login.php');
  exit();
}

include 'db_connection.php';
// Fetch the first row from the header_footer table
$sql = "SELECT * FROM header_footer LIMIT 1";
$getLOgo = $conn->query($sql);

$sqlFooter = "SELECT * FROM footer";
$resultFooter = $conn->query($sqlFooter);

if ($getLOgo->num_rows > 0) {
    $row = $getLOgo->fetch_assoc();
}

?>  
    <footer class=" h-10 mb-2">
    <div class="flex items-center h-full justify-center">
        <p> &copy; 
          <span>
            <?php
              $currentYear = date('Y');
              echo $currentYear;
            ?> || &nbsp;
          </span>
          <span class=" font-semibold text-indigo-600">
           
            <?php 
                echo '<h1 class="font-semibold text-indigo-400">' . $row['name'] . '</h1>'; 
                
            ?>
          </span>
        </p>
      </div>
    </footer>

    <!-- <footer class="bg-indigo-300 h-10 mb-2">
      <div class="flex items-center h-full justify-center">
        <p>Copyright &copy; 
          <span>
            <?php
              $currentYear = date('Y');
              echo $currentYear;
            ?> -
          </span>
          <span class=" font-semibold text-indigo-600">
            <?php foreach ($resultFooter as $footer) 
              { 
                echo $footer['name']; 
                
              } 
            ?>
          </span>
        </p>
      </div>
    </footer> -->