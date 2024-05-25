<?php
require_once "include/classes.php";

$product = null;
if (isset($_GET['id'])) {
    $productObj = new Products();
    $product = $productObj->getProduct($_GET['id']);

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $old_price = $_POST['old_price'];
        $rating = $_POST['rating'];
        $category = $_POST['category'];

        $target = $product['image'];
        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
            $image = $_FILES['image']['name'];
            $target = "img/".basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
        }

        $productObj->editProduct($_GET['id'], $name, $price, $old_price, $rating, $category, $target);
    }
} else {
    header('Location: index.php');
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
        include 'include/header.php';
        ?>

        <div class="container">
            <div class="wrapper">
                <h2>Edit Product</h2>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
                </div>
                <div class="form-group">
                <label for="category">Category</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="Action" <?php if ($product['category'] == 'Action') echo 'selected'; ?>>Action</option>
                        <option value="Arcade" <?php if ($product['category'] == 'Arcade') echo 'selected'; ?>>Arcade</option>
                        <option value="Fighting" <?php if ($product['category'] == 'Fighting') echo 'selected'; ?>>Fighting</option>
                        <option value="FPS" <?php if ($product['category'] == 'FPS') echo 'selected'; ?>>FPS</option>
                        <option value="RPG" <?php if ($product['category'] == 'RPG') echo 'selected'; ?>>RPG</option>
                        <option value="Simulation" <?php if ($product['category'] == 'Simulation') echo 'selected'; ?>>Simulation</option>
                        <option value="Sports" <?php if ($product['category'] == 'Sports') echo 'selected'; ?>>Sports</option>
                        <option value="Strategy" <?php if ($product['category'] == 'Strategy') echo 'selected'; ?>>Strategy</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="old_price">Old Price</label>
                    <input type="number" class="form-control" id="old_price" name="old_price" value="<?php echo $product['old_price']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="text" class="form-control" id="rating" name="rating" value="<?php echo $product['rating']; ?>" required>
                </div>
                <div class="form-group">
                    <img src="<?php echo $product['image']; ?>" alt="Product Image">
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-danger" name="submit">Submit</button>
            </form>
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