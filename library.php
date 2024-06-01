<?php
require_once "include/classes/Products.php";
require_once "include/classes/Library.php";

session_start();

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
	exit;
}

require_once "include/header.php";
?>
<body>
	
	<?php
	include_once 'include/nav.php';
	?>

	<div class="section">
		<div class="container d-flex justify-content-center align-items-center">
			<div class="row">
				<div id="store" class="col-md-9 mx-auto library">
					<?php
						$user_id = $_SESSION['user_id'];
						$products = new Library();
						$products->getGames($user_id);
					?>
				</div>
			</div> 
		</div>
	</div>
	
	<?php
	include 'include/footer.php';
	include 'include/scripts.php';
	?>

</body>
</html>
