<?php 
session_start();


 ?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="resources/css/style2.css" />
    <title>agencysign-in</title>
</head>
    <body>

<?php
    include 'database/db.php';
    
?>

<nav>
        <ul>
            <li class="drop-menu">
                <a href="#">Menu</a>
                <ul class="drop">

                   
                </ul>
            </li>
            <li><a href="home.html">Home</a></li>
            <li><a href="package.html">tour package</a></li>
            <li><a href="gallery.html">Gallery</a></li>
            <li><a href="hotels-quality.html">Services</a></li>
            <li><a href="contact.html">contact Us</a></li>
            <li><a href="agencies.php">Agency</a></li>
            
          </ul>
    </nav>

<?php
        
    if(isset($_POST['agency_login'])){
        $email = htmlentities($_POST['agency_email']);
        $password = htmlentities($_POST['agency_password']);

        
        if(empty($email) || empty($password) ){
            $_SESSION['error'] = 'Please Fill All Fields';
            header('Location: agencysign-in.php');
            return;
        }


            $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_email = :agency_email');
            $stmt->execute([':agency_email'    => $email ]);
            $agency = $stmt->fetch(PDO::FETCH_ASSOC);

            if($email !== $agency['agency_email']){
                //when email & password doesnot match with database
                $_SESSION['error'] = 'Info is Wrong';
                header('Location: agencysign-in.php');
                return;
            }elseif($email === $agency['agency_email'] ){
                if(password_verify($password, $agency['agency_password'])){

                    $_SESSION['agency_email']  = $agency['agency_email'];
                    $_SESSION['agency_id']  = $agency['agency_id'];
                        header('Location: agency-create-pack2.php');
                        return;

                }else{
                    $_SESSION['error'] = 'Wrong Password';
                    header('Location: agencysign-in.php');
                    return;
                }
            }

    }
?>

<div class="con-signin"> 
        <div class="box-main1">
            <a href="login2.php"> <button type="submit" class="btn-btn">
                    <h3>Tourist</h3>
                  </button></a>
            <a href="agencysign-in.php"> <button type="submit" class="btn-btnn">
                    <h3>Agency</h3>
                  </button></a>
            <h1 style="text-align: center; margin-bottom: 10px">Agency Sign In</h1>
    <form action="" method="post" class=" mx-auto pt-5">
        <div class="flex-box">
                <div class="box-12">
                    <div style="display: flex; margin-bottom: 5px">
                        <img src="resources/images/fb.jpg" alt="" style="width: 50px; height: 50px; border-radius: 5%" />
                        <p style="line-height: 50px; font-size: 25px">&nbsp;Facebook</p>
                    </div>
                    <div style="display: flex">
                        <img src="resources/images/gmail.jpg" alt="" style="width: 50px; height: 50px; border-radius: 5%" />
                        <p style="line-height: 50px; font-size: 25px">&nbsp;Gmail</p>
                    </div>
                </div>
        <div class="box-22">
            <div class="f-group-a">
              <label for="agency_email"><span class="f-size">Email address</span></label>
              <input type="email" class="inp-w-h1" placeholder="Enter your username..." id="" name="agency_email">
        </div>

        <div class="f-group-a">
            <label for="agency_password"><span class="f-size">Password</span></label>
            <input type="password" class="inp-w-h1" placeholder="Enter your password..." id="" name="agency_password">
        </div>
         <h4>
             <a href="agencyregistration.php" style="float: right; color: red"> Don't have an account?</a>
         </h4>   
       <div class="f-group-a">
            <input type="submit" value="Log In" name="agency_login" class="btn btn-e">


        </div>
    </form>
</div>
        </div>

    </body>
    <style>
    .box-main1 {
        background: rgba(105, 100, 100, 0.404);
        color: white;
    }
    
    .con-signin {
        background: url(resources/images/sign-in2.jpg) no-repeat;
        background-size: cover;
        background-blend-mode: multiply;
        background-color: rgba(18, 17, 17, 0.3);
        width: 100%;
        height: 700px;
    }
    
     .btn-btn {
    width: 320px;
     border: none;
    background: rgb(16, 160, 59);
     height: 45px;
    color: white;
    float: left;
       position: absolute;
    border-radius: 4px;
    margin: -65px -20px auto;
       
        
}
    .btn-btnn {
    width: 320px;
     border: none;
    background: rgb(16, 160, 59);
     height: 45px;
    color: white;
    float: right;
       position: absolute;
    border-radius: 4px;
    margin: -65px 300px auto;
    
        
}
    
    .active-pages {
    background: #FF0000;
    border-bottom: 3px solid rgba(209, 45, 16, 0.89);
}
</style>

