<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!--    <link rel="stylesheet" href="resources/css/style2.css" />-->
    <title>AgencyRegistration</title>
</head>

<body>



<?php
    include 'database/db.php';
    

    //Agency Insert Query... Agency Registration
    if(isset($_POST['agency_register'])){
        $agency_name     = htmlentities($_POST['agency_name']);
        $agency_firstname = htmlentities($_POST['agency_firstname']);
        $agency_lastname  = htmlentities($_POST['agency_lastname']);
        $agency_email    = htmlentities($_POST['agency_email']);
        $agency_contact  = htmlentities($_POST['agency_contact']);
        $agency_address  = htmlentities($_POST['agency_address']);
//        $date            = date("y.m.d");

        $agency_password = htmlentities($_POST['agency_password']);
        
        $agency_profile_image = '';
        var_dump($_FILES);
          //uploading image in images folder
        $agency_profile_img = $_FILES['agency_profile_image']['name'];
        $agency_profile_img_temp = $_FILES['agency_profile_image']['tmp_name'];
        move_uploaded_file($agency_profile_img_temp, "resources/images/$agency_profile_img");
        $agency_profile_image = $agency_profile_img;
        var_dump($agency_profile_image);
        
        //Empty Field Validation
        if($agency_name == '' || $agency_firstname == '' || $agency_lastname == '' || $agency_email == '' || $agency_password == '' || $agency_contact == '' || $agency_address == ''){
            $_SESSION['error'] = 'All fields are required';
            header('Location: agencyregistration.php');
            return;
        }

        //contact no validation
        $pattern = "/(^(\+88|0088)?(01){1}[23456789]{1}(\d){8})$/";
        $contact = '';
        if(!preg_match($pattern, $agency_contact)){
            $_SESSION['error'] = 'Invalid Contact Info';
            header("Location: agencyregistration.php");
            return;
        }else{
            $contact = $agency_contact;
        }

        //Agency Name Validation
        $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_name = :agency_name');
        $stmt->execute([':agency_name' => $agency_name]);
        $agency_names = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $agency_names[] = $row;
        }
        if(!empty($agency_names)){
            $_SESSION['error'] = 'Agency Name already exist. Please try something else';
            header('Location: agencyregistration.php');
            return;
        }

        //Agency email Validation
        $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_email = :agency_email');
        $stmt->execute([':agency_email' => $agency_email]);
        $agency_emails = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $agency_emails[] = $row;
        }
        if(!empty($agency_emails)){
            $_SESSION['error'] = 'Email Address already exist. Please try something else';
            header('Location: agencyregistration.php');
            return;
        }
        else{
            
            $hash_password = password_hash($agency_password, PASSWORD_BCRYPT, ['cost' => 12]);
            $stmt = $pdo->prepare('INSERT INTO agencies(agency_name, agency_firstname, agency_lastname, agency_email, agency_password, agency_profile_image, agency_contact, agency_address) VALUES(:agency_name, :agency_firstname, :agency_lastname, :agency_email, :agency_password, :agency_profile_image, :agency_contact, :agency_address)');
             
            $stmt->execute([':agency_name'      => $agency_name,
                            ':agency_firstname' => $agency_firstname,
                            ':agency_lastname'  => $agency_lastname,
                            ':agency_email'     => $agency_email,
                            ':agency_password'  => $hash_password,
//                            ':profile_image'    => ' ',
                            ':agency_profile_image'    => $agency_profile_image,
                            ':agency_contact'   => $contact,
                            ':agency_address'   => $agency_address
                            ]);

            $_SESSION['success'] = 'Your Registration has been submitted to Admin';
            header('Location: agencysign-in.php');
            return;
        }
    }

?>

