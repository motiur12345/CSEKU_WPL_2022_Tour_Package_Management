<?php 
session_start();


 ?>
<?php
    include 'database/db.php';
    include 'includes/functions.php';

    if(empty($_SESSION['tourist_login']) || $_SESSION['tourist_login'] == ''){
        header('Location: login2.php');
        return;
    }

    if(isset($_SESSION['tourist_id'])){
        $tourist_id = $_SESSION['tourist_id'];

        $tourist = readTourist($tourist_id);
    }
?>
<?php
   
    if(isset($_SESSION['tourist_id'])){
        if(isset($_GET['edit'])){
            $tourist_id = $_GET['edit'];

            $stmt = $pdo->prepare('SELECT * FROM tourists WHERE tourist_id = :tourist_id');
            $stmt->execute([':tourist_id' => $tourist_id]);
            $tourist = $stmt->fetch(PDO::FETCH_ASSOC);
        
            $username           = $tourist['tourist_username'];
            $tourist_email      = $tourist['tourist_email'];
            $tourist_status     = $tourist['tourist_status'];
            $tourist_date       = $tourist['date'];
//            $tourist_stripe_id  = $tourist['tourist_stripe'];

            if(isset($_POST['update_profile'])){
                $firstname  = htmlentities($_POST['tourist_firstname']);
                $lastname   = htmlentities($_POST['tourist_lastname']);
                $contact    = htmlentities($_POST['tourist_contact']);
                $address    = htmlentities($_POST['tourist_address']);

                $password   = htmlentities($_POST['tourist_password']);

                $tourist_stripe = $stripe->customers->update(
                    $tourist_stripe_id,
                    ['name'  => $firstname." ".$lastname,
                    'email'  => $tourist_email]
                );

                //uploading image in images folder
                $profile_img = $_FILES['profile_image']['name'];
                $profile_img_temp = $_FILES['profile_image']['tmp_name'];
                move_uploaded_file($profile_img_temp, "images/$profile_img");
                if(empty($profile_img)){
                    $stmt = $pdo->prepare('SELECT * FROM tourists WHERE tourist_id = :tourist_id');
                    $stmt->execute(array(':tourist_id' => $tourist_id));
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $profile_img = $row['profile_image'];
                    }
                }

                //contact no validation
                $tourist_contact = '';
                if(!empty($contact)){
                    $pattern = "/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/";
                    if(!preg_match($pattern, $contact)){
                        $_SESSION['error'] = 'Invalid Contact Info';
                        header("Location: profile.php?page=edit_profile&edit=". $tourist_id);
                        return;
                    }else{
                        $tourist_contact = $contact;
                    }
                }

                //Empty Field Validation
                if($firstname == '' || $lastname == '' || $password == ''){
                    $_SESSION['error'] = 'Please Fill the Form';
                    header('Location: profile.php?page=edit_profile&edit='. $tourist_id);
                    return;
                }else{
                    $hash_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

                    $stmt = $pdo->prepare('UPDATE tourists SET tourist_username = :tourist_username, tourist_firstname = :tourist_firstname, tourist_lastname = :tourist_lastname, tourist_email = :tourist_email, tourist_password = :tourist_password, profile_image = :profile_image,  tourist_contact = :tourist_contact, tourist_address = :tourist_address WHERE tourist_id = :tourist_id');

                    $stmt->execute([
                                    ':tourist_id'          => $tourist_id,
                                    ':tourist_username'    => $username,
                                    ':tourist_firstname'   => $firstname,
                                    ':tourist_lastname'    => $lastname,
                                    ':tourist_email'       => $tourist_email,
                                    ':tourist_password'    => $hash_password,
                                    ':profile_image'       => $profile_img,
                                    ':tourist_contact'     => $tourist_contact,
                                    ':tourist_address'     => $address,
                                    ]);

                    $_SESSION['success'] = 'Your Info has been Updated';
                    header('Location: profile.php');
                    return;
                }
            }
        }
            
    }
?>
<head>
    <title>Edit profile</title>
    <link rel="stylesheet" type="text/css" href="resources/css/style.css">
<!--    <link rel="stylesheet" type="text/css" href="resources/css/style2.css">-->

</head>
<body>
    

<nav>
        <ul>
            <li class="drop-menu">
                <a href="#">Menu</a>
                <ul class="drop">
<!--                    <li><a href="profile.html">Your profile</a></li>-->
                    
<!--                    <li><a href="tour-scheme.html">Tour Scheme</a></li>-->
                   <li><a href="transport-hotels.html">Hotels & Transportation</a></li>
<!--                   <li><a href="reserve-ticket.html">Ticket Availability</a></li>-->
                  <li><a href="logout.php">Logout</a></li>
                   
                </ul>
            </li>
            <li><a  href="home.html">Home</a></li>
            <li><a href="package2.php">tour package</a></li>
            <li><a href="gallery.html">Gallery</a></li>
            <li><a href="hotels-quality.html">Services</a></li>
            <li><a href="contact.html">contact Us</a></li>
            <li><a href="agencies.php">Agency</a></li>
            
          </ul>
    </nav>
    
<center>
        <div class="box">
<?php
        include 'includes/flash_msg.php';
 ?>
    

            <img src="resources/images/<?php echo $tourist['profile_image']; ?>"  alt="<?php echo $tourist['tourist_username']; ?>" >
            <p> <a href="#" class="edit-img"> Edit image </a></p>
            <input type="file" id="" name="profile_image">
<!--            <label for="profile_image">EDIT PIC</label>-->
            <input type="text" value="<?php echo $tourist['tourist_firstname']; ?>" id="" placeholder="First name" name="tourist_firstname">
            <input type="text" value="<?php echo $tourist['tourist_lastname']; ?>" id="" placeholder="Last name" name="tourist_lastname">
<!--            <input type="email" value="" id="" placeholder="Email name" name="user_email">-->
            <input type="password" value="" id="" placeholder="Password" name="tourist_password">
            <input type="text" value="<?php echo $tourist['tourist_contact']; ?>" id="" placeholder="Contact" name="tourist_contact">
            <input type="text" value="<?php echo $tourist['tourist_address']; ?>" id="" placeholder="Address" name="tourist_address">
<!--            <input type="submit" value="Update" name="update_profile" class="btn btn-primary">-->
            <a href="profile.php"><button style="float:left;margin:10px 0 0 18.2%;">CANCEL</button></a>
            <a href="profile.php"><button style="float:right;margin:10px 18.2% 0 0;" input type="submit" name="update_profile">DONE</button></a>
<!--            <a href="profile.php" type="button" class="btn btn-secondary float-right">Cancel</a>-->

<!--    </form>-->
</div>
    </center>
</body>
<style>

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
    
    </style>