<?php
    declare(strict_types = 1);
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once('../vendor/autoload.php');
    require("models/user-model.php");

    $env = parse_ini_file('.env');
    $secret_key = $env["KEY"];
    $stmp_key = $env["STMP"];

    $user = new User();

    $method = $_SERVER['REQUEST_METHOD'];


    switch($method){
        case "POST":

            if(isset($_REQUEST['signup'])){
                $verify = 0;
                $otp = rand(100000,999999);
                $re_data = json_decode(file_get_contents('php://input'), true);     
                $result = $user -> findUser($re_data["username"]);

                if($result){

                    if(!$user -> data){

                        $result2 = $user -> createUser($re_data["username"], $re_data["password"], $re_data["firstname"], $re_data["lastname"], 
                                            $re_data["phone"], $re_data["email"], $re_data["address"], $otp, $verify);
                      
                      
                        if($result2){
                            //send email to user with otp
                            if($re_data["email"] == true){
                            $email = $re_data["email"];
                            $client_name = $re_data["firstname"] . " ". $re_data["lastname"];

                            require("controllers/phpmailer-email-sending.php");
                            }

                            echo json_encode("Sign up successfully!");
                            http_response_code(201);
                        }else{
                            echo json_encode("Sign up failed!");
                            http_response_code(400);
                        }     
                        

                    }else{
                        http_response_code(202);
                        echo json_encode("Username existed! Choose another one!");
                    }

                }else{
                    echo json_encode("Failed to connect to database!");
                    http_response_code(400);
                }
                
                break;
            }

            if(isset($_REQUEST['signin'])){
                //Get username & password then do the steps
                $data = json_decode(file_get_contents('php://input'), true);  
                //Check if username & password match
                $result = $user -> checkUserAndGetDetails($data["username"], $data["password"]);

                if($result){
                    $temp = $user -> data;
                    
                    if($temp){
                        //creating JWT Token
                        $date = new DateTimeImmutable();
                        $expire_at = $date -> modify('+ 1 day') -> getTimestamp();     
                        $domainName = "domain_name";
                        $username   = $data["username"]; 

                        $request_data = [
                            'iat'  => $date -> getTimestamp(),       // Issued at: time when the token was generated
                            'iss'  => $domainName,                   // Issuer
                            'exp'  => $expire_at,                    // Expire
                            'username' => $username,                 // User name
                        ];
            
                        $token = JWT::encode(
                            $request_data,
                            $secret_key,
                            'HS512'
                        );

                        //Prepare to send data to client
                        $auth = array(
                            "jwt" => $token,
                            "info" => $temp
                        );
    
                        echo json_encode($auth);
                        http_response_code(200);
                    }else{
                        echo json_encode("Invalid username or password.");
                        http_response_code(202);
                    }

                }else{
                    echo json_encode("Failed to connect to database!");
                    http_response_code(400);
                }             

            }

            
            if(isset($_REQUEST['profile'])){

                //Normally we use Header to send JWT, but apache faled to pass Header Authorization
                $data = json_decode(file_get_contents('php://input'), true);  

                if($data){

                    // Find Bearer Token
                    if (preg_match('/Bearer(\s|\S+)/', $data, $matches)) {   
                        //get JWToken
                        $jwt = $matches[1];

                        if ($jwt) {

                            //decode JWToken
                            $token = JWT::decode($jwt, new Key($secret_key, 'HS512'));
                            $now = new DateTimeImmutable();
                            $serverName = "domain_name";   
    
                            //check 
                            if($token -> iss !== $serverName || $token -> iat > $now -> getTimestamp() || $token -> exp < $now -> getTimestamp()){
                                header('HTTP/1.1 401 Unauthorized');
                                http_response_code(400);
                                echo json_encode("HTTP/1.1 401 Unauthorized!");
                                exit;
                            }else{
                                // get username 
                                $user -> getUserDetails($token -> username);
                                $userInfo = $user -> data;
                                echo json_encode($userInfo);
                                http_response_code(200);
                            }
                            
                        }else{
                            // No token was able to be extracted (from the authorization header)  
                            http_response_code(400);
                            header('HTTP/1.0 400 Bad Request');
                            echo json_encode('HTTP/1.0 400 Bad Request');
                            exit;
                        }

                       
                    }else{

                        http_response_code(400);
                        header('HTTP/1.0 400 Bad Request');
                        echo json_encode('HTTP/1.0 400 Bad Request');
                        exit;
                    }
 
                }

            }

            if(isset($_REQUEST['email_verify'])){
                $data = json_decode(file_get_contents('php://input'), true); 

                $token = $data["jwt"];
                $verify_code = $data["verify_code"];
               
                if($data){

                    // Find Bearer Token
                    if (preg_match('/Bearer(\s|\S+)/', $token, $matches)) {   
                        //get JWToken
                        $jwt = $matches[1];

                        if ($jwt){

                            //decode JWToken
                            $token = JWT::decode($jwt, new Key($secret_key, 'HS512'));
                            $now = new DateTimeImmutable();
                            $serverName = "domain_name";   
    
                            //check 
                            if($token -> iss !== $serverName || $token -> iat > $now -> getTimestamp() || $token -> exp < $now -> getTimestamp()){
                                header('HTTP/1.1 401 Unauthorized');
                                http_response_code(400);
                                echo json_encode("HTTP/1.1 401 Unauthorized!");
                                exit;
                            }else{
                                $username = $token -> username;
                                // verify email 
                                $result = $user -> verifyEmail($username, $verify_code);
                                if($result){
                                    echo json_encode("Veritiy Success!");
                                    http_response_code(200);
                                }else{
                                    echo json_encode("Veritiy Failed!");
                                    http_response_code(400);
                                }
                                
                            }
                            
                        }else{
                            // No token was able to be extracted (from the authorization header)  
                            http_response_code(400);
                            header('HTTP/1.0 400 Bad Request');
                            echo json_encode('HTTP/1.0 400 Bad Request');
                            exit;
                        }

                       
                    }else{

                        http_response_code(400);
                        header('HTTP/1.0 400 Bad Request');
                        echo json_encode('HTTP/1.0 400 Bad Request');
                        exit;
                    }
                }
            }

        break;

    }

?>