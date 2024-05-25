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
                    <div class="header-search">
                        <form>
                            <select class="input-select">
                                <option value="0">All Categories</option>
                                <option value="1">Action</option>
                                <option value="2">Arcade</option>
                                <option value="3">Fighting</option>
                                <option value="4">FPS</option>
                                <option value="5">RPG</option>
                                <option value="6">Simulation</option>
                                <option value="7">Sports</option>
                                <option value="8">Strategy</option>

                                
                            </select>
                            <input class="input" placeholder="Search here">
                            <button class="search-btn">Search</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Your Cart</span>
                                <div class="qty">0</div>
                            </a>
                            <!--<div class="cart-dropdown">
                                <div class="cart-list">
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="./img/product01.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                            <h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
                                        </div>
                                        <button class="delete"><i class="fa fa-close"></i></button>
                                    </div>

                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="./img/product02.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                            <h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
                                        </div>
                                        <button class="delete"><i class="fa fa-close"></i></button>
                                    </div>
                                </div>
                                <div class="cart-summary">
                                    <small>3 Item(s) selected</small>
                                    <h5>SUBTOTAL: $2940.00</h5>
                                </div>
                                <div class="cart-btns">
                                    <a href="#">View Cart</a>
                                    <a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>-->
                        </div>

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
                <li><a href="index.php">Home</a></li>
                <li><a href="store.php">Store</a></li>
                <?php if(isset($_SESSION['username'])): ?>
                    <li><a href="library.php">Library</a></li>
                <?php endif; ?>
        </div>
    </div>
</nav>
