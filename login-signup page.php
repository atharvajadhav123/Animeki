<?php
$login = false;
$showError = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['request_type']) && $_POST['request_type'] == 'signup') {
    // Handle the form submission here}
    include'partials/_dbconnect.php';
    $username=$_POST["username"];
    $password=$_POST["password"];
    $phone_no=$_POST["phoneno"];
    $email=$_POST["email"];
    $address=$_POST["address"];
    //check whether username exists
    $existSql = "SELECT * FROM `users` WHERE email = '$email'";
    $result = mysqli_query($conn, $existSql);
    $numExitRows = mysqli_num_rows($result);
    if($numExitRows > 0){
        $showError ="Email Already in use...";
    }
    else{
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql="INSERT INTO `users` ( `username`, `password`, `dt`, `phoneno`, `email` ,`address`) VALUES ( '$username', '$hash', current_timestamp(), '$phone_no', '$email' ,'$address')";
        $result = mysqli_query($conn, $sql);
                
    }
    
}
elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['request_type']) && $_POST['request_type'] == 'login') {
    include'partials/_dbconnect.php';
    $email=$_POST["email"];
    $password=$_POST["password"];
    $sql="select * from users where email='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 1)
    {
        while($row = mysqli_fetch_assoc($result)){
            if(password_verify($password,$row['password'])){
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $row['username'];
                $_SESSION['userid'] = $_POST['sno'];
                header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
                header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
                header("location: FoodyHomePage.php");
            }
            else{
                $showError= "Invalid Credentials";
            }
        }
    }    
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YUMMY TUMMY login</title>

    <link rel="stylesheet" href="css/loginstyle.css">
</head>

<body>

    <header>


        <svg class="#gfg" width="40" height="32" role="img" aria-label="Bootstrap">
            <use xlink:href="#bootstrap"></use>
        </svg>

    </header>
    <div class="wrapper">
        <span class="icon-close">
            <a href='<?php $_SERVER['REQUEST_URI']?>'>
                <ion-icon name="close"></ion-icon>
            </a>
        </span>
        <div class="form-box login">
            <?php
                if($showError)
                {
                  echo''.$showError.'';  
                }
                else echo'<h2>Login</h2>';
                ?>
            <form action="<?php $_SERVER['REQUEST_URI'] ?>?request_type=login" method="post">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail-open"></ion-icon>
                    </span>
                    <input type="email" required name="email">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                    <input type="hidden" name="request_type" value="login">
                </div>
                <div class="remember-forget">
                    <label><input type="checkbox">Remember Me</label>
                    <a href="#">Forget Password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="login-register">
                    <p>Don't have an account?<a href="#" class="register-link">Register</a></p>
                </div>
            </form>
        </div>
        <div class="form-box register">
            <h2>Register</h2>
            <form action="<?php $_SERVER['REQUEST_URI'] ?>?request_type=signup" method="post">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input type="text" required name="username">
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="call"></ion-icon>
                    </span>
                    <input type="text" required name="phoneno">
                    <label>Mobile Number</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail-open"></ion-icon>
                    </span>
                    <input type="email" required name="email">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" name="password" required>
                    <input type="hidden" name="request_type" value="signup">
                    <label>Password</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input type="text" required name="address">
                    <label>Address</label>
                </div>
                <div class="remember-forget">
                    <label><input type="checkbox">I agree to terms & conditions</label>
                </div>
                <button type="submit" class="btn">Register</button>
                <div class="login-register">
                    <p>Already have an account?<a href="#" class="register-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>


    <script src="js/loginjs.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>