<!-- **************HEADER*************** -->
<?php include "backend/layout/header.php"; ?>
<!-- **************HEADER*************** -->

<?php
session_start();

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

  if ($conn->query($sql) === TRUE) {
    echo 'Registration successful. <a href="login.php">Login here</a>.';
    $_SESSION['flash_message'] = "Registration successful";
    header("Location: login.php");
  } else {
    echo 'Error: ' . $sql . '<br>' . $conn->error;
  }
}
?>

<head>
  <title>Registration</title>
</head>
</head>
<div class="w-full flex justify-center items-center h-full bg-gray-200">
  <div class="bg-indigo-200 p-8 border border-gary-400 rounded-xl">
    <h2 class="text-2xl text-gray-600 font-bold px-2 border-l-4 border-green-400 mb-8">Registration Form</h2>
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
          type="submit" value="Register">
      </div>
    </form>
    </form>
    <div class="mt-2 w-full text-end ">
      <a class="text-gray-600 hover:text-indigo-500" href="login.php">Back to login</a>
    </div>
  </div>
</div>

</html>