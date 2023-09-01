<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
    <link rel="stylesheet" href="styles/signin.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="sign-in-wrapper">
        <div>
            <div class="logo">
                <img src="../resources/logo.png" alt="">    
            </div>
           
            <div class="sign-in-box">
                <h2>Content Management System</h2>
                <form action="" method="post">
                    <div class="sign-in-field">
                        <label for="username"></label>
                        <input type="text" id="username" name="username" placeholder="Username" required>   
                    </div>
                    <div class="sign-in-field">
                        <label for="password"></label>
                        <input type="password" id="password" name="password" placeholder="Password" required>   
                    </div>
                    <div class="noti">
                        <?php if(isset($_SESSION["noti"])){echo $_SESSION["noti"];} ?>
                    </div>
                    <div class="btn-wrapper">
                        <button type="submit" class="signin-btn" name="signin">Sign In</button>
                    </div>    
                </form> 
            </div>
            
        </div>

        
    </div>
   
</body>
</html>
