<?php
   require("models/product/laptop.php");
   require("models/product/smartphone.php");
   require("models/product/tablet.php");
   require("models/brand.php");
   require("models/prototype.php");
   require("models/category.php");
   require("models/customer.php");
   require("models/order.php");


   $action = isset($_REQUEST["act"]) ? $_REQUEST["act"] : "home";
   $host_directory = "electronics-ecommerce-backend/CMS";
   $error_msg = "";
   $success_msg = "";
   
   //Create the layout of the website: (exmaple: Navigation, Header,....)
   require("views/layout.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <div class="content">
      <?php
         switch($action){
            case "laptop":
               require("views/laptop/laptop.php");
            break;
      
            case "tablet":
               require("views/smartphone_tablet/st.php");
            break;
      
            case "smartphone":
               require("views/smartphone_tablet/st.php");
            break;
      
            case "brand":
               require("views/brand/brand.php");
            break;
      
            case "signout":
               require("controllers/handle-signout.php");
            break;
                
            case "home":
               require("views/home.php");  
            break;
      
            case "customer":
               require("views/customer.php");
            break;

            case "order":
               require("views/order.php");
            break;

            default:
               //
            break;
        }
      ?>

    </div>
</body>
</html>