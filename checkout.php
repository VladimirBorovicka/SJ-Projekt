<?php
require_once "include/classes/Cart.php";
require_once "include/classes/Order.php";
require_once "include/classes/Users.php";

session_start();
$cart = new Cart();
$cartItems = $cart->getCartItemsIds();


if (isset($_POST['order'])) {
	session_start();

	$order = new Order();
	$order->createOrder($_SESSION['user_id'], $cartItems);

	$cart->clearCart();
	header('Location: library.php');
}

if (isset($_POST['remove'])) {
	$item = $_POST['item'];
	$cart->removeFromCart($item);
	header('Location: checkout.php');
}

require_once 'include/header.php';
?>
	<body>

		<?php
		include 'include/nav.php';
		?>

		<div class="section">
			<div class="container">
				<div class="row">
				<form action="checkout.php" method="post">
					<div class="col-md-7">
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Billing address</h3>
							</div>
							<?php
								$user = new Users();
								$userData = $user->getUserData($_SESSION['user_id']);
							?>
							<div class="form-group">
								<input class="input" type="text" name="first-name" placeholder="First Name" value="<?php echo $userData["first_name"]; ?>" required>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="last-name" placeholder="Last Name" value="<?php echo $userData["surname"]; ?>"required>
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email" value="<?php echo $userData["email"]; ?>"required>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Address" required> 
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city" placeholder="City" required>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="Country" required>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip-code" placeholder="ZIP Code" required>
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="tel" placeholder="Telephone" required>
							</div>
						</div>
					</div>

					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">
							<?php
								$cartItems = $cart->getCartItems();
								$cart->getCartItemsHtml($cartItems);
							?>
							</div>
							<div class="order-col">
								<div>Shiping</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<?php
								echo '<div><strong class="order-total">' . $cartItems['total'] . '€</strong></div>';
								?>
							</div>
						</div>
						<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1" checked>
								<label for="payment-1">
									<span></span>
									Direct Bank Transfer
								</label>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2">
								<label for="payment-2">
									<span></span>
									Cheque Payment
								</label>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-3">
									<span></span>
									Paypal System
								</label>
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms" required>
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
						<?php if ($cartItems['total'] > 0) { ?>
							<button type="submit" class="primary-btn order-submit btn-main" name="order">Place order</button>
						<?php } ?>
						</form>
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
