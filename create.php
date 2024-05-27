<?php
require_once "include/classes/Products.php";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $old_price = $_POST['old_price'];
    $rating = $_POST['rating'];
    $category = $_POST['category'];

    $target = "";

    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];
        $target = "img/".basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    $productObj = new Products($conn);
    $productObj->createProduct($name, $price, $old_price, $rating, $category, $target);
}
require_once "include/header.php";
?>
	<body>
		<?php
        include 'include/nav.php';
         ?>

        <div class="container">
            <div class="wrapper">
                <h2>Create Product</h2>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                <label for="category">Category</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="Action">Action</option>
                        <option value="Arcade">Arcade</option>
                        <option value="Fighting">Fighting</option>
                        <option value="FPS">FPS</option>
                        <option value="RPG">RPG</option>
                        <option value="Simulation">Simulation</option>
                        <option value="Sports">Sports</option>
                        <option value="Strategy">Strategy</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="old_price">Old Price</label>
                    <input type="number" class="form-control" id="old_price" name="old_price">
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="text" class="form-control" id="rating" name="rating" required>
                </div>
                <div class="form-group">
                    <img src="<?php echo $product['image']; ?>" alt="Product Image" required>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-danger" name="submit">Submit</button>
            </form>
        </div>
    </div>


		<?php
        include 'include/footer.php';
        include 'include/scripts.php';
        ?>

	</body>
</html>
