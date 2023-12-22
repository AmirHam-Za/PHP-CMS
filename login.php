<!-- **************HEADER*************** -->
<?php include "backend/layout/header.php"; ?>
<!-- **************HEADER*************** -->

<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      $_SESSION['user_id'] = $row['id'];
      header('Location: backend/dashboard.php');
      exit();
    } else {
      $_SESSION['flash_message_login'] = "Invalid password.";
    }
  } else {
    $_SESSION['flash_message_login'] = "Invalid username.";
  }
}
?>

<body>

  <div class="w-full flex justify-center items-center h-full bg-gray-200">
    <div class="bg-indigo-200 p-8 border border-gary-400 rounded-xl">
      <h2 class="text-2xl text-gray-600 font-bold px-2 border-l-4 border-green-400 mb-8">Login Form </h2>
      <form class="border border-gray-400 p-4 rounded-xl" method="post" action="">
        <label class="tet-gry-600 fontsemibold " for="username">Username:</label><br>
        <input class="h-8 rounded" type="text" name="username" required>
        <br>
        <label class="tet-gry-600 fontsemibold  for=" password">Password:</label><br>
        <input class="h-8 rounded" type="password" name="password" required>
        <br>

        <div class=" p-4 mt-4 w-full ">
          <input
            class="w-full border border-green-500 rounded-3xl font-semibold text-gray-600 px-4 py-1 hover:bg-green-500 transition hover:text-gray-100  text-center"
            type="submit" value="Login">
        </div>
      </form>
      <div class="mt-2 w-full text-end ">
        <a class="text-gray-600 hover:text-indigo-500" href="register.php">Register Now</a>
      </div>
      </form>



      <?php if (isset($_SESSION['flash_message'])) {
        echo '<div id="flashMessage" class="flash-message absolute top-4 right-6 px-16 bg-gray-100  text-center rounded border-l-8  border-green-500 z-10 h-12 flex items-center animate__animated animate__tada  animate__slow"><p class="text-xl font-bold text-green-500">' . $_SESSION['flash_message'] . '</p></div>';

        unset($_SESSION['flash_message']);
        echo '<script>
                setTimeout(function() {
                    document.getElementById("flashMessage").style.display = "none";
                }, 2500);
            </script>';
      }
      ?>

      <?php if (isset($_SESSION['flash_message_login'])) {
        echo '<div class="w-full flex justify-center items-center ">
            <div id="flashMessage" class="flash-message absolute top-16 px-16 bg-red-400  text-center rounded border-l-8  border-red-500 z-10 h-12 flex items-center animate__animated animate__rubberBand  animate__slow">
              <p class="text-xl font-bold text-gray-200">' . $_SESSION['flash_message_login'] . '</p>
            </div>
            </div>';

        unset($_SESSION['flash_message_login']);
        echo '<script>
                setTimeout(function() {
                    document.getElementById("flashMessage").style.display = "none";
                }, 5000);
            </script>';
      }
      ?>
    </div>
  </div>
</body>

</html>