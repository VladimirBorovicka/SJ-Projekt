<?php
require_once 'connectDB.php';

class Products extends Database{
    protected $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function getProducts($filter) {
        $sql = "SELECT * FROM products";
    
        if ($filter == 1) {
            $sql .= " ORDER BY rating DESC";
        } else if ($filter == 2) {
            $sql .= " ORDER BY date_added DESC";
        } else if ($filter == 3) {
            $sql .= " ORDER BY price ASC";
        } else if ($filter == 4) {
            $sql .= " ORDER BY price DESC";
        }

        $result = $this->conn->query($sql);
        
        if ($result->rowCount() > 0) {
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<a href="product.php?id=' . $row['id'] . '">';
                echo '<div class="col-md-4 col-xs-6">';
                echo '<div class="product">';
                echo '<div class="product-img">';
                echo '<img src="' . $row['image'] . '" alt="">';
                echo '<div class="product-label">';
                if ($row['date_added'] > date('Y-m-d', strtotime('-2 days'))) {
                    echo '<span class="new">NEW</span>';
                }
                echo '</div>';
                echo '</div>';
                echo '<div class="product-body">';
                echo '<p class="product-category">' .$row['category'] . '</p>';
                echo '<h3 class="product-name"><a href="#">' . $row['name'] . '</a></h3>';
                echo '<h4 class="product-price">€' . $row['price'];
                if (isset($row['old_price']) && !empty($row['old_price'])) {
                    echo ' <del class="product-old-price">€' . $row['old_price'] . '</del>';
                }
                echo '</h4>';
                echo '<div class="product-rating">';
                for ($i = 0; $i < 5; $i++) {
                    if ($i < $row['rating']) {
                        echo '<i class="fa fa-star"></i>';
                    } else {
                        echo '<i class="fa fa-star-o"></i>';
                    }
                }
                echo '</div>';
                echo '<div class="product-btns">';
                if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                    $id = $row['id'];
                    echo '<a href="edit.php?id=' . $id . '" class="quick-view"><i class="fa fa-pencil"></i><span class="tooltipp">edit</span></a>';
                    echo '<a href="delete.php?id=' . $id . '" class="add-to-wishlist"><i class="fa fa-trash"></i><span class="tooltipp">delete</span></a>';
                }
                echo '</div></div>';
                echo '<div class="add-to-cart">';

                if (isset($_SESSION['user_id'])) {
                    $products = new Products();
                    $user_id = $_SESSION['user_id'];
                    $ownedGames = $products->getOwnedGames($user_id);
                    $cart = new Cart();
                    $cartItemsIds = $cart->getCartItemsIds();
                
                    echo '<form action="store.php" method="post">';
                    echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
                
                    if (in_array($row['id'], $ownedGames)) {
                        echo '<button type="button" disabled class="owned-btn"><i class="fa fa-check"></i> Already Owned</button>';
                    } elseif (in_array($row['id'], $cartItemsIds)) {
                        echo '<button type="button" disabled class="add-to-cart-btn-muted"><i class="fa fa-check"></i> Already in cart</button>';
                    } else {
                        echo '<button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add to Cart</button>';
                    }
                
                    echo '</form>';
                
                } else {
                    echo '<a href="login.php"><button type="button" class="login-btn">Login to Purchase</button></a>';
                }
                
                echo '</div></div></div></a>';
            }
        } else {
            echo "No products found";
        }
    }

    public function getOwnedGames($user_id) {
        $sql = "SELECT game_id FROM user_games WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getRandomProducts($limit = 3) {
        $sql = "SELECT * FROM products ORDER BY RAND() LIMIT $limit";
        $result = $this->conn->query($sql);

        $products = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $products[] = $row;
        }

        foreach ($products as $product) {
            echo '<div class="product-widget">';
            echo '<div class="product-img">';
            echo '<img src="' . $product['image'] . '" alt="">';
            echo '</div>';
            echo '<div class="product-body">';
            echo '<p class="product-category">' . $product['category'] . '</p>';
            echo '<h3 class="product-name"><a href="#">' . $product['name'] . '</a></h3>';
            echo '<h4 class="product-price">' . $product['price'] . '€';
            if (isset($product['old_price']) && !empty($product['old_price'])) {
                echo '<del class="product-old-price">' . $product['old_price'] . '€</del>';
            }
            echo '</h4>';
            echo '</div>';
            echo '</div>';
        }
    }

    public function getProduct($id) {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editProduct($id, $name, $price, $old_price, $rating, $category, $image, $description) {
        $sql = "UPDATE products SET name = :name, price = :price, old_price = :old_price, rating = :rating, image = :image, category = :category, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':old_price', $old_price);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: store.php");
    }

    public function deleteProduct($id) {
        $sql = "DELETE FROM user_games WHERE game_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: store.php");
    }

    public function createProduct($name, $price, $old_price, $rating, $category, $image, $description) {
        $sql = "INSERT INTO products (name, price, old_price, rating, category, image, description) VALUES (:name, :price, :old_price, :rating, :category, :image, :description)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':old_price', $old_price);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
        header("Location: store.php");
    }

    function displayNewestProducts() {
        $sql = "SELECT * FROM products ORDER BY date_added DESC LIMIT 7";
        $result = $this->conn->query($sql);

        if ($result->rowCount() > 0) {
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="product">';
                echo '  <div class="product-img">';
                echo '    <img src="'.$row['image'].'" alt="">';
                echo '    <div class="product-label">';
                if ($row['date_added'] > date('Y-m-d', strtotime('-2 days'))) {
                    echo '      <span class="new">NEW</span>';
                }
                echo '    </div>';
                echo '  </div>';
                echo '  <div class="product-body">';
                echo '    <p class="product-category">'.$row['category'].'</p>';
                echo '    <h3 class="product-name"><a href="#">'.$row['name'].'</a></h3>';
                echo '<h4 class="product-price">€' . $row['price'];
                if (isset($row['old_price']) && !empty($row['old_price'])) {
                    echo ' <del class="product-old-price">€' . $row['old_price'] . '</del>';
                }
                echo '</h4>';
                echo '    <div class="product-rating">';
                $stars = new Products();
                $stars = $this->getStars($row['rating']);
                echo '    </div>';
                echo '  </div>';
                echo '</div>';
            }
        } else {
            echo "No products found";
        }
    }

    public function getStars($productRating) {
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $productRating) {
                echo '<i class="fa fa-star"></i>';
            } else {
                echo '<i class="fa fa-star-o"></i>';
            }
        }
    }
}
?>