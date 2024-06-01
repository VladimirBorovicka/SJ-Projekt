<?php
require_once "include/header.php";
require_once "include/classes/Products.php";
require_once "include/classes/Cart.php";

if (isset($_GET['id'])) {
	$product_id = $_GET['id'];
	$product = new Products();
	$product = $product->getProduct($product_id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        $product_id = $_POST["product_id"];
        $cart = new Cart();
        $cart->addToCart($product_id);
    }
}
?>
	<body>

		<?php
		include_once 'include/nav.php';
		?>

		<div class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
							<div class="product-preview">
								<img src="<?php echo $product["image"]?>" alt="">
							</div>
						</div>
					</div>

					<div class="col-md-2  col-md-pull-5"></div>
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name text-black"><?php echo $product["name"]?></h2>
							<div>
								<div class="product-rating">

									<?php
									$stars = new Products();
									$stars = $stars->getStars($product["rating"]);
									?>

								</div>
							<div>
								<h3 class="product-price"><?php echo $product["price"] . "€" ?> <del class="product-old-price"><?php echo $product["old_price"] . "€" ?></del></h3>
							</div>
							<p class="text-black"><?php echo substr($product["description"], 0, 200) . "..."?></p>
	
								<div class="add-to-cart">
									<form method="post">
										<input type="hidden" name="product_id" value="<?php echo $product["id"]?>">
										<?php 
											$productObj = new Products();
											$ownedGames = $productObj->getOwnedGames($_SESSION['user_id']);
											if(in_array($product["id"], $_SESSION['cart'])): 
										?>
											<button type="button" disabled class="add-to-cart-btn-muted"><i class="fa fa-check"></i> Already in cart</button>
										<?php 
											elseif(in_array($product["id"], $ownedGames)): 
										?>
											<button type="button" disabled class="add-to-cart-btn-muted"><i class="fa fa-check"></i> Already owned</button>
										<?php 
											else: 
										?>
											<button type="submit" name="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
										<?php 
											endif; 
										?>
									</form>
								</div>
							</div>

							<ul class="product-links">
								<li>Category:</li>
								<li><a href="#" class="text-black"><?php echo $product["category"]?></a></li>
							</ul>

							<ul class="product-links">
								<li>Share:</li>
								<li><a href="#"><i class="fa fa-facebook text-black"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter text-black"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus text-black"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope text-black"></i></a></li>
							</ul>

						</div>
					</div>

					<div class="col-md-12">
						<div id="product-tab">
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
							</ul>

							<div class="tab-content">
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<p class="text-black"><?php echo $product["description"]?></p>
										</div>
									</div>
								</div>						
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		include_once 'include/footer.php';
		include_once 'include/scripts.php';
		?>

	</body>
</html>
