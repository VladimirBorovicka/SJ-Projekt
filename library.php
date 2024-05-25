<?php
require_once "include/classes.php";
session_start();
if (!isset($_SESSION['username'])) {
	header("Location: login.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Electro - HTML Ecommerce Template</title>
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
 		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
 		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>
 		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>
 		<link rel="stylesheet" href="css/font-awesome.min.css">
 		<link type="text/css" rel="stylesheet" href="css/style.css"/>
    </head>
	<body>
		<?php
		include_once 'include/header.php';
		?>

		<div class="section">
			<div class="container">
				<div class="row">
					<div id="aside" class="col-md-3">
						<?php
						$products = new Products();
						$randomProducts = $products->getRandomProducts();
						?>
						<div class="aside">
							<h3 class="aside-title">Recommended</h3>
							<?php foreach ($randomProducts as $product) { ?>
								<div class="product-widget">
									<div class="product-img">
										<img src="<?php echo $product['image']; ?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?php echo $product['category']; ?></p>
										<h3 class="product-name"><a href="#"><?php echo $product['name']; ?></a></h3>
										<h4 class="product-price"><?php echo $product['price']; ?>€ 
										<?php if (isset($product['old_price']) && !empty($product['old_price'])): ?>
											<del class="product-old-price"><?php echo $product['old_price'] . '€'; ?></del>
										<?php endif; ?>
										</h4>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>

					<div id="store" class="col-md-9">
						<?php
							$user_id = $_SESSION['user_id'];
							$products = new Library();
							$products->getGames($user_id);
						?>
						</div>
					</div>
				</div>
			</div>
		</div>


		<?php
		include 'include/footer.php';
		?>

		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
