<?php

include 'db_connection.php';

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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Details</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>

<body class="bg-gray-100 p-8">

  <div class="max-w-md mx-auto bg-white p-4 rounded-md shadow-md">

    <?php if ($content): ?>
      <div class="mb-4">
        <!-- <span class="font-bold">Image:</span><br> -->
        <img src="<?php echo $content["image"]; ?>" alt="">
        <div class="flex justify-between">
          <div class=""> <span class="font-bold">Title:</span>
            <?php echo $content["title"]; ?><br>
          </div>
          <div class=""> <span class="font-bold">Reading time:</span>
            <?php echo $content["read_time"]; ?><br>
          </div>
        </div>
        <span class="font-bold">Description:</span>
        <?php echo $content["description"]; ?><br>
      </div>
    <?php else: ?>
      <p>No Content found</p>
    <?php endif; ?>

  </div>

</body>

</html>

<?php

// Close the connection
$conn->close();

?>