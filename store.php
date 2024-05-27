<?php
require_once "include/classes/Products.php";
require_once "include/classes/Cart.php";
require_once "include/header.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $product_id = $_POST['product_id'];
    $products = new Cart();
    $products->addToCart($product_id);
}
?>
<body>

	<?php
	include 'include/nav.php';
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
					<div class="store-filter clearfix">
						<div class="store-sort">
							<label>
								Sort By:
								<?php
								$filter = isset($_GET['filter']) ? $_GET['filter'] : 1;
								?>

								<form id="filterForm" method="get" action="store.php">
									<select class="input-select" name="filter" onchange="this.form.submit()">
										<option value="1" <?php if ($filter == 1) echo 'selected'; ?>>Popular</option>
										<option value="2" <?php if ($filter == 2) echo 'selected'; ?>>Newest</option>
										<option value="3" <?php if ($filter == 3) echo 'selected'; ?>>Price ascending</option>
										<option value="4" <?php if ($filter == 4) echo 'selected'; ?>>Price descending</option>
									</select>
								</form>
							</label>

						</div>
						<ul class="store-grid">
							<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
								<li class=""><a href="create.php"><i class="fa fa-plus"></i></a></li>
							<?php endif; ?>
						</ul>
					</div>

						<?php
						$products = new Products();
						$products->getProducts($filter);
						?>

					</div>
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
