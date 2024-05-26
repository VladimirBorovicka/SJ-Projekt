<?php

require_once 'include/connectDB.php';

class Users extends Database {
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $user['role'];
                $_SESSION['user_id'] = $user['id'];
                header("Location: index.php");
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function register($firstname, $surname, $username, $email, $password) {
        $sql = "SELECT * FROM users WHERE username = :username OR email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $role = 'user';
        $sql = "INSERT INTO users (first_name, surname, username, email, password, role) VALUES (:firstname, :surname, :username, :email, :password, :role)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("location: login.php");
        exit;
    }

    public function getUserData($user_id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editUser($username, $first_name, $last_name, $email, $password, $id) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username = :username, first_name = :first_name, surname = :last_name, email = :email, password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: account.php");
    }
}

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

                    echo '<form action="add_to_cart.php" method="post">';
                    echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';

                    if (in_array($row['id'], $ownedGames)) {
                        echo '<button type="button" disabled class="owned-btn">Already Owned</button>';
                    } else {
                        echo '<button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>';
                    }

                    echo '</form>';
                } else {
                    echo '<a href="login.php"><button type="button" class="login-btn">Login to Purchase</button></a>';
                }

                echo '</div></div></div>';
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

        return $products;
    }

    public function getProduct($id) {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editProduct($id, $name, $price, $old_price, $rating, $category, $image,) {
        $sql = "UPDATE products SET name = :name, price = :price, old_price = :old_price, rating = :rating, image = :image, category = :category WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':old_price', $old_price);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category', $category);
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

    public function createProduct($name, $price, $old_price, $rating, $category, $image) {
        $sql = "INSERT INTO products (name, price, old_price, rating, category, image) VALUES (:name, :price, :old_price, :rating, :category, :image)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':old_price', $old_price);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category', $category);
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
                echo '    <h4 class="product-price">$'.$row['price'].' <del class="product-old-price">$'.$row['old_price'].'</del></h4>';
                echo '    <div class="product-rating">';
                for ($i = 0; $i < 5; $i++) {
                    if ($i < $row['rating']) {
                        echo '      <i class="fa fa-star"></i>';
                    } else {
                        echo '      <i class="fa fa-star-o"></i>';
                    }
                }
                echo '    </div>';
                echo '  </div>';
                echo '</div>';
            }
        } else {
            echo "No products found";
        }
    }
}

    class Library extends Database{
        protected $conn;

        public function __construct() {
            parent::__construct();
            $this->conn = $this->getConnection();
        }

        public function getGames($user_id) {
            try {
                $sql = "SELECT user_games.game_id, users.username, products.name, products.price, products.description, products.image, products.date_added, products.category, products.old_price, products.rating
                        FROM user_games 
                        INNER JOIN users ON user_games.user_id = users.id 
                        INNER JOIN products ON user_games.game_id = products.id 
                        WHERE user_games.user_id = :user_id";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([':user_id' => $user_id]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($result) > 0) {
                    foreach ($result as $row) {
                        echo '<div class="col-md-4 col-xs-6">';
                echo '<div class="product">';
                echo '<div class="product-img">';
                echo '<img src="' . $row['image'] . '" alt="">';
                echo '<div class="product-label">';
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
                echo '</div></div>';
                echo '</div></div>';
            }
                } else {
                    echo "You dont own any games yet!";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    class Cart extends Database{
        private $conn;

        public function __construct() {
            parent::__construct();
            $this->conn = $this->getConnection();
        }

        public function getCartItems() {
    
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }
    
            $items = array();
            $total = 0;
    
            foreach ($_SESSION['cart'] as $product_id) {
                $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = :id");
                $stmt->execute([':id' => $product_id]);
                $product = $stmt->fetch();
    
                $items[] = array(
                    'name' => $product['name'],
                    'price' => $product['price']
                );
    
                $total += $product['price'];
            }
    
            return array('items' => $items, 'total' => $total);
        }

        function getCartItemsHtml($cartItems) {
            $output = '';

            foreach ($cartItems['items'] as $key => $item) {
                $output .= '<div class="order-col">';
                $output .= '<div><a href="remove_from_cart.php?item=' . $key . '" class="text-black"><i class="fa fa-trash"></i></a> 1x ' . $item['name'] . '</div>';
                $output .= '<div>$' . $item['price'] . '</div>';
                $output .= '</div>';
            }

            $output .= '<div class="order-col">';
            $output .= '<div><strong>TOTAL</strong></div>';
            $output .= '<div><strong class="order-total">$' . $cartItems['total'] . '</strong></div>';
            $output .= '</div>';

            return $output;
        }


        public function getCartItemsIds() {
            return $_SESSION['cart'];
        }

        public function getCartNumber() {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }
            echo count($_SESSION['cart']);
        }

        public function clearCart() {
            $_SESSION['cart'] = array();
        }
    }

    class Order extends Database{
        private $conn;

        public function __construct() {
            parent::__construct();
            $this->conn = $this->getConnection();
        }

        public function createOrder($user_id, $cartItems) {
            foreach ($cartItems as $game_id) {
                $sql = "INSERT INTO user_games (user_id, game_id) VALUES (:user_id, :game_id)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->bindParam(':game_id', $game_id);
                $result = $stmt->execute();
            }
        }
    }
?>