<nav>
        <ul>
            <li class="drop-menu">
                <a href="#">Menu</a>
                <ul class="drop">
                   
                </ul>
            </li>
            <li><a  href="home.html">Home</a></li>
            <li><a href="package.html">tour package</a></li>
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
            
            <h1 style="text-align: center">Agency Register</h1>
    <form action="" method="post"  enctype="multipart/form-data" class="mx-auto col-md-8">
        
        <div class="f-group">
            <label for="agency_name"><span class="f-size">Agency Name</span></label>
            <input type="text" class="inp-w-h1" placeholder="Enter your Agency name..." id="" name="agency_name">
        </div>
        <div class="f-group">
            <label for="agency_firstname"><span class="f-size">First Name</span></label>
            <input type="text" class="inp-w-h1" placeholder="Enter your first name..." id="" name="agency_firstname">
        </div>
        <div class="f-group">
            <label for="agency_lastname"><span class="f-size">Last Name</span></label>
            <input type="text" class="inp-w-h1" placeholder="Enter your last name..." id="" name="agency_lastname">
        </div>
        <div class="f-group">
            <label for="agency_email"><span class="f-size">Email</span></label>
            <input type="email" class="inp-w-h1" placeholder="Enter your email address..." id="" name="agency_email">
        </div>
        <div class="f-group">
            <label for="agency_password"><span class="f-size">Password</span></label>
            <input type="password" class="inp-w-h1" placeholder="Enter your password..." id="" name="agency_password">
        </div>
        <div class="f-group">
            <label for="agency_contact"><span class="f-size">Contact</span></label>
            <input type="text" class="inp-w-h1" placeholder="Enter your contact number..." id="" name="agency_contact">
        </div>
        <div class="f-group">
            <label for="agency_address"><span class="f-size">Address</span></label>
            <input type="text" class="inp-w-h1" placeholder="Enter agency address..." id="" name="agency_address">
        </div>
         <div class="f-group">
            <label for="agency_profile_image"><span class="f-size">Profile Picture</span></label><br>
            <input type="file" id="" name="agency_profile_image">
        </div>
         <h4>
                <a href="agencysign-in.php" style="float: left; color: red;margin-left: 150px;"> Already have an account?</a>
            </h4>
<!--        <div class="form-group p-2">-->
        <button style="margin: 10px;" input type="submit" value="Register" name="agency_register" class="btn">Submit</button>

<!--            <a href="../index.php" type="button" class="btn btn-secondary float-right">Cancel</a>-->
<!--        </div>-->
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
        
         @import url("https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;700&display=swap");
* {
    margin: 0;
    padding: 0;
    font-family: "Raleway", sans-serif;
}
        
      /* register page css */  
        .btn {
    border: none;
    background: rgb(16, 160, 59);
    width: 120px;
    height: 45px;
    color: white;
    /* margin-left: 140px;
         */
    float: right;
    border-radius: 4px;
    margin-top: 20px;
}

.box {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border: 2px solid rgb(71, 107, 82);
    padding: 10px;
    border-radius: 10px;
}

.f-size {
    font-size: 20px;
}

label {
    width: 30%;
    margin-top: 10px;
}

.f-group {
    width: 500px;
    display: flex;
}

.inp-w-h1 {
    padding: 10px 20px;
    width: 70%;
    border-radius: 5px;
    margin: 5px;
}
        
        /* new css */

.card-d {
    width: 400px;
    margin: auto;
    text-align: center;
    line-height: 1.5;
    margin-top: 50px;
    border: 0.03px solid gray;
    border-radius: 5px;
}

.img-profile {
    height: 100px;
    width: 100px;
    margin: auto;
    border-radius: 50%;
}

.mt {
    margin-bottom: 10px;
}


/* navbar css */

nav {
    background: #0984e3;
}

ul {
    list-style: none;
    width: 800px;
    margin: auto;
    display: flex;
}

ul li {
    display: inline-block;
    margin-left: 2px;
}

ul li a {
    padding: 15px 20px;
    display: inline-block;
    text-decoration: none;
    color: white;
    text-transform: capitalize;
    text-align: center;
    font-size: 18px;
}

ul li a:hover {
    background: #74b9ff;
}

.drop-menu {
    position: relative;
}

.active-page {
    background: #74b9ff;
    border-bottom: 3px solid rgba(209, 45, 16, 0.89);
}

.drop {
    position: absolute;
    background: #0984e3;
    width: 150px;
    display: block;
    border-radius: 5px;
    left: 0;
    margin-top: 1px;
    z-index: 1;
    display: none;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    -ms-border-radius: 5px;
    -o-border-radius: 5px;
}

.drop li {
    display: block;
    margin-left: -1px;
}

.drop li a {
    display: block;
    font-size: 16px;
    text-align: left;
    padding: 8px 10px !important;
}

ul li:hover>a {
    background: #74b9ff;
}

ul .drop-menu:hover .drop {
    display: block;
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