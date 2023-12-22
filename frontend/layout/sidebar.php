<?php
$sqlCategories = "SELECT * FROM categories";
$resultCategories = $conn->query($sqlCategories);

$sqlTags = "SELECT * FROM tags";
$resultTags = $conn->query($sqlTags);
?>
<div class="sidebar  w-3/12 ml-4">
  <div class="p-4 rounded-md shadow-md bg-gray-100 border border-gray-300 mt-2 ">
    <div class="bg-indigo-100 p-4 rounded-md shadow-md border border-gray-300 flex flex-wrap gap-2">
      <div class="w-full mb-6">
        <!--**********************CATEGORY LIST **************************-->
        <div class="text-gray-600 font-semibold text-xl border-l-4 border-green-500 ml-2 ">
          <p class="ml-1">Categories</p>
        </div>
        <?php
        foreach ($resultCategories as $category) {
          ?>
          <p>
            <a class="hover:bg-gray-200 border border-gray-400 m-2 block p-2 rounded-lg text-gray-600 font-semibold shadow "
              href="page_by_cat.php?id=<?php echo $category['id']; ?>"
              class="bg-blue-500 text-white px-4 py-2 rounded mr-2">
              <?php echo $category['name']; ?>
            </a>
          </p>
          <?php
        }
        ?>
      </div>
      <div class="w-full">
        <!--**********************TAG LIST **************************-->
        <div class="text-gray-600 font-semibold text-xl border-l-4 border-green-500 ml-2 ">
          <p class="ml-1">Tags</p>
        </div>
        <?php
        foreach ($resultTags as $tag) {
          ?>
          <p>
            <a class="hover:bg-gray-200 border border-gray-400 m-2 block p-2 rounded-lg text-gray-600 font-semibold shadow"
              href="page_by_tag.php?id=<?php echo $tag['id']; ?>" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">
              <?php echo $tag['name']; ?>
            </a>
          </p>
          <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>