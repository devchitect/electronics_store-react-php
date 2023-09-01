<?php 
    $laptop = new Laptop();
    $phone = new Phone();
    $tablet = new Tablet();
    $brand = new Brand();
    $customer = new Customer();
    $order = new Order();

    $laptop -> getAllLatop();
    $laptop_count = count($laptop -> data);
    
    $phone -> getAllPhone();
    $phone_count = count($phone -> data);
    
    $tablet -> getAllTablet();
    $tablet_count = count($tablet -> data);
    
    $brand -> getAllBrand();
    $brand_count = count($brand -> data);
      
    $customer -> getAllCustomer();
    $customer_count = count($customer -> data);

        
    $order -> getAllOrders();
    $order_count = count($order -> data);

    
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div>
        <div class="home">
            <div class="home-welcome">
                <h3> &#x1F44B  Hello, <?= $_SESSION["name"] ?> !</h3>
            </div>
            <br>
            <div class="home-card-wrapper">
                <div class="home-card">
                    <h3><?= $laptop_count ?></h3>
                    <h4>Laptops in the Store.</h4>
                </div>

                <div class="home-card">
                    <h3><?= $tablet_count ?></h3>
                    <h4>Tablets in the Store.</h4>
                </div>

                <div class="home-card">
                    <h3><?= $phone_count ?></h3>
                    <h4>Smartphones in the Store.</h4>
                </div>

                <div class="home-card">
                    <h3><?= $brand_count ?></h3>
                    <h4>Brands.</h4>
                </div>

                <div class="home-card">
                    <h3><?= $customer_count ?></h3>
                    <h4>Users created account.</h4>
                </div>

                <div class="home-card">
                    <h3><?= $order_count ?></h3>
                    <h4>Orders have been created.</h4>
                </div>
            </div>
            
        </div>
        
    </div>
</body>
</html>