<?php
require_once 'connectDB.php';

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
                    echo '<a href="product.php?id=' . $row['game_id'] . '">';
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
                    echo '</h4>';
                    echo '<div class="product-btns">';
                    echo '</div></div>';
                    echo '</div></div>';
                    echo '</a>';
                }
            } else {
                echo "You dont own any games yet!";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>