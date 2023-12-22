<?php

$sqlFooter = "SELECT * FROM footer";
$resultFooter = $conn->query($sqlFooter);
?>
<footer class="bg-indigo-300 h-10 mb-2">
  <div class="flex items-center h-full justify-center">
    <p>Copyright &copy;
      <span>
        <?php
        $currentYear = date('Y');
        echo $currentYear;
        ?> -
      </span>
      <span class="font-semibold text-indigo-600">

        <?php foreach ($resultFooter as $footer) {
          echo '<h1 class="font-semibold text-indigo-600">' . $footerTitle['name'] . '</h1>';

        }
        ?>
      </span>
    </p>
  </div>
</footer>