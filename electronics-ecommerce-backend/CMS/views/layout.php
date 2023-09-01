<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Century 20</title>
    <link rel="stylesheet" href="styles/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    
    <nav class="navbar">
        <div>
            <div class="logo-wrapper">
                <a href="">
                    <img src="../resources/logo.png" alt="">
                </a>     
            </div>
            <div class="line"></div>
            <div class="navbar-menu">
                <ul class="menu-wrapper">
                    <li><a href="?act=home"><i class="bi bi-house-door"></i><span>Home</span></a></li>

                    <li class="product-dropdown-btn"><a><i class="bi bi-box"></i><span>Categories</span></a><span><i class="product-dropdown-icon bi bi-caret-right-fill"></i></span></li>
                    <ol class="product-dropdown">
                        <li><a href="?act=laptop"><i class="bi bi-laptop"></i>Laptop</a></li>
                        <li><a href="?act=smartphone"><i class="bi bi-phone"></i>Smartphone</a></li>
                        <li><a href="?act=tablet"><i class="bi bi-tablet-landscape"></i>Tablet</a></li>
                        <!-- <li><a href=""><i class="bi bi-headphones"></i>Headphone</a></li>
                        <li><a href=""><i class="bi bi-speaker"></i>Speaker</a></li>
                        <li><a href=""><i class="bi bi-webcam"></i>Camera</a></li>
                        <li><a href=""><i class="bi bi-joystick"></i>Drone</a></li> -->
                    </ol>
                    <li><a href="?act=brand"><i class="bi bi-award"></i>Brand</a></li>
                    <li><a href="?act=customer"><i class="bi bi-person-fill-gear"></i><span>Customers</span></a></li>
                    <li><a href="?act=order"><span><i class="bi bi-receipt"></i></span><span>Orders</span></a></li>
                </ul>
            </div>
        </div>

        <a class="signout-btn" href="?act=signout"><span></span>Sign out</a>

    </nav>
    <script type="text/javascript" src="scripts/script.js?v=1"></script>
</body>
</html>