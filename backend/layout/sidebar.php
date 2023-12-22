<?php
// include 'header.php';
// include 'style.css';
?>
  <div class="sidebar fixed top-16 bg-gray-300">
<div class="w-full p-2 min-h-screen relative">
<div class="w-full">
      <div class="w-full bg-indigo-200 border border-indigo-400 rounded text-gray-600 px-4 mb-1 py-2 hover:bg-indigo-400 transition hover:text-gray-100">
    
      <a class="w-full block" href="dashboard.php"><i class="fa-solid fa-gauge-high"></i> &nbsp; Dashboard</a>
    </div>

    <div class="bg-indigo-200 border border-indigo-400 rounded text-gray-600 px-4 mb-1 py-2 hover:bg-indigo-400 transition hover:text-gray-100">
    
      <a class="w-full  block" href="index.php"><i class="fa-solid fa-signs-post"></i>&nbsp;Content</a>
    </div>

    <div class="bg-indigo-200 border border-indigo-400 rounded text-gray-600 px-4 mb-1 py-2 hover:bg-indigo-400 transition hover:text-gray-100">
   
      <a class="w-full block" href="comment.php"> <i class="fa-regular fa-comment-dots"></i>&nbsp;Comments</a>
    </div>

    <div class="bg-indigo-200 border border-indigo-400 rounded text-gray-600 px-4 mb-1 py-2 hover:bg-indigo-400 transition hover:text-gray-100">
  
      <a class="w-full block" href="categories.php">  <i class="fa-solid fa-layer-group"></i>&nbsp;Category</a>
    </div>

    <div class="bg-indigo-200 border border-indigo-400 rounded text-gray-600 px-4 mb-1 py-2 hover:bg-indigo-400 transition hover:text-gray-100">
    
      <a class="w-full block" href="tags.php"><i class="fa-solid fa-bars-staggered"></i>&nbsp;Tags</a>
    </div>
    
    <div class="bg-indigo-200 border border-indigo-400 rounded text-gray-600 px-4 mb-1 py-2 hover:bg-indigo-400 transition hover:text-gray-100">

      <a class="w-full block" href="header_footer.php">    <i class="fa-solid fa-fingerprint"></i>&nbsp;Header & Footer</a>
    </div>
</div>

    <div class=" absolute bottom-20 ">
          <!-- **********FOOTER*********** -->
  <?php include 'layout/footer_part_backend.php'; ?>
  <!-- **********FOOTER*********** -->
  </div>
</div>

  </div>
  