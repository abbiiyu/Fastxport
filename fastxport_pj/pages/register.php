<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up page</title>
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="../logo.png" alt="Logo" />
        </div>
        <ul class="tulisan-navbar">
            <li><a href="product.html">Product</a></li>
            <li><a href="joinassupplier.html">Join as Supplier</a></li>
            <li><a href="#">Expedition</a></li>
            <li><a href="#">Help</a></li>
        </ul>
        <button class="login-button" onclick="window.location.href='login.html'">Sign In</button>
    </nav>
    <div class="coba">
    <div class="wrapper">
        <h1>Sign Up</h1>

        <form action="" class="form">    
            <div class="input-box">
            <p>Country / State</p><input class="country" type="text" placeholder="Enter your country / region" required>
            </div>            
            <div class="input-box">
            <p>Email</p><input class="email" type="text" placeholder="Enter your email" required>
            </div>
            <div class="input-box">
            <p>Enter Password   </p><input type="text" placeholder="Enter your password" required>
            </div>
            <div class="input-box">
            <p>Confirm Password </p><input class="confirm" type="text" placeholder="Confirm your password" required>
            </div>
            <br>
            <br>
            <div class="input-box">
                <p>full Name</p><input class="name" type="text" placeholder="Enter your full name" required>
            </div>
            <div class="input-box">
                <p>Telp</p><input class="no" type="text" placeholder="Enter your telephone number" required>
            </div>    
            <div class="remember-forgot">
                <label><input type="checkbox">i agree to the terms and privacy policy. i agree to <br> obtain further information about products and <br> services from Fastxport</label>
                <br>
                <br>
            </div>
            <div class="button">
                <a href="signsucces.html" class="button1">Submit</a>
            </div>
            
        
        </form>

    </div>
    </div> 
</body>
</html>