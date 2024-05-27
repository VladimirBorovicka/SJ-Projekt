<?php
require_once "include/classes/Cart.php";
?>
<header>
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> +421-918-952-721</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> vlado11159@gmail.com</a></li>
                <li><a href="https://maps.app.goo.gl/s5mhRMP9q9NawjMR7" target="_blank"><i class="fa fa-map-marker"></i>Slovenská 15</a></li>
            </ul>
            <ul class="header-links pull-right">
                <?php
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if (isset($_SESSION['username'])) {
                    echo '<li><a href="account.php"><i class="fa fa-user circle"></i> ' . $_SESSION['username'] . '</a>';
                    echo '</a></li>';
                    echo '<li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>';
                } else {
                    echo '<li><a href="login.php"><i class="fa fa-user-o"></i> Login</a></li>';
                    echo '</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>

    <div id="header">
        <div class="container">
            <div class="row">
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="index.php" class="logo">
                                <img src="./img/logo.png" alt="">
                            </a>
                        </div>
                    </div>

                <div class="col-md-6">
                    
                </div>

                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="checkout.php">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Your Cart</span>
                                <div class="qty">
                                    <?php
                                    $number = new Cart();
                                    $number->getCartNumber();
                                    ?>
                                </div>
                            </a>
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<nav id="navigation">
    <div class="container">
        <div id="responsive-nav">
            <ul class="main-nav nav navbar-nav">
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>"><a href="index.php">Home</a></li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'store.php' ? 'active' : '' ?>"><a href="store.php">Store</a></li>
                <?php if(isset($_SESSION['username'])): ?>
                    <li class="<?= basename($_SERVER['PHP_SELF']) == 'library.php' ? 'active' : '' ?>"><a href="library.php">Library</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
