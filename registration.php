<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="resources/css/style2.css" />
    <title>touristRegister</title>
</head>
    <body>
<?php
    include 'database/db.php';

   

    //Tourist Insert Query.... Tourist Registration
    if(isset($_POST['tourist_register'])){
        $username   = htmlentities($_POST['tourist_username']);
        $firstname  = htmlentities($_POST['tourist_firstname']);
        $lastname   = htmlentities($_POST['tourist_lastname']);
        $email      = htmlentities($_POST['tourist_email']);
        $contact    = htmlentities($_POST['tourist_contact']);
        $address    = htmlentities($_POST['tourist_address']);
        $date       = date("y.m.d");

        $password   = htmlentities($_POST['tourist_password']);

         //uploading image in images folder
        $profile_img = $_FILES['profile_image']['name'];
        $profile_img_temp = $_FILES['profile_image']['tmp_name'];
        move_uploaded_file($profile_img_temp, "resources/images/$profile_img");

        //Empty Field Validation
        if($username == '' || $firstname == '' || $lastname == '' || $email == '' || $password == ''){
            $_SESSION['error'] = 'Please Fill the Form';
            header('Location: registration.php');
            return;
        }

        //contact no validation
        $tourist_contact = '';
        if(!empty($contact)){
            $pattern = "/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/";
            if(!preg_match($pattern, $contact)){
                $_SESSION['error'] = 'Invalid Contact Info';
                header("Location: registration.php");
                return;
            }else{
                $tourist_contact = $contact;
            }
        }

        //Username Validation
        $stmt = $pdo->prepare('SELECT * FROM tourists WHERE tourist_username = :tourist_username');
        $stmt->execute([':tourist_username' => $username]);
        $tourist_usernames = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $tourist_usernames[] = $row;
        }
        if(!empty($tourist_usernames)){
            $_SESSION['error'] = 'Username already exist. Please try something else';
            header('Location: registration.php');
            return;
        }

        //Email Validation
        $stmt = $pdo->prepare('SELECT * FROM tourists WHERE tourist_email = :tourist_email');
        $stmt->execute([':tourist_email' => $email]);
        $tourist_emails = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $tourist_emails[] = $row;
        }
        if(!empty($tourist_emails)){
            $_SESSION['error'] = 'Email Address already exist. Please try something else';
            header('Location: registration.php');
            return;
        }
        else{
            $hash_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
            $stmt = $pdo->prepare('INSERT INTO tourists(tourist_username, tourist_firstname, tourist_lastname, tourist_email, tourist_password, profile_image, tourist_contact, tourist_address, date) VALUES(:tourist_username, :tourist_firstname, :tourist_lastname, :tourist_email, :tourist_password, :profile_image, :tourist_contact, :tourist_address, :date)');

            $stmt->execute([':tourist_username'    => $username,
                            ':tourist_firstname'   => $firstname,
                            ':tourist_lastname'    => $lastname,
                            ':tourist_email'       => $email,
                            ':tourist_password'    => $hash_password,
                            ':profile_image'       => $profile_img,
                            ':tourist_contact'     => $tourist_contact,
                            ':tourist_address'     => $address,
                            ':date'                => $date]);

            header('Location: login2.php');
            return;
        }
    }

?>

<nav>
        <ul>
            <li class="drop-menu">
                <a href="#">Menu</a>
                <ul class="drop">
<!--                    <li><a href="profile.html">Your profile</a></li>-->
                   
<!--                    <li><a href="tour-scheme.html">Tour Scheme</a></li>-->
<!--                    <li><a href="transport-hotels.html">Hotels & Transportation</a></li>-->
<!--                    <li><a href="reserve-ticket.html">Ticket Availability</a></li>-->
<!--                    <li><a href="logout.php">Logout</a></li>-->
                   
                </ul>
            </li>
            <li><a href="home.html">Home</a></li>
            <li><a href="package2.php">tour package</a></li>
            <li><a href="gallery.html">Gallery</a></li>
            <li><a href="hotels-quality.html">Services</a></li>
            <li><a href="contact.html">contact Us</a></li>
            <li><a href="agencies.php">Agency</a></li>
            
          </ul>
    </nav>
<div class="con-register">
        <div class="box box-main22">
    <a href="registration.php"> <button type="submit" class="btn-btn">
                    <h3>Tourist</h3>
                  </button></a>
            <a href="agencyregistration.php"> <button type="submit" class="btn-btnn">
                    <h3>Agency</h3>
                  </button></a>
            
            <h1 style="text-align: center"> Tourist Register</h1>
    <form action="" method="post" enctype="multipart/form-data" class="col-md-8 mx-auto mb-5">
    
   
        
        <div class="f-group">
            <label for="tourist_username"><span class="f-size">Username</span></label>
            <input type="text" class="inp-w-h1" placeholder="Enter your Username..." id="" name="tourist_username">
        </div>
        <div class="f-group">
            <label for="tourist_firstname"><span class="f-size">First Name</span></label>
            <input type="text" class="inp-w-h1" placeholder="Enter your first name..." id="" name="tourist_firstname">
        </div>
        <div class="f-group">
            <label for="tourist_lastname"><span class="f-size">Last Name</span></label>
            <input type="text" class="inp-w-h1" placeholder="Enter your last name..." id="" name="tourist_lastname">
        </div>
        <div class="f-group">
            <label for="tourist_email"><span class="f-size">Email address</span></label>
            <input type="email" class="inp-w-h1" placeholder="Enter your email address..." id="" name="tourist_email">
        </div>
       <div class="f-group">
            <label for="tourist_password"><span class="f-size">Password</span></label>
            <input type="password" class="inp-w-h1" placeholder="Enter your password..." id="" name="tourist_password">
        </div>
        <div class="f-group">
            <label for="tourist_contact"><span class="f-size">Contact</span></label>
            <input type="text" class="inp-w-h1" placeholder="Enter your contact number..." id="" name="tourist_contact">
        </div>
        <div class="f-group">
            <label for="tourist_address"><span class="f-size">Address</span></label>
            <input type="text" class="inp-w-h1" placeholder="Enter your address..." id="" name="tourist_address">
        </div>
        <div class="f-group">
            <label for="profile_image"><span class="f-size">Profile Picture</span></label><br>
            <input type="file" id="" name="profile_image">
        </div>
         <h4>
                <a href="login2.php" style="float: left; color: red;margin-left: 150px;"> Already have an account?</a>
            </h4>

        <button style="margin: 10px;" input type="submit" value="Register" name="tourist_register" class="btn">Submit</button>
            
        
    </form>
</div>
        </div>
    </body>

 <style>
        .box-main22 {
            background: rgba(41, 49, 42, 0.7);
            color: white;
        }
        
        .con-register {
            background: url(resources/images/sign-in2.jpg) no-repeat;
            background-size: cover;
            background-blend-mode: multiply;
            background-color: rgba(18, 17, 17, 0.3);
            width: 100%;
            height: 700px;
        }
            .btn-btn {
    width: 260px;
     border: none;
    background: rgb(16, 160, 59);
     height: 45px;
    color: white;
    float: left;
       position: absolute;
    border-radius: 4px;
    margin: -65px -10px auto;
       
        
}
    .btn-btnn {
    width: 260px;
     border: none;
    background: rgb(16, 160, 59);
     height: 45px;
    color: white;
    float: right;
       position: absolute;
    border-radius: 4px;
    margin: -65px 250px auto;
    
        
}
    </style>