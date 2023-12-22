<?php
session_start();
if (!isset($_SESSION['user_id'])) {
	header('Location: ../login.php');
	exit();
}
?>
<?php include 'layout/header.php'; ?>

<body>
	<div class="flex flex-col">
		<div class="">
			<?php include 'layout/nav.php'; ?>
		</div>

		<div class="flex">
			<div class="">
				<?php include 'layout/sidebar.php'; ?>
			</div>
			<div class="p-2 ml-64 mt-12">
				<?php
				include 'db_connection.php';
				?>

				<body class="bg-gray-100">
					<!-- *****************BODY CONTENT AREA********************** -->
					<div class="mt-4 p-4 rounded-md shadow-md border border-gray-300  justify-between">
						<h2 class="mb-3 border-l-4 border-green-500">
							<p class="ml-2 text-gray-600 text-xl font-semibold"> Tag</p>
						</h2>

						<div class="mx-auto bg-purple-100 p-4 rounded-md shadow mt-3">
							<!-- Create User Form -->
							<form action="insert_tag_data.php" method="post">
								<label class="text-gray-600 text-sm font-semibold" for="name">Tag Name:</label><br>
								<input class="h-8 rounded mb-2" type="text" name="name" id="name" required><br>

								<button type="submit"
									class="border border-indigo-400 rounded-3xl text-gray-600 px-4 py-1 hover:bg-indigo-400 transition hover:text-gray-100">
									Create
								</button>
							</form>
						</div>
					</div>
				</body>
				<?php
				$conn->close();
				?>
			</div>
		</div>
	</div>
</body>
<script src="dashboard/custom.js"></script>

</html